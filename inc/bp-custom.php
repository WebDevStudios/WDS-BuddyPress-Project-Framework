<?php
/*
*
* place BP customizations here
*
*/

/*
* custom defines
*/

// this is how you customize the avatar sizes
define( 'BP_AVATAR_THUMB_WIDTH', 50 );
define( 'BP_AVATAR_THUMB_HEIGHT', 50 );
define( 'BP_AVATAR_FULL_WIDTH', 150 );
define( 'BP_AVATAR_FULL_HEIGHT', 150 );
define( 'BP_AVATAR_ORIGINAL_MAX_WIDTH', 450 );
define( 'BP_AVATAR_ORIGINAL_MAX_FILESIZE', 5120000 );

// allows special charachters in usernames
define('BP_ENABLE_USERNAME_COMPATIBILITY_MODE', true);
// profile tab landing page
define( 'BP_DEFAULT_COMPONENT', 'activity');
// group tab landing page
define( 'BP_GROUPS_DEFAULT_EXTENSION', 'members' );
// removes members slug from url, url.com/username
define('BP_ENABLE_ROOT_PROFILES', true );

/*
* custom filters
*/
// removes @ mentions from the site
add_filter( 'bp_activity_do_mentions', '__return_false' );
// turns off profile field links
remove_filter( 'bp_get_the_profile_field_value', 'xprofile_filter_link_profile_data', 9, 2 );


/**
 * bp_change_profile_tab_order function.
 *
 * Change user nav items
 *
 * @access public
 * @return void
 */
function bp_change_profile_tab_order() {
	global $bp;

    // this is how you change profile nav positions works similar to wp nav positions
	$bp->bp_nav['profile']['position'] = 10;
	$bp->bp_nav['activity']['position'] = 20;

    // this is how you remove profile nav items
	$bp->bp_nav['sites'] = false;
	$bp->bp_nav['blogs'] = false;
	$bp->bp_nav['invite-anyone'] = false;

    // this is how you change tab names
    $bp->bp_nav['activity']['name'] = 'Stuff';
}
add_action( 'bp_setup_nav', 'bp_change_profile_tab_order', 999 );



/**
 * bp_change_settings_subnav function.
 *
 * how to add new tabs to profile and show custom content
 *
 * @access public
 * @return void
 */
function bp_custom_user_nav_item() {
    global $bp;

    $args = array(
            'name' => __('New Item', 'buddypress'),
            'slug' => 'new-item',
            'default_subnav_slug' => 'new-item',
            'position' => 50,
            'show_for_displayed_user' => false,
            'screen_function' => 'bp_custom_user_nav_item_screen',
            'item_css_id' => 'custom-class'
    );

    bp_core_new_nav_item($args);
}
add_action('bp_setup_nav', 'bp_custom_user_nav_item', 99);

    // these are bp actions that will show a custom page on the tab created in bp_custom_user_nav_item()
    function bp_custom_user_nav_item_screen() {
        add_action( 'bp_template_content', 'bp_custom_screen_content' );
        bp_core_load_template( apply_filters( 'bp_core_template_plugin', 'members/single/plugins' ) );
    }

    // this will show content when you visit the tab
    function bp_custom_screen_content() {

       echo 'the custom content';

    }
