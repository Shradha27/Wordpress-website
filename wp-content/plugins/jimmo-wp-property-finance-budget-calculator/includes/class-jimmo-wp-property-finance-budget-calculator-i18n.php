<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       http://www.net-jet.de/
 * @since      1.0.0
 *
 * @package    Jimmo_WP_Property_Finance_Budget_Calculator
 * @subpackage Jimmo_WP_Property_Finance_Budget_Calculator/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Jimmo_WP_Property_Finance_Budget_Calculator
 * @subpackage Jimmo_WP_Property_Finance_Budget_Calculator/includes
 * @author     NetJet UG (haftungsbeschränkt) <info@net-jet.de>
 */
class Jimmo_WP_Property_Finance_Budget_Calculator_i18n {

	private $locale;


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'jimmo-wp-property-finance-budget-calculator',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}

	/**
	 * Unload the plugin text domain for translation.
	 * 
	 * Used for changing the locale after it was first loaded.
	 *
	 * @return void
	 * @since 1.0.2
	 */
	public function unload_plugin_textdomain() {
		unload_textdomain( 'jimmo-wp-property-finance-budget-calculator' );
	}

	public function change_locale( $locale ) {
		// Change locale
		add_filter( 'locale', function( $lang ) use ( $locale ) { return $locale; } );

		$this->unload_plugin_textdomain();
		$this->load_plugin_textdomain();
	}
}
