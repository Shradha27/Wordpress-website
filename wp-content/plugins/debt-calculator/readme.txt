=== Debt Calculator ===
Contributors: katzwebdesign
Tags: debt, bankruptcy, calculator, finance, debt calculator, financial
Requires at least: 2.5
Tested up to: 3.6
Stable tag: trunk

Add a debt calculator to your website to help users determine how long it will take to pay off debt.

== Description ==

> For plugin support, go to the official <a href="http://www.seodenver.com/debt-calculator/">Debt Calculator page</a>

Easily add a debt repayment calculator to your website. If you have a website about debt, personal finance, credit, mortgages, bankruptcy, or other financial services, offer your users a tool to estimate how long it will take them to get out of debt.

Simply add the text `[debtcalc]` to page or post content, and have a helpful debt calculation form embedded in your site's content. You can also add the calculator to your website's sidebar by using the `[debtcalc]` shortcode in a text widget!

<h4>Shortcode Use</h4>

* `class` : Adds CSS class to container <code>DIV</code>. Default: `debtCalculator`
* `width` : Inline CSS width of container <code>DIV</code>. Default: `400px`
* `zebra` : Whether to add CSS class of <code>debt_row_odd</code> to odd table rows, making the table alternating colors (called zebrastriping). Default: `true`
* `legend` : Add a legend to the form with the specified text. Default: `false`

<h4>Sample code:</h4>
`[debtcalc class="sampleCssClass" width="100%" zebra="false" legend="Your Debt Snapshot"]`

The form's container DIV will have class "sampleCssClass" and will be 100% wide. The table will NOT be zebrastriped, and the legend text will be "Your Debt Snapshot".

* Updating the style: You can update the form's style by editing the plugin's <code>debt.css</code> file
 
== Installation ==

1. Upload plugin files to your plugins folder, or install using WordPress' built-in Add New Plugin installer.
1. Activate the plugin
1. Add `[debtcalc]` shortcode to your content where you want a debt calculator

== Upgrade Notice ==

= 1.0.1 = 
* Turned link off by default
* Updated link to plugin page
* Improved ReadMe

== Changelog ==

= 1.0.1 = 
* Turned link off by default
* Updated link to plugin page
* Improved ReadMe

= 1.0 =
* Initial release

== Screenshots ==

1. How the form appears embedded in content with zebrastriping on and the legend set as "Your Debt Snapshot". To recreate, use `[debtcalc legend="Your Debt Snapshot"]`

== Frequently Asked Questions ==

= Where did the initial code come from? =
* The calculator javascript code used is <a href="http://javascript.internet.com/math-related/credit-card-debt-calculator.html" rel="nofollow">Credit Card .Debt Calculator</a>

= What is the plugin license? =
* This plugin is released under a GPL license