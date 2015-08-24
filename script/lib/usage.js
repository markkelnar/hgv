/**
 * HGV Usage Information
 *
 * @author WPEngine
 */

'use strict';

/**
 * Module dependencies
 */
var fs = require( 'fs' ),
	path = require( 'path' ),
	chalk = require( 'chalk' );

var start_usage = [
	'',
	'',
	'Usage: script/start ' + chalk.green( '<environment>' ) + ' ' + chalk.gray( '[<args>]' ),
	'',
	'    --force            Force an update of an existing environment.',
	'',
	'For help on environment configuration, please view the HGV wiki',
	'on GitHub: ' + chalk.green( '<https://github.com/wpengine/hgv/wiki>' )
].join( '\n' ) + '\n';

module.exports = {
	start: start_usage
};