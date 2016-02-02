<?php
/**
 * BuddyPress - Members Profile Change Cover Image
 *
 * @package BuddyPress
 * @subpackage bp-legacy
 */

?>

<h4><?php _e( 'Change Cover Image', 'buddypress' ); ?></h4>

<?php

/**
 * Fires before the display of profile cover image upload content.
 *
 * @since 2.4.0
 */
do_action( 'bp_before_profile_edit_cover_image' ); ?>

<div class="bp-avatar-nav">
    <ul class="avatar-nav-items">
        <li class="avatar-nav-item <?php echo bp_is_tab_current( 'upload' ); ?>" id="bp-avatar-upload">
        	<a href="<?php echo bp_displayed_user_domain() . 'profile/change-cover-image/'; ?>" class="bp-avatar-nav-item" data-nav="upload">Upload</a>
        </li>
        <li class="avatar-nav-item <?php echo bp_is_tab_current( 'crop' ); ?>" id="bp-avatar-crop">
        	<a href="<?php echo bp_displayed_user_domain() . 'profile/change-cover-image/crop/'; ?>" class="bp-avatar-nav-item" data-nav="crop">Crop</a>
        </li>
    </ul>
</div>

<?php bp_attachments_get_template_part( 'cover-images/index' ); ?>

<?php

/**
 * Fires after the display of profile cover image upload content.
 *
 * @since 2.4.0
 */
do_action( 'bp_after_profile_edit_cover_image' ); ?>
