<?php
/**
 * Plugin Name: Allow Editor Widgets
 * Plugin URI: https://github.com/norcross/allow-editor-widgets
 * Description: Allow editors to manage widgets in WP.
 * Author: Andrew Norcross
 * Author URI: http://reaktivstudios.com/
 * Version: 0.0.1
 * Text Domain: allow-editor-widgets
 * Domain Path: languages
 * License: MIT
 * GitHub Plugin URI: https://github.com/norcross/allow-editor-widgets
 */

// Set my base for the plugin.
if ( ! defined( 'ALEDWG_BASE' ) ) {
	define( 'ALEDWG_BASE', plugin_basename( __FILE__ ) );
}

// Set my directory for the plugin.
if ( ! defined( 'ALEDWG_DIR' ) ) {
	define( 'ALEDWG_DIR', plugin_dir_path( __FILE__ ) );
}

// Set my version for the plugin.
if ( ! defined( 'SALEDWG_VER' ) ) {
	define( 'ALEDWG_VER', '0.0.1' );
}

/**
 * Set up and load our class.
 */
class AllowEditorWidgets
{

	/**
	 * Load our hooks and filters.
	 *
	 * @return void
	 */
	public function init() {
		add_action( 'plugins_loaded',               array( $this, 'textdomain'          )           );
		add_action( 'plugins_loaded',               array( $this, 'load_files'          )           );
	}

	/**
	 * Load textdomain for international goodness.
	 *
	 * @return void
	 */
	public function textdomain() {
		load_plugin_textdomain( 'allow-editor-widgets', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
	}

	/**
	 * Call our files in the appropriate place.
	 *
	 * @return void
	 */
	public function load_files() {

		// Load our back end.
		if ( is_admin() ) {
			require_once( 'lib/admin.php' );
		}
	}

	// End the class.
}

// Instantiate our class.
$AllowEditorWidgets = new AllowEditorWidgets();
$AllowEditorWidgets->init();


