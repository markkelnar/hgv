/**
 * HGV YAML Configuration Generator
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
	prompt = require( 'prompt' ),
	rootCheck = require( 'root-check' ),
	yaml = require( 'yamljs' ),
	mkdirp = require( 'mkdirp' );

/**
 * Default values for the YAML file
 */
var defaults = {
	enviro      : '',
	hhvm_domains: [],
	php_domains : [],
	wpe_name    : '',
	branch      : 'develop',
	remote      : 'staging'
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
 * Print out usage information and return false.
 *
 * @return {Boolean}
 */
function usage() {
	process.stdout.write( require( './usage' ).start );

	return false;
}

/**
 * Get the environment name out of the passed arguments array. If none exists, then print usage information instead.
 *
 * @return {String|Boolean}
 */
function setup() {
	// We must have exactly one
	if ( argv.length !== 1 && argv[1] !== '--force' ) {
		return usage();
	}

	var enviro = argv[ 0 ].trim();

	if ( '' === enviro ) {
		return usage();
	}

	return enviro;
}

/**
 * Just some fun ASCII art for Hgv consistency
 */
function pre() {
	process.stdout.write( require( './header' ) );

	// Get the passed environment variable.
	var enviro = setup(),
		file_path = '';

	if ( ! enviro ) {
		process.exit( 0 );
	}

	// Make sure the config directory exists
	var config_directory = path.join( 'hgv_data', 'config', 'sites' );
	if ( ! fs.existsSync( config_directory ) ) {
		mkdirp.sync( config_directory );
	}

	// If it's not a Yaml file, make it one.
	file_path = path.extname( enviro ) === '.yml' ? enviro : enviro + '.yml';

	// Make sure we're in the hgv_data/config/sites directory
	file_path = path.join( config_directory, file_path );

	// Check to see if our config file exists. If so, only proceed if --force is set.
	fs.stat( file_path, function( err, stat ) {
		if ( err !== null ) {
			// The file doesn't exist, so start things up.
			init( enviro, file_path );
		} else {
			process.stdout.write( '\n' );
			process.stdout.write( chalk.red( 'WARNING!' ) + '\n' );
			process.stdout.write( chalk.yellow( 'Your installation already has a configuration file.\n' ) );

			// The file exists! Check for the --force flag.
			if ( argv.indexOf( '--force' ) > -1 ) {
				process.stdout.write( chalk.yellow( 'This utility will update the existing file\'s settings.\n' ) );

				// Parse the existing file and store it in the default array
				yaml.load( file_path, function( result ) {
					// Merge our parameters
					settings = result;
					defaults = extend( defaults, result.wp );

					// Start things up
					init( enviro, file_path );
				} );
			} else {
				// Explain how to use the tool.
				process.stdout.write( '\n' );
				process.stdout.write( 'To overwrite this file, add the ' + chalk.bold( '--force' ) + ' flag to the ' + chalk.bold( '/script/start' ) + '\n' );
				process.stdout.write( 'command to re-run the generator and update the existing values.\n' );

				// Exit with an error code.
				process.exit( 1 );
			}
		}
	} );
}

/**
 * Make sure no comma-separated lists end up in an array.
 *
 * @param {Array} array Array to clean up.
 *
 * @returns {Array}
 */
function fix_arrays( array ) {
	var output_array = [];

	for ( var i = 0, l = array.length; i < l; i++ ) {
		var domain = array[ i ];
		if ( domain.indexOf( ',' ) > -1 ) {
			var domains = domain.split( ',' );
			output_array = output_array.concat( domains );
		} else {
			output_array.push( domain );
		}
	}

	return output_array;
}

/**
 * Return a de-duped version of an array.
 *
 * @param {Array} array Array to de-dupe
 *
 * @returns {Array}
 */
function uniq( array ) {
	var seen = {};
	return array.filter( function ( item ) {
		return seen.hasOwnProperty( item ) ? false : (seen[item] = true);
	} );
}

/**
 * Initialize the prompting machine.
 *
 * @param {String} enviro    Environment name
 * @param {String} file_path Output file path
 */
function init( enviro, file_path ) {
	var skip = process.platform !== 'win32' ? ' (Ctrl + C to skip)' : ' (Cmd + C to skip)';

	var schema = {
		properties: {
			hhvm_domains: {
				description: 'HHVM project domains' + skip,
				default    : defaults.hhvm_domains,
				message    : 'HHVM project domains' + skip,
				type       : 'array'
			},
			php_domains : {
				description: 'PHP project domains' + skip,
				default    : defaults.php_domains,
				message    : 'PHP project domains' + skip,
				type       : 'array'
			},
			wpe_name    : {
				description: 'Name of the WPEngine Installation',
				default    : defaults.wpe_name,
				message    : 'Environment must be a string',
				type       : 'string'
			},
			branch      : {
				description: 'Git branch name',
				default    : defaults.branch,
				message    : 'Branch name must be a string',
				type       : 'string'
			},
			remote      : {
				description: 'Git remote name',
				default    : defaults.remote,
				message    : 'Remote name must be a string',
				type       : 'string'
			}
		}
	};

	prompt.start();
	prompt.get( schema, function( err, result ) {
		// Set the environment
		result.enviro = enviro;

		// Split up any comma-separated lists in the arrays
		result.hhvm_domains = uniq( fix_arrays( result.hhvm_domains ) );
		result.php_domains = uniq( fix_arrays( result.php_domains ) );

		// Set up our settings array
		settings = { wp: result };

		// Once we're done, finalize the YAML file
		finalize( file_path );
	} );
}

/**
 * Write out our generated YAML file.
 *
 * @param {String} file_path Output filepath
 */
function finalize( file_path ) {
	var yaml_string = yaml.stringify( settings, 4 );

	fs.writeFile( file_path, yaml_string, function( err ) {
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