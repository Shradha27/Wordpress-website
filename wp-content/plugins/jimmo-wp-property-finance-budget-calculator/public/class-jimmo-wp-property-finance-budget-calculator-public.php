<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://www.net-jet.de/
 * @since      1.0.0
 *
 * @package    Jimmo_WP_Property_Finance_Budget_Calculator
 * @subpackage Jimmo_WP_Property_Finance_Budget_Calculator/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and  hooks  to enqueue the
 * admin-specific stylesheet and JavaScript. Also includes the
 * calculation logic for 
 *
 * @package    Jimmo_WP_Property_Finance_Budget_Calculator
 * @subpackage Jimmo_WP_Property_Finance_Budget_Calculator/public
 * @author     NetJet UG (haftungsbeschränkt) <info@net-jet.de>
 */
class Jimmo_WP_Property_Finance_Budget_Calculator_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Holds a nonce identifying the instance of the form.
	 *
	 * @var    string
	 */
	private $jlb_nonce;

	/**
	  * Holds the changed locale.
	  *
	  * @var [type]
	  * @since 1.0.2
	  */
	 private $locale;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param    string    $plugin_name       The name of the plugin.
	 * @param    string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since     1.0.0
	 * @return    void
	 */
	public function enqueue_styles() {
		wp_register_style(
			$this->plugin_name,
			plugin_dir_url( __FILE__ ) . 'css/jimmo-wp-property-finance-budget-calculator-public.css',
			array(), $this->version,
			'all'
		);

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since     1.0.0
	 * @return    void
	 */
	public function enqueue_scripts() {
		wp_register_script(
			$this->plugin_name,
			plugin_dir_url( __FILE__ ) . 'js/jimmo-wp-property-finance-budget-calculator-public.js',
			array( 'jquery' ),
			$this->version,
			false 
		);

	}

	/**
	 * Register shortcode for output of the whole form in the frontend.
	 *
	 * @return    void
	 * @since     1.0.0
	 */
	public function jw_budget_calculator_shortcode_init() {
		if ( ! shortcode_exists( 'jw-budget-calculator' ) ) {
			add_shortcode( 'jw-budget-calculator', array( $this, 'jw_budget_calculator_shortcode' ) );
		}
	}

	/**
	 * Generate the output for the whole form in the frontend.
	 *
	 * @param array $atts
	 * @param string $content
	 * @return string
	 */
	function jw_budget_calculator_shortcode( $atts = [], $content = null, $tag ) {
		wp_enqueue_style( $this->plugin_name );
		wp_enqueue_script( $this->plugin_name );
		$this->jlb_nonce = wp_create_nonce( 'jlb_form' );
		wp_localize_script(
			$this->plugin_name,
			'jimmo_wp_property_finance_budget_calculator_ajax_obj',
			array(
				'nonce'    => $this->jlb_nonce,
				'ajax_url' => admin_url( 'admin-ajax.php' ),
    		)
		);

		// Change locale based on lang attribute
		$atts = array_change_key_case( (array)$atts, CASE_LOWER );
		$jwb_atts = shortcode_atts( ['lang' => ''], $atts, 'jw-budget-calculator' );

		// Change locale if lang is provided
		if (! empty( $jwb_atts['lang'] ) ) {
			// Include class Jimmo_WP_Property_Finance_Budget_Calculator_i18n
			require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-jimmo-wp-property-finance-budget-calculator-i18n.php';
			$plugin_i18n = new Jimmo_WP_Property_Finance_Budget_Calculator_i18n();
			$plugin_i18n->change_locale( $jwb_atts['lang'] );
			$this->locale = get_locale();
		}

		ob_start();
		include 'partials/jimmo-wp-property-finance-budget-calculator-public-display.php';
		$output = ob_get_clean();
		return $output;
	}

	/**
	 * Calculate ammortization schedule and send back result as JSON.
	 * 
	 * Function is called via WordPress AJAX API.
	 *
	 * @since     1.1.0
	 * @return    void
	 */
	public function calculate_ammortization_schedule() {
		check_ajax_referer( 'jlb_form' );

		// Change translation if necessary 
		if ( ! empty( $_POST['creditData']['locale'] ) ) {
			$locale = filter_var( $_POST['creditData']['locale'], FILTER_VALIDATE_REGEXP, array( "options" => array( "regexp" => "/^[a-z]{2,3}(_[A-Z]{2})?$/" ) ) );
			if ( ! empty( $locale ) ) {
				require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-jimmo-wp-property-finance-budget-calculator-i18n.php';
				$plugin_i18n = new Jimmo_WP_Property_Finance_Budget_Calculator_i18n();
				$plugin_i18n->change_locale( $locale );
			}
		}

		// Define array of spelled-out months
		$MONTHS = array(
			esc_html__( 'January', 'jimmo-wp-property-finance-budget-calculator' ),
			esc_html__( 'February', 'jimmo-wp-property-finance-budget-calculator' ),
			esc_html__( 'March', 'jimmo-wp-property-finance-budget-calculator' ),
			esc_html__( 'April', 'jimmo-wp-property-finance-budget-calculator' ),
			esc_html__( 'May', 'jimmo-wp-property-finance-budget-calculator' ),
			esc_html__( 'June', 'jimmo-wp-property-finance-budget-calculator' ),
			esc_html__( 'July', 'jimmo-wp-property-finance-budget-calculator' ),
			esc_html__( 'August', 'jimmo-wp-property-finance-budget-calculator' ),
			esc_html__( 'September', 'jimmo-wp-property-finance-budget-calculator' ),
			esc_html__( 'October', 'jimmo-wp-property-finance-budget-calculator' ),
			esc_html__( 'November', 'jimmo-wp-property-finance-budget-calculator' ),
			esc_html__( 'December', 'jimmo-wp-property-finance-budget-calculator' ),
		);

		// set variables
		$start_month = intval( $_POST['creditData']['startDate']['startMonth'] ) - 1;
		$start_year = intval( $_POST['creditData']['startDate']['startYear'] );
		
		$data = array();
		
		$month = $start_month;
		$year = 0;
		$liabilities = floatval( $_POST['creditData']['possibleInvestment'] - $_POST['creditData']['equity'] );
		$mortgage = $liabilities;
		$payment = floatval( $_POST['creditData']['realAmount'] );
		$redemption = 0;
		$interest = 0;
		$total_interest = 0;
		$interest_rate = floatval( $_POST['creditData']['percentageRate'] ) / 100;

		while ( $mortgage > 0 ) {
			// Start new year if necessary
			if ( $month >= 12 ) {
				// Jahreswerte runden
				$data[$year]['liabilities'] = number_format( $data[$year]['liabilities'], 2 );
				$data[$year]['mortgage'] = number_format( $data[$year]['mortgage'], 2 );
				$data[$year]['payment'] = number_format( $data[$year]['payment'], 2 );
				$data[$year]['redemption'] = number_format( $data[$year]['redemption'], 2 );
				$data[$year]['interest'] = number_format( $data[$year]['interest'], 2 );
				$data[$year]['total_interest'] = number_format( $data[$year]['total_interest'], 2 );
				$year++;
				$month = 0;
			}

			if ( 0 == $month || ( $month == $start_month && 0 == $year ) ) {
				$data[$year] = array(
					'year'           => $start_year + $year,
					'liabilities'    => $mortgage,
					'mortgage'       => $mortgage,
					'payment'        => 0,
					'redemption'     => null,
					'interest'       => null,
					'total_interest' => null,
					'single_months'  => array(),
				);
			}

			// Aktuellen Monat berechnen
			$liabilities = $mortgage;
			$interest = $liabilities * $interest_rate / 12;
			$redemption = $payment - $interest;
			if ( $redemption > $liabilities ) {
				$redemption = $liabilities;
				$payment = $redemption + $interest;
			}
			$mortgage = $liabilities - $redemption;
			$total_interest += $interest;

			$data_month = array(
						'month'          => esc_html( $MONTHS[ $month ] ),
						'liabilities'    => number_format( $liabilities, 2),
						'mortgage'       => number_format( $mortgage, 2),
						'payment'        => number_format( $payment, 2),
						'redemption'     => number_format( $redemption, 2),
						'interest'       => number_format( $interest, 2),
						'total_interest' => number_format ($total_interest, 2),
			);

			$data[$year]['single_months'][ $month ] = $data_month;

			// Jahreswerte anpassen
			$data[$year]['mortgage'] -= $redemption;
			$data[$year]['payment'] += $payment;
			$data[$year]['redemption'] += $redemption;
			$data[$year]['interest'] += $interest;
			$data[$year]['total_interest'] = $total_interest;

			

			//Monat hoch zählen
			$month++;
			
		} // end while

		// Letzte Jahreswerte runden
		$data[$year]['liabilities'] = number_format( $data[$year]['liabilities'], 2 );
		$data[$year]['mortgage'] = number_format( $data[$year]['mortgage'], 2 );
		$data[$year]['payment'] = number_format( $data[$year]['payment'], 2 );
		$data[$year]['redemption'] = number_format( $data[$year]['redemption'], 2 );
		$data[$year]['interest'] = number_format( $data[$year]['interest'], 2 );
		$data[$year]['total_interest'] = number_format( $data[$year]['total_interest'], 2 );
		$year++;
		$month = 0;

		// Array kürzen, wenn länger als 100 Jahre
		$data_last_index = count( $data ) - 1;
		

		if ( $data_last_index > 100 ) {
			$data[$year - 1]['error'] = array(
				'message' => sprintf(
					esc_html__('Table was cut off after 100 years. Calculated repayment period is %s years.', 'jimmo-wp-property-finance-budget-calculator'),
					$data_last_index
				)
			);
			$substitute_data = array(
				array(
					'year'           => '...',
					'liabilities'    => '...',
					'mortgage'       => '...',
					'payment'        =>'...',
					'redemption'     => '...',
					'interest'       => '...',
					'total_interest' => '...',
					'single_months'  => array()
				)
			);

			array_splice( $data, 101, -1, $substitute_data );
		}

		// Send Data as JSON
		wp_send_json( $data );
	}

}
