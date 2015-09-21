jQuery(document).ready(function($){	
    $( "#wp-admin-bar-php-selector-hhvm" ).click(function() {
        phpSelector($('a', this).attr("rel"));
    });
    $( "#wp-admin-bar-php-selector-five" ).click(function() {
        phpSelector($('a', this).attr("rel"));
    });
    $( "#wp-admin-bar-php-selector-seven" ).click(function() {
        phpSelector($('a', this).attr("rel"));
    });
});

function phpSelector(value) {
    if ( ! value ) {
        return;
    }
    wpCookies.set('backend', value, 360000, '/');
    window.location.reload(true);
}
