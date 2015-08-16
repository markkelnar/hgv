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
	Promise = require( 'promise' ),
	error = require( './error' );

/**
 * Module variables
 */
var config_directory = path.join( 'hgv_data', 'config' );

/**
 * Prompt the end user to specify their environment
 *
 * @return {Promise}
 */
function chooser() {
	process.stdout.write( require( './header' ) );

	// Try to get a list of known environments
	var configs = [];

	return new Promise( function ( fulfill, reject ) {
		fs.readdir( config_directory, function ( err, configs ) {
			if ( err ) {
				error.no_config();
			}

			// Get the environment names from the file names
			var environs = configs.map( function ( item ) {
				return path.basename( item, '.yml' );
			} );

			// Prompt the user to select an environment
			inquirer.prompt( [
				{
					type   : 'list',
					name   : 'environment',
					message: 'Deploy to which environment?',
					choices: environs
				}
			], function ( result ) {
				try {
					load_config( result.environment ).then( fulfill );
				} catch ( e ) {
					error.broken_config( result.environment );
				}
			} );
		} );
	} );
}

/**
 * Attempt to load the configuration file from /hgv_data
 *
 * @throws Will throw an error if the file is invalid or missing.
 *
 * @param {String} environment
 *
 * @return {Promise}
 */
function load_config( environment ) {
	return new Promise( function( fulfill, reject ) {
		var file_path = path.join( config_directory, environment ) + '.yml';

		yaml.load( file_path, fulfill, reject );
	} );
}

// Load the configuration file
chooser().then( function( data ) { console.log( data ) } );