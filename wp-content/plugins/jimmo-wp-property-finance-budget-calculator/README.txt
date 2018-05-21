=== JIMMO WP Property Finance Budget Calculator ===
Contributors: netjet
Tags: loan, loan budget, loan budget calculator, equity, mortgage, real estate, property costs, repayment calculator, real estate affordability, loan affordability, mortgage affordability
Requires at least: 3.6.0
Tested up to: 4.8.1
Stable tag: 1.1.0
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Display a loan budget calculator on your website, where visitors can check how much loan or mortgage they can afford,
and show an amortization plan.

== Description ==

JIMMO WP Property Finance Budget Calculator lets you add a multi-page form to your site where your visitors can 
calculate the amount of loan or mortgage they can afford for real estate.

**Look at a [demo and in-depth description](http://www.net-jet.de/jimmo-wp-property-finance-budget-calculator/) of the plugin!**

The form is responsive and adapts to the place where it is included (e.g. Content, Sidebar, ...), as well as
the screen size, as long as the theme itself is responsive, too.

The following values are taken into account:

* The financial situation of the visitor (spare money, rental income, equity)
* Administration costs of the property
* Loan data (percentage rate, repayment rate)
* Cost of purchasing (brokerage costs, notary fees, taxes)

**Suggestions?**

If you have suggestions or questions, feel free to email us at info@net-jet.de

**Social Media**

Become a fan of our sites on facebook!
[https://www.facebook.com/jimmotool/](https://www.facebook.com/jimmotool/)
[https://www.facebook.com/net.jet.de/](https://www.facebook.com/net.jet.de/)

Follow us on Twitter!
[https://twitter.com/jimmotool](https://twitter.com/jimmotool)
[https://twitter.com/net_jet_de](https://twitter.com/net_jet_de)

== Installation ==

1. Upload the contents of `jimmo-wp-property-finance-budget-calculator.zip` to the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress
1. Place `[jw-budget-calculator]` on any page or post, or `<?php echo do_shortcode( '[jw-budget-calculator]' ); ?>` in your templates

== Frequently Asked Questions ==

= I installed the plugin, but the form is not displayed =

Did you use the shortcode `[jw-budget-calculator]` or the template-tag `<?php echo do_shortcode( '[jw-budget-calculator]' ); ?>` anywhere on
your site? This code tells the plugin where to insert the form.

= Can I display the form on multiple places on my site? =

Yes. You can easily add the shortcode or template-tag to multiple pages or places on your site, and even on the same page.

== Screenshots ==

1. The first page of the form as shown to the visitor

== Changelog ==

= 1.1.0 =
* Added documentation on how to use the plugin to the settings page
* Changes in the template for the calculator form
* Improved data validation for the calculation of repayment plans
* Fixed a bug in the locale handling of the repayment plan calculation

= 1.0.2 =
* Include JavaScript and CSS Stylesheets only on pages where the form is actually displayed
* Changes in the i18n behaviour of the plugin

= 1.0.1 =
* Fixed a bug that could lead to wrong values in the ammortization schedule
* Changed the calculation of the ammortization schedule to lower data volume
* Limited the number of years shown in the ammortization schedule to first 100 plus last row to prevent crashes with extreme input values

= 1.0 =
* Initial release

== Upgrade Notice ==

= 1.1.0 =
Update to prevent errors if malicious values are submitted via AJAX.

= 1.0.2 *
Update to increase page loading speed and lower transfer volume.

= 1.0.1 =
Update to prevent wrong result values in the ammortization schedule and crashes with extreme input values.

= 1.0 =
If you are using a pre-release or beta version, as indicated by a version number lower than 1.0,
update to get all features and bug fixes.
