function shoppExtraMenuPage() {
	if (!current_user_can('manage_options'))  {
		wp_die( __('You do not have sufficient permissions to access this page.','sppb') );
	}
	echo "<div class='wrap shopp'>";
	echo "<div id='icon-options-general' class='icon32'><br /></div>";
	echo "<h2>".__( 'Shoppdeveloper.com - Main Plugin Page', 'sflb' )."</h2>";
	echo "<table class='form-table'>";
	echo "<tbody>";
	echo "<tr>";
	echo "<th scope='row' valign='top'><label for='introduction'>".__( 'Introduction:','sppb')."</label></th>";
	echo "<td>";
	echo "<p>The Shopp Extra menu facilitates plugins created by <a href='http://www.shoppdeveloper.com' title='Shoppdeveloper.com website'>Shoppdeveloper.com</a>.</p>";
	echo "<p>You can find the plugins we have developed so far, on <a href='http://profiles.wordpress.org/users/Shoppdeveloper.com/' title='Shoppdeveloper.com on WordPress.org'>WordPress.org</a>.</p>";
	echo "<p>We'd love to hear what you like or don't like about our plugins.<br />
		What works and what doesn't.</p>";
	echo "<p></p>";
	echo "<p>Thanks in advance.</p>";
	echo "<p></p>";
	echo "<p>Shoppdeveloper.com Team</p>";
	echo "</td>";
	echo "</tr>";
	echo "</tbody>";
	echo "</table>";
	echo "</div>";
} // End function shoppExtraMenuPage