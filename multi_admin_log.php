<?php
/*
Plugin Name:  Multi-Admin Log Plugin
Plugin URI:   https://chrisnwasike.github.io/multiadminlog
Description:  Adds a Multi-Admin Log menu in the Admin section of WordPress for Site Administrators to add Logs.
Version:      1.0.0
Author:       Chris Nwasike
Author URI:   https://chrisnwasike.github.io/
License:      GPL2
License URI:  https://www.gnu.org/licenses/gpl-2.0.html
Text Domain:  multiadminlog
*/

if ( ! defined( 'WPINC' )) {
  return;
}

global $multiadminlog_db_version;
$multiadminlog_db_version = '1.0.0';

function multiadminlog_install() {
	global $wpdb;
	global $multiadminlog_db_version;

	$table_name = $wpdb->prefix . 'multiadminlog';

	$charset_collate = $wpdb->get_charset_collate();

	$sql = "CREATE TABLE $table_name (
		id mediumint(9) NOT NULL AUTO_INCREMENT,
		time datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
		admin_id tinytext NOT NULL,
		admin_log text NOT NULL,
		PRIMARY KEY  (id)
	) $charset_collate;";

	require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
	dbDelta( $sql );

  if ( !get_option( 'multiadminlog_db_version' ) )
  {
    add_option( 'multiadminlog_db_version', $multiadminlog_db_version );
  }
  update_option( 'multiadminlog_db_version', $multiadminlog_db_version );

}

define( 'MULTIADMINLOG_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
define( 'MULTIADMINLOG_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'MULTIADMINLOG_VERSION', time() );

//Include Menu Section for Admin
include( MULTIADMINLOG_PLUGIN_DIR . 'includes/multiadminlog-menus.php');

//Include Settings for Adding logs
include( MULTIADMINLOG_PLUGIN_DIR . 'includes/multiadminlog-settings.php');

//Include CCS styles and Javascript
include( MULTIADMINLOG_PLUGIN_DIR . 'includes/multiadminlog-styles.php');
//include( MULTIADMINLOG_PLUGIN_DIR . 'includes/multiadminlog-scripts');

register_activation_hook( __FILE__, 'multiadminlog_install' );
