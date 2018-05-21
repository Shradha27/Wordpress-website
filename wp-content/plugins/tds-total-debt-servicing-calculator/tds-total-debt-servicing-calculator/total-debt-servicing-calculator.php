<?php
/*
  Plugin Name: Total Debt Servicing Calculator
  Plugin URI: https://www.mortgagebidder.ca
  Description: Use this shortcode [debt-servicing-calculator] on your page to show Total Debt Servicing Calculator Form
  Version: 1.0
  Author: Mortgage Bidder Canada Inc.
  Author URI: https://www.mortgagebidder.ca
 */
// register jquery and style on initialization
add_action('init', 'tdsc_register_scripts');

function tdsc_register_scripts() {
    //wp_register_script('tdsc-jquery', plugins_url('/js/jquery.js', __FILE__), array('jquery'));
    wp_register_script('tdsc-bootstrap', plugins_url('/js/bootstrap.js', __FILE__), array('jquery'));
    wp_register_script('tdsc-validate', plugins_url('/js/jquery.validate.js', __FILE__), array('jquery'));
    //wp_register_script('tdsc-custom', plugins_url('/js/custom.js', __FILE__), array('jquery'));
    wp_register_style('tdsc-bootstap', plugins_url('/css/bootstrap.css', __FILE__));
    wp_register_style('tdsc-style', plugins_url('/css/style.css', __FILE__));
}

// use the registered jquery and style above
add_action('wp_enqueue_scripts', 'tdsc_enqueue_styles');

function tdsc_enqueue_styles() {
   // wp_enqueue_script('tdsc-jquery');
    wp_enqueue_script('tdsc-bootstrap');
    wp_enqueue_script('tdsc-validate');
   // wp_enqueue_script('tdsc-custom');
    wp_enqueue_style('tdsc-bootstap');
    wp_enqueue_style('tdsc-style');
}

