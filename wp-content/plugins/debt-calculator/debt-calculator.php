<?php
/*
Plugin Name: Debt Calculator
Plugin URI: http://www.coloradobankruptcy.net/debt-calculator/
Description: Add a debt calculator to your website to help users determine how long it will take to pay off debt.
Author: Katz Web Services, Inc.
Version: 1.0.1
Author URI: http://www.katzwebservices.com

--------------------------------------------------
 
Copyright 2010  Katz Web Services, Inc.  (email : info@katzwebservices.com)

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

Version:

1.0     - Initial release

*/

// Hook for adding admin menus
add_action('admin_menu', 'kwd_debt_add_pages');
// action function for above hook
function kwd_debt_add_pages() {
    // Add a new submenu under Themes:
    add_options_page("Debt Calculator Configuration", "Debt Calculator", 'edit_plugins', __FILE__, "debt_calculator_admin");
}

add_option('debt_thank_you', "1");
add_option('debt_table_link', "0");
add_option('debt_shortcode', "debtcalculator");

function debt_calculator_admin() {

    // variables for the field and option names 
    $field1 = 'debt_thank_you';
	$field2 = 'debt_shortcode';
	$field3 = '	debt_table_link';
	$hidden_field_name = 'debt_hidden';

    // See if the user has posted us some information
    // If they did, this hidden field will be set to 'Y'
    if( $_POST[ $hidden_field_name ] == 'Y' ) {

        // Save the posted value in the database
        update_option( 'debt_thank_you', $_POST[ $field1 ] );
        update_option( 'debt_shortcode', $_POST[ $field2 ] );
        update_option( 'debt_table_link', $_POST[ $field3 ] );
        // Put an options updated message on the screen

?>
<div class="updated"><p><strong>Options Saved</strong></p></div>
<?php

    }

    ?>
<div class="wrap">
	<h2>Debt Calculator</h2>
	<div class="postbox-container" style="width:65%;">
					<div class="metabox-holder">	
						<div class="meta-box-sortables">
<form name="form1" method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">
<input type="hidden" name="<?php echo $hidden_field_name; ?>" value="Y">

<div class="postbox">
			<div class="handlediv"><br /></div>
			<h3 class="hndle"><span>Debt Calculator Options</span></h3>
			<div class="inside">				
				<table class="form-table" width="100%">
					<tr>
						<th valign="top" scope="row" style="width:60%">
							<label for="<?php echo $field2; ?>" style="font-weight:bold;">Shortcode:</label>
							<p><small>When you type in <code>[<?php echo get_option('debt_shortcode'); ?>]</code> into the text editor, the debt calculator form will display. Change that shortcode here.</small></p>
						</th>
						<td valign="top" style="padding-left:5%">
							<input type="text" name="<?php echo $field2; ?>" id="<?php echo $field2; ?>"  value="<?php echo get_option('debt_shortcode'); ?>" size="40" style="font-size:125%;"/>
						</td>
					</tr>
					<tr>
						<th valign="top" scope="row" style="width:60%">
							<label for="<?php echo $field1; ?>" style="font-weight:bold;">Give Thanks:</label>
							<p><small>Give thanks with a link below the calculator.</small></p>
						</th>
						<td valign="top" style="padding-left:5%">
							<input type="checkbox" name="<?php echo $field3; ?>" id="<?php echo $field3; ?>" value="1" <?php if(get_option('debt_table_link') == true) { ?>checked="checked"<?php }?> />
						</td>
					</tr>
				</table>
										<p class="submit" style="margin:0; padding-top:.5em; padding-left:10px;">
										<input type="submit" class="button-primary" name="save" value="<?php _e('Save Changes') ?>" />
										</p>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
				<div class="postbox-container" style="width:34%;">
					<div class="metabox-holder">	
						<div class="meta-box-sortables">
							<div class="postbox">
								<div class="handlediv"><br /></div>
								<h3 class="hndle"><span>Debt Calculator</span></h3>
								<div class="inside" style="padding:10px; padding-top:0;">
								<h4>Notes</h4>
								<ul style="list-style:disc outside; margin-left:2em;">
									<li>Updating the style: You can update the form's style by editing the plugin's <code>debt.css</code> file</li>
									<li>The calculator javascript code used is <a href="http://javascript.internet.com/math-related/credit-card-debt-calculator.html" rel="nofollow">Credit Card Debt Calculator</a></li>
									<li>You can add the calculator to your website's sidebar by using the shortcode in a text widget</li>
								</ul>
								<h4>Shortcode Use</h4>
								<ul>
								<li><code>class</code> : Adds CSS class to container <code>DIV</code></li>
								<li><code>width</code> : Inline CSS width of container <code>DIV</code></li>
								<li><code>zebra</code> : Whether to add CSS class of <code>debt_row_odd</code> to odd table rows, making the table alternating colors (called zebrastriping)</li>
								<li><code>legend</code> : Add a legend to the form with the specified text</li>
								</ul>
								<h4>Sample code:</h4>
								<p><code>[<?php echo get_option('debt_shortcode'); ?> class="sampleCssClass" width="100%" zebra="false" legend="Your Debt Snapshot"]</code></p>
								<p>The form's container DIV will have class "sampleCssClass" and will be 100% wide. The table will NOT be zebrastriped, and the legend text will be "Your Debt Snapshot".</p>
							</div>
						</div>
					</div>
				</div>

<?php
 
} //wspin_admin

