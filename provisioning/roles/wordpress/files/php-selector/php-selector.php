<?php
/*
Plugin Name: PHP Toggle Selector
Version: 0.3-alpha
Description: Toggle the backend processor between HHVM, php5 and php7. *Note: This plugin does not allow you to toggle between PHP and HHVM in your production environment.
Author: WP Engine
Author URI: http://wpengine.com
Plugin URI: http://wpengine.com
Text Domain: php-selector
Domain Path: /languages

*/

include_once __DIR__.'/php-selector/class-php-selector.php';

$wpengine_php_selector = new wpengine\PHPSelector();

// The following code adds a link to the admin menu bar during dashboard view and regular page view.
add_action( 'admin_enqueue_scripts', array($wpengine_php_selector,'add_javascript') );
add_action( 'wp_enqueue_scripts', array($wpengine_php_selector,'add_javascript') );
add_action( 'admin_bar_menu', array($wpengine_php_selector,'add_php_selector_to_admin_bar'), 99 );

