/**
 * HGV Error Information
 *
 * @author WPEngine
 */

'use strict';

/**
 * Module dependencies
 */
var chalk = require( 'chalk' );

/**
 * No configuration filex exist, prompt to run the start script.
 */
function no_config() {
	var message = [
		'',
		'',
		'HGV does not seem to have a `' + chalk.green( '/hgv_data/config' ) + '` directory! Please',
		'run the `' + chalk.yellow( './script/start' ) + '` bootstrap script to configure a deployment',
		'environment.',
		'',
		'For help on environment configuration, please view the HGV wiki',
		'on GitHub: ' + chalk.green( '<https://github.com/wpengine/hgv/wiki>' ),
		''
	].join( '\n' );

	process.stderr.write( message );

	process.exit( 1 );
}

/**
 * There was an error reading or parsing the specified configuration file.
 *
 * @param {String} config Broken configuration file
 */
function broken_config( config ) {
	var message = [
		'',
		'',
		'HGV is having a problem working with the `' + chalk.green( config ) + '` environment.',
		'You might need to run `' + chalk.yellow( './script/start ' + config + ' --force' ) + '` to repair',
		'and/or update the file.',
		'',
		'For help on environment configuration, please view the HGV wiki',
		'on GitHub: ' + chalk.green( '<https://github.com/wpengine/hgv/wiki>' ),
		''
	].join( '\n' );

	process.stderr.write( message );

	process.exit( 1 );
}

/**
 * There was an error reading the site directory (i.e. it might not be imported yet).
 *
 * @param {String} site Site with the directory we tried to read
 */
function broken_site( site ) {
	var message = [
		'',
		'',
		'HGV can\'t find the directory for the `' + chalk.green( site ) + '` environment.',
		'Please ensure the directory exists in `' + chalk.yellow( '/hgv_data/sites' ) + '` and try again.',
		'',
		'For help on environment configuration, please view the HGV wiki',
		'on GitHub: ' + chalk.green( '<https://github.com/wpengine/hgv/wiki>' ),
		''
	].join( '\n' );

	process.stderr.write( message );

	process.exit( 1 );
}

module.exports = {
	no_config    : no_config,
	broken_config: broken_config,
	broken_site  : broken_site
};