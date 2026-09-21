<?php
/*
Plugin Name: Branda
Plugin URI: https://wpmudev.com/project/ultimate-branding/
Description: A complete white label and branding solution for multisite. Login images, favicons, remove WordPress links and branding, and much more.
Author: WPMU DEV
Version: 3.4.32
Author URI: https://wpmudev.com/
Requires PHP: 7.4
Text_domain: ub


Copyright 2009-2024 Incsub (https://incsub.com)
Author – WPMU DEV

This program is free software; you can redistribute it and/or modify it under
the terms of the GNU General Public License (Version 2 - GPLv2) as published
by the Free Software Foundation.

This program is distributed in the hope that it will be useful, but WITHOUT
ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS
FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.

You should have received a copy of the GNU General Public License along with
this program; if not, write to the Free Software Foundation, Inc., 51 Franklin
St, Fifth Floor, Boston, MA 02110-1301 USA

 */

if ( ! function_exists( 'branda_deactivate_plugin' ) ) {
	/**
	 * Keep only one Branda copy active.
	 *
	 * @param string $keep_file Absolute path of the copy that should remain active.
	 */
	function branda_deactivate_plugin( $keep_file ) {
		if ( ! function_exists( 'deactivate_plugins' ) ) {
			require_once ABSPATH . 'wp-admin/includes/plugin.php';
		}

		$keep = plugin_basename( $keep_file );

		foreach (
			array(
				'branda-white-labeling/ultimate-branding.php',
				'ultimate-branding/ultimate-branding.php'
			) as $plugin
		) {
			if ( $plugin !== $keep ) {
				deactivate_plugins( $plugin, true );
			}
		}
	}
}

add_action(
	'activated_plugin',
	function ( $plugin ) {
		if ( plugin_basename( __FILE__ ) === $plugin ) {
			branda_deactivate_plugin( __FILE__ );
		}
	}
);



if ( defined( 'BRANDA_BUILD_TYPE' ) ) {
	// Another version of the plugin must be active already, abort
	return;
}

const BRANDA_BUILD_TYPE = 'free';
/**
 * Branda Version
 */
$ub_version = null;

// Define WPMUDEV_BRANDA_PLUGIN_FILE.
if ( ! defined( 'WPMUDEV_BRANDA_PLUGIN_FILE' ) ) {
	define( 'WPMUDEV_BRANDA_PLUGIN_FILE', __FILE__ );
}

// Plugin directory.
if ( ! defined( 'WPMUDEV_BRANDA_DIR' ) ) {
	define( 'WPMUDEV_BRANDA_DIR', plugin_dir_path( __FILE__ ) );
}

// Plugin url.
if ( ! defined( 'WPMUDEV_BRANDA_URL' ) ) {
	define( 'WPMUDEV_BRANDA_URL', plugin_dir_url( __FILE__ ) );
}


// Include the configuration library.
require_once dirname( __FILE__ ) . '/etc/config.php';
// Include the functions library.
if ( file_exists( 'inc/deprecated-functions.php' ) ) {
	require_once 'inc/deprecated-functions.php';
}
require_once 'inc/functions.php';
require_once 'inc/class-branda-helper.php';

/**
 * Set ub Version.
 */
if ( ! function_exists( 'branda_set_ub_version' ) ) {
	function branda_set_ub_version() {
		global $ub_version;
		$data = get_plugin_data( __FILE__, false, false );
		$ub_version = $data['Version'];
	}
}

// Set up my location.
add_action( 'init', function () {
	set_ultimate_branding( __FILE__ );
}, 9 );

if ( ! defined( 'BRANDA_SUI_VERSION' ) ) {
	define( 'BRANDA_SUI_VERSION', '2.12.23' );
}

$dash_notification_path = dirname( __FILE__ ) . '/external/dash-notice/wpmudev-dash-notification.php';
if ( file_exists( $dash_notification_path ) ) {
	include_once $dash_notification_path;
}

register_activation_hook( __FILE__, 'branda_register_activation_hook' );
register_deactivation_hook( __FILE__, 'branda_register_deactivation_hook' );
register_uninstall_hook( __FILE__, 'branda_register_uninstall_hook' );

