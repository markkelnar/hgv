/**
 * Vagrant Push control routine
 *
 * @author WPEngine
 */

'use strict';

/**
 * Module dependencies
 */
var fs = require( 'fs' ),
	Git = require( 'git-wrapper2' ),
	chalk = require( 'chalk' ),
	path = require( 'path' ),
	inquirer = require( 'inquirer' ),
	yaml = require( 'yamljs' ),
	Promise = require( 'promise' ),
	error = require( './error' );

/**
 * Module variables
 */
var config_directory = path.join( 'hgv_data', 'config', 'sites' );

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

/**
 * Actually trigger the Git push internally.
 *
 *
 *
 * @param {Object} config
 */
function push( config ) {
	return new Promise( function( fulfill, reject ) {
		var git = new Git();

		try {
			// Parse out the branch and remote information from the config
			var branch = config.wp.branch,
				remote = config.wp.remote;

			// Make sure we're in the project directory
			var cwd = process.cwd();

			process.chdir( path.join( cwd, 'hgv_data', 'sites', config.wp.enviro ) );

			// Push the changes up
			var pusher = git.push( remote, branch );
			pusher.stdout.on( 'data', function( data ) {
				process.stdout.write( chalk.gray( '[git] ' ) + data );
			} );
			pusher.stderr.on( 'data', function( data ) {
				process.stderr.write( chalk.gray( '[git] ' ) + chalk.yellow( data ) );
			} );
			pusher.on( 'close', function() {
				process.chdir( cwd ); // Reset the current directory

				fulfill( config.wp.enviro ); // Done
			} );
		} catch ( e ) {
			error.broken_site( config.wp.enviro );
		}
	} );
}

/**
 * Let the user know that `vagrant push` is complete.
 *
 * @param {String} environment
 */
function complete( environment ) {
	var message = [
		'',
		'HGV is finished pushing everything to the ' + chalk.green( environment ) + ' environment!',
		'',
		'For any further help with your environment, please view the HGV wiki',
		'on GitHub: ' + chalk.green( '<https://github.com/wpengine/hgv/wiki>' ),
		'',
		''
	].join( '\n' );

	process.stderr.write( message );

	process.exit( 0 );
}

// Load the configuration file
chooser()
	.then( push )
	.then( complete );