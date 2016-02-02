<?php
/**
 * BuddyPress Cropper templates.
 *
 * This template is used to crop the avatar
 *
 * @since 2.3.0
 *
 * @package BuddyPress
 * @subpackage bp-attachments
 */

?>

<?php if( bp_get_crop_cover_full_image( bp_displayed_user_id() ) ) : ?>

<h4><?php _e( 'Current Cover Image', 'bppf' ); ?></h4>

<p><?php _e( 'Your Cover Image has already been pre-cropped. You can customize the cropping below.', 'bppf' ); ?></p>

<div id="bp-delete-cover-image-container">

	<p><img src="<?php echo bp_crop_cover_full_image( bp_displayed_user_id() ); ?>" id="cover-to-crop" class="cover" alt="<?php esc_attr_e( 'Cover Photo to crop', 'buddypress' ); ?>" /></p>

	<a name="cover-crop-submit" id="cover-crop-submit" class="button edit"><?php esc_attr_e( 'Crop Image', 'bppf' ); ?></a>

	<input type="hidden" name="full_src" id="full_src" value="<?php echo bp_crop_cover_full_image( bp_displayed_user_id(), 'path' );?>" />
	<input type="hidden" name="cropped_src" id="cropped_src" value="<?php echo bp_attachments_get_attachment( 'path', array( 'item_id' => bp_displayed_user_id() ) );?>" />
	<input type="hidden" name="item_id" id="item_id" value="<?php echo bp_displayed_user_id();?>" />
	<input type="hidden" name="image_size" id="image_size" value="<?php echo bp_get_cover_image_size( bp_crop_cover_full_image( bp_displayed_user_id(), 'path' ) );?>" />
	<input type="hidden" id="x" name="x" />
	<input type="hidden" id="y" name="y" />
	<input type="hidden" id="w" name="w" />
	<input type="hidden" id="h" name="h" />

	<?php wp_nonce_field( 'bp_avatar_cropstore' ); ?>

	<div class="bp-cover-image-status"></div>

</div>

<?php else : ?>

	<h4><?php _e( 'No Cover Image', 'bppf' ); ?></h4>

	<p><?php _e( 'A cover image has not been uploaded. Click the upload tab to upload a new image.', 'bppf' ); ?></p>

<?php endif; ?>
