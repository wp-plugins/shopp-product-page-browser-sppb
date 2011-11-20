<?php
/*
* SPPB functions - Provides function for SPPB.
*
* @version 1.0.1
* @since 0.1
* @package shopp-sppb
* @subpackage sppb-functions
*
*/

/*
 *
 * @author Shoppdeveloper.com
 * @since 0.1
 *
 */


function add_sppb_stylesheet() {
        $sppb_StyleUrl = plugins_url('sppb.css', __FILE__); // Respects SSL, sppb.css is relative to the current file
        $sppb_StyleFile = WP_PLUGIN_DIR .'/'. basename(dirname(__FILE__)).'/sppb.css';
        if ( file_exists($sppb_StyleFile) ) {
            wp_register_style('sppb_StyleSheets', $sppb_StyleUrl);
            wp_enqueue_style( 'sppb_StyleSheets');
        }
} // End add_sppb_stylesheet


function sppb_languages() {
	// enable language files
	$plugin_dir = basename(dirname(__FILE__));
	load_plugin_textdomain( 'sppb', false, $plugin_dir."/languages/" );
}

function sppb( $result, $options, $Product){
	// add the new tag to shopp('product','') collection
	$result = sppb_generate_links( $options );
	return $result;
}

?>