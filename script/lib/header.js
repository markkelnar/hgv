/**
 * Hgv Header
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

var fallback = [
	chalk.gray( ' ------------------------- ' ) + chalk.green( ' ----------------- ' ),
	chalk.gray( '|   _    _                |' ) + chalk.green( '|  __      __     |' ),
	chalk.gray( '|  | |  | |               |' ) + chalk.green( '|  \\ \\    / /     |' ),
	chalk.gray( '|  | |__| |  __           |' ) + chalk.green( '|   \\ \\  / /      |' ),
	chalk.gray( '|  |  __  |/ _  \\         |' ) + chalk.green( '|    \\ \\/ /       |' ),
	chalk.gray( '|  | |  | | (_| |         |' ) + chalk.green( '|     \\  /        |' ),
	chalk.gray( '|  |_|  |_|\\__, |         |' ) + chalk.green( '|      \\/         |' ),
	chalk.gray( '|           __/ |___  __  |' ) + chalk.green( '|        ___ ____ |' ),
	chalk.gray( '|          |___/( _ )/  \\ |' ) + chalk.green( '|       |_  )__ / |' ),
	chalk.gray( '|               / _ \\ () ||' ) + chalk.green( '|        / / |_ \\ |' ),
	chalk.gray( '|               \\___/\\__/ |' ) + chalk.green( '|       /___|___/ |' ),
	chalk.gray( ' ------------------------- ' ) + chalk.green( ' ----------------- ' ),
	'',
	''
].join( '\n' );

module.exports = fallback;
//module.exports = chalk.supportsColor && process.platform !== 'win32' ?
//	fs.readFileSync( path.join( __dirname, 'header.txt' ), 'utf8' ) : fallback;