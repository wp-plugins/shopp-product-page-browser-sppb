<?php
//Uninstall file of Shopp Product Page Browser plugin 

if( ! defined( 'ABSPATH') && !defined('WP_UNINSTALL_PLUGIN') ) exit();

// remove options array from database
delete_option('sppb_options');
global $wpdb;

$query = "DELETE *
			FROM {$wpdb->prefix}shopp_meta
			WHERE name LIKE 'sppb_%'
			AND type = 'setting'";
$wpdb->query($query);
?>