<?php

//Uninstall file of Shopp Product Page Browser plugin 
if( !defined( 'ABSPATH') && !defined('WP_UNINSTALL_PLUGIN') )
    exit();

// remove options array from database
delete_option('sppb_options');

?>