function tdsc_calculator_html() {
    echo'<script>

	$().ready(function() {


		// validate signup form on keyup and submit
		$("#tds-calculator").validate({
			rules: {
				annual_income: {
					required: true,
                                        number: true,
					minlength: 4
				},
                                coapplicant_grossincome: {
					required: true,
                                        number: true,
					minlength: 2
				},
				monthly_mortgage: {
					required: true,
					number: true,
					minlength: 2
				},
				monthly_propertytax: {
					required: true,
					number: true,
					minlength: 2
				},
				monthly_condofee: {
					required: true,
					number: true,
					minlength: 2
				},
				monthly_heatingcost: {
					required: true,
					number: true,
					minlength: 2
				},
				monthly_childsupport: {
					required: true,
					number: true,
					minlength: 2
				},
                                monthly_alimonypayment: {
					required: true,
					number: true,
					minlength: 2
				},
                                creditcard_balance: {
					required: true,
					number: true,
					minlength: 2
				},
                                monthly_car_loan: {
					required: true,
					number: true,
					minlength: 2
				},
                                creditline_limit: {
					required: true,
					number: true,
					minlength: 2
				},
                                overdraft_limit: {
					required: true,
					number: true,
					minlength: 2
				},
			},
			messages: {

				annual_income: {
					minlength: "Please enter at least 4 digits anual income."
				},
				coapplicant_grossincome: {
					minlength: "Please enter at least 2 digits."
				},
				monthly_mortgage: {
					minlength: "Please enter at least 2 digits."
				},
				monthly_propertytax: {
					minlength: "Please enter at least 2 digits."
				},
				monthly_condofee: {
					minlength: "Please enter at least 2 digits."
				},
				monthly_heatingcost: {
					minlength: "Please enter at least 2 digits."
				},
				monthly_childsupport: {
					minlength: "Please enter at least 2 digits."
				},
                                monthly_alimonypayment: {
					minlength: "Please enter at least 2 digits."
				},
                                creditcard_balance: {
					minlength: "Please enter at least 2 digits."
				},
                                monthly_car_loan: {
					minlength: "Please enter at least 2 digits."
				},
                                creditline_limit: {
					minlength: "Please enter at least 2 digits."
				},
                                overdraft_limit: {
					minlength: "Please enter at least 2 digits."
				},
			}
		});




	});
     </script>';
    echo '<div class="row">';
    echo '<div class="col-sm-12 affcal-container clearfix">';
    echo '<h2 class="aff-cal">Total Debt Servicing (TDS) Calculator</h2>';
    echo '<form id="tds-calculator" action="' . esc_url($_SERVER['REQUEST_URI']) . '" method="post">';
    echo '<h3 class="hac-color">Income</h3>';
    echo '<hr class="ca-hr">';
    echo '<div class="col-sm-6 col-xm-12 form-group">';
    echo '<label class="control-label">Annual Gross Income</label>';
    echo '<input class="form-control" type="text" name="annual_income" id="annual_income" value="' . ( isset($_POST["annual_income"]) ? esc_attr($_POST["annual_income"]) : '' ) . '"  />';
    echo '</div>';
    echo '<div class="col-sm-6 col-xm-12 form-group">';
    echo '<label class="control-label">Spouse/Co-applicant`s Annual Gross Income</label>';
    echo '<input class="form-control" type="text" name="coapplicant_grossincome" id="coapplicant_grossincome" value="' . ( isset($_POST["coapplicant_grossincome"]) ? esc_attr($_POST["coapplicant_grossincome"]) : '' ) . '"  />';
    echo '</div>';
    echo '<h3 class="hac-color">Expenses</h3>';
    echo '<hr class="ca-hr">';
    echo '<div class="col-sm-6 col-xm-12 form-group">';
    echo '<label class="control-label">Monthly Mortgage or Rent Payment</label>';
    echo '<input class="form-control" type="text" name="monthly_mortgage" id="monthly_mortgage" value="' . ( isset($_POST["monthly_mortgage"]) ? esc_attr($_POST["monthly_mortgage"]) : '' ) . '" required />';
    echo '</div>';
    echo '<div class="col-sm-6 col-xm-12 form-group">';
    echo '<label class="control-label">Monthly Property Tax</label>';
    echo '<input class="form-control" type="text" name="monthly_propertytax" id="monthly_propertytax" value="' . ( isset($_POST["monthly_propertytax"]) ? esc_attr($_POST["monthly_propertytax"]) : '' ) . '" required />';
    echo '</div>';
    echo '<div class="col-sm-6 col-xm-12 form-group">';
    echo '<label class="control-label">Monthly Condo Fee</label>';
    echo '<input class="form-control" type="text" name="monthly_condofee" id="monthly_condofee" value="' . ( isset($_POST["monthly_condofee"]) ? esc_attr($_POST["monthly_condofee"]) : '' ) . '" required />';
    echo '</div>';
    echo '<div class="col-sm-6 col-xm-12 form-group">';
    echo '<label class="control-label">Monthly Heating Cost</label>';
    echo '<input class="form-control" type="text" name="monthly_heatingcost" id="monthly_heatingcost" value="' . ( isset($_POST["monthly_heatingcost"]) ? esc_attr($_POST["monthly_heatingcost"]) : '' ) . '" required />';
    echo '</div>';
    echo '<div class="col-sm-6 col-xm-12 form-group">';
    echo '<label class="control-label">Monthly Child Support Payment</label>';
    echo '<input class="form-control" type="text" name="monthly_childsupport" id="monthly_childsupport" value="' . ( isset($_POST["monthly_childsupport"]) ? esc_attr($_POST["monthly_childsupport"]) : '' ) . '" required />';
    echo '</div>';
    echo '<div class="col-sm-6 col-xm-12 form-group">';
    echo '<label class="control-label">Monthly Alimony Payment</label>';
    echo '<input class="form-control" type="text" name="monthly_alimonypayment" id="other_monthly_expenses" value="' . ( isset($_POST["monthly_alimonypayment"]) ? esc_attr($_POST["monthly_alimonypayment"]) : '' ) . '" required />';
    echo '</div>';
    echo '<h3 class="hac-color">Existing Debt</h3>';
    echo '<hr class="ca-hr">';
    echo '<div class="col-sm-6 col-xm-12 form-group">';
    echo '<label class="control-label">Credit Card Balance</label>';
    echo '<input class="form-control" type="text" name="creditcard_balance" id="creditcard_balance" value="' . ( isset($_POST["creditcard_balance"]) ? esc_attr($_POST["creditcard_balance"]) : '' ) . '" required />';
    echo '</div>';
    echo '<div class="col-sm-6 col-xm-12 form-group">';
    echo '<label class="control-label">Monthly Car Loan Payment</label>';
    echo '<input class="form-control" type="text" name="monthly_car_loan" id="monthly_car_loan" value="' . ( isset($_POST["monthly_car_loan"]) ? esc_attr($_POST["monthly_car_loan"]) : '' ) . '" required />';
    echo '</div>';
    echo '<div class="col-sm-6 col-xm-12 form-group">';
    echo '<label class="control-label">Credit Line Limit</label>';
    echo '<input class="form-control" type="text" name="creditline_limit" id="creditline_limit" value="' . ( isset($_POST["creditline_limit"]) ? esc_attr($_POST["creditline_limit"]) : '' ) . '" required />';
    echo '</div>';
    echo '<div class="col-sm-6 col-xm-12 form-group">';
    echo '<label class="control-label">Overdraft Limit</label>';
    echo '<input class="form-control" type="text" name="overdraft_limit" id="overdraft_limit" value="' . ( isset($_POST["overdraft_limit"]) ? esc_attr($_POST["overdraft_limit"]) : '' ) . '" required />';
    echo '</div>';
    echo '<hr class="ca-hr">';
    echo '<p class="button-container"><input class="btn btn-primary pull-right" type="submit" id="tdsc-calculator" name="tdsc-calculator" value="Calculate"></p>';
    echo '</form>';
    echo '</div>';
    echo '</div>';
}

