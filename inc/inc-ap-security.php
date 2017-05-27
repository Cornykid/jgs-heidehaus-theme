<?php
/**
 * Disable HTML in comments.
 *
 * @since 1.0
 * @see https://confluence.intranet.doccheck.ag/display/IT/WordPress+Security#WordPressSecurity-Autor-Seitenverstecken
 */
add_filter('pre_comment_content', 'wp_specialchars');

/**
 * Hide author pages.
 *
 * @since 1.0
 * @see https://confluence.intranet.doccheck.ag/display/IT/WordPress+Security#WordPressSecurity-HTMLinKommentarendeaktivieren
 */
function ap_hide_author_pages()
{
    if (is_author()) {
        wp_redirect(home_url(), 403);
        exit;
    }
}

add_action('template_redirect', 'ap_hide_author_pages');

/**
 * Disable REST API.
 *
 * @since 1.1
 * @see https://confluence.intranet.doccheck.ag/display/IT/WordPress+Security#WordPressSecurity-RESTAPIdeaktivieren
 * @see https://de.wordpress.org/plugins/disable-json-api/
 */
$ap_current_wp_version = get_bloginfo('version');

if (version_compare($ap_current_wp_version, '4.7', '>=')) {
    ap_api_force_auth_errors();
} else {
    ap_api_disable_via_filters();
}

/**
 * This function is called if the current version of WordPress is 4.7 or above
 * Forcibly raise an authentication error to the REST API if the user is not logged in
 */
function ap_api_force_auth_errors()
{
    add_filter('rest_authentication_errors', 'ap_api_only_logged_in_access');
}

/**
 * This function gets called if the current version of WordPress is less than 4.7
 * We are able to make use of filters to actually disable the functionality entirely
 */
function ap_api_disable_via_filters()
{

    // Filters for WP-API version 1.x
    add_filter('json_enabled', '__return_false');
    add_filter('json_jsonp_enabled', '__return_false');

    // Filters for WP-API version 2.x
    add_filter('rest_enabled', '__return_false');
    add_filter('rest_jsonp_enabled', '__return_false');

    // Remove REST API info from head and headers
    remove_action('xmlrpc_rsd_apis', 'rest_output_rsd');
    remove_action('wp_head', 'rest_output_link_wp_head', 10);
    remove_action('template_redirect', 'rest_output_link_header', 11);

}

/**
 * Returning an authentication error if a user who is not logged in tries to query the REST API
 * @param $access
 * @return WP_Error
 */
function ap_api_only_logged_in_access($access)
{

    if (!is_user_logged_in()) {
        return new WP_Error(
            'rest_cannot_access',
            __('Only authenticated users can access the REST API.', 'disable-json-api'),
            array('status' => rest_authorization_required_code())
        );
    }

    return $access;
}