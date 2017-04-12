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
        // Example, 5.6.99-hhvm
        if( $this->poweredByHhvm() ) {
            return 'HHVM';
        }
        if( $this->poweredByPhp71() ) {
            return 'PHP 7.1';
        }
        // Example, 7.0.0-dev
        if( $this->poweredByPhp7() ) {
            return 'PHP 7.0';
        }
        if( $this->poweredByPhp56() ) {
            return 'PHP 5.6';
        }
        // Example, 5.5.9-1ubuntu4.11
        return 'PHP 5.5';
    }

    function getPhpVersion() {
        return substr(phpversion(), 0, 3);
    }

    function poweredByHhvm() {
        // Example, 5.6.99-hhvm
        if( false === strstr(phpversion(), 'hhvm')) {
            return false;
        }
        return true;
    }

    function poweredByPhp71() {
        // Example, 7.1.0-dev
        if( "7.1" == $this->getPhpVersion()) {
            return true;
        }
        return false;
    }

    function poweredByPhp7() {
        // Example, 7.0.0-dev
        if( "7.0" == $this->getPhpVersion()) {
            return true;
        }
        return false;
    }

    function poweredByPhp56() {
        if( "5.6" == $this->getPhpVersion()) {
            return true;
        }
        return false;
    }

    function poweredByPhp5() {
        // Example, 5.5.9-1ubuntu4.11
        if( "5.5" == $this->getPhpVersion()) {
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
                'title'  => 'PHP 5.5',
                'href'   => $this->poweredByPhp5() ? '' : '#php5',
                'meta'   => array('rel' => 'php5'),
        ));
        $wp_admin_bar->add_node( array(
                'parent' => 'php_selector_link',
                'id'     => 'php-selector-fivesix',
                'title'  => 'PHP 5.6',
                'href'   => $this->poweredByPhp56() ? '' : '#php56',
                'meta'   => array('rel' => 'php56'),
        ));
        $wp_admin_bar->add_node( array(
                'parent' => 'php_selector_link',
                'id'     => 'php-selector-seven',
                'title'  => 'PHP 7.0',
                'href'   => $this->poweredByPhp7() ? '' : '#php7',
                'meta'   => array('rel' => 'php7'),
        ));
        $wp_admin_bar->add_node( array(
                'parent' => 'php_selector_link',
                'id'     => 'php-selector-sevenone',
                'title'  => 'PHP 7.1',
                'href'   => $this->poweredByPhp71() ? '' : '#php71',
                'meta'   => array('rel' => 'php71'),
        ));
    }

    function add_javascript() {
        // Load the jquery and utils for cookie setting via the dropdown.
        wp_enqueue_script( 'php_selector_script', plugin_dir_url( __FILE__ ) . 'js/selector.js', array( 'utils','jquery' ) );
    }
}
