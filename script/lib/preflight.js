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
	semver = require( 'semver' ),
	util = require( 'util' ),
	Promise = require( 'promise' ),
	error = require( './error' );

/**
 * Module variables
 */
var messages = [ '' ];

/**
 * Test a dependency to make sure the minimum version is installed.
 *
 * @param {String}   name       Name of the dependency to test
 * @param {String}   minVersion Minimum version allowed
 * @param {String}   command    Command line instruction to fetch the version
 * @param {Function} [filter]   Optional filter callback
 *
 * @returns {Promise}
 */
function checkDependency( name, minVersion, command, filter ) {
	if ( undefined === filter ) {
		filter = semver.clean;
	}

	return new Promise( function( fulfill, reject ) {
		var check = exec( command, function( err, stdout, stderr ) {
			if ( err ) {
				messages.push( chalk.red( util.format( 'No installation of %s is detected!', name ) ) );
			} else {
				var version = filter.apply( null, [stdout] );

				if ( compareVersion( minVersion, version ) > 0 ) {
					messages.push( chalk.red( util.format( '%s v%s is installed. You need at least v%s!', name, version, minVersion ) ) );
				} else {
					messages.push( chalk.green( util.format( '%s v%s looks good!', name, version ) ) );
				}
			}
		} );

		check.on( 'close', fulfill );
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
Promise.all(
	[
		checkDependency( 'Vagrant', '1.7.4', 'vagrant -v', function( raw ) { return semver.clean( raw.replace( /vagrant/i, '' ) ); } ),
		checkVM(),
		checkDependency( 'Node', '0.12.7', 'node -v' ),
		checkDependency( 'Git', '1.9.3', 'git --version', function( raw ) { return semver.clean( raw.trim().replace( /git version/i, '' ).split( '.' ).slice( 0, 3 ).join( '.' ) ); } )
	] )
	.then( complete );