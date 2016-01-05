<?php
/*
*
* place BP customizations here
*
*/


// Register the Cover Image feature for Users profiles
function wds_clp_register_feature() {

	bp_set_theme_compat_feature( 'templates', array(
		'name'     => 'cover_image',
		'settings' => array(
			'components'   => array( 'xprofile', 'groups' ),
			'width'        => 940,
			'height'       => 225,
			'callback'     => 'clp_cover_image',
			'theme_handle' => 'bp-legacy-css',
		),
	) );


}
add_action( 'bp_after_setup_theme', 'wds_clp_register_feature' );


// Example of function to customize the display of the cover image
function clp_cover_image( $params = array() ) {
}