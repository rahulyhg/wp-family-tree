<?php
/*
Copyright (c) 2010,2011 Arvind Shah
WP Family Tree is released under the GNU General Public
License (GPL) http://www.gnu.org/licenses/gpl.txt
*/

function family_tree_options_page() {
	if (function_exists('add_options_page')) {
		add_options_page('WP Family Tree', 'WP Family Tree', 10, 'wp-family-tree', 'family_tree_options_subpanel');
	}
}
function family_tree_options_subpanel() {
	global $wp_version;
	
	if (isset($_POST['update_options'])) {
		
		if ( function_exists('check_admin_referer') ) {
			check_admin_referer('family-tree-action_options');
		}

		if ($_POST['family_tree_category_key'] != "")  {
			update_option('family_tree_category_key', stripslashes(strip_tags($_POST['family_tree_category_key'])));
		}
		if ($_POST['canvasbgcol'] != "")  {
			update_option('canvasbgcol', stripslashes(strip_tags($_POST['canvasbgcol'])));
		}
		if ($_POST['nodeoutlinecol'] != "")  {
			update_option('nodeoutlinecol', stripslashes(strip_tags($_POST['nodeoutlinecol'])));
		}
		if ($_POST['nodefillcol'] != "")  {
			update_option('nodefillcol', stripslashes(strip_tags($_POST['nodefillcol'])));
		}
		if ($_POST['nodefillopacity'] != "")  {
			update_option('nodefillopacity', stripslashes(strip_tags($_POST['nodefillopacity'])));
		}
		if ($_POST['nodetextcolour'] != "")  {
			update_option('nodetextcolour', stripslashes(strip_tags($_POST['nodetextcolour'])));
		}
		echo '<div class="updated"><p>Options saved.</p></div>';
	}

 ?>
	<div class="wrap">
	<h2>WP Family Tree Options</h2>

	<a href="http://www.esscotti.com/wp-family-tree-plugin/"><img width="150" height="50" alt="Visit WP Family Tree home" align="right" src="<?php echo get_option('siteurl'); ?>/wp-content/plugins/wp-family-tree/logo.jpg"/></a>

	<form name="ft_main" method="post">
<?php
	if (function_exists('wp_nonce_field')) {
		wp_nonce_field('family-tree-action_options');
	}
?>
	<h3>General</h3>
	<table class="form-table"><tr valign="top">
	<th scope="row"><label for="family_tree_category_key">Name of category for family members (default: "Family")</label></th>
	<td><input name="family_tree_category_key" type="text" id="family_tree_category_key" value="<?php echo wpft_options::get_option('family_tree_category_key'); ?>" size="40" /></td>
	</tr></table>

	<h3>Family tree styling</h3>
	<table class="form-table">
		<tr valign="top">
			<th scope="row"><label for="canvasbgcol">Background colour (#rgb)</label></th>
			<td><input name="canvasbgcol" type="text" id="canvasbgcol" value="<?php echo wpft_options::get_option('canvasbgcol'); ?>" size="40" /></td>
		</tr>
	
		<tr valign="top">
			<th scope="row"><label for="nodeoutlinecol">Node outline colour (#rgb)</label></th>
			<td><input name="nodeoutlinecol" type="text" id="nodeoutlinecol" value="<?php echo wpft_options::get_option('nodeoutlinecol'); ?>" size="40" /></td>
		</tr>
	
		<tr valign="top">
			<th scope="row"><label for="nodefillcol">Node fill colour (#rgb)</label></th>
			<td><input name="nodefillcol" type="text" id="nodefillcol" value="<?php echo wpft_options::get_option('nodefillcol'); ?>" size="40" /></td>
		</tr>
	
		<tr valign="top">
			<th scope="row"><label for="nodefillopacity">Node opacity (0.0 to 1.0)</label></th>
			<td><input name="nodefillopacity" type="text" id="nodefillopacity" value="<?php echo wpft_options::get_option('nodefillopacity'); ?>" size="40" /></td>
		</tr>
		<tr valign="top">
			<th scope="row"><label for="nodetextcolour">Node text colour (#rgb)</label></th>
			<td><input name="nodetextcolour" type="text" id="nodetextcolour" value="<?php echo wpft_options::get_option('nodetextcolour'); ?>" size="40" /></td>
		</tr>
	</table>

	<p class="submit">
	<input type="hidden" name="action" value="update" />
<!--
	<input type="hidden" name="page_options" value="family_tree_category_key"/>
-->
	<input type="submit" name="update_options" class="button" value="<?php _e('Save Changes', 'Localization name') ?> &raquo;" />
	</p>

	</form>
	</div>
<?php
}

class wpft_options {

	static function get_option($option) {
		$value = get_option($option);

		if ($value !== false) { 
			return $value;
		}
		// Option did not exist in database so return default values...
		switch ($option) {
		case "family_tree_category_key":
			return 'Family';	// Default category for posts included in the tree
		case "canvasbgcol":
			return '#fff';		// Background colour for tree canvas
		case "nodeoutlinecol":
			return '#000';		// Outline colour for nodes
		case "nodefillcol":
			return '#fff';		// Fill colour for nodes
		case "nodefillopacity":
			return '0.4';		// Node opacity (0 to 1)
		case "nodetextcolour":
			return '#000';		// Node text colour
		} 
		return '';
	}
	
	
		
}

?>