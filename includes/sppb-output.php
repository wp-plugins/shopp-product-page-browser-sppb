<?php

/*
* SPPB output - Provides SPPB output on Shopp product page.
*
* @version 1.3
* @since 0.1
* @package Shopp-sppb
* @author Shoppdeveloper.com
*
*/

function sppb_generate_links($args){
		$option = 'both';
		$cat 	= '';

        if ( isset($args['show']) ) {
        	$option  = strtolower($args['show']);
	        $option  = preg_replace ( '/[^a-z]+/', "", $option );
        }

        if ( isset($args['cat']) ) {
        	$cat  = $args['cat'];
	        $cat  = preg_replace ( '/[^0-9]+/', "", $cat );
        }


		$array = array( 'show' => 'both', 'cat' => $cat);

		if ( 'previous' == $option ) $array['show'] = 'previous';

		if ( 'next' == $option ) $array['show'] = 'next';

		$result = sppb_generated_links( $array );

		return $result;

} // End generate_links

function sppb_generated_links( $args ) {
	global $Shopp;
    $sppb					= load_sppb_settings(); // retrieve settings from database
    $current_product_id		= shopp( 'product.get-id' );
    $current_product_url	= shopp( 'product.get-url' );
	$show = $args['show'];

    if ( '' != $args['cat'] ) {
	    $current_category = $args['cat'];
    } else {
        $current_category = shopp( 'product.get-category', 'show=id' );
    }

	$previous_product_image = '';
	$previous_product_alt 	= '';
	$next_product_alt 		= '';
	$next_product_image		= '';
	$result 				= ''; 
	$thumb_size				= $sppb['size'];
	$image_setting 			= $sppb['image_setting'];
	$products_limit			= $sppb['products_limit'];
	$thumb_size_string		= "width='" . $thumb_size . "' height='" . $thumb_size . "'"; 
	$prodcount				= 0;

	if ( ( ! in_array( $current_category, $sppb['exclude_category'] ) ) && ( ! in_array( $current_product_id, $sppb['exclude_product'] ) ) ){
       	shopp('storefront','category',"id=$current_category&show=$products_limit&load=true");

 		if ( shopp('collection','has-products') ){
			$prodcount = shopp('collection.get-total');
			$size_string = "size=$thumb_size";
			
			if ( ! empty($image_setting) ) {
				$thumb_size_string = '';
				$size_string = "setting=$image_setting";
			}

			switch($prodcount){

				case 1:
					// do nothing there is no other product
					shopp('storefront','product',"id=$current_product_id&load=true");
					$result = '';
					return;
					break;
				case 2:
					$sppb_products[0] = $current_product_id; 

					while ( shopp('collection', 'products') ){
           				$prodid = shopp('product.get-id');
						$sppb_products[] = $prodid;
					}

					$sppb_products = array_unique($sppb_products);
					$sppb_products = array_merge($sppb_products);
					$previous_product_id = $sppb_products[1];
					shopp('catalog', 'product', "id=$previous_product_id&load=true");
					$previous_product_link = shopp('product.get-url');
					$previous_product_link .= "?cat=$current_category";

					if ( 'Y' == $sppb['thumbnail'] ) {

						$previous_product_image = shopp( 'product.get-coverimage', "property=url&$size_string" );
						$sppb['thumbnail'] = ( empty($previous_product_image) ) ? 'N' : $sppb['thumbnail'];
						$previous_product_alt = shopp( 'product.get-name' );
						$next_product_alt = $previous_product_alt;
						$next_product_image = $previous_product_image;
					}

					$next_product_link = $previous_product_link;
					shopp('storefront', 'product', "id=$current_product_id&load=true");
					break;
				default:

					while ( shopp('collection','products') ) {
	       				$prodid = shopp('product.get-id');
						$sppb_products[] = $prodid;
					}

					reset($sppb_products);
					$sppb_ids = array_flip($sppb_products);

					if ( isset($sppb_ids[$current_product_id]) ) {
						$current_key = $sppb_ids[$current_product_id];
					} else {
						// if current_key is not present, we'll assume it is in the middle of the array
						$current_key = floor( ( min($prodcount, $products_limit)/2) );
					}

					unset($sppb_ids); // we no longer need this

					if ( 0 == $current_key ) {
						// if current_key is first element, then previous product is last element
						$previous_product_id = $sppb_products[$prodcount-1];
					} else {
						$previous_product_id = $sppb_products[$current_key-1];
					}

					shopp('storefront', 'product',"id=$previous_product_id&load=true");
					$previous_product_link = shopp('product.get-url');
					$previous_product_link .= "?cat=$current_category";

					if ( 'Y' == $sppb['thumbnail'] ){
						$previous_product_image = shopp( 'product.get-coverimage', "property=url&$size_string" );
						$previous_product_alt = shopp( 'product.get-name' );
					}

					if ( $current_key == (min($products_limit, $prodcount)-1) ) {
						// if current_key is last element, then next product is first element
						$next_product_id = $sppb_products[0];
					} else {
						$next_product_id = $sppb_products[$current_key+1];
					}

					shopp('storefront', 'product', "id=$next_product_id&load=true");
					$next_product_link = shopp('product.get-url');
					$next_product_link .= "?cat=$current_category";

					if ( 'Y' == $sppb['thumbnail'] ) {
						$next_product_image = shopp( 'product.get-coverimage', "property=url&$size_string" );
						$next_product_alt = shopp( 'product.get-name' );
					}

					shopp('storefront', 'product', "id=$current_product_id&load=true");
					break;

			} // End switch($prodcount)

 			unset($sppb_products);  //free up some memory

			switch( $show ){

				case 'next':
					$result = "<div id='sppb-next'><a href='" . $next_product_link . "' >";

					if ( 'Y' == $sppb['thumbnail'] ) {
						$result .= "<img src='".$next_product_image."' title='".$next_product_alt;
						$result .= "' alt='".$next_product_alt."' ".$thumb_size_string.">";
					} else {
						$result .= $sppb['next'];
					}

					$result .= "</a></div>";
					break;
				case 'previous':
					$result = "<div id='sppb-previous'><a href='".$previous_product_link."'>";

					if ( 'Y' == $sppb['thumbnail'] ) {
						$result .= "<img src='" . $previous_product_image . "' title='" . $previous_product_alt;
						$result .= "' alt='" . $previous_product_alt . "' " . $thumb_size_string . ">";
					} else {
						$result .= $sppb['previous'];
					}

					$result .= "</a></div>";
					break;
				default:
					$result = "<div id='sppb-previous'><a href='".$previous_product_link."'>";

					if ( 'Y' == $sppb['thumbnail'] ) {
						$result .= "<img src='" . $previous_product_image . "' title='" . $previous_product_alt;
						$result .= "' alt='" . $previous_product_alt . "' ".$thumb_size_string . "></a></div>";
						$result .= "<div id='sppb-next'><a href='" . $next_product_link . "'>";
						$result .= "<img src='" . $next_product_image . "' title='" . $next_product_alt; 
						$result .= "' alt='" . $next_product_alt . "' " . $thumb_size_string . ">";
					} else {
						$result .= $sppb['previous'] . "</a></div>";
						$result .= "<div id='sppb-next'><a href='" . $next_product_link . "'>";
						$result .= $sppb['next'];
					}

					$result .= "</a></div>";
					break;

			} //  End switch ($args)

    	} else {

			// While testing uncomment the next line to determine whether the plugin is not working or can't find a product

			// $result = __("No Categories/Products Found",'sppb');

		} // End if

	} //End if

	return $result;

} //End generated_links

