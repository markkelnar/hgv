jQuery(document).ready(function($){	
    $( "#wp-admin-bar-backend-php-hhvm" ).click(function() {
        backendSelector($('a', this).attr("rel"));
    });
    $( "#wp-admin-bar-backend-php-five" ).click(function() {
        backendSelector($('a', this).attr("rel"));
    });
    $( "#wp-admin-bar-backend-php-seven" ).click(function() {
        backendSelector($('a', this).attr("rel"));
    });
});

function backendSelector(value) {
    if ( ! value ) {
        return;
    }
    wpCookies.set('backend', value, 360000, '/');
    window.location.reload(true);
}
