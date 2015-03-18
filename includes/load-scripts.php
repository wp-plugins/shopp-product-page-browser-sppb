<?php
/*
* SPPB functions - Provides function for SPPB.
*
* @version 1.3
* @since 0.1
* @package shopp-sppb
* @subpackage sppb-functions
*
* @author Shoppdeveloper.com
*
*/

function add_sppb_stylesheet() {
        $sppb_StyleUrl = plugins_url('sppb.css', __FILE__);
        $sppb_StyleFile = plugin_dir_path( __FILE__ ) . 'sppb.css';

        if ( file_exists($sppb_StyleFile) ) {
            wp_register_style('sppb_StyleSheets', $sppb_StyleUrl);
            wp_enqueue_style( 'sppb_StyleSheets');
        }
} // End add_sppb_stylesheet

add_action( 'wp_enqueue_scripts', 'add_sppb_stylesheet' );

function add_sppb_script($hook) {

        if( 'shopp-extra_page_sppb-settings' == $hook) {

            $sppb_ScriptUrl = plugins_url('sppb-settings.js', __FILE__);
            $sppb_ScriptFile = plugin_dir_path( __FILE__ ).'sppb-settings.js';

            if ( file_exists($sppb_ScriptFile) ) {
                wp_register_script('sppb_ScriptFile', $sppb_ScriptUrl);
                wp_enqueue_script( 'sppb_ScriptFile');
            }
        }
} // End add_sppb_script

add_action( 'admin_enqueue_scripts', 'add_sppb_script' );

function sppb_load_textdomain() {
	load_plugin_textdomain( 'sppb', false, 'shopp-sppb/languages/' );
}

add_action( 'wp_loaded', 'sppb_load_textdomain' );

function sppb( $result, $options, $Product){
	// add the new tag to shopp('product','') collection
	$result = sppb_generate_links( $options );
	return $result;
}

add_filter('shopp_tag_product_browser', 'sppb', 10, 3);
?>