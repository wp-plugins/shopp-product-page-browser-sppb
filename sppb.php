<?php
/*
Plugin Name: Shopp Product Page Browser (sppb)
Plugin URI: http://wordpress.org/extend/plugins/shopp-product-page-browser-sppb/
Donate link: http://www.shoppdeveloper.com
Description: This plugin adds the feature to browse Shopp Product Pages in the Shopp webshop.
Version: 1.3 
Author: Shoppdeveloper.com
Author URI: http://www.shoppdeveloper.com

License: GPLv2


    Copyright 2011-2013 Shoppdeveloper.com  (email : support@shoppdeveloper.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/


defined( 'WPINC' ) || header( 'HTTP/1.1 403' ) & exit;

add_action('init', 'sppb_init');

function sppb_init(){
    global $SDC;
    define('PREVIOUS', __('Previous', 'sppb'));
    define('NEXT', __('Next', 'sppb'));

    // only start when Shopp is activated
    if ( function_exists('shopp') ) {

        if ( is_admin() ) {
            include 'includes/load-scripts.php';
            include 'includes/core.php';
            include 'includes/mainscreen.php';
        } else {
            include 'includes/load-scripts.php';
            include 'includes/sppb-output.php';
        }

    }
}



 
?>