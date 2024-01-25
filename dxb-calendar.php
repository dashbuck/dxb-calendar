<?php
defined( 'ABSPATH' ) OR exit;

/**
 * DXB Calendar
 *
 * @package           dxbcalendar
 * @author            Dash Buck
 * @copyright         2024 Dash Buck
 * @license           GPL-2.0-or-later
 * Plugin Name:       DXB Calendar
 * Plugin URI:        https://dashbuck.com/calendar
 * Description:       Displays the date according to Dash's personal calendar.
 * Version:           0.0.0
 * Requires at least: 6.3
 * Requires PHP:      7.4
 * Author:            Dash Buck
 * Author URI:        https://dashbuck.com
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.txt
 * Update URI:        https://dashbuck.com/calendar
 * Text Domain:       dxbcal
 */

 /**
  * Activate the plugin.
  * 
  * @author Franz Josef Kaiser/wecodemore
  * @link http://wordpress.stackexchange.com/questions/25910/uninstall-activate-deactivate-a-plugin-typical-features-how-to/25979#25979
  */

register_activation_hook(   __FILE__, 'dxbcal_activation' );
function dxbcal_activation()
{
    if ( ! current_user_can( 'activate_plugins' ) )
        return;
    $plugin = isset( $_REQUEST['plugin'] ) ? $_REQUEST['plugin'] : '';
    check_admin_referer( "activate-plugin_{$plugin}" );

    //if there isn't a db table for the plugin, create one
    //global $wpdb;
    //$wpdb->query( "DROP TABLE IF EXISTS {$wpdb->prefix}dxbcaltable" ); reverse it
    
    //define option: day 1 $option_name = 'dxbcal_day1';

    # Uncomment the following line to see the function in action
    # exit( var_dump( $_GET ) );
}

 /**
  * Deactivate the plugin.
  * 
  * @author Franz Josef Kaiser/wecodemore
  * @link http://wordpress.stackexchange.com/questions/25910/uninstall-activate-deactivate-a-plugin-typical-features-how-to/25979#25979
  */

register_deactivation_hook( __FILE__, 'dxbcal_deactivation' );
function dxbcal_deactivation()
{
    if ( ! current_user_can( 'activate_plugins' ) ) { return; }
    
    $plugin = isset( $_REQUEST['plugin'] ) ? $_REQUEST['plugin'] : '';
    check_admin_referer( "deactivate-plugin_{$plugin}" );

    # Uncomment the following line to see the function in action
    # exit( var_dump( $_GET ) );
}

 /**
  * Uninstall the plugin.
  */

register_uninstall_hook(    __FILE__, 'dxbcal_uninstall' );
function dxbcal_uninstall()
{
    //defend against bad behavior
    defined( 'WP_UNINSTALL_PLUGIN' ) OR die;
    if ( ! current_user_can( 'activate_plugins' ) ) { return; }
    check_admin_referer( 'bulk-plugins' );

    //remove option data
    $option_name = 'dxbcal_day1';
    delete_option( $option_name );
    delete_site_option( $option_name ); //Multisite

    //remove database table
    global $wpdb;
    $wpdb->query( "DROP TABLE IF EXISTS {$wpdb->prefix}dxbcaltable" );
}

//TODO: settings page
    //MVP version:
    // - CSV import list of days to database
    // - Set 'day 1' of year
    //Eventually would like to be able to construct the calendar in settings ala Fantasy Calendar (possibly even actual implementation of Fantasy Calendar as WP plugin? I bet they'd let me lol)
//if ( is_admin() ) {
    // we are in admin mode
 //   require_once __DIR__ . '/admin/plugin-name-admin.php';
//}

//add_filter( 'should_load_separate_core_block_assets', '__return_true' ); //be polite - only load when needed!
//TODO: register dxbcal block. register_block_type()
    //use base and contrast as color names so we don't have to do a stylesheet. if we do, opt in to inlining since it'll be smol

//TODO: Do date math and display correct db row

