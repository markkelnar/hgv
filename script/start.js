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

	init();
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