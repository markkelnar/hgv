/**
 * HGV Requirements Scanner
 *
 * @author WPEngine
 */

'use strict';

/**
 * Module dependencies
 */
var exec = require( 'child_process' ).exec,
	chalk = require( 'chalk' ),
	compareVersion = require( 'compare-version' ),
	util = require( 'util' ),
	Promise = require( 'promise' ),
	error = require( './error' );

/**
 * Module variables
 */
var messages = [ '' ];

/**
 * Convert non-standard version strings to something we can use in comparisons.
 *
 * @param {String} raw
 *
 * @returns {String}
 */
function parseVersion( raw ) {
	return raw.replace( /[^\d|^\.]/g, '' );
}

/**
 * Ensure we're running the right version of Vagrant.
 *
 * @uses parseVersion `vagrant -v` returns something like "Vagrant 1.7.4" so we need to strip the string
 *
 * @returns {Promise}
 */
function checkVagrant() {
	return new Promise( function( fulfill, reject ) {
		var vagrant_check = exec( 'vagrant -v', function( err, stdout, stderr ) {
			if ( err ) {
				messages.push( chalk.red( 'No installation of Vagrant is detected!' ) );
			} else {
				var vagrantVer = parseVersion( stdout ),
					minRequired = '1.7.2';

				if ( compareVersion( minRequired, vagrantVer ) > 0 ) {
					messages.push( chalk.red( util.format( 'Vagrant v%s is installed. You need at least v%s!', vagrantVer, minRequired ) ) );
				} else {
					messages.push( chalk.green( util.format( 'Vagrant v%s looks good!', vagrantVer )  ) );
				}
			}
		} );

		vagrant_check.on( 'close', fulfill );
	} );
}

/**
 * Check VirtualBox requirements.
 *
 * @returns {Promise}
 */
function checkVM() {
	return new Promise( function( fulfill, reject ) {
		var vm_check = exec( 'VBoxManage --version', function( err, stdout, stderr ) {
			if ( err ) {
				messages.push( chalk.red( 'No installation of VirtualBox is detected!' ) );
				if ( /^win/.test( process.platform ) ) {
					messages.push( chalk.gray( 'You appear to be on Windows. If Hyper-V is enabled, you\'re good to go.' ) );
				}
			} else {
				var vboxVer = stdout.trim(), // `--version` returns just the version number and a newline
					minRequired = '4.3.20';

				if ( compareVersion( minRequired, vboxVer ) > 0 ) {
					messages.push( chalk.red( util.format( 'VirtualBox v%s is installed. You need at least v%s!', vboxVer, minRequired ) ) );
				} else {
					messages.push( chalk.green( util.format( 'VirtualBox v%s looks good!', vboxVer ) ) );
				}
			}
		} );

		vm_check.on( 'close', fulfill );
	} );
}

/**
 * Ensure we're running the right version of Node.
 *
 * @uses parseVersion `node -v` returns something like "v0.12.7" so we need to strip the non-numeric character
 *
 * @returns {Promise}
 */
function checkNode() {
	return new Promise( function( fulfill, reject ) {
		var node_check = exec( 'node -v', function( err, stdout, stderr ) {
			if ( err ) {
				messages.push( chalk.red( 'No installation of Node is detected - which is bizarre as this is a Node app!' ) );
			} else {
				var nodeVer = parseVersion( stdout ),
					minRequired = '0.12.7';

				if ( compareVersion( minRequired, nodeVer ) > 0 ) {
					messages.push( chalk.red( util.format(  'Node v%s is installed. You need at least v%s!', nodeVer, minRequired ) ) );
				} else {
					messages.push( chalk.green( util.format( 'Node v%s looks good!', nodeVer ) ) );
				}
			}
		} );

		node_check.on( 'close', fulfill );
	} );
}

/**
 * Let the user know that preflight is complete.
 */
function complete() {
	var message = messages.concat( [
		'',
		'HGV is finished scanning your local environment!',
		'',
		'For any further help with your environment, please view the HGV wiki',
		'on GitHub: ' + chalk.green( '<https://github.com/wpengine/hgv/wiki>' ),
		'',
		''
	] ).join( '\n' );

	process.stderr.write( message );

	process.exit( 0 );
}

/**
 * Check system compatibility
 */
Promise.all( [ checkVagrant(), checkVM(), checkNode() ] )
	.then( complete );