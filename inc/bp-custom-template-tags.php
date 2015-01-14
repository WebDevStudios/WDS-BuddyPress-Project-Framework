<?php
/* place custom template tag code here */

	/**
	 * Display linked BuddyPress avatar and nicename in header if user is logged in.
	 */
	function wds_ce_bp_user_info() {
		if ( is_user_logged_in() ) {
			echo '<div class="bp-user-info">';
			echo '<a href="' . bp_loggedin_user_domain() . '">';
			echo '<span class="bp-user-name">' . bp_core_get_user_displayname( bp_loggedin_user_id() ) . '</span>';
			echo bp_loggedin_user_avatar( 'type=thumb&width=66&height=66' );
			echo '</a>';
			echo '</div>';
		}
		return;
	}


?>