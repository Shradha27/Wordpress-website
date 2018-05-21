<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://www.net-jet.de/
 * @since             1.0.0
 * @package           Jimmo_WP_Property_Finance_Budget_Calculator
 *
 * @wordpress-plugin
 * Plugin Name:       JIMMO WP Property Finance Budget Calculator
 * Plugin URI:        http://wordpress.org/plugins/jimmo-wp-property-finance-budget-calculator
 * Description:       Plugin to calculate a loan budget for Real Estate.
 * Version:           1.1.0
 * Author:            NetJet UG (haftungsbeschränkt)
 * Author URI:        http://www.net-jet.de/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       jimmo-wp-property-finance-budget-calculator
 * Domain Path:       /languages
 * 
 * JIMMO WP Property Finance Budget Calculator
 * Copyright (C) 2017  NetJet UG (haftungsbeschränkt)
 * 
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 * 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 * 
 * You should have received a copy of the GNU General Public License along
 * with this program; if not, write to the Free Software Foundation, Inc.,
 * 51 Franklin Street, Fifth Floor, Boston, MA 02110-1301 USA.
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-jimmo-wp-property-finance-budget-calculator-activator.php
 */
function activate_jimmo_wp_property_finance_budget_calculator() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-jimmo-wp-property-finance-budget-calculator-activator.php';
	Jimmo_WP_Property_Finance_Budget_Calculator_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-jimmo-wp-property-finance-budget-calculator-deactivator.php
 */
function deactivate_jimmo_wp_property_finance_budget_calculator() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-jimmo-wp-property-finance-budget-calculator-deactivator.php';
	Jimmo_WP_Property_Finance_Budget_Calculator_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_jimmo_wp_property_finance_budget_calculator' );
//register_deactivation_hook( __FILE__, 'deactivate_jimmo_wp_property_finance_budget_calculator' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-jimmo-wp-property-finance-budget-calculator.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_jimmo_wp_property_finance_budget_calculator() {

	$plugin = new Jimmo_WP_Property_Finance_Budget_Calculator( plugin_basename(__FILE__) );
	$plugin->run();

}
run_jimmo_wp_property_finance_budget_calculator();
