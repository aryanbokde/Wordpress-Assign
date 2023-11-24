<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://github.com/aryanbokde
 * @since             1.0.0
 * @package           Wordpress_Assign
 *
 * @wordpress-plugin
 * Plugin Name:       Wordpress Assign
 * Plugin URI:        https://github.com/aryanbokde
 * Description:       Custom post type Event
 * Version:           1.0.0
 * Author:            Rakesh
 * Author URI:        https://github.com/aryanbokde/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       wordpress-assign
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */

define( 'WORDPRESS_ASSIGN_VERSION', '1.0.0' );
define( 'WORDPRESS_ASSIGN_DIR_URL', plugin_dir_url( __FILE__ ) );
define( 'WORDPRESS_ASSIGN_DIR_PATH', plugin_dir_path( __FILE__ ) );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-wordpress-assign-activator.php
 */
function activate_wordpress_assign() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wordpress-assign-activator.php';
	Wordpress_Assign_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-wordpress-assign-deactivator.php
 */
function deactivate_wordpress_assign() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wordpress-assign-deactivator.php';
	Wordpress_Assign_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_wordpress_assign' );
register_deactivation_hook( __FILE__, 'deactivate_wordpress_assign' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-wordpress-assign.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_wordpress_assign() {

	$plugin = new Wordpress_Assign();
	$plugin->run();

}
run_wordpress_assign();


