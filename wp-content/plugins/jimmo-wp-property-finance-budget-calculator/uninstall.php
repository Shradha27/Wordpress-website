<?php

/**
 * Fired when the plugin is uninstalled.
 *
 * 
 *
 * @link       http://www.net-jet.de/
 * @since      1.0.0
 *
 * @package    Jimmo_WP_Property_Finance_Budget_Calculator
 */

// If uninstall not called from WordPress, then exit.
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit;
}

delete_option( 'jimmo_wp_property_finance_budget_calculator_display_credits' );
