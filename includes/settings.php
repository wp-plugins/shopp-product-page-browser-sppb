<?php
/*
*
* SPPB options - Provides Shopp Product Page Browser (sppb) option page in Shopp Extra menu.
*
*/
?>

<div class="wrap shopp">
	<div id="icon-options-general" class="icon32"><br /></div>

<?php	global $Shopp;

		$shopp_first_run = shopp_setting('display_welcome');

    	// Check for Shopp version and Shopp mode
		if (SHOPP_VERSION >= '1.3') {
	    	$errors = array();
        	$errors['start'] = array(); // errors on Shopp mode

			if (isset($shopp_first_run) ) {
            	if ("off" != $shopp_first_run) $errors['start'][] = 'Shopp first run status should read "off" your Shopp first run mode status reads '.$shopp_first_run.'. <BR />';
			} else {
		    	$errors['start'][] = 'Could not read Shopp first run mode status from database. <BR />';
			}

		} else {
	    	exit("<h2>Shopp Product Page Browser</h2><p>This version of the Shopp Product Page Browser plugin needs Shopp version 1.3 or higher.<br />
	    	Please update to Shopp version 1.3 or higher, or download the Shopp Product Page Browser plugin version that matches your Shopp version from wordpress.org.</p>");
			return false;
		}

    	if ( ! empty($errors['start']) ){
        	$can_not_Start = '<p>Fix the following errors: <p />';

        	foreach ( $errors['start'] as $error ){
            	$can_not_start .= $error.'<br />';
        	}

			exit("<h2>Shopp Product Page Browser</h2><p>Could not start due to some Shopp settings.</p>".$can_not_start);
			return false;
		} 

		$this->load_settings();
		?>

	<h2><?php _e( 'Shopp Product Page Browser (sppb) Settings', 'sppb' ); ?></h2>
	<form name="sppb_settings" method="post" action="<?php echo esc_url($_SERVER['REQUEST_URI']); ?>">
		<?php wp_nonce_field('shopp-product-browser'); ?>
		<table class="form-table">
			<tbody>
				<tr>
					<th scope="row" valign="top"><label for="previous"><?php _e( 'Previous:','sppb'); ?></label></th>
					<td>
    					<input type="text" name="settings[sppb_previous]" id="sppb_previous" value="<?php echo $this->sppb_previous; ?>" /><br />
						<small><?php _e('Default is Previous.', 'sppb'); ?></small>
					</td>
				</tr>
				<tr>
					<th scope="row" valign="top"><label for="next"><?php _e( 'Next:','sppb'); ?></label></th>
					<td>
						<input type="text" name="settings[sppb_next]" id="sppb_next" value="<?php echo $this->sppb_next; ?>" /><br />
						<small><?php _e( 'Default is Next.', 'sppb' ); ?></small>
					</td>
				</tr>
				<tr>
					<th scope="row" valign="top"><label for="thumbnail"><?php _e( 'Thumbnail:', 'sppb'); ?></label></th>
					<td>
						<input type="radio" name="settings[sppb_thumbnail]" id="sppb_thumbnail_N" value="N" <?php echo ($this->sppb_thumbnail == "N") ? 'checked' : ''; ?> /><?php _e( 'No', 'sppb');?>  
						<input type="radio" name="settings[sppb_thumbnail]" id="sppb_thumbnail_Y" value="Y" <?php echo ($this->sppb_thumbnail == "Y") ? 'checked' : ''; ?> /><?php _e( 'Yes', 'sppb'); ?> <br />
						<small><?php _e('Specify whether or not you want to display a thumbnail of the previous/next product.', 'sppb'); ?></small>
					</td>
				</tr>
				<tr>
					<th scope="row" valign="top"><label for="size"><?php _e( 'Thumbnail Size:','sppb'); ?></label></th>
					<td>
						<input type="text" name="settings[sppb_size]" id="sppb_size" size="3" value="<?php echo $this->sppb_size; ?>" /><br />
						<small><?php _e( 'Default is 50.', 'sppb' ); ?></small>
					</td>
				</tr>
				<tr>
					<th scope="row" valign="top"><label for="image_setting"><?php _e( 'Image Setting:','sppb'); ?></label></th>
					<td>
						<select name="settings[sppb_image_setting]" id="sppb_image_setting">
	   							<option value='' <?php echo ( '' == $this->sppb_image_setting ) ? 'selected' : ''; ?> /><?php _e('= No Image Setting =', 'sppb'); ?></option>
							<?php foreach ($imagesettings as $imagesetting): ?>
	   							<option value="<?php echo $imagesetting; ?>" <?php echo ( $imagesetting == $this->sppb_image_setting ) ? 'selected' : ''; ?> /><?php echo $imagesetting; ?></option>
	   						<?php endforeach; ?>
						</select><br />
						<small><?php _e( 'Image settings are defined on the Shopp->Setup->Images tab', 'sppb' ); ?>.<br />
						<?php _e( 'This setting will override the above thumbnail size', 'sppb' ); ?>.</small>
					</td>
				</tr>				
				<tr>
					<th scope="row" valign="top"><label for="exclude_category"><?php _e( 'Exclude Category:','sppb'); ?></label></th>
					<td>
						<input type="text" name="settings[sppb_exclude_category]" value="<?php echo $this->sppb_exclude_category; ?>" /><br />
						<small><?php _e('Specify the categories to exclude from browsing. Enter Category ID\'s comma separated.', 'sppb'); ?></small>
					</td>
				</tr>
				<tr>
					<th scope="row" valign="top"><label for="exclude_product"><?php _e( 'Exclude Product:', 'sppb'); ?></label></th>
					<td>
						<input type="text" name="settings[sppb_exclude_product]" value="<?php echo $this->sppb_exclude_product; ?>" /><br />
						<small><?php _e( "Specify the products to exclude from browsing. Enter Product ID's comma separated.", 'sppb'); ?></small>
					</td>
				</tr>
				<tr>
					<th scope="row" valign="top"><label for="products_in_category"><?php _e( 'Products in Category:', 'sppb'); ?></label></th>
					<td>
						<input type="text" name="settings[sppb_products_limit]" id="sppb_products_limit" size="3" value="<?php echo $this->sppb_products_limit; ?>" /><br />
						<small><?php _e( 'Increase this number, if you have more products in a category. Default is 200.', 'sppb' ); ?></small>
					</td>
				</tr>
			</tbody>
		</table>
		<p class="submit"><input type="submit" class="button-primary" name="save" value="<?php _e('Save Changes', 'sppb'); ?>"></p>
	</form>
</div>
<script type="text/javascript">
/* <![CDATA[ */
var previous = <?php echo "'" . PREVIOUS . "'"; ?>;
var next = <?php echo "'" . NEXT . "'"; ?>;
/* ]]> */
</script>