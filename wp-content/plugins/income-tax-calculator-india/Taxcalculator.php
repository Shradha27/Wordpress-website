<?php
/*
    Plugin Name: Income Tax Calculator (India)
	Plugin URI: http://wbxpress.com/income-tax-calculator/
	Description: Calculates Income Tax Liability for Salaried Persons of India. 
	Author: wbxpress
	Version: 2.0
	Author URI: http://profiles.wordpress.org/wbxpress
*/

function addcal($text)
{
include("taxcal.php");
$newone=str_replace("[*it_cal*]", $html, $text);
return $newone;
}

add_filter('the_content', 'addcal');
?>