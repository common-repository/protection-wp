<?php
/*
Plugin Name: Protection WP
Plugin URI: http://plugins.sonicity.eu/protection-wp/
Description: Protects your blog from people stealing your content!
Version: 1.0.3
Author: Sonicity
Author URI: http://www.sonicity.eu
*/

/*  Copyright 2010 Sonicity.EU - support@sonicity.eu

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

// Hook for adding admin menus
add_action('admin_menu', 'protection_add_pages');

// action function for above hook
function protection_add_pages() {
    add_options_page('Protection WP', 'Protection WP', 'administrator', 'protection', 'protection_options_page');
}

// jr_effects_options_page() displays the page content for the Test Options submenu
function protection_options_page() {

    // variables for the field and option names
    $opt_name_1 = 'mt_protection_click';	
    $opt_name_2 = 'mt_protection_printing';
    $opt_name_5 = 'mt_protection_plugin_support';
	$opt_name_6 = 'mt_protection_rss';
	$opt_name_7 = 'mt_protection_highlight';
    $hidden_field_name = 'mt_protection_submit_hidden';
	$data_field_name_1 = 'mt_protection_click';
	$data_field_name_2 = 'mt_protection_printing';
    $data_field_name_5 = 'mt_protection_plugin_support';
	$data_field_name_6 = 'mt_protection_rss';
	$data_field_name_7 = 'mt_protection_highlight';

    // Read in existing option value from database
	$opt_val_1 = get_option($opt_name_1);
	$opt_val_2 = get_option($opt_name_2);
    $opt_val_5 = get_option($opt_name_5);
	$opt_val_6 = get_option($opt_name_6);
	$opt_val_7 = get_option($opt_name_7);

    // See if the user has posted us some information
    // If they did, this hidden field will be set to 'Y'
    if( $_POST[ $hidden_field_name ] == 'Y' ) {
        // Read their posted value
		$opt_val_1 = $_POST[$data_field_name_1];
		$opt_val_2 = $_POST[$data_field_name_2];
        $opt_val_5 = $_POST[$data_field_name_5];
		$opt_val_6 = $_POST[$data_field_name_6];
		$opt_val_7 = $_POST[$data_field_name_7];

if ($opt_val_6=="No") {
update_option("posts_per_rss", "5");
} else {
update_option("posts_per_rss", "-1");
}

        // Save the posted value in the database
		update_option( $opt_name_1, $opt_val_1 );
		update_option( $opt_name_2, $opt_val_2 );
        update_option( $opt_name_5, $opt_val_5 );
		update_option( $opt_name_6, $opt_val_6 );
		update_option( $opt_name_7, $opt_val_7 );

        // Put an options updated message on the screen

?>
<div class="updated"><p><strong><?php _e('Options saved.', 'mt_trans_domain' ); ?></strong></p></div>
<?php

    }

    // Now display the options editing screen

    echo '<div class="wrap">';

    // header

    echo "<h2>" . __( 'Protection WP Plugin Options', 'mt_trans_domain' ) . "</h2>";
echo "<br /><strong>Please note: Content theft is still possible even with the use of this content. If some users really wish to steal your content, they'll always find a way to do so for as long as your content is online. However, use of this plugin does make it more difficult to do so and will stop some content thieves.</strong><br />";

    // options form
    
    $change3 = get_option("mt_protection_plugin_support");
	$change4 = get_option("mt_protection_click");
	$change5 = get_option("mt_protection_rss");
	$change6 = get_option("mt_protection_highlight");
	$change7 = get_option("mt_protection_printing");

if ($change3=="Yes" || $change3=="") {
$change3="checked";
$change31="";
} else {
$change3="";
$change31="checked";
}

if ($change4=="Yes" || $change4=="") {
$change4="checked";
$change41="";
} else {
$change4="";
$change41="checked";
}

if ($change5=="Yes") {
$change5="checked";
} else if ($change5=="No") {
$change51="checked";
} else {
$change52="checked";
}

if ($change6=="Yes" || $change6=="") {
$change6="checked";
$change61="";
} else {
$change6="";
$change61="checked";
}

if ($change7=="Yes" || $change7=="") {
$change7="checked";
$change71="";
} else {
$change7="";
$change71="checked";
}
    ?>
<form name="form1" method="post" action="">
<input type="hidden" name="<?php echo $hidden_field_name; ?>" value="Y">

<p><?php _e("(Default: Disabled) Right-clicking on your page is...", 'mt_trans_domain' ); ?> 
<input type="radio" name="<?php echo $data_field_name_1; ?>" value="Yes" <?php echo $change4; ?>>Disabled
<input type="radio" name="<?php echo $data_field_name_1; ?>" value="No" <?php echo $change41; ?>>Enabled
</p>

<p><?php _e("(Default: Enabled) RSS Feed is...", 'mt_trans_domain' ); ?> 
<input type="radio" name="<?php echo $data_field_name_6; ?>" value="Yes" <?php echo $change5; ?>>Disabled
<input type="radio" name="<?php echo $data_field_name_6; ?>" value="No" <?php echo $change51; ?>>Enabled
</p>

<p><?php _e("(Default: Enabled) Printing is...", 'mt_trans_domain' ); ?> 
<input type="radio" name="<?php echo $data_field_name_2; ?>" value="Yes" <?php echo $change7; ?>>Disabled
<input type="radio" name="<?php echo $data_field_name_2; ?>" value="No" <?php echo $change71; ?>>Enabled
</p>

<p><?php _e("(Default: Disabled) Highlighting text is...", 'mt_trans_domain' ); ?> 
<input type="radio" name="<?php echo $data_field_name_7; ?>" value="Yes" <?php echo $change7; ?>>Disabled
<input type="radio" name="<?php echo $data_field_name_7; ?>" value="No" <?php echo $change71; ?>>Enabled
</p><hr />

<p><?php _e("Support this Plugin?", 'mt_trans_domain' ); ?> 
<input type="radio" name="<?php echo $data_field_name_5; ?>" value="Yes" <?php echo $change3; ?>>Yes
<input type="radio" name="<?php echo $data_field_name_5; ?>" value="No" <?php echo $change31; ?>>No
</p>

<p class="submit">
<input type="submit" name="Submit" value="<?php _e('Update Options', 'mt_trans_domain' ) ?>" />
</p><hr />

</form>
<?php } ?>
<?php

function show_protection() {
$click=get_option("mt_protection_click");
$rss=get_option("mt_protection_rss");
$highlight=get_option("mt_protection_highlight");
$print=get_option("mt_protection_printing");

if ($click=="" || $click=="Yes") {
?>
<SCRIPT TYPE="text/javascript">
<!--
var message="This page is protected!";
function clickIE() {if (document.all) {(message);return false;}}
function clickNS(e) {if
(document.layers||(document.getElementById&&!document.all)) {
if (e.which==2||e.which==3) {(message);return false;}}}
if (document.layers)
{document.captureEvents(Event.MOUSEDOWN);document.onmousedown=clickNS;}
else{document.onmouseup=clickNS;document.oncontextmenu=clickIE;}
document.oncontextmenu=new Function("return false")
// -->
</SCRIPT> 
<?php
}

if ($print=="Yes") {
?>
<style type="text/css">
@media print { body { display:none; } }
</style>
<?php
}

if ($highlight=="" || $highlight=="Yes") {
?>
<script type="text/javascript">
window.onload = function() {
  document.onselectstart = function() {return false;} // ie
  document.onmousedown = function() {return false;} // mozilla
}

window.onload = function() {
  var element = document.getElementById('body');
  element.onselectstart = function () { return false; } // ie
  element.onmousedown = function () { return false; } // mozilla
}
</script>
<script language="JavaScript1.2">
 
function disableselect(e){
return false
}
 
function reEnable(){
return true
}
 
//if IE4+
document.onselectstart=new Function ("return false")
 
//if NS6
if (window.sidebar){
document.onmousedown=disableselect
document.onclick=reEnable
}
</script>
<?php
}

function fb_disable_feed() {
update_option("posts_per_rss", "-1");

wp_die( __('No feed available,please visit our <a href="'. get_bloginfo('url') .'">homepage</a>!') );
}

if ($rss=="Yes") {
add_action('do_feed', 'fb_disable_feed', 1);
add_action('do_feed_rdf', 'fb_disable_feed', 1);
add_action('do_feed_rss', 'fb_disable_feed', 1);
add_action('do_feed_rss2', 'fb_disable_feed', 1);
add_action('do_feed_atom', 'fb_disable_feed', 1);

if (get_option("posts_per_rss")>0) {
update_option("posts_per_rss", "-1");
}

}

$supportplugin=get_option("mt_protection_plugin_support");
if ($supportplugin=="" || $supportplugin=="Yes") {
add_action('wp_footer', 'protection_footer_plugin_support');
}
}

function protection_footer_plugin_support() {
  $pshow = "<p style='font-size:x-small'>Protection Plugin made by <a href='http://www.findstrideritecoupons.com'>Stride Rite Coupons</a></p>";
  echo $pshow;
}

add_action("wp_head", "show_protection");

?>
