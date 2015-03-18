<?php
/*
* SPPB options - Provides Shopp Product Page Browser (sppb) option page in Shopp menu.
*
* @version 1.3
* @since 0.1
* @package sppb
* @author Shoppdeveloper.com
*
*/

defined( 'WPINC' ) || header( 'HTTP/1.1 403' ) & exit; // Prevent direct access

class ShoppProductBrowser {

	// variables 
	public $sbbp_options;				// array to store the settings
	public $sppb_previous;				// text string to replace 'previous'
	public $sppb_next;					// text string to replace 'next'
	public $sppb_thumbnail;				// replace text link with thumbnail link 'Y' or 'N'
	public $sppb_size;					// size of thumbnail
	public $sppb_image_setting;			// use predefined image setting
	public $sppb_exclude_category;		// do not display previous/next links in these categories
	public $sppb_exclude_product;		// do not display previous/next links with these products
	public $sppb_products_limit;		// maximum of products in one category
	public $meta_table;

	function ShoppProductBrowser() {
		// table setting
		global $wpdb;

        $p 								= $wpdb->prefix;
        $this->meta_table 				= $p . 'shopp_meta';
		$this->sppb_previous			= PREVIOUS;
		$this->sppb_next				= NEXT;
		$this->sppb_thumbnail 			= 'N';
		$this->sppb_size				= '50';
		$this->sppb_image_setting		= '';
		$this->sppb_exclude_category	= '';
		$this->sppb_exclude_product 	= '';
		$this->sppb_products_limit 		= '200';

	}

	function shopp_product_browser_settings_page() {

		if ( ! empty($_POST['save']) ) {
		    check_admin_referer('shopp-product-browser');
            shopp_set_formsettings();
			$updated = __('Product Browser settings saved.','sppb');
		}

		$settings = sDB::query("SELECT name FROM $this->meta_table WHERE type = 'image_setting'", 'array');

		foreach ( $settings as $setting) $imagesettings[] = $setting->name; 
		
		include("settings.php");
	}

	function load_settings() {
		//update from prior versions
		$this->sppb_settings = get_option('sppb_options');

		if ( ! empty($sppb_settings ) ) {
			$this->convert_old_settings($sppb_settings);
			delete_option('sppb_options');
		}
			
		$this->check_settings();
	}


	function convert_old_settings( $args ) {
		//convert settings from prior versions to Shopp settings
		foreach ($args as $key => $value) {
			shopp_set_setting( 'sppb_'.$key, $value);
		}
	}

	function check_settings() {
		$query = "SELECT name, value
					FROM $this->meta_table
					WHERE name LIKE 'sppb_%'";
		$results = sDB::query($query, 'array');

		if ( ! $results ) return;

		foreach ( $results as $result ) $this->{$result->name} = $result->value;

	}

} // End of Class
?>