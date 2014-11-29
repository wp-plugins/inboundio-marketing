<?php

/**
 * Fired during plugin activation
 *
 * @link       http://www.inboundio.com
 * @since      1.0.0
 *
 * @package    imp
 * @subpackage imp/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    imp
 * @subpackage imp/includes
 * @author     Anurag Singh <anurag722@hotmail.com>
 */
class Imp_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {
		global $wpdb;

		// create tables during activation
		// Leads
		$table_name = $wpdb->prefix . "imp_leads"; 
		$sql = "CREATE TABLE IF NOT EXISTS $table_name (
			id INTEGER(9) NOT NULL AUTO_INCREMENT,
			first_name VARCHAR(255),
			last_name VARCHAR(255),
			email_address VARCHAR(255),
			contact_number VARCHAR(255),
			imported VARCHAR(2),
			status VARCHAR(2),
			UNIQUE KEY id (id)
			);";

		require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
		dbDelta( $sql );
}

}
