#!/usr/bin/env node
/**
 * Hgv YAML Configuration Generator
 *
 * @author WPEngine
 */

'use strict';

/**
 * Module dependencies
 */
var fs = require( 'fs' ),
	path = require( 'path' ),
	chalk = require( 'chalk' ),
	rootCheck = require( 'root-check' );

/**
 * Command line arguments
 */
var argv = process.argv.slice( 2 );

/**
 * Just some fun ASCII art for Hgv consistency
 */
function pre() {
	console.log( require( './lib/header' ) );

	// Check to see if our config file exists. If so, only proceed if --force is set.
	fs.stat( '.mercuryrc', function( err, stat ) {
		if ( err !== null ) {
			// The file doesn't exist, so start things up.
			init();
		} else {
			process.stdout.write( '\n' );
			process.stdout.write( '    ' + chalk.red( 'WARNING!' ) + '\n' );
			process.stdout.write( '    ' + chalk.yellow( 'Your installation already has a ' + chalk.cyan( '.mercuryrc' ) + ' file.\n' ) );

			// The file exists! Check for the --force flag.
			if ( argv.indexOf( '--force' ) > -1 ) {
				init();
			} else {
				// Explain how to use the tool.
				process.stdout.write( '\n' );
				process.stdout.write( '    To overwrite this file, add the ' + chalk.bold( '--force' ) + ' flag to the ' + chalk.bold( '/script/start' ) + '\n' );
				process.stdout.write( '    command to re-run the generator and update the existing values.\n' );

				// Exit with an error code.
				process.exit( 1 );
			}
		}
	} );
}

/**
 * Initialize the prompting machine.
 */
function init() {

}

/**
 * If the user is running as root, warn them
 */
rootCheck(
	'\n' +
	chalk.red('Be careful using the `sudo` command.') +
	'\n\nSince `start` is a user command, there is no need to execute it with root\n' +
	'permissions. If you\'re having permission errors when running without sudo,\n' +
	'please spend a few minutes learning more about how your system should work\n' +
	'and make any necessary repairs.'
);

/**
 * Fire off the generator
 */
pre();