function load_sppb_settings(){
	global $wpdb;
	$sppb_settings =  array();

	// retrieve settings from database
	$query = "SELECT name, value
				FROM {$wpdb->prefix}shopp_meta
				WHERE name LIKE 'sppb_%'";
	$results = sDB::query($query, 'array');

	if ( ! $results ) return;

	foreach ( $results as $result ) { 
		$option_name = str_replace('sppb_', '', $result->name);
		$sppb_settings[$option_name] = $result->value;
	}

	$sppb_settings['previous']			= ($sppb_settings['previous'] == '') ? __('Previous', 'sppb') : $sppb_settings['previous'];
	$sppb_settings['next']				= ($sppb_settings['next'] == '') ? __('Next', 'sppb') : $sppb_settings['next'];
	$sppb_settings['thumbnail']			= ($sppb_settings['thumbnail'] == '') ?  'N' : $sppb_settings['thumbnail'];
	$sppb_settings['size']				= ($sppb_settings['size'] == '') ? '50' : $sppb_settings['size'];
	$sppb_settings['image_setting']		= ($sppb_settings['image_setting'] == '') ? '' : $sppb_settings['image_setting'];
	$sppb_settings['exclude_category']	= ($sppb_settings['exclude_category'] == '') ? Array() : explode(",", $sppb_settings['exclude_category']);
	$sppb_settings['exclude_product'] 	= ($sppb_settings['exclude_product'] == '') ? Array() : explode(",", $sppb_settings['exclude_product']);
	$sppb_settings['products_limit'] 	= ($sppb_settings['products_limit'] == '') ? '200' : $sppb_settings['products_limit'];

	return $sppb_settings;

} //End load_sppb_settings

?>