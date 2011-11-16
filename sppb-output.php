<?php
/*
* SPPB output - Provides SPPB output on Shopp product page.
*
* @version 1.0
* @since 0.1
* @package Shopp-sppb
* @subpackage sppb-output
*
*/

/*
 *
 * @author Shoppdeveloper.com
 * @since 0.1
 *
 */


function sppb_generate_links($arg){

	$option  = strtolower($arg['show']);
	$option  = ereg_replace ( '[^a-z]+', "", $option ); 
	switch( $option ){
		case 'next':
			$result = sppb_generated_links( 'next' );
			break;
		case 'previous':
			$result = sppb_generated_links( 'previous' );
			break;
		default:
			$option = 'both';
			$result = sppb_generated_links( 'both' );
	}
	return $result;

} // End generate_links


function sppb_generated_links( $args ){

	global $Shopp;
    $sppb					= load_sppb_settings(); // retrieve settings from database
    $current_product_id		= shopp( 'product', 'id', 'return=true' );
    $current_product_url	= shopp( 'product', 'url', 'return=true' );
    $current_category		= shopp( 'category', 'id', 'return=true' );
	$previous_product_image = '';
	$previous_product_alt 	= '';
	$next_product_alt 		= '';
	$next_product_image		= '';
	$result 				= ''; 
	$thumb_size				= $sppb['size'];
	$products_limit			= $sppb['products_limit'];
	$thumb_size_string		= "width='".$thumb_size."' height='".$thumb_size."'"; 
  
	if ( $current_category == '' ){	
		$current_category = shopp('product','category','show=id&return=true');
	}
	if ($current_category == ''){
		shopp('catalog','catalog-products','load=true');
		$current_category = 'ALL';
	} else {
       	shopp('catalog','category',"id=$current_category&show=$products_limit&load=true"); 
	}
	if( ( !in_array( $current_category, $sppb['exclude_category'] ) ) && ( !in_array( $current_product_id, $sppb['exclude_product'] ) ) ){
 		if ( shopp('category','has-products') ){
			$prodcount = shopp('category','total','return=true');

			switch($prodcount){

				case 1:
					// do nothing there is no other product
					$result = '';
					return;
					break;
				case 2:
					$sppb_products[0] = $current_product_id; 
					while (shopp('category','products')){
						$prodid = shopp('product','id','return=true');
						$sppb_products[] = $prodid;
					}
					$sppb_products = array_unique($sppb_products);
					$sppb_products = array_merge($sppb_products);
					$previous_product_id = $sppb_products[1];
					shopp('catalog','product',"id=$previous_product_id&load=true");
					$previous_product_link = shopp('product','url','return=true');
					if($sppb['thumbnail'] == 'Y'){
						$previous_product_image = shopp( 'product','coverimage',"property=url&size=$thumb_size&return=true" );
						$previous_product_alt = shopp( 'product','name','return=true' );
						$next_product_alt = $previous_product_alt;
						$next_product_image = $previous_product_image;
					}
					$next_product_link = $previous_product_link;
					shopp('catalog','product',"id=$current_product_id&load=true");
					break;
				default:
					while (shopp('category','products')){
                       				$prodid = shopp('product','id','return=true');
						$sppb_products[] = $prodid;
					}
					reset($sppb_products);
					$current_key = key($sppb_products);
					while ($sppb_products[$current_key] != $current_product_id){
						next($sppb_products);
						$current_key = key($sppb_products);
					}
					if($current_key == 0){
						// if current_key is first element, then previous product is last element
						$previous_product_id = $sppb_products[$prodcount-1];
					} else {
						$previous_product_id = $sppb_products[$current_key-1];
					}
					shopp('catalog','product',"id=$previous_product_id&load=true");
					$previous_product_link = shopp('product','url','return=true');
					if($sppb['thumbnail'] == 'Y'){
						$previous_product_image = shopp( 'product','coverimage',"property=url&size=$thumb_size&return=true" );
						$previous_product_alt = shopp( 'product','name','return=true' );
					}
					if($current_key == ($prodcount-1)){
						// if current_key is last element, then next product is first element
						$next_product_id = $sppb_products[0];
					} else {
						$next_product_id = $sppb_products[$current_key+1];
					}
					shopp('catalog','product',"id=$next_product_id&load=true");
					$next_product_link = shopp('product','url','return=true');
					if($sppb['thumbnail'] == 'Y'){
						$next_product_image = shopp( 'product','coverimage',"property=url&size=$thumb_size&return=true" );
						$next_product_alt = shopp( 'product','name','return=true' );
					}
					shopp('catalog','product',"id=$current_product_id&load=true");
					break;
			} // End switch($prodcount)
			switch( $args ){
				case 'next':
					$result = "<div id='sppb-next'><a href='".$next_product_link."' >";
					if ($sppb['thumbnail'] == 'Y'){
						$result .= "<img src='".$next_product_image."' title='".$next_product_alt;
						$result .= "' alt='".$next_product_alt."' ".$thumb_size_string.">";
					} else {
						$result .= $sppb['next'];
					}
					$result .= "</a></div>";
					break;
				case 'previous':
					$result = "<div id='sppb-previous'><a href='".$previous_product_link."'>";
					if ($sppb['thumbnail'] == 'Y'){
						$result .= "<img src='".$previous_product_image."' title='".$previous_product_alt;
						$result .= "' alt='".$previous_product_alt."' ".$thumb_size_string.">";
					} else {
						$result .= $sppb['previous'];
					}
					$result .= "</a></div>";
					break;
				default:
					$result = "<div id='sppb-previous'><a href='".$previous_product_link."'>";
					if ($sppb['thumbnail'] == 'Y'){
						$result .= "<img src='".$previous_product_image."' title='".$previous_product_alt;
						$result .= "' alt='".$previous_product_alt."' ".$thumb_size_string."></a></div>";
						$result .= "<div id='sppb-next'><a href='".$next_product_link."'>";
						$result .= "<img src='".$next_product_image."' title='".$next_product_alt; 
						$result .= "' alt='".$next_product_alt."' ".$thumb_size_string.">";
					} else {
						$result .= $sppb['previous']."</a></div>";
						$result .= "<div id='sppb-next'><a href='".$next_product_link."'>";
						$result .= $sppb['next'];
					}
					$result .= "</a></div>";
					break;
			} //  End switch ($args)
        	} else {
			$result = __("No Categories/Products Found",'sppb');
		} // End if

	} //End if
	return $result;

} //End generated_links


function load_sppb_settings(){
	// retrieve settings from database
	$sppb_settings						= get_option( 'sppb_options' );
	$sppb_settings['previous']			= ($sppb_settings['previous'] == '')? __('Previous','sppb'):$sppb_settings['previous'];
	$sppb_settings['next']				= ($sppb_settings['next'] == '')? __('Next','sppb'):$sppb_settings['next'];
	$sppb_settings['thumbnail']			= ($sppb_settings['thumbnail'] == '')? 'N':$sppb_settings['thumbnail'];
	$sppb_settings['size']				= ($sppb_settings['size'] == '')?'50':$sppb_settings['size'];
	$sppb_settings['exclude_category']	= explode($sppb_settings['exclude_category']);
	$sppb_settings['exclude_product'] 	= explode($sppb_settings['exclude_product']);
	$sppb_settings['products_limit'] 	= ($sppb_settings['products_limit'] == '')?'200':$sppb_settings['products_limit'];
	return $sppb_settings;

} //End load_sppb_settings


?>