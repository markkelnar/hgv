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
	extend = require( 'util' )._extend,
	chalk = require( 'chalk' ),
	rootCheck = require( 'root-check' ),
	yaml = require( 'yamljs' );

/**
 * Default values for the YAML file
 */
var defaults = {
	environment: 'staging',
	domain     : 'testing'
};

/**
 * Object container that will be serialized to YAML.
 */
var settings = {};

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
				process.stdout.write( '    ' + chalk.yellow( 'This utility will update the existing file\'s settings.\n' ) );

				// Parse the existing file and store it in the default array
				yaml.load( '.mercuryrc', function( result ) {
					// Merge our parameters
					defaults = extend( defaults, result );

					// Start things up
					init();
				} );
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
	

	// Once we're done, finalize the YAML file
	finalize();
}

/**
 * Write out our generated YAML file.
 */
function finalize() {
	var yaml_string = yaml.stringify( settings );

	fs.writeFile( '.mercuryrc', yaml_string, function( err ) {
		if ( err ) {
			process.stderr.write( err.toString() );
		} else {
			process.stdout.write( '    ' + chalk.green( 'All settings sucessfully saved!\n' ) );
			process.exit();
		}
	} );
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