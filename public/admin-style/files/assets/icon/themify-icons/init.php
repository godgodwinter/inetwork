<?php
/*
Plugin Name:  Themify Icons Plugin
Plugin URI:   https://themify.me/themify-icons
Version:      1.0.5
Author:       Themify
Description:  Insert the Themify Icons easily in your post content, WordPress menus, and widget titles.
Text Domain:  themify-icons
Domain Path:  /languages
*/

if ( !defined( 'ABSPATH' ) ) exit;

register_activation_hook( __FILE__, array( 'Themify_Icons', 'activate' ) );

class Themify_Icons {

	public function __construct() {
		add_action( 'plugins_loaded', array( $this, 'constants' ), 1 );
		add_action( 'plugins_loaded', array( $this, 'includes' ), 2 );
		add_action( 'plugins_loaded', array( $this, 'i18n' ), 5 );
		add_action( 'plugins_loaded', array( $this, 'setup' ) );
		add_filter( 'plugin_row_meta', array( $this, 'themify_plugin_meta'), 10, 2 );
	}

	public function constants() {
		if( ! defined( 'THEMIFY_ICONS_DIR' ) )
			define( 'THEMIFY_ICONS_DIR', trailingslashit( plugin_dir_path( __FILE__ ) ) );

		if( ! defined( 'THEMIFYICONS_URI' ) )
			define( 'THEMIFY_ICONS_URI', trailingslashit( plugin_dir_url( __FILE__ ) ) );

		if( ! defined( 'THEMIFY_ICONS_VERSION' ) )
			define( 'THEMIFY_ICONS_VERSION', '1.1' );
	}

	public function includes() {
		if( is_admin() ) {
			include( THEMIFY_ICONS_DIR . 'includes/admin.php' );
			include( THEMIFY_ICONS_DIR . 'includes/tinymce.php' );
		}
		include( THEMIFY_ICONS_DIR . 'includes/menu-icons.php' );
		include( THEMIFY_ICONS_DIR . 'includes/widget-icons.php' );
		include( THEMIFY_ICONS_DIR . 'includes/shortcode.php' );

		if( ! class_exists( 'Themify_Icon_Picker' ) ) {
			include( THEMIFY_ICONS_DIR . 'includes/themify-icon-picker/themify-icon-picker.php' );
		}
		Themify_Icon_Picker::get_instance( THEMIFY_ICONS_URI . 'includes/themify-icon-picker' );
		Themify_Icon_Picker::get_instance()->register( 'Themify_Icon_Picker_Themify' );
	}

	public function themify_plugin_meta( $links, $file ) {
		if ( plugin_basename( __FILE__ ) == $file ) {
			$row_meta = array(
			  'changelogs'    => '<a href="' . esc_url( 'https://themify.me/changelogs/' ) . basename( dirname( $file ) ) .'.txt" target="_blank" aria-label="' . esc_attr__( 'Plugin Changelogs', 'themify-icons' ) . '">' . esc_html__( 'View Changelogs', 'themify-icons' ) . '</a>'
			);
	 
			return array_merge( $links, $row_meta );
		}
		return (array) $links;
	}
	public function i18n() {
		load_plugin_textdomain( 'themify-icons', false, '/languages' );
	}

	public function setup() {
		if( is_admin() ) {
			add_action( 'admin_enqueue_scripts', array( $this, 'admin_enqueue' ) );
			add_action( 'admin_init', array( $this, 'activation_redirect' ) );
		} else {
			add_action( 'wp_enqueue_scripts', array( $this, 'enqueue' ) );
		}
	}

	public function enqueue() {
		wp_register_style( 'themify-icons', Themify_Icon_Picker::themify_unique(THEMIFY_ICONS_URI . 'assets/themify-icons.css'), null, THEMIFY_ICONS_VERSION );
		wp_register_style( 'themify-icons-frontend', Themify_Icon_Picker::themify_unique(THEMIFY_ICONS_URI . 'assets/themify-icons-frontend.css'), array( 'themify-icons' ), THEMIFY_ICONS_VERSION );
	}

	function admin_enqueue( $hook_suffix ) {
		$this->enqueue();
		wp_enqueue_style( 'themify-icons' );
		wp_enqueue_style( 'themify-icons-frontend' );
		Themify_Icon_Picker::get_instance()->enqueue();
	}

	public static function activate( $network_wide ) {
		If( version_compare( get_bloginfo( 'version' ), '3.9', ' < ' ) ) {
			/* the plugin requires at least 3.9 */
			deactivate_plugins( basename( __FILE__ ) ); // Deactivate the plugin
		} else {
			if( ! $network_wide && ! isset( $_GET['activate-multi'] ) ) {
				add_option( 'themify_icons_activation_redirect', true );
			}
		}
	}

	public function activation_redirect() {
		if( get_option( 'themify_icons_activation_redirect', false ) ) {
			delete_option( 'themify_icons_activation_redirect' );
			wp_redirect( admin_url( 'options-general.php?page=themify-icons' ) );
		}
	}
}
$themify_icons = new Themify_Icons;