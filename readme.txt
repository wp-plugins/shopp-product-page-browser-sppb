=== Shopp Product Page Browser ===
Contributors: Shoppdeveloper.com
Donate link: http://www.shoppdeveloper.com/
Tags: shopp,navigate,products,browse,ecommerce,webshop,previous,next
Requires at least: 2.0.2
Tested up to: 3.2.1
Stable tag: 1.0.2

Add "previous/next"-product links to your Shopp webshop's product pages.  

== Description ==

With this plugin installed you can supply your customers with previous/next buttons on the product pages of your Shopp webshop.
They will no longer have to go back and forth between category/catalog pages and product pages. You can translate the plugin to
your own language, .pot file is included. Dutch language files are already present.

By use of the tag, you can set if you want to display 'previous', 'next', or 'both'.
By use of the settings page, you can 

- set the phrases used for 'Previous' and 'Next'
- set to use product thumbnails instead of 'Previous'/'Next'
- set the size of the thumbnails
- exclude categories ('Previous'/'Next'-buttons will not appear on those Shopp product pages)
- exclude products ('Previous'/'Next'-buttons will not appear on those Shopp product pages)

If you are using Shopp 1.2.x please download version 1.2.1 of our plugin from the <a href='http://wordpress.org/extend/plugins/shopp-product-page-browser-sppb/download/' title='Shopp Product Page Browser Download Page'> Download page</a>.


== Installation ==

Download and install the plugin through your WordPress Admin Panel, or

1. Download the right plugin zip-file. (Version 1.0.2 for Shopp 1.1.9, version 1.2.1 for Shopp 1.2.x.)
2. Unzip the zip-file.
3. Upload the folder to the `/wp-content/plugins/` directory
4. The plugin is NOT going to change or edit your Shopp files, but just to be sure, back up your files and database.
5. Activate the plugin through the 'Plugins' menu in WordPress
6. Place `<?php shopp('product','browser','show=both'); ?>` in your Shopp product.php template file.
   Alternatively you can use `<?php shopp('product','browser','show=previous'); ?>` or `<?php shopp('product','browser','show=next'); ?>`.
7. Adjust the settings on the settings page (Shopp sppb)
8. Supply <a href='http://www.shoppdeveloper.com/shopp-product-page-browser-plugin/'>Feedback</a>. We'd love to hear from you!

== Frequently Asked Questions ==

= Will the plugin work without Shopp installed? =

No. Without Shopp installed, the plugin will be useless.

= Will the plugin change or edit my Shopp pages or products? =

No. You will have to add the tag mentioned in the installation instructions but that is it. The plugin will store the settings of the settings page in the database. No other data is written or saved anywhere.

= Will it work without using categories? =

Yes. The plugin will determine the previous and next products by checking the catalog-products listing.

= Will it go to the next category once the last product is displayed? =

No. We couldn't come up with a scenario that needed that feature. If you do, let us know.
Right now the listing will go back to the first product after the last product has been displayed.

= Can I change the settings for the CSS-classes used? =

Sure. You can override them in your own stylesheet or change the settings in sppb.css. The file is present in the plugin folder.

= Is there a translation available? =

There is not much text in this plugin but a .pot file is included so you can translate the phrases to your needs.
The plugin is in English. Dutch language files are already present. Checkout the /languages folder.

= What version of Shopp do I need? =

This 1.0.2 version of our plugin has been tested with Shopp version 1.1.9. 

If you are using Shopp 1.2.x please download version 1.2.1 of our plugin from the <a href='http://wordpress.org/extend/plugins/shopp-product-page-browser-sppb/download/' title='Shopp Product Page Browser Download Page'> download page</a>.

== Screenshots ==

1. The settings page

2. Where to put the code in Product.php

3. What it looks like on your product page

== Changelog ==
= 1.0.2 =
Adjusted the code to remove PHP warnings.

= 1.0.1 =
Corrected stylesheet loading. <br />
Quotes and Double Quotes can be used in 'Previous' and 'Next' input field.

= 1.0 =
Added comments.<br />
First version on WordPress SVN.

= 0.2 =
Optimized some of the code.

= 0.1 =
First version. Ready to be tested.

== Upgrade Notice ==

= 1.0.1 =
Fixed stylesheet loading. <br />
Quotes and Double Quotes can be used in 'Previous' and 'Next' input field.

= 1.0 =
Added comments.<br />
First version on WordPress SVN.