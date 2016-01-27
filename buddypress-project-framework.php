<?php
/**
 * Plugin Name: BuddyPress Project Framework
 * Plugin URI:  http://webdevstudios.com
 * Description: A framework for custom BuddyPress development
 * Version:     2.0.0
 * Author:      WebDevStudios
 * Author URI:  http://webdevstudios.com
 * Donate link: http://webdevstudios.com
 * License:     GPLv2
 * Text Domain: bpf
 * Domain Path: /languages
 */

/**
 * Copyright (c) 2016 WebDevStudios (email : contact@webdevstudios.com)
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License, version 2 or, at
 * your discretion, any later version, as published by the Free
 * Software Foundation.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
 */

/**
 * Built using generator-plugin-wp
 */


/**
 * Autoloads files with classes when needed
 *
 * @since  0.1.0
 * @param  string $class_name Name of the class being requested
 * @return void
 */
function bpf_autoload_classes( $class_name ) {
	if ( 0 !== strpos( $class_name, 'BPPF_' ) ) {
		return;
	}

	$filename = strtolower( str_replace(
		'_', '-',
		substr( $class_name, strlen( 'BPPF_' ) )
	) );

	BuddyPress_Project_Framework::include_file( $filename );
}
spl_autoload_register( 'bpf_autoload_classes' );


/**
 * Main initiation class
 *
 * @since  0.1.0
 * @var  string $version  Plugin version
 * @var  string $basename Plugin basename
 * @var  string $url      Plugin URL
 * @var  string $path     Plugin Path
 */
class BuddyPress_Project_Framework {

	/**
	 * Current version
	 *
	 * @var  string
	 * @since  0.1.0
	 */
	const VERSION = '2.0.0';

	/**
	 * URL of plugin directory
	 *
	 * @var string
	 * @since  0.1.0
	 */
	protected $url = '';

	/**
	 * Path of plugin directory
	 *
	 * @var string
	 * @since  0.1.0
	 */
	protected $path = '';

	/**
	 * Plugin basename
	 *
	 * @var string
	 * @since  0.1.0
	 */
	protected $basename = '';

	protected $project_framework;


	/**
	 * Singleton instance of plugin
	 *
	 * @var BuddyPress_Project_Framework
	 * @since  0.1.0
	 */
	protected static $single_instance = null;

	/**
	 * Creates or returns an instance of this class.
	 *
	 * @since  0.1.0
	 * @return BuddyPress_Project_Framework A single instance of this class.
	 */
	public static function get_instance() {
		if ( null === self::$single_instance ) {
			self::$single_instance = new self();
		}

		return self::$single_instance;
	}

	/**
	 * Sets up our plugin
	 *
	 * @since  0.1.0
	 */
	protected function __construct() {
		$this->basename = plugin_basename( __FILE__ );
		$this->url      = plugin_dir_url( __FILE__ );
		$this->path     = plugin_dir_path( __FILE__ );

		$this->plugin_classes();
	}

	/**
	 * Attach other plugin classes to the base plugin class.
	 *
	 * @since  0.1.0
	 * @return void
	 */
	public function plugin_classes() {
		// Attach other plugin classes to the base plugin class.
		// $this->plugin_class = new BPPF_Plugin_Class( $this );
		$this->project_framework = new BPPF_Loader( $this );
	} // END OF PLUGIN CLASSES FUNCTION

	/**
	 * Add hooks and filters
	 *
	 * @since  0.1.0
	 * @return void
	 */
	public function hooks() {
		register_activation_hook( __FILE__, array( $this, '_activate' ) );
		register_deactivation_hook( __FILE__, array( $this, '_deactivate' ) );

		add_action( 'init', array( $this, 'init' ) );
	}

	/**
	 * Activate the plugin
	 *
	 * @since  0.1.0
	 * @return void
	 */
	function _activate() {
		// Make sure any rewrite functionality has been loaded
		flush_rewrite_rules();
	}

	/**
	 * Deactivate the plugin
	 * Uninstall routines should be in uninstall.php
	 *
	 * @since  0.1.0
	 * @return void
	 */
	function _deactivate() {}

	/**
	 * Init hooks
	 *
	 * @since  0.1.0
	 * @return void
	 */
	public function init() {
		if ( $this->check_requirements() ) {
			load_plugin_textdomain( 'buddypress-project-framework', false, dirname( $this->basename ) . '/languages/' );
			//add_action( 'bp_include', '' );

			if ( file_exists(  __DIR__ . '/cmb2/init.php' ) ) {
			  require_once  __DIR__ . '/cmb2/init.php';
			} elseif ( file_exists(  __DIR__ . '/CMB2/init.php' ) ) {
			  require_once  __DIR__ . '/CMB2/init.php';
			}
		}
	}

	/**
	 * Check if the plugin meets requirements and
	 * disable it if they are not present.
	 *
	 * @since  0.1.0
	 * @return boolean result of meets_requirements
	 */
	public function check_requirements() {
		if ( ! $this->meets_requirements() ) {

			// Add a dashboard notice
			add_action( 'all_admin_notices', array( $this, 'requirements_not_met_notice' ) );

			// Deactivate our plugin
			deactivate_plugins( $this->basename );

			return false;
		}

		return true;
	}

	/**
	 * Check that all plugin requirements are met
	 *
	 * @since  0.1.0
	 * @return boolean
	 */
	public static function meets_requirements() {
		// Do checks for required classes / functions
		// function_exists('') & class_exists('')
		if( !class_exists('BuddyPress') ) {
			return false;
		}
		// We have met all requirements
		return true;
	}

	/**
	 * Adds a notice to the dashboard if the plugin requirements are not met
	 *
	 * @since  0.1.0
	 * @return void
	 */
	public function requirements_not_met_notice() {
		// Output our error
		echo '<div id="message" class="error">';
		echo '<p>' . sprintf( __( 'BuddyPress Project Framework is missing requirements and has been <a href="%s">deactivated</a>. Please make sure all requirements are available.', 'buddypress-project-framework' ), admin_url( 'plugins.php' ) ) . '</p>';
		echo '</div>';
	}

	/**
	 * Magic getter for our object.
	 *
	 * @since  0.1.0
	 * @param string $field
	 * @throws Exception Throws an exception if the field is invalid.
	 * @return mixed
	 */
	public function __get( $field ) {
		switch ( $field ) {
			case 'version':
				return self::VERSION;
			case 'basename':
			case 'url':
			case 'path':
				return $this->$field;
			default:
				throw new Exception( 'Invalid '. __CLASS__ .' property: ' . $field );
		}
	}

	/**
	 * Include a file from the includes directory
	 *
	 * @since  0.1.0
	 * @param  string  $filename Name of the file to be included
	 * @return bool    Result of include call.
	 */
	public static function include_file( $filename ) {
		$file = self::dir( 'includes/class-'. $filename .'.php' );
		if ( file_exists( $file ) ) {
			return include_once( $file );
		}
		return false;
	}

	/**
	 * This plugin's directory
	 *
	 * @since  0.1.0
	 * @param  string $path (optional) appended path
	 * @return string       Directory and path
	 */
	public static function dir( $path = '' ) {
		static $dir;
		$dir = $dir ? $dir : trailingslashit( dirname( __FILE__ ) );
		return $dir . $path;
	}

	/**
	 * This plugin's url
	 *
	 * @since  0.1.0
	 * @param  string $path (optional) appended path
	 * @return string       URL and path
	 */
	public static function url( $path = '' ) {
		static $url;
		$url = $url ? $url : trailingslashit( plugin_dir_url( __FILE__ ) );
		return $url . $path;
	}
}

/**
 * Grab the BuddyPress_Project_Framework object and return it.
 * Wrapper for BuddyPress_Project_Framework::get_instance()
 *
 * @since  0.1.0
 * @return BuddyPress_Project_Framework  Singleton instance of plugin class.
 */
function bpf() {
	return BuddyPress_Project_Framework::get_instance();
}

// Kick it off
add_action( 'plugins_loaded', array( bpf(), 'hooks' ) );


/**
 * bppf_run_extended_settings loads
 *
 * BP defines hooked to plugins loaded before BP
 *
 * @return void
 */
