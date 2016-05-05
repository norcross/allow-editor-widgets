<?php
/**
 * Allow Editor Widgets - admin functions
 *
 * Contains admin related functions.
 *
 * @package Allow Editor Widgets
 */

/**
 * Set up and load our class.
 */
class ALEDWG_Admin
{

	/**
	 * Load our hooks and filters.
	 *
	 * @return void
	 */
	public function init() {
		add_filter( 'user_has_cap',                 array( $this, 'add_editor_cap'      )           );
		add_action( 'admin_menu',                   array( $this, 'manage_editor_menu'  )           );
	}

	/**
	 * Add the 'edit_theme_options' capability to editors.
	 *
	 * @param  array $caps  The current capabilities set to the current user.
	 *
	 * @return array $caps  The (potentially) modified capabilities set to the current user.
	 */
	public function add_editor_cap( $caps ) {

		// Check if the user has the edit_posts capability.
		if( ! empty( $caps[ 'edit_posts' ] ) ) {

			//  Add 'edit_theme_options' capability.
			$caps[ 'edit_theme_options' ] = true;
		}

		// Return the modified capabilities.
		return $caps;
	}

	/**
	 * Manage the admin sidebar menu to remove the non-widget things.
	 *
	 * @return void
	 */
	public function manage_editor_menu() {

		// Get the current user object.
		$user = new WP_User( get_current_user_id() );

		// Bail without a user.
		if ( empty( $user ) || ! is_object( $user ) || empty( $user->roles ) ) {
			return;
		}

		// Get my subset of roles.
		$roles  = array_values( $user->roles );

		// If "editor" exists in the roles, remove our submenu items.
		if ( in_array( 'editor', $roles ) ) {

			// Our two standard ones.
			remove_submenu_page( 'themes.php', 'themes.php' );
			remove_submenu_page( 'themes.php', 'nav-menus.php' );

			// The general customizer link.
        	remove_submenu_page( 'themes.php', 'customize.php?return=' . urlencode( str_replace( get_bloginfo( 'url' ), '', get_admin_url() ) ) );

			// An action in case something is different.
			do_action( 'aledwg_admin_menu' );
		}
	}

	// End the class.
}

// Instantiate our class.
$ALEDWG_Admin = new ALEDWG_Admin();
$ALEDWG_Admin->init();


