<?php

/**
 * Fired during plugin deactivation
 *
 * @link       http://www.inboundio.com
 * @since      1.0.0
 *
 * @package    imp
 * @subpackage imp/includes
 */

/**
 * Fired during plugin deactivation.
 *
 * This class defines all code necessary to run during the plugin's deactivation.
 *
 * @since      1.0.0
 * @package    imp
 * @subpackage imp/includes
 * @author     Anurag Singh <anurag722@hotmail.com>
 */
class Imp_Deactivator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function deactivate() {
		global $wpdb;
		$table_name = $wpdb->prefix . "imp_leads"; 
		$wpdb->query("DROP TABLE IF EXISTS $table_name");
	}

}
