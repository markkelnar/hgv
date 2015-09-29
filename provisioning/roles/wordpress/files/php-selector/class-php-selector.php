<?php

namespace wpengine;

class PHPSelector
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

    function add_php_selector_to_admin_bar($wp_admin_bar) {

        // Add menu option to admin menu bar
        $wp_admin_bar->add_menu( array(
                'id' => 'php_selector_link',
                'title' => __($this->backendValue()." - ".phpversion()),
        ));

        // adds a child node to site name parent node
        $wp_admin_bar->add_node( array(
                'parent' => 'php_selector_link',
                'id'     => 'php-selector-hhvm',
                'title'  => 'HHVM',
                'href'   => $this->poweredByHhvm() ? '' : '#hhvm',
                'meta'   => array('rel' => 'hhvm'),
        ));
        $wp_admin_bar->add_node( array(
                'parent' => 'php_selector_link',
                'id'     => 'php-selector-five',
                'title'  => 'PHP 5',
                'href'   => $this->poweredByPhp5() ? '' : '#php5',
                'meta'   => array('rel' => 'php5'),
        ));
        $wp_admin_bar->add_node( array(
                'parent' => 'php_selector_link',
                'id'     => 'php-selector-seven',
                'title'  => 'PHP 7',
                'href'   => $this->poweredByPhp7() ? '' : '#php7',
                'meta'   => array('rel' => 'php7'),
        ));
    }

    function add_javascript() {
        // Load the jquery and utils for cookie setting via the dropdown.
        wp_enqueue_script( 'php_selector_script', plugin_dir_url( __FILE__ ) . 'js/selector.js', array( 'utils','jquery' ) );
    }
}
