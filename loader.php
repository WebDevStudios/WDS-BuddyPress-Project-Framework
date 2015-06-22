<?php
/*
Plugin Name: BP Project Framework
Plugin URI: https://github.com/WebDevStudios/BP-Project-Framework
Description: A boilerplate for custom BuddyPress development.
Text Domain: buddypress
Domain Path: /languages
Version: 2.3.2.1
Author: WDS Team
Author URI: http://webdevstudios.com
License: GPLv2
*/

if ( !defined( 'ABSPATH' ) ) exit;

if ( !class_exists( 'BP_Project_Framework' ) ) :


/**
 * BP_Project_Framework class.
 */
class BP_Project_Framework {


    /**
     * instance function.
     *
     * @access public
     * @static
     * @return \BP_Project_Framework $instance
     */
	public static function instance() {

		// Store the instance locally to avoid private static replication
		static $instance = null;

		// Only run these methods if they haven't been run previously
		if ( null === $instance ) {
			$instance = new BP_Project_Framework;
			$instance->actions();
		}

		// Always return the instance
		return $instance;
	}


    /**
     * __construct function.
     *
     * @access private
     * @return \BP_Project_Framework
     */
	private function __construct() { /* Do nothing here */ }


	/**
	 * actions function.
	 *
	 * @access private
	 * @return void
	 */
	private function actions() {


		add_action( 'bp_include', array( $this, 'includes' ) );

        // these are for template file overrides.
		add_action( 'bp_register_theme_packages', array( $this, 'bp_custom_templatepack_work' ) );
		add_filter( 'pre_option__bp_theme_package_id', array( $this, 'bp_custom_templatepack_package_id' ) );
		add_action( 'wp', array( $this, 'bp_templatepack_kill_legacy_js_and_css' ), 999 );
		
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
	}


	/**
	 * inc function.
	 *
	 * @access public
	 * @return void
	 */
	public function includes() {
        // to include a file place it in the inc directory
        foreach( glob(  plugin_dir_path(__FILE__) . 'inc/*.php' ) as $filename ) {
            include $filename;
        }
	}
	
	
	/**
	 * enqueue_scripts function.
	 * 
	 * @access public
	 * @return void
	 */
	public function enqueue_scripts() {
	

		wp_enqueue_style( 'bp-custom-css', plugins_url( 'assets/css/bp-custom.css' , __FILE__ ), array(), filemtime( plugin_dir_path( __FILE__ ) . 'assets/css/bp-custom.css' ) );
		wp_enqueue_script( 'bp-custom-js', plugins_url( 'assets/js/bp-custom.js' , __FILE__ ), array(), filemtime( plugin_dir_path( __FILE__ ) . 'assets/js/bp-custom.js' ) );
	}


	/**
	 * templatepack_work function.
	 *
	 * @access public
	 * @return void
	 */
	public function bp_custom_templatepack_work() {

		bp_register_theme_package( array(
				'id'		 => 'templates',
				'name'	 => __( 'BuddyPress Templates', 'buddypress' ),
				'version' => bp_get_version(),
				'dir'	 => plugin_dir_path( __FILE__ ) . '/templates',
				'url'	 => plugin_dir_url( __FILE__ ) . '/templates'
			) );

	}


	/**
	 * templatepack_package_id function.
	 *
	 * @access public
	 * @param mixed $package_id
	 * @return void
	 */
	public function bp_custom_templatepack_package_id( $package_id ) {
		return 'templates';
	}


	// Proposed BP core change: see http://buddypress.trac.wordpress.org/ticket/3741#comment:43
	/**
	 * templatepack_kill_legacy_js_and_css function.
	 *
	 * @access public
	 * @return void
	 */
	public function bp_templatepack_kill_legacy_js_and_css() {
		wp_dequeue_script( 'groups_widget_groups_list-js' );
		wp_dequeue_script( 'bp_core_widget_members-js' );
	}


}


/**
 * bp_custom_template_stack function.
 *
 * @access public
 * @return void
 */
function bp_project_framework() {
	return BP_Project_Framework::instance();
}
    bp_project_framework();

endif;
