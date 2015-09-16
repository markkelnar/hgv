<?php
/*
Plugin Name: PHP Toggle Admin Menu
Plugin URI: http://wpengine.com
Description: Toggle the backend PHP processor
Version: 0.1
Author: Mark Kelnar

wp_enqueue_script( 'backendphp', '/wp-content/mu-plugins/backend-selector/js/selector.js', array(), false, true );
*/

namespace wpengine;

class BackendPHP
{
    const cookie_name = 'backend';

    function cookieValue() {
        return isset( $_COOKIE[self::cookie_name] ) ? $_COOKIE[self::cookie_name] : '';
    }

    /**
     * Calculate the actual PHP version that built this page.
     */
    function backendValue() {
        $version = phpversion();
        // Example, 5.6.99-hhvm
        if( false !== strstr($version, 'hhvm')) {
            return 'HHVM';
        }
        // Example, 7.0.0-dev
        if( 7 == substr($version, 0, 1)) {
            return 'PHP 7';
        }
        // Example, 5.5.9-1ubuntu4.11
        return 'PHP 5';
    }

    function poweredByHhvm() {
        // Example, 5.6.99-hhvm
        if( false === strstr(phpversion(), 'hhvm')) {
            return false;
        }
        return true;
    }

    function poweredByPhp7() {
        // Example, 7.0.0-dev
        if( ! $this->poweredByHhvm() && 7 == substr(phpversion(), 0, 1)) {
            return true;
        }
        return false;
    }

    function poweredByPhp5() {
        // Example, 5.5.9-1ubuntu4.11
        if( ! $this->poweredByHhvm() && 5 == substr(phpversion(), 0, 1)) {
            return true;
        }
        return false;
    }

    function add_backend_php_to_admin_bar($wp_admin_bar) {         

        // Add menu option to admin menu bar
        $wp_admin_bar->add_menu( array(
                'id' => 'backend_php_link',
                'title' => __($this->backendValue()." - ".phpversion()),
        ));

        // adds a child node to site name parent node
        $wp_admin_bar->add_node( array(
                'parent' => 'backend_php_link',
                'id'     => 'backend-php-hhvm',
                'title'  => 'HHVM',
                'href'   => $this->poweredByHhvm() ? '' : 'php7.mark.local/#hhvm',
        ));
        $wp_admin_bar->add_node( array(
                'parent' => 'backend_php_link',
                'id'     => 'backend-php-five',
                'title'  => 'PHP 5',
                'href'   => $this->poweredByPhp5() ? '' : '#php5',
        ));
        $wp_admin_bar->add_node( array(
                'parent' => 'backend_php_link',
                'id'     => 'backend-php-seven',
                'title'  => 'PHP 7',
                'href'   => $this->poweredByPhp7() ? '' : '#php7',
        ));
    }
}

$wpengine_backend_php = new BackendPHP();

// Load the jquery and utils for cookie setting via the dropdown.
wp_enqueue_script( 'backend_selector_script', plugin_dir_url( __FILE__ ) . 'js/selector.js', array( 'utils','jquery' ) );

// The following code adds a link to the admin menu bar
add_action( 'admin_bar_menu', array($wpengine_backend_php,'add_backend_php_to_admin_bar'), 99 );

