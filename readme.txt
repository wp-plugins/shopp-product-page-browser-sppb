=== Shopp Product Page Browser ===
Contributors: Shoppdeveloper.com
Donate link: http://www.shoppdeveloper.com/
Tags: shopp,navigate,products,browse,ecommerce,webshop,previous,next
Requires at least: 2.0.2
Tested up to: 3.2.1
Stable tag: 1.0.1

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

== Installation ==

1. download the plugin zip file.
2. Unzip the zip file.
3. Upload the `shopp-sppb` folder to the `/wp-content/plugins/` directory
4. The plugin is NOT going to change or edit your Shopp files, but just to be sure, back up your files and database.
5. Activate the plugin through the 'Plugins' menu in WordPress
6. Place `<?php shopp('product','browser','show=both'); ?>` in your Shopp product.php template file.
   Alternatively you can use `<?php shopp('product','browser','show=previous'); ?>` or `<?php shopp('product','browser','show=next'); ?>`.

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

Sure. You can override them in our own stylesheet or change the settings in sppb.css. The file is present in the plugin folder.

= Is there a translation available? =

There is not much text in this plugin but a .pot file is included so you can translate the phrases to your needs.
The plugin is in English. Dutch language files are already present. Checkout the /languages folder.

== Screenshots ==

1. The settings page

2. Where to put the code in Product.php

3. What it looks like on your product page

== Changelog ==

= 1.0 =
Added comments.<br />
First version on WordPress SVN.

= 0.2 =
Optimized some of the code.

= 0.1 =
First version. Ready to be tested.




