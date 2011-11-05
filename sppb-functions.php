<?php
/*
* SPPB functions - Provides function for SPPB.
*
* @version 1.0
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
	// load sppb.css stylesheet
	// Respects SSL, sppb.css is relative to the current file
	$styleUrl = plugins_url( 'sppb.css', __FILE__ ); 
	$styleFile = WP_PLUGIN_DIR . '/shopp-sppb/sppb.css';
	if ( file_exists( $styleFile ) ) {
		wp_register_style( 'styleFile', $styleUrl );
		wp_enqueue_style( 'styleFile' );
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