function tdsc_calculator() {

    // if the submit button is clicked, send the email
    if (isset($_POST['tdsc-calculator'])) {
        $annual_income           = sanitize_text_field( $_POST['annual_income'] );
        $coapplicant_grossincome = sanitize_text_field($_POST['coapplicant_grossincome']);
        $monthly_mortgage        = sanitize_text_field($_POST['monthly_mortgage']);
        $monthly_condofee        = sanitize_text_field($_POST['monthly_condofee']);
        $monthly_childsupport    = sanitize_text_field($_POST['monthly_childsupport']);
        $monthly_propertytax     = sanitize_text_field($_POST['monthly_propertytax']);
        $monthly_heatingcost     = sanitize_text_field($_POST['monthly_heatingcost']);
        $monthly_alimonypayment  = sanitize_text_field($_POST['monthly_alimonypayment']);
        $creditcard_balance      = sanitize_text_field($_POST['creditcard_balance']);
        $creditline_limit        = sanitize_text_field($_POST['creditline_limit']);
        $monthly_car_loan        = sanitize_text_field($_POST['monthly_car_loan']);
        $overdraft_limit         = sanitize_text_field($_POST['overdraft_limit']);

        if ($creditcard_balance)
            $creditcard_balance = $creditcard_balance * .025;
        if ($creditline_limit)
            $creditline_limit   = $creditline_limit * .025;
        if ($overdraft_limit)
            $overdraft_limit    = $overdraft_limit * .025;


        $totalexpenses = $monthly_mortgage + $monthly_condofee + $monthly_childsupport + $monthly_propertytax + $monthly_heatingcost + $monthly_alimonypayment + $creditcard_balance + $creditline_limit + $monthly_car_loan + $overdraft_limit;

        $totalincome   = $annual_income + $coapplicant_grossincome;
        $monthlyincome = $totalincome / 12;
        $tds_ratio     = number_format(($totalexpenses / $monthlyincome) * 100, 2);

        $result = '';
        $result .='<div class="calculate-tdsc-response">';
        $result .='<h2 class="TDSC-title">Mortgage Calculator Result</h2>';
        $result .='<div class="text-center">
									  <ul class="tdsc-response-box clearfix">
										  <li>
											  <h4>Total Income</h4>
											  <p>$' . $totalincome . '</p>
										  </li>
										  <li>
											  <h4>Total Expenses</h4>
											  <p>$' . $totalexpenses . '</p>
										  </li>

										  <li>
											  <h4>TDS</h4>
											  <p>' . $tds_ratio . '%</p>
										  </li>
									  </ul>';
        $result .='</div></div>';
        echo $result;
    }

}

function tdsc_shortcode() {
    ob_start();
    tdsc_calculator_html();
    tdsc_calculator();

    return ob_get_clean();
}

add_shortcode('debt-servicing-calculator', 'tdsc_shortcode');
?>