<?php

/**
 * Fired during plugin activation
 *
 * @link       http://www.net-jet.de/
 * @since      1.0.0
 *
 * @package    Jimmo_WP_Property_Finance_Budget_Calculator
 * @subpackage Jimmo_WP_Property_Finance_Budget_Calculator/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Jimmo_WP_Property_Finance_Budget_Calculator
 * @subpackage Jimmo_WP_Property_Finance_Budget_Calculator/includes
 * @author     NetJet UG (haftungsbeschränkt) <info@net-jet.de>
 */
class Jimmo_WP_Property_Finance_Budget_Calculator_Activator {

	/**
	 * Trigger the activation notice to be displayed.
	 *
	 * Sets a transient to display a message after plugin activation that
	 * prompts the user to activate the credits to be shown below the form
	 * to visitors.
	 *
	 * @since    1.0.0
	 * @return   void
	 */
	public static function activate() {
		set_transient( 'jimmo_wp_property_finance_budget_calculator_activation_notice', true );
	}

}
