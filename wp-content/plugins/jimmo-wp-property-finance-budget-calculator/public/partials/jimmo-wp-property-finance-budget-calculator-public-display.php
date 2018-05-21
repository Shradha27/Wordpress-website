<?php

/**
 * Provide a public-facing view for the plugin
 *
 * This file is used to markup the public-facing aspects of the plugin.
 *
 * @link       http://www.net-jet.de/
 * @since      1.0.0
 *
 * @package    Jimmo_WP_Property_Finance_Budget_Calculator
 * @subpackage Jimmo_WP_Property_Finance_Budget_Calculator/public/partials
 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->

<div class="jl-budget-widget">
    <header>
        <h2><?php esc_html_e( 'Property Finance Budget Calculator', 'jimmo-wp-property-finance-budget-calculator' ); ?></h2>
        <div class="jl-statusbar">
            <div class="jl-statusbar-progress" style="width: 25%;"><span class="jl-step">25</span>%</div>
        </div>
    </header>
    <form class="loan-budget-calculator" novalidate="novalidate">
        <fieldset class="financial-situation">
            <legend><?php esc_html_e( 'Basic Financial Data', 'jimmo-wp-property-finance-budget-calculator' ); ?></legend>
            <label for="base-amount"><?php esc_html_e( 'Monthly available base amount', 'jimmo-wp-property-finance-budget-calculator'); ?></label>
            <input novalidate="novalidate" type="text" name="base-amount" class="base-amount" placeholder="<?php esc_attr_e( 'e.g.', 'jimmo-wp-property-finance-budget-calculator' ); ?> 1000<?php /* translators: decimal mark  */esc_attr_e( '.', 'jimmo-wp-property-finance-budget-calculator' ); ?>00">
            <label for="administration-costs"><?php esc_html_e('Monthly administration costs of the new property', 'jimmo-wp-property-finance-budget-calculator'); ?></label>
            <input novalidate="novalidate" type="text" name="administration-costs" class="administration-costs" placeholder="<?php esc_attr_e( 'e.g.', 'jimmo-wp-property-finance-budget-calculator' ); ?> 400<?php /* translators: decimal mark  */esc_attr_e( '.', 'jimmo-wp-property-finance-budget-calculator' ); ?>00">
            <div>
                <input type="checkbox" name="rented-out" class="rented-out" class="rented-out" style="display: inline;">
                <label for="rented-out"><?php esc_html_e('Will the object be (partially) rented out?', 'jimmo-wp-property-finance-budget-calculator'); ?></label>
            </div>
            <div class="rental-income-entry" style="display: none;">
                <label for="rental-income"><?php esc_html_e('Expected monthly rental income', 'jimmo-wp-property-finance-budget-calculator'); ?></label>
                <input type="text" name="rental-income" class="rental-income" placeholder="<?php esc_attr_e( 'e.g.', 'jimmo-wp-property-finance-budget-calculator' ); ?> 500<?php /* translators: decimal mark  */esc_attr_e( '.', 'jimmo-wp-property-finance-budget-calculator' ); ?>00">
            </div>
            <label for="real-amount"><strong><?php esc_html_e('Real amount available', 'jimmo-wp-property-finance-budget-calculator'); ?></strong></label>
            <input type="text" name="real-amount" class="real-amount" readonly placeholder="---">
            <input type="button" name="continue-financial-situation" class="continue continue-financial-situation" value="<?php esc_attr_e('continue', 'jimmo-wp-property-finance-budget-calculator'); ?>" disabled>
        </fieldset>
        <fieldset class="loan-data hidden">
            <legend><?php esc_html_e('Loan Data', 'jimmo-wp-property-finance-budget-calculator'); ?></legend>
            <label for="percentage-rate"><?php esc_html_e('Annual percentage rate (in % - nominal)', 'jimmo-wp-property-finance-budget-calculator'); ?></label>
            <input type="text" name="percentage-rate" class="percentage-rate" placeholder="<?php esc_attr_e( 'e.g.', 'jimmo-wp-property-finance-budget-calculator' ); ?> 2<?php /* translators: decimal mark  */esc_attr_e( '.', 'jimmo-wp-property-finance-budget-calculator' ); ?>00">
            <label for="repayment-rate"><?php esc_html_e('Repayment rate (in %)', 'jimmo-wp-property-finance-budget-calculator'); ?></label>
            <input type="text" name="repayment-rate" class="repayment-rate" placeholder="<?php esc_attr_e( 'e.g.', 'jimmo-wp-property-finance-budget-calculator' ); ?> 2<?php /* translators: decimal mark  */esc_attr_e( '.', 'jimmo-wp-property-finance-budget-calculator' ); ?>00">
            <label for="equity"><?php esc_html_e('Equity', 'jimmo-wp-property-finance-budget-calculator'); ?></label>
            <input type="text" name="equity" class="equity" placeholder="<?php esc_attr_e( 'e.g.', 'jimmo-wp-property-finance-budget-calculator' ); ?> 30000<?php /* translators: decimal mark  */esc_attr_e( '.', 'jimmo-wp-property-finance-budget-calculator' ); ?>00">
            <label for="possible-investment"><strong><?php esc_html_e('Possible investment (WITHOUT extra costs)', 'jimmo-wp-property-finance-budget-calculator'); ?></strong></label>
            <input type="text" name="possible-investment" class="possible-investment" readonly placeholder="---">
            <input type="button" name="back-loan-data"  class="back back-loan-data" value="<?php esc_attr_e('back', 'jimmo-wp-property-finance-budget-calculator'); ?>">
            <input type="button" name="continue-loan-data" class="continue continue-loan-data" value="<?php esc_attr_e('continue', 'jimmo-wp-property-finance-budget-calculator'); ?>" disabled>
        </fieldset>
        <fieldset class="cost-of-purchasing hidden">
            <legend><?php esc_html_e('Cost of purchasing', 'jimmo-wp-property-finance-budget-calculator'); ?></legend>
            <label for="brokerage-costs"><?php esc_html_e('Brokerage costs (in %)', 'jimmo-wp-property-finance-budget-calculator'); ?></label>
            <input type="text" name="brokerage-costs" class="brokerage-costs" placeholder="<?php esc_attr_e( 'e.g.', 'jimmo-wp-property-finance-budget-calculator' ); ?> 5<?php /* translators: decimal mark  */esc_attr_e( '.', 'jimmo-wp-property-finance-budget-calculator' ); ?>00">
            <label for="notary-fees"><?php esc_html_e('Notary fees (in %)', 'jimmo-wp-property-finance-budget-calculator'); ?></label>
            <input type="text" name="notary-fees" class="notary-fees" placeholder="<?php esc_attr_e( 'e.g.', 'jimmo-wp-property-finance-budget-calculator' ); ?> 5<?php /* translators: decimal mark  */esc_attr_e( '.', 'jimmo-wp-property-finance-budget-calculator' ); ?>00">
            <label for="transfer-tax"><?php esc_html_e('Real estate transfer tax (in %)', 'jimmo-wp-property-finance-budget-calculator'); ?></label>
            <input type="text" name="transfer-tax" class="transfer-tax" placeholder="<?php esc_attr_e( 'e.g.', 'jimmo-wp-property-finance-budget-calculator' ); ?> 5<?php /* translators: decimal mark  */esc_attr_e( '.', 'jimmo-wp-property-finance-budget-calculator' ); ?>00">
            <input type="button" name="back-cost-of-purchasing" class="back back-cost-of-purchasing" value="<?php esc_attr_e('back', 'jimmo-wp-property-finance-budget-calculator'); ?>">
            <input type="button" name="continue-cost-of-purchasing" class="continue continue-cost-of-purchasing" value="<?php esc_attr_e('final result', 'jimmo-wp-property-finance-budget-calculator'); ?>" disabled>
        </fieldset>
        <fieldset class="available-budget hidden">
            <label for="final-price"><strong><?php esc_html_e('Final price of your property', 'jimmo-wp-property-finance-budget-calculator'); ?></strong></label>
            <input type="text" name="final-price" class="final-price" readonly placeholder="---">
            <label><strong><?php esc_html_e( 'Show ammortization plan', 'jimmo-wp-property-finance-budget-calculator' ) ?></strong></label>
            <div>
                <div class="width-50">
                    <label for="ammortization-start-month"><?php esc_html_e( 'Start Month', 'jimmo-wp-property-finance-budget-calculator' ) ?></label>
                    <select name="ammortization-start-month" class="ammortization-start-month">
                        <option value="1"><?php esc_html_e( 'January', 'jimmo-wp-property-finance-budget-calculator' ) ?></option>
                        <option value="2"><?php esc_html_e( 'February', 'jimmo-wp-property-finance-budget-calculator' ) ?></option>
                        <option value="3"><?php esc_html_e( 'March', 'jimmo-wp-property-finance-budget-calculator' ) ?></option>
                        <option value="4"><?php esc_html_e( 'April', 'jimmo-wp-property-finance-budget-calculator' ) ?></option>
                        <option value="5"><?php esc_html_e( 'May', 'jimmo-wp-property-finance-budget-calculator' ) ?></option>
                        <option value="6"><?php esc_html_e( 'June', 'jimmo-wp-property-finance-budget-calculator' ) ?></option>
                        <option value="7"><?php esc_html_e( 'July', 'jimmo-wp-property-finance-budget-calculator' ) ?></option>
                        <option value="8"><?php esc_html_e( 'August', 'jimmo-wp-property-finance-budget-calculator' ) ?></option>
                        <option value="9"><?php esc_html_e( 'September', 'jimmo-wp-property-finance-budget-calculator' ) ?></option>
                        <option value="10"><?php esc_html_e( 'October', 'jimmo-wp-property-finance-budget-calculator' ) ?></option>
                        <option value="11"><?php esc_html_e( 'November', 'jimmo-wp-property-finance-budget-calculator' ) ?></option>
                        <option value="12"><?php esc_html_e( 'December', 'jimmo-wp-property-finance-budget-calculator' ) ?></option>
                    </select>
                </div>
                <div class="width-50">
                    <label for="ammortization-start-year"><?php esc_html_e( 'Start Year', 'jimmo-wp-property-finance-budget-calculator' ) ?></label>
                    <select name="ammortization-start-year"class="ammortization-start-year">
                    </select>
                </div>
            </div>
            <input type="hidden" name="jwb-locale" class="jwb-locale" value="<?php echo $this->locale; ?>">
            <input type="button" name="back-available-budget" class="back back-available-budget" value="<?php esc_attr_e('back', 'jimmo-wp-property-finance-budget-calculator'); ?>">
            <input type="button" name="show-ammortization-schedule" class="show-ammortization-schedule" value="<?php esc_attr_e( 'Show ammortization plan', 'jimmo-wp-property-finance-budget-calculator' ); ?>">
        </fieldset>
    </form>

    <div class="sk-fading-circle hidden">
        <div class="sk-circle1 sk-circle"></div>
        <div class="sk-circle2 sk-circle"></div>
        <div class="sk-circle3 sk-circle"></div>
        <div class="sk-circle4 sk-circle"></div>
        <div class="sk-circle5 sk-circle"></div>
        <div class="sk-circle6 sk-circle"></div>
        <div class="sk-circle7 sk-circle"></div>
        <div class="sk-circle8 sk-circle"></div>
        <div class="sk-circle9 sk-circle"></div>
        <div class="sk-circle10 sk-circle"></div>
        <div class="sk-circle11 sk-circle"></div>
        <div class="sk-circle12 sk-circle"></div>
    </div>

    <div class="ammortization-plan hidden">
        <div class="disclaimer">
            <?php esc_html_e( 'This schedule is calculated based on your input with standards calculation methods. The actual values might be marginally different.', 'jimmo-wp-property-finance-budget-calculator' ) ?>
        </div>
        <div class="table-container">
            <table >
                <thead>
                    <tr>
                        <th><?php esc_html_e( 'Month / Year', 'jimmo-wp-property-finance-budget-calculator' ); ?></th>
                        <th><?php esc_html_e( 'Liabilities', 'jimmo-wp-property-finance-budget-calculator' ); ?></th>
                        <th><?php esc_html_e( 'Mortgage', 'jimmo-wp-property-finance-budget-calculator' ); ?></th>
                        <th><?php esc_html_e( 'Payment', 'jimmo-wp-property-finance-budget-calculator' ); ?></th>
                        <th><?php esc_html_e( 'Redemption', 'jimmo-wp-property-finance-budget-calculator' ); ?></th>
                        <th><?php esc_html_e( 'Interest', 'jimmo-wp-property-finance-budget-calculator' ); ?></th>
                        <th><?php esc_html_e( 'Total interest', 'jimmo-wp-property-finance-budget-calculator' ); ?></th>
                    </tr>
                </thead>
                <tbody  class="ammortization-plan-data">
                </tbody>
            </table>
        </div>
    </div>
    <?php if ( get_option( 'jimmo_wp_property_finance_budget_calculator_display_credits' ) ) { ?>
        <div class="jimmo-credit">
            <?php printf(
                __('Powered by JIMMO WP Loan Budget Calculator - <a href="%s">JIMMO-TOOLs</a> Software for real estate agents.', 'jimmo-wp-property-finance-budget-calculator' ),
                'http://www.jimmo-tool.de/'
            ); ?>
        </div>
    <?php } ?>
</div>