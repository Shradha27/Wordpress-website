<?php 
/*
Plugin Name: Loan Calculator Pro
Description: Free Mortgage Loan Rate Calculator Widget for your blog
Version: 1.0
Author: <a title="Visit author homepage" href="http://www.lightimagemedia.com">Light Image Media</a>
Author Name: Light Image Media
Website: http://www.lightimagemedia.com
*/

define( 'SIMPLE_MMC_PLUGIN_BASENAME', plugin_dir_path(__FILE__));
define( 'SIMPLE_MMC_PLUGIN_URL', plugin_dir_url(__FILE__));

function loan_calc_short_code($atts){
	$owner = 'www.lightimagemedia.com';
	$html_code = '<div id="loan_calc_short_code_main">
	<div id="advanced_mortgage_calculator_content">
		<form id="advanced_mortgage_calc" method="post" action="'.admin_url( 'admin-ajax.php' ).'">
			<input type="hidden" name="action" value="smmc_calculate" />
			<div id="top_content" class="right_content">
				<div class="mortgage_item_monthly_mortgage_calc">
					Loan:</br>
					<input id="advanced_mortgage_calc_loan" class="required number values_advanced_mortgage_calc" name="advanced_mortgage_calc_loan" type="text" />
				</div>
				<div class="mortgage_item_monthly_mortgage_calc">
					Interest rate:</br>
					<input id="advanced_mortgage_calc_rate" class="required number values_advanced_mortgage_calc" name="advanced_mortgage_calc_rate" type="text" />
				</div>
				<div class="mortgage_item_monthly_mortgage_calc">
					Years:</br>
					<input id="advanced_mortgage_calc_years" class="required number values_advanced_mortgage_calc" name="advanced_mortgage_calc_years" type="text" />
				</div>
			</div>
			<div class="right_content">
				<center>
					<input id="advanced_mortgage_calculate" name="advanced_mortgage_calculate" type="submit" value="Calculate" />
				</center>
			</div>
		</form>
		<div id="advanced_mortgage_calc_result"></div>
	</div>
</div>';
	echo $html_code;
}

add_shortcode( 'loan-calculator', 'loan_calc_short_code' );

// WIDGET SECTION
include_once( SIMPLE_MMC_PLUGIN_BASENAME . "loan-calc-widget.php" );
// Register our widget.
function monthly_mortgage_init_free() {
	register_widget( 'loan_calculator' );
}
add_action( 'widgets_init', 'monthly_mortgage_init_free');

// STYLING AND JS
add_action( 'init', 'loan_calc_load_scripts');
function loan_calc_load_scripts(){
	
	wp_register_style('monthly-mortgage-css-free', plugins_url('loan-calc.css',__FILE__ ));
	wp_enqueue_style('monthly-mortgage-css-free');
	
	wp_register_script('monthly-mortgage-validator-free', plugins_url('jquery.validate.js',__FILE__ ),array(),false,true);
	wp_enqueue_script('monthly-mortgage-validator-free', array( 'jquery' ));

	wp_register_script('jquery-form',plugins_url('jquery.form.min.js'),array(),false,true);
	wp_enqueue_script('jquery-form', array( 'jquery' ));
	
	wp_register_script('monthly-mortgage-action-free', plugins_url('loan-calc.js',__FILE__ ),array(),false,true);
	wp_enqueue_script('monthly-mortgage-action-free', array( 'jquery-form' ));
}

if ( is_admin() )
{
    add_action('wp_ajax_smmc_calculate', 'smmc_calculate_callback');
    add_action('wp_ajax_nopriv_smmc_calculate', 'smmc_calculate_callback');
    // Add other back-end action hooks here
}

function smmc_calculate_callback(){
	// response output
	include_once( SIMPLE_MMC_PLUGIN_BASENAME . "loan-calc.php" );
	exit;
}



function loan_calc_plugin(){
     //add_options_page('Loan Calculator', 'Loan Calculator', 'manage_options', 'loan-calc-plugin', 'loan_calc_plugin_options');
	 add_menu_page( 'Loan Calculator', 'Loan Calculator', 'manage_options', 'loan_calc_menu', 'loan_calc_plugin_options', plugins_url('loan-calc.png',__FILE__  ));
}

add_action('admin_menu','loan_calc_plugin');


function loan_calc_plugin_options(){
     include(SIMPLE_MMC_PLUGIN_BASENAME."loan-calc-admin.php");
}





?>