function bppf_run_extended_settings() {

	$options = get_option('bppf_options');

	foreach( $options as $key => $value ) {
		switch ( $key ) {
			case 'avatar_thumb_size_select' :
				if( !defined('BP_AVATAR_THUMB_WIDTH') )
					define ( 'BP_AVATAR_THUMB_WIDTH', (int) $options[$key] );
				if( !defined('BP_AVATAR_THUMB_HEIGHT') )
					define ( 'BP_AVATAR_THUMB_HEIGHT', (int) $options[$key] );
			break;
			case 'avatar_full_size_select' :
				if( !defined('BP_AVATAR_FULL_WIDTH') )
					define ( 'BP_AVATAR_FULL_WIDTH', (int) $options[$key] );
				if( !defined('BP_AVATAR_FULL_HEIGHT') )
					define ( 'BP_AVATAR_FULL_HEIGHT', (int) $options[$key] );
			break;
			case 'avatar_max_size_select' :
				if( !defined('BP_AVATAR_ORIGINAL_MAX_WIDTH') )
					define ( 'BP_AVATAR_ORIGINAL_MAX_WIDTH', (int) $options[$key] );
			break;
			case 'avatar_default_image' :
				if( !defined('BP_AVATAR_DEFAULT') )
					define ( 'BP_AVATAR_DEFAULT', $options[$key] );
				if( !defined('BP_AVATAR_DEFAULT_THUMB') )
					define ( 'BP_AVATAR_DEFAULT_THUMB', $options[$key] );
			break;
			// advanced options
			case 'root_profiles_checkbox' :
				if( 'on' === $options[$key] && !defined('BP_ENABLE_ROOT_PROFILES') )
					define ( 'BP_ENABLE_ROOT_PROFILES', true );
			break;
			case 'cover_image_checkbox' :
				if( 'on' === $options[$key] && !defined('BP_DTHEME_DISABLE_CUSTOM_HEADER') )
					define ( 'BP_DTHEME_DISABLE_CUSTOM_HEADER', true );
			break;
			case 'group_auto_join_checkbox' :
				if( 'on' === $options[$key] && !defined('BP_DISABLE_AUTO_GROUP_JOIN') )
					define ( 'BP_DISABLE_AUTO_GROUP_JOIN', true );
			break;
			case 'ldap_username_checkbox' :
				if( 'on' === $options[$key] && !defined('BP_ENABLE_USERNAME_COMPATIBILITY_MODE') )
					define ( 'BP_ENABLE_USERNAME_COMPATIBILITY_MODE', true );
			break;
			case 'wysiwyg_editor_checkbox' :
				if( 'on' === $options[$key] && !defined('NO_MEDIA_POST_FORM') )
					define ( 'NO_MEDIA_POST_FORM', true );
			break;
			case 'all_autocomplete_checkbox' :
				if( 'on' === $options[$key] && !defined('BP_MESSAGES_AUTOCOMPLETE_ALL') )
					define ( 'BP_MESSAGES_AUTOCOMPLETE_ALL', true );
			break;
			case 'depricated_code_checkbox' :
				if( 'on' === $options[$key] && !defined('BP_IGNORE_DEPRECATED') )
					define ( 'BP_IGNORE_DEPRECATED', true );
			break;
			// multisite options
			case 'enable_multiblog_checkbox' :
				if( 'on' === $options[$key] && !defined('BP_ENABLE_MULTIBLOG') )
					define ( 'BP_ENABLE_MULTIBLOG', true );
			break;
			case 'root_blog_select' :
				if( 'on' === $options[$key] && !defined('BP_ROOT_BLOG') )
					define ( 'BP_ROOT_BLOG', (int) $options[$key] );
			break;
		}
	}

}
add_action( 'plugins_loaded', 'bppf_run_extended_settings' );

/**
 * bppf_run_bp_included_settings loads
 *
 * BP filter/action hooked to bp include
 *
 * @return void
 */
function bppf_run_bp_included_settings() {

	$options = get_option('bppf_options');

	foreach( $options as $key => $value ) {
		switch ( $key ) {
			case 'profile_autolink_checkbox' :
				if( 'on' === $options[$key] )
					add_action( 'bp_init', 'bppf_remove_xprofile_links' );
			break;
			case 'user_mentions_checkbox' :
				if( 'on' === $options[$key] )
					add_action( 'bp_init', 'bppf_remove_user_mentions' );
			break;
		}
	}

}
add_action( 'bp_include', 'bppf_run_bp_included_settings' );

/**
 * bppf_remove_xprofile_links
 * @return void
 */
function bppf_remove_xprofile_links() {
	remove_filter( 'bp_get_the_profile_field_value', 'xprofile_filter_link_profile_data', 9, 2 );
}

/**
 * bppf_remove_user_mentions
 * @return void
 */
function bppf_remove_user_mentions() {
	add_filter('bp_activity_do_mentions', '__return_false');
}