$kwd_debt_calc_version = '1.0.1';
$debt_dirname = plugin_basename(dirname(__FILE__));

function kwd_debt_scripts() {
	global $debt_dirname;
    wp_enqueue_script('debt_calculator', '/' . PLUGINDIR . '/'.$debt_dirname.'/js/calculator.js', array('jquery') );
}
add_action('wp_print_scripts', 'kwd_debt_scripts');

function kwd_debt_styles() {
	global $debt_dirname;
	wp_register_style('debt_style', '/' .PLUGINDIR . "/$debt_dirname/css/debt.css");
	wp_enqueue_style('debt_style');
}
add_action('wp_print_styles', 'kwd_debt_styles');

function kwd_debt_shortcode( $atts, $content = null ) {
   extract( shortcode_atts( array(
      'class' => 'debtCalculator',
      'width' => '400px',
      'zebra' => true,
      'legend' => '',
      ), $atts ) );

if(strtolower($zebra) == 'false' || $zebra == '0') { $zebra = false; }
if(strtolower($legend) == 'false' || $legend == '0') { $legend = false; }
$class = esc_attr($class); 
$width = esc_attr($width);
if($zebra) { $bg = ' class="debt_row_odd"';}


$code = '<div class="'.$class.'" style="width: '.$width.'">
<form>
<div class="errors"></div>';
if($legend) {
$code .='<fieldset>
<legend>'.$legend.'</legend>';
}
$code .='
<table border="0" cellspacing="0" cellpadding="0">
    <tbody>
	    <tr>
			<th scope="row"><label for="balance">Total Credit Card Debt:</label></th>
			<td style="width:150px"><input name="balance" id="balance" size="12" type="text" class="text" /></td>
	    </tr>
	    <tr'.$bg.'>
	 	   <th scope="row"><label for="debt_interest">Interest Rate (Annual Percentage):</label></th>
	 	   <td style="width:150px"><input name="debt_interest" id="debt_interest" size="12" type="text" class="text" /></td>
	    </tr>
	    <tr>
			<th scope="row"><label for="mnth_pay">Current Monthly Payment:</label></th>
			<td style="width:150px"><input name="mnth_pay" id="mnth_pay" size="12" type="text" class="text" /></td>
	    </tr>
	</tbody>
	<tfoot>
	    <tr>
			<td colspan="2">
				<input name="calculateDebt" id="calculateDebt" type="button" value="Calculate" /> 
		    </td>
	    </tr>
	</tfoot>
</table>';
if($legend) {
	$code .=' </fieldset>';
}
$code .= '
<table>
	<tbody>
	    <tr>
			<th scope="row">Months It Will Take To Be Debt Free:</th>
			<td><input name="num_months" size="12" type="text" class="text disabled"></td>
	    </tr>
	    <tr>
			<th scope="row">Years It Will Take To Be Debt Free:</th>
			<td><input name="num_years" size="12" type="text" class="text disabled"></td>
	    </tr>
	    <tr'.$bg.'>
			<th scope="row">Total Amount Payed To Lender:</th>
			<td><input name="total_pay" size="12" type="text" class="text disabled"></td>
	    </tr>
	    <tr>
			<th scope="row">Total Interest Paid To Lender:</th>
			<td><input name="total_int" size="12" type="text" class="text disabled"></td>
	    </tr>
    </tbody>
</table>
</form>';
if(get_option('debt_table_link')) {
	$code .= "\n".'<p class="debt_table_link"><a href="http://www.seodenver.com/debt-calculator/">WordPress Debt Calculator Plugin</a></p>';
}

$code .= '
</div>';

   return $code;
}

$shortcode = get_option('debt_shortcode');
if(!$shortcode) { $shortcode = 'debtcalc'; }
add_shortcode($shortcode, 'kwd_debt_shortcode');

?>