<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * Dashboard. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://www.inboundio.com
 * @since             1.0.0
 * @package           imp
 *
 * @wordpress-plugin
 * Plugin Name:       InBoundio Marketing
 * Plugin URI:        http://www.inboundio.com/
 * Description:       InBoundio Marketing can be used to manage contacts/leads and send emails to them.
 * Version:           2.0.1
 * Author:            InBoundio
 * Author URI:        http://www.inboundio.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       imp
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-imp-activator.php
 */
function activate_imp() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-imp-activator.php';
	Imp_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-imp-deactivator.php
 */
function deactivate_imp() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-imp-deactivator.php';
	Imp_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_imp' );
register_deactivation_hook( __FILE__, 'deactivate_imp' );

/**
 * The core plugin class that is used to define internationalization,
 * dashboard-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-imp.php';
require plugin_dir_path( __FILE__ ) . 'includes/class-imp-widget.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_imp() {

	$plugin = new Imp();
	$plugin->run();

	$widget = new Imp_Widget();
}
run_imp();
