<?php

/**
 * The plugin bootstrap file
 *
 * @link 				http://dccmarketing.com
 * @since 				1.0.0
 * @package 			Formidable_CachePress
 *
 * @wordpress-plugin
 * Plugin Name: 		Formidable CachePress
 * Plugin URI: 			http://dccmarketing.com/
 * Description: 		Flushes SiteGround cache in CachePress when Formidable actions are triggered.
 * Version: 			1.0.0
 * Author: 				DCC Marketing
 * Author URI: 			http://dccmarketing.com/
 * License: 			GPL-2.0+
 * License URI: 		http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain: 		formidable-cachepress
 * Domain Path: 		/assets/languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) { die; }

register_activation_hook( __FILE__, 'frm_cp_check' );
add_action( 'plugins_loaded', 'frm_cp_flush_caches', 99 );

/**
 * Checks for the existence of CachePress
 */
function frm_cp_check() {

	$plugins = get_option( 'active_plugins' );

	if ( ! in_array( 'sg-cachepress/sg-cachepress.php', $plugins ) ) { return FALSE; }

} // frm_cp_check()

/**
 * Flushes cache before Formidable settings are saved.
 */
function frm_cp_flush_caches() {

	global $sg_cachepress_supercacher;

	add_action( 'frm_before_update_form_settings', array( $sg_cachepress_supercacher, 'purge_cache' ) );

} // frm_cp_flush_caches()