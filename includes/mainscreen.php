<?php
/**
*
* Mainscreen for ShoppExtra Menu and Shopp Facebook Like Button
*
*/

defined( 'WPINC' ) || header( 'HTTP/1.1 403' ) & exit;

class ShoppProductBrowserScreen{

   	function __construct(){
      	add_action( 'shopp_init', array( &$this, 'init' ) );
   	}

   	function init(){
      	add_action('admin_menu', array(&$this, 'add_menu'));
		$sppb_admin_nonce = wp_create_nonce('sppb_admin');
   	}

   	function add_menu(){
		// Add settings page to the Shopp menu
		global $SDC;

		if ( ! isset($SDC['pages']['shoppExtraMenu']) ) {
      			add_menu_page( 'Shopp Extra', 'Shopp Extra',(defined('SHOPP_USERLEVEL') ? SHOPP_USERLEVEL : 'shopp_financials'), 'shopp-extra',array($this,'shoppExtraMenuPage'),'',53);
		        $SDC['pages']['shoppExtraMenu'] = 'present';
		} 

  		add_submenu_page('shopp-extra', 'Shopp sppb', 'Shopp sppb',(defined('SHOPP_USERLEVEL') ? SHOPP_USERLEVEL : 'manage_options'), 'sppb-settings', array($this, 'sppb_create_page'));	

    }

	function shoppExtraMenuPage() {
		if ( ! current_user_can('shopp_financials') ) wp_die( __('You do not have sufficient permissions to access this page.', 'sppb') ); 
		?>

		<div class='wrap shopp'>
		<div id='icon-options-general' class='icon32'><br /></div>
		<h2> <?php _e( 'Shoppdeveloper.com - Main Plugin Page', 'sppb' ); ?></h2>
			<table class='form-table'>
				<tbody>
					<tr>
						<th scope='row' valign='top'><label for='introduction'> <?php _e( 'Introduction:','sppb'); ?></label></th>
						<td width='500px'>
							<p> <?php _e('The Shopp Extra menu facilitates plugins created by', 'sppb'); ?> <a href='http://www.shoppdeveloper.com' title='Shoppdeveloper.com website'>Shoppdeveloper.com</a></p>
							<p> <?php _e('We\'d love to hear what you like or don\'t like about our plugins','sppb'); ?>.<BR />
								<?php _e('What works and what doesn\'t','sppb'); ?>.</p>
							<BR />
							<p> <?php _e('Thanks in advance','sppb'); ?>.</p>
							<p></p>
							<p>Shoppdeveloper.com Team</p>
						</td>
						<td>
						</td>
					</tr>
					<?php include 'other_plugins.php'; ?>
				</tbody>
			</table>
		</div>
		<?php
	} // End function shoppExtraMenuPage

    function sppb_create_page(){
      $sppb_page = new ShoppProductBrowser();
      $sppb_page->shopp_product_browser_settings_page();
    }

} // end class

$sppb_Page = new ShoppProductBrowserScreen();
?>