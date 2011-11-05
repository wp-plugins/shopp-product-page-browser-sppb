<?php
/*
* SPPB options - Provides Shopp Product Page Browser (sppb) option page in Shopp menu.
*
* @version 1.0
* @since 0.1
* @package sppb
* @subpackage sppb-options
*
*/

/*
 *
 * @author Shoppdeveloper.com
 * @since 0.1
 *
 */



class SPPBSettingsPage{
	function SPPB_settingspage(){
		$this->__construct();
	}

   	function __construct(){
      	add_action('shopp_init', array(&$this, 'init'));
   	}

   	function init(){
      	add_action('admin_menu', array(&$this, 'add_menu'));
		$sppbError = FALSE;
   	}

   	function add_menu(){
		// Add settings page to the Shopp menu
      	global $Shopp;
      	$ShoppMenu = $Shopp->Flow->Admin->MainMenu; //this is the Shopp menu handle
      	add_submenu_page($ShoppMenu, 'Shopp sppb', 'Shopp sppb',(defined('SHOPP_USERLEVEL') ? SHOPP_USERLEVEL : 'manage_options'), 'sppb-settings', array($this, 'createPage_SPPB'));
 
   	}

   	function createPage_SPPB(){
		// variables 
		
		$sbbp_options;				// array to store the settings
		$sppb_previous;				// text string to replace 'previous'
		$sppb_next;					// text string to replace 'next'
		$sppb_thumbnail;			// replace text link with thumbnail link 'Y' or 'N'
		$sppb_size;					// size of thumbnail
		$sppb_exclude_category;		// do not display previous/next links in these categories
		$sppb_exclude_product;		// do not display previous/next links with these products
		$sppb_products_limit;		// maximum of products in one category
		$sppb_submit_hidden;		// flag to save new settings

		// Read existing option values from database, use default value if empty.
		$sppb_options			= get_option( 'sppb_options' );
		$sppb_previous			= ($sppb_options['previous'] == '')? __('Previous','sppb'):$sppb_options['previous'];
		$sppb_next				= ($sppb_options['next'] == '')? __('Next','sppb'):$sppb_options['next'];
		$sppb_thumbnail 		= ($sppb_options['thumbnail'] == '')? 'N':$sppb_options['thumbnail'];
		$sppb_size				= ($sppb_options['size'] == '')?'50':$sppb_options['size'];
		$sppb_exclude_category	= $sppb_options['exclude_category'];
		$sppb_exclude_product 	= $sppb_options['exclude_product'];
		$sppb_products_limit 	= ($sppb_options['products_limit'] == '')?'200':$sppb_options['products_limit'];


		// If changes are made, this hidden field will be set to 'Y'
		if(isset($_POST[ 'sppb_submit_hidden' ]) && $_POST[ 'sppb_submit_hidden' ] == 'Y' ) {

			// Read values entered in the form
			$sppb_previous 		= $_POST[ 'sppb_previous'];
			$sppb_next 		= $_POST[ 'sppb_next'];
			$sppb_thumbnail 	= $_POST[ 'sppb_thumbnail'];
			$sppb_size 		= $_POST[ 'sppb_size'];
			$sppb_exclude_category 	= $_POST[ 'sppb_exclude_category'];
			$sppb_exclude_product 	= $_POST[ 'sppb_exclude_product'];
			$sppb_products_limit 	= $_POST[ 'sppb_products_limit'];

			// Check the posted values
			$sppb_options['previous'] 		= $sppb_previous; // any value will do
			$sppb_options['next']			= $sppb_next;	// any value will do

			if ($sppb_thumbnail == 'Y' || $sppb_thumbnail == 'N'){ // needs to be Y or N
				$sppb_options['thumbnail']	= $sppb_thumbnail;
			} else {
				$sppb_thumbnail = $sppb_options['thumbnail'];
				$this->sppbError=TRUE;
			}

			if(is_numeric($sppb_size)){     // needs to be a number
				$sppb_options['size']	= $sppb_size;
			} else {
				$sppb_size = $sppb_options['size'];
				$this->sppbError=TRUE;
			}

			$sppb_options['exclude_category'] 	= $sppb_exclude_category; //not tested yet
			$sppb_options['exclude_product']	= $sppb_exclude_product;  // not tested yet

			if(is_numeric($sppb_products_limit)){	// needs to be a number
				$sppb_options['products_limit']	= $sppb_products_limit;
			} else {
				$sppb_products_limit = $sppb_options['products_limit'];
				$this->sppbError=TRUE;
			}

			// Save the posted values
			update_option( 'sppb_options', $sppb_options );

    		// Put an options updated message on the screen
			if($this->sppbError){
				$errorMessage = __('Some invalid input has been discarded.','sppb');
			}
?>
      			<div id="message" class="updated fade">
        			<p><strong><?php _e( 'Options saved.', 'sppb' );echo " ".$errorMessage; ?></strong></p>
      			</div>
<?php
		} //endif
?>
		<div class="wrap shopp">
			<div id="icon-options-general" class="icon32"><br /></div>
				<h2><?php _e( 'Shopp Product Page Browser (sppb) Settings', 'sppb' ); ?></h2>
				<form name="sppb_settings" method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">
					<input type="hidden" name="sppb_submit_hidden" value="Y">
					<table class="form-table">
						<tbody>
							<tr>
								<th scope="row" valign="top"><label for="previous"><?php _e( 'Previous:','sppb'); ?></label></th>
								<td>
                							<input type="text" name="sppb_previous" value="<?php echo $sppb_previous; ?>" /><br />
									<?php _e('Default is Previous.','sppb'); ?>
								</td>
							</tr>
							<tr>
								<th scope="row" valign="top"><label for="next"><?php _e( 'Next:','sppb'); ?></label></th>
								<td>
									<input type="text" name="sppb_next" value="<?php echo $sppb_next; ?>" /><br />
									<?php _e( 'Default is Next.','sppb' );?>
								</td>
							</tr>
							<tr>
								<th scope="row" valign="top"><label for="thumbnail"><?php _e( 'Thumbnail:','sppb'); ?></label></th>
								<td>
									<input type="radio" name="sppb_thumbnail" value="N" <?php echo ($sppb_thumbnail == "N") ? 'checked' : ''; ?> /><?php _e( 'No', 'sppb');?>  
									<input type="radio" name="sppb_thumbnail" value="Y" <?php echo ($sppb_thumbnail == "Y") ? 'checked' : ''; ?> /><?php _e( 'Yes', 'sppb'); ?> <br />
									<?php _e('Specify whether or not you want to display a thumbnail of the previous/next product.','sppb'); ?>
								</td>
							</tr>
							<tr>
								<th scope="row" valign="top"><label for="size"><?php _e( 'Thumbnail Size:','sppb'); ?></label></th>
								<td>
									<input type="text" name="sppb_size" size="3" value="<?php echo $sppb_size; ?>" /><br />
									<?php _e( 'Default is 50.','sppb' );?>
								</td>
							</tr>
							<tr>
								<th scope="row" valign="top"><label for="exclude_category"><?php _e( 'Exclude Category:','sppb'); ?></label></th>
								<td>
									<input type="text" name="sppb_exclude_category" value="<?php echo $sppb_exclude_category; ?>" /><br />
									<?php _e('Specify the categories to exclude from browsing. Enter Category ID\'s comma separated.','sppb'); ?>
								</td>
							</tr>
							<tr>
								<th scope="row" valign="top"><label for="exclude_product"><?php _e( 'Exclude Product:','sppb'); ?></label></th>
								<td>
									<input type="text" name="sppb_exclude_product" value="<?php echo $sppb_exclude_product; ?>" /><br />
									<?php _e( "Specify the products to exclude from browsing. Enter Product ID's comma separated.",'sppb'); ?>
								</td>
							</tr>
							<tr>
								<th scope="row" valign="top"><label for="products_in_category"><?php _e( 'Products in Category:','sppb'); ?></label></th>
								<td>
									<input type="text" name="sppb_products_limit" size="3" value="<?php echo $sppb_products_limit; ?>" /><br />
									<?php _e( 'Increase this number, if you have more products in a category. Default is 200.','sppb' );?>
								</td>
							</tr>
						</tbody>
					</table>
					<p class="submit"><input type="submit" class="button-primary" name="save" value="<?php _e('Save Changes','sppb'); ?>"></p>
				</form>

<?php
   			} //End of IF-statement

} // End of Class


?>