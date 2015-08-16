/**
 * Vagrant Push control routine
 * @author WPEngine
 */

'use strict';

/**
 * Module dependencies
 */
var fs = require( 'fs' ),
	path = require( 'path' ),
	inquirer = require( 'inquirer' ),
	yaml = require( 'yamljs' ),
	error = require( './error' );

/**
 * Prompt the end user to specify their environment
 *
 * @return {String}
 */
function chooser() {
	process.stdout.write( require( './header' ) );

	// Try to get a list of known environments
	var config_directory = path.join( 'hgv_data', 'config' ),
		configs = [];

	try {
		configs = fs.readdirSync( config_directory );
	} catch ( e ) {
		error.no_config();
	}

	// Get the environment names from the file names
	var environs = configs.map( function( item ) {
		return path.basename( item, '.yml' );
	} );

	// Prompt the user to select an environment
	inquirer.prompt( [
		{
			type: 'list',
			name: 'environment',
			message: 'Deploy to which environment?',
			choices: environs
		}
	], function( result ) {
		try {
			return load_config( result.environment );
		} catch ( e ) {
			error.broken_config( result.environment );
		}
	} );
}

/**
 * Attempt to load the configuration file from /hgv_data
 *
 * @throws Will throw an error if the file is invalid or missing.
 *
 * @param {String} environment
 */
function load_config( environment ) {
	console.log( environment );
	return {};
}

// Load the configuration file
var config = chooser();