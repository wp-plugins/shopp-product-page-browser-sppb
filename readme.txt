=== Shopp Product Page Browser ===
Contributors: Shoppdeveloper.com
Author: Shoppdeveloper.com
Author URI: http://www.shoppdeveloper.com
Donate link: http://www.shoppdeveloper.com/
Tags: shopp,navigate,products,browse,ecommerce,webshop,previous,next
Requires at least: 2.0.2
Tested up to: 4.1.1
Stable tag: 1.3
License: GPLv2 or later

Add "previous/next"-product links to your Shopp webshop's product pages.  

== Description ==

With this plugin installed you can supply your customers with previous/next buttons on the product pages of your Shopp webshop.
They will no longer have to go back and forth between category/catalog pages and product pages when browsing a category. You can translate the plugin to your own language, .pot file is included. Dutch language files are already present.

By use of the tag, you set whether you want to display 'previous', 'next', or 'both'.
By use of the settings page, you specify 

- the phrases used for 'Previous' and 'Next'
- to use product thumbnails instead of 'Previous'/'Next'
- the size of the thumbnails
- to use predefined Shopp image-setting
- which categories to exclude ('Previous'/'Next'-buttons will not appear on those Shopp product pages)
- which products to exclude ('Previous'/'Next'-buttons will not appear on those Shopp product pages)

== Installation ==

Install the plugin through your WordPress Admin Panel, or

1. Download the right plugin zip-file. 
   - Version 1.0.2 for Shopp 1.1.x,
   - Version 1.2.5 for Shopp 1.2.5,
   - Version 1.3 for Shopp 1.3.x
2. Unzip the zip-file.
3. Upload the folder to the `/wp-content/plugins/` directory
4. The plugin is NOT going to change or edit your Shopp files, but just to be sure, back up your files and database.
5. Activate the plugin through the 'Plugins' menu in WordPress
6. Version 1.0.x  
   Place  
   `<?php shopp('product','browser','show=both'); ?>`   
   in your Shopp product.php template file.  
   Alternatively you can use  
   `<?php shopp('product','browser','show=previous'); ?>`   
   or  
   `<?php shopp('product','browser','show=next'); ?>`.  

   Version 1.2.5
   Place  
   `<?php if ($_GET["cat"]): ?>`  
	`<?php $cat = $_GET["cat"]; ?>`  
   `<?php else: ?>`  
	`<?php $cat = shopp('product','category','show=id&return=true'); ?>`  
   `<?php endif; ?>`  
   `<?php shopp('product','browser',"show=both&cat=$cat"); ?>` 

   Version 1.3
   Place  
   `<?php if ($_GET["cat"]): ?>`  
   `<?php $cat = $_GET["cat"]; ?>`  
   `<?php else: ?>`  
   `<?php $cat = shopp('product.get-category','show=id'); ?>`  
   `<?php endif; ?>`  
   `<?php shopp('product','browser',"show=both&cat=$cat"); ?>`    
   in your Shopp product.php template file.  

   Alternatively you can replace the last line of code with  
   `<?php shopp('product','browser',"show=next&cat=$cat"); ?>`  
   or  
   `<?php shopp('product','browser',"show=previous&cat=$cat"); ?>`.
7. Adjust the settings on the settings page (Shopp Extra, Shopp sppb)
8. If you run in any trouble please use the contact form on our own website. For some reason we do not get notified when you leave a message here at Wordpress.org.
9. Supply <a href='Plugin URI: http://www.shoppdeveloper.com/shopp-product-page-browser-plugin/' title='Shoppdeveloper.com feedback for Product Page Browser Plugin'>Feedback</a>. We'd love to hear from you!

== Frequently Asked Questions ==

= Will the plugin work without Shopp installed? =

No. Without Shopp installed, the plugin will be useless.

= Will the plugin change or edit my Shopp pages or products? =

No. You will have to add the tag mentioned in the installation instructions but that is it. The plugin will store the settings of the settings page in the database. No other data is written or saved anywhere.

= Will it work without using categories? =

No. You will need to create at least one category for your products.

= Will it go to the next category once the last product is displayed? =

No. We couldn't come up with a scenario that needed that feature. If you do, let us know.
Right now the listing will go back to the first product after the last product has been displayed.

= Can I change the settings for the CSS-classes used? =

Sure. You can override them in your own stylesheet or change the settings in sppb.css. The file is present in the plugin folder.

= Is there a translation available? =

There is not much text in this plugin but a .pot file is included so you can translate the phrases to your needs.
The plugin is in English. Dutch language files are already present. Checkout the /languages folder.

= What version of Shopp do I need? =

This 1.3 version of the plugin has been tested with Shopp 1.3.x release. If you are using Shopp 1.1.x, please download version 1.0.2 of this plugin, for Shopp 1.2.x you will need version 1.2.5 of this plugin.

== Screenshots ==

1. The settings page (version 1.0 and version 1.2)

2. The settings page (version 1.3)

3. Where to put the code in product.php when using version 1.0.x

4. Where to put the code in product.php when using version 1.2.5

5. Where to put the code in product.php when using version 1.3

6. What it looks like on your product page

== Changelog ==
= 1.3 =
-New version to work with Shopp 1.3.x.
-Restructured code and files to match our generally used plugin structure
-Converted code to match Shopp dot notation
-Added feature to use predefined Shopp image-setting

= 1.2.5 =
-New version to work with Shopp 1.2.5. No need to update if you are using Shopp 1.1.x
-Added the $cat variable due to a change in Shopp handling categories

= 1.2 =
-New version to work with Shopp 1.2r6 beta. No need to update if you are not using the 1.2 (beta) version of Shopp. Due to changes to the Shopp Menu (in Admin Panel) we have added the 'Shopp Extra' parent menu which will facilitate all our Shopp plugins. 

= 1.0.1 =
-Corrected stylesheet loading.
-Quotes and Double Quotes can be used in 'Previous' and 'Next' input field.

= 1.0 =
-Added comments.
-First version on WordPress SVN.

= 0.2 =
-Optimized some of the code.

= 0.1 =
-First version. Ready to be tested.

== Upgrade Notice ==
= 1.3 =
-New version to work with Shopp 1.3.x. No need to update if you are using an older Shopp version.

= 1.2.5 =
-New version to work with Shopp 1.2.5. No need to update if you are using Shopp 1.1.x

= 1.2 =
-New version to work with Shopp 1.2r6 beta. No need to update if you are not using the 1.2 (beta) version of Shopp.

= 1.0.1 =
-Fixed stylesheet loading. <br />
-Quotes and Double Quotes can be used in 'Previous' and 'Next' input field.

= 1.0 =
-Added comments.
-First version on WordPress SVN.