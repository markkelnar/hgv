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
	os = require( 'os' ),
	chalk = require( 'chalk' ),
	compareVersion = require( 'compare-version' ),
	semver = require( 'semver' ),
	util = require( 'util' ),
	Promise = require( 'promise' ),
	error = require( './error' );

/**
 * Module variables
 */
var messages = [ ''],
	symbols = {
		ok : '✓',
		err: '✖'
	};

if ( /^win/.test( process.platform ) ) {
	symbols = {
		ok : '\u221A',
		err: '\u00D7'
	};
}

/**
 * Test a dependency to make sure the minimum version is installed.
 *
 * @param {String}   name       Name of the dependency to test
 * @param {String}   minVersion Minimum version allowed
 * @param {String}   command    Command line instruction to fetch the version
 * @param {Function} [filter]   Optional filter callback
 * @param {Function} [onError]  Optional error handler when tool is not installed
 *
 * @returns {Promise}
 */
function checkDependency( name, minVersion, command, filter, onError ) {
	if ( undefined === filter ) {
		filter = semver.clean;
	}

	return new Promise( function( fulfill, reject ) {
		var check = exec( command, function( err, stdout, stderr ) {
			if ( err ) {
				process.stdout.write( '  ' + chalk.red( symbols.err ) + '  ' + chalk.gray( util.format( 'No installation of %s is detected!', name ) ) + os.EOL );

				if ( onError ) {
					onError.apply( null, [name] );
				}
			} else {
				var version = filter.apply( null, [stdout] );

				if ( compareVersion( minVersion, version ) > 0 ) {
					process.stdout.write( '  ' + chalk.red( symbols.err ) + '  ' + chalk.gray( util.format( '%s ' + chalk.red( 'v%s' ) + ' is installed. You need at least ' + chalk.white( 'v%s' ) + '!', name, version, minVersion ) ) + os.EOL );
				} else {
					process.stdout.write( '  ' + chalk.green( symbols.ok ) + '  ' + chalk.gray( util.format( '%s ' + chalk.green( 'v%s' ) + ' looks good!', name, version ) ) + os.EOL );
				}
			}
		} );

		check.on( 'close', fulfill );
	} );
}

/**
 * Hyper-V users don't necessarily need VirtualBox, so let's make sure we let them know that.
 */
function windowsTest() {
	if ( /^win/.test( process.platform ) ) {
		messages.push( chalk.gray( 'You appear to be on Windows. If Hyper-V is enabled, you\'re good to go.' ) );
	}
}

function checkGhost() {
	return new Promise( function( fulfill, reject ) {
		var check = exec( 'vagrant plugin list', function( err, stdout, stderr ) {
			if ( err ) {
				process.stdout.write( '  ' + chalk.red( symbols.err ) + '  ' + chalk.gray( 'Unable to detect any Vagrant plugins.' ) + os.EOL );
			} else {
				var hasGhost = false,
					ghostVersion,
					minVersion = '0.2.1',
					plugins = stdout.split( os.EOL );

				for ( var i = 0; i < plugins.length; i++ ) {
					var plugin = plugins[ i ];

					if ( plugin.indexOf( 'vagrant-ghost' ) === 0 ) {
						hasGhost = true;
						ghostVersion = semver.clean( plugin.trim().replace( /vagrant-ghost/i, '' ).replace( /\(|\)/g, '' ) );
					}
				}

				if ( ! hasGhost ) {
					process.stdout.write( '  ' + chalk.gray( symbols.err + '  The Vagrant Ghost plugin (recommended) was not detected!' ) + os.EOL );
				} else {
					if ( compareVersion( minVersion, ghostVersion ) > 0 ) {
						process.stdout.write( '  ' + chalk.red( symbols.err ) + '  ' + chalk.gray( util.format( 'Vagrant Ghost ' + chalk.red( 'v%s' ) + ' is installed. You need at least ' + chalk.white( 'v%s' ) + '!', ghostVersion, minVersion ) ) + os.EOL );
					} else {
						process.stdout.write( '  ' + chalk.green( symbols.ok ) + '  ' + chalk.gray( util.format( 'Vagrant Ghost ' + chalk.green( 'v%s' ) + ' looks good!', ghostVersion ) ) + os.EOL );
					}
				}
			}
		} );

		check.on( 'close', fulfill );
	} );
}

/**
 * Let the user know that preflight is complete.
 */
function complete() {
	var message = [
		'',
		'HGV is finished scanning your local environment!',
		'',
		'For any further help with your environment, please view the HGV wiki',
		'on GitHub: ' + chalk.green( '<https://github.com/wpengine/hgv/wiki>' ),
		'',
		''
	].join( os.EOL );

	process.stdout.write( message );

	process.exit( 0 );
}

var init_message = [
	'',
	'HGV is scanning your local environment ...',
	''
].join( os.EOL );

process.stdout.write( init_message );

/**
 * Check system compatibility
 */
Promise.all(
	[
		checkDependency( 'Vagrant',    '1.7.4',  'vagrant -v',           function( raw ) { return semver.clean( raw.replace( /vagrant/i, '' ) ); } ),
		checkDependency( 'VirtualBox', '4.3.20', 'VBoxManage --version', function( raw ) { return raw.trim(); }, windowsTest ),
		checkDependency( 'Node',       '0.12.7', 'node -v' ),
		checkDependency( 'Git',        '1.9.3',  'git --version',        function( raw ) { return semver.clean( raw.trim().replace( /git version/i, '' ).split( '.' ).slice( 0, 3 ).join( '.' ) ); } ),
		checkGhost()
	] )
	.then( complete );