jQuery(document).ready(function($){	

    $( "#wp-admin-bar-backend-php-hhvm" ).click(function() {
        wpCookies.set('backend', 'hhvm', 360000, '/');
    });
    $( "#wp-admin-bar-backend-php-five" ).click(function() {
        wpCookies.set('backend', 'php', 360000, '/');
    });
    $( "#wp-admin-bar-backend-php-seven" ).click(function() {
        wpCookies.set('backend', 'php7', 360000, '/');
    });
});
