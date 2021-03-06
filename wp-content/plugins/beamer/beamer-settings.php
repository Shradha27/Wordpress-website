<?php
	// BEAMER SETTINGS CLASS
	class BeamerSettings {
		private $beamer_settings_options;
		// Construct
		public function __construct() {
			add_action( 'admin_menu', array( $this, 'beamer_settings_add_plugin_page' ) );
			add_action( 'admin_init', array( $this, 'beamer_settings_page_init' ) );
		}

		// Add settings page
		public function beamer_settings_add_plugin_page() {
			add_options_page(
				'Beamer Settings', // page_title
				'Beamer Settings', // menu_title
				'manage_options', // capability
				'beamer-settings', // menu_slug
				array( $this, 'beamer_settings_create_admin_page' ) // function
			);
		}

		// Create settings page
		public function beamer_settings_create_admin_page() {
			$this->beamer_settings_options = get_option( 'beamer_settings_option_name' );
			include('beamer-settings-panel.php');
		}

		// Add setting page elements
		public function beamer_settings_page_init() {
			// Register settings
			register_setting(
				'beamer_settings_option_group', // option_group
				'beamer_settings_option_name', // option_name
				array( $this, 'beamer_settings_sanitize' ) // sanitize_callback
			);
			// Settings sections -------------------------------------------------------
				// Add general settings section
				add_settings_section(
					'beamer_settings_setting_section', // id
					'General Settings', // title
					array( $this, 'beamer_settings_section_info' ), // callback
					'beamer-settings-admin' // page
				);
				// Add advanced settings section
				add_settings_section(
					'beamer_settings_advanced_section', // id
					'Advanced Options', // title
					array( $this, 'beamer_settings_advanced_section_info' ), // callback
					'beamer-settings-admin' // page
				);
				// Add user settings section
				add_settings_section(
					'beamer_settings_user_section', // id
					'User Options', // title
					array( $this, 'beamer_settings_user_section_info' ), // callback
					'beamer-settings-admin' // page
				);
				// Add master settings section
				add_settings_section(
					'beamer_settings_master_section', // id
					'Filter Options', // title
					array( $this, 'beamer_settings_master_section_info' ), // callback
					'beamer-settings-admin' // page
				);
			// Settings fields -------------------------------------------------------
				// Field: product-id
				add_settings_field(
					'product_id', // id
					'Product ID', // title
					array( $this, 'product_id_callback' ), // callback
					'beamer-settings-admin', // page
					'beamer_settings_setting_section' // section
				);
				// Field: selector
				add_settings_field(
					'selector', // id
					'Selector', // title
					array( $this, 'selector_callback' ), // callback
					'beamer-settings-admin', // page
					'beamer_settings_setting_section' // section
				);

				// Field: display (advanced)
				add_settings_field(
					'display', // id
					'Display', // title
					array( $this, 'display_callback' ), // callback
					'beamer-settings-admin', // page
					'beamer_settings_advanced_section' // section
				);
				// Field: top (advanced)
				add_settings_field(
					'top', // id
					'Top', // title
					array( $this, 'top_callback' ), // callback
					'beamer-settings-admin', // page
					'beamer_settings_advanced_section' // section
				);
				// Field: right (advanced)
				add_settings_field(
					'right', // id
					'Right', // title
					array( $this, 'right_callback' ), // callback
					'beamer-settings-admin', // page
					'beamer_settings_advanced_section' // section
				);
				// Field: bottom (advanced)
				add_settings_field(
					'bottom', // id
					'Bottom', // title
					array( $this, 'bottom_callback' ), // callback
					'beamer-settings-admin', // page
					'beamer_settings_advanced_section' // section
				);
				// Field: left (advanced)
				add_settings_field(
					'left', // id
					'Left', // title
					array( $this, 'left_callback' ), // callback
					'beamer-settings-admin', // page
					'beamer_settings_advanced_section' // section
				);
				// Field: button_position (advanced)
				add_settings_field(
					'button_position', // id
					'Button Position', // title
					array( $this, 'button_position_callback' ), // callback
					'beamer-settings-admin', // page
					'beamer_settings_advanced_section' // section
				);
				// Field: button_position (advanced)
				add_settings_field(
					'button_position', // id
					'Button Position', // title
					array( $this, 'button_position_callback' ), // callback
					'beamer-settings-admin', // page
					'beamer_settings_advanced_section' // section
				);
				// Field: language (advanced)
				add_settings_field(
					'language', // id
					'Language', // title
					array( $this, 'language_callback' ), // callback
					'beamer-settings-admin', // page
					'beamer_settings_advanced_section' // section
				);
				// Field: filters (advanced)
				add_settings_field(
					'filters', // id
					'Filter', // title
					array( $this, 'filters_callback' ), // callback
					'beamer-settings-admin', // page
					'beamer_settings_advanced_section' // section
				);
				// Field: lazy (advanced; checkbox)
				add_settings_field(
					'lazy', // id
					'Lazy', // title
					array( $this, 'lazy_callback' ), // callback
					'beamer-settings-admin', // page
					'beamer_settings_advanced_section' // section
				);
				// Field: alert (advanced; checkbox)
				add_settings_field(
					'alert', // id
					'Alert', // title
					array( $this, 'alert_callback' ), // callback
					'beamer-settings-admin', // page
					'beamer_settings_advanced_section' // section
				);
				// Field: callback (advanced)
				add_settings_field(
					'callback', // id
					'Callback', // title
					array( $this, 'callback_callback' ), // callback
					'beamer-settings-admin', // page
					'beamer_settings_advanced_section' // section
				);
				// Field: user (user; checkbox)
				add_settings_field(
					'user', // id
					'Catch user data', // title
					array( $this, 'user_callback' ), // callback
					'beamer-settings-admin', // page
					'beamer_settings_user_section' // section
				);

				// Field: mobile (master; checkbox)
				add_settings_field(
					'mobile', // id
					'Disable for mobile', // title
					array( $this, 'mobile_callback' ), // callback
					'beamer-settings-admin', // page
					'beamer_settings_master_section' // section
				);
				// Field: filter front (master; checkbox)
				add_settings_field(
					'nofront', // id
					'Disable in the Front Page', // title
					array( $this, 'nofront_callback' ), // callback
					'beamer-settings-admin', // page
					'beamer_settings_master_section' // section
				);
				// Field: filter posts (master; checkbox)
				add_settings_field(
					'noposts', // id
					'Disable for Posts', // title
					array( $this, 'noposts_callback' ), // callback
					'beamer-settings-admin', // page
					'beamer_settings_master_section' // section
				);
				// Field: filter pages (master; checkbox)
				add_settings_field(
					'nopages', // id
					'Disable for Pages', // title
					array( $this, 'nopages_callback' ), // callback
					'beamer-settings-admin', // page
					'beamer_settings_master_section' // section
				);
				// Field: filter archive (master; checkbox)
				add_settings_field(
					'noarchive', // id
					'Disable for Archives', // title
					array( $this, 'noarchive_callback' ), // callback
					'beamer-settings-admin', // page
					'beamer_settings_master_section' // section
				);
				// Field: filter id (master)
				add_settings_field(
					'noid', // id
					'Filter by ID', // title
					array( $this, 'noid_callback' ), // callback
					'beamer-settings-admin', // page
					'beamer_settings_master_section' // section
				);
				// Field: master (master; checkbox)
				add_settings_field(
					'master', // id
					'Master Switch', // title
					array( $this, 'master_callback' ), // callback
					'beamer-settings-admin', // page
					'beamer_settings_master_section' // section
				);
		}

		// Sanitize fields
		public function beamer_settings_sanitize($input) {
			$sanitary_values = array();
			if ( isset( $input['product_id'] ) ) {
				$sanitary_values['product_id'] = sanitize_text_field( $input['product_id'] );
			}
			if ( isset( $input['selector'] ) ) {
				$sanitary_values['selector'] = sanitize_text_field( $input['selector'] );
			}
			// Advenced
			if ( isset( $input['display'] ) ) {
				$sanitary_values['display'] = $input['display'];
			}
			if ( isset( $input['top'] ) ) {
				$sanitary_values['top'] = sanitize_text_field( $input['top'] );
			}
			if ( isset( $input['right'] ) ) {
				$sanitary_values['right'] = sanitize_text_field( $input['right'] );
			}
			if ( isset( $input['bottom'] ) ) {
				$sanitary_values['bottom'] = sanitize_text_field( $input['bottom'] );
			}
			if ( isset( $input['left'] ) ) {
				$sanitary_values['left'] = sanitize_text_field( $input['left'] );
			}
			if ( isset( $input['button_position'] ) ) {
				$sanitary_values['button_position'] = $input['button_position'];
			}
			if ( isset( $input['language'] ) ) {
				$sanitary_values['language'] = sanitize_text_field( $input['language'] );
			}
			if ( isset( $input['filters'] ) ) {
				$sanitary_values['filters'] = sanitize_text_field( $input['filters'] );
			}
			if ( isset( $input['lazy'] ) ) {
				$sanitary_values['lazy'] = $input['lazy'];
			}
			if ( isset( $input['alert'] ) ) {
				$sanitary_values['alert'] = $input['alert'];
			}
			if ( isset( $input['callback'] ) ) {
				$sanitary_values['callback'] = sanitize_text_field( $input['callback'] );
			}
			// User
			if ( isset( $input['user'] ) ) {
				$sanitary_values['user'] = $input['user'];
			}
			// Master
			if ( isset( $input['mobile'] ) ) {
				$sanitary_values['mobile'] = $input['mobile'];
			}
			if ( isset( $input['nofront'] ) ) {
				$sanitary_values['nofront'] = $input['nofront'];
			}
			if ( isset( $input['noposts'] ) ) {
				$sanitary_values['noposts'] = $input['noposts'];
			}
			if ( isset( $input['nopages'] ) ) {
				$sanitary_values['nopages'] = $input['nopages'];
			}
			if ( isset( $input['noarchive'] ) ) {
				$sanitary_values['noarchive'] = $input['noarchive'];
			}
			if ( isset( $input['noid'] ) ) {
				$sanitary_values['noid'] = sanitize_text_field( $input['noid'] );
			}
			if ( isset( $input['master'] ) ) {
				$sanitary_values['master'] = $input['master'];
			}

			return $sanitary_values;
		}

			// Beamer Sections Info
			public function beamer_settings_section_info() {
				echo('<div>To set your <b>Beamer embed</b> just add your product-id. You can customize your embed with the advanced parameters. For more information please read our <a href="'.bmr_url('docs').'" target="_blank">Documentation.</a></div>');
			}

			// Beamer Sections Info
			public function beamer_settings_advanced_section_info() {
				echo('<div>Customize the <b>Beamer embed</b>. For more information on each parameter and customization option please read our <a href="'.bmr_url('docs').'" target="_blank">Documentation.</a></div>');
			}

			// Beamer User Info
			public function beamer_settings_user_section_info() {
				echo('<div><b>Beamer</b> can track the users info (name, surname and email) as long as they are logged in their Wordpress accounts (recommended only for Wordpress sites that have subscribers).</div>');
			}

			// Beamer Master Info
			public function beamer_settings_master_section_info() {
				echo('<div><b>Beamer</b> can be disabled in some devices or pages</div>');
			}

		// Callbacks
			// Product ID
			public function product_id_callback() {
				printf(
					'<input class="regular-text" type="text" name="beamer_settings_option_name[product_id]" id="bmr-product_id" value="%s"><div class="bmrTip">This code identifies your product in Beamer. <span>Required</span></div>',
					isset( $this->beamer_settings_options['product_id'] ) ? esc_attr( $this->beamer_settings_options['product_id']) : ''
				);
			}
			// Selector
			public function selector_callback() {
				printf(
					'<input class="regular-text" type="text" name="beamer_settings_option_name[selector]" id="bmr-selector" value="%s"><div class="bmrTip">HTML id for the DOM element to be used as a trigger to show the panel.</div>',
					isset( $this->beamer_settings_options['selector'] ) ? esc_attr( $this->beamer_settings_options['selector']) : ''
				);
			}
			// Button Position
			public function display_callback() {
				?> <select name="beamer_settings_option_name[display]" id="bmr-display">
					<?php $selected = (isset( $this->beamer_settings_options['display'] ) && $this->beamer_settings_options['display'] === 'right') ? 'selected' : '' ; ?>
					<option value="right" <?php echo $selected; ?>>right</option>
					<?php $selected = (isset( $this->beamer_settings_options['display'] ) && $this->beamer_settings_options['display'] === 'left') ? 'selected' : '' ; ?>
					<option value="left" <?php echo $selected; ?>>left</option>
				</select> <div class="bmrTip">Side on which the Beamer panel will be shown in your site. <span>Optional</span></div> <?php
			}
			// Top
			public function top_callback() {
				printf(
					'<input class="regular-text" type="text" name="beamer_settings_option_name[top]" id="bmr-top" value="%s" placeholder="0"> <div class="bmrTip">Top position offset for the notification bubble. <span>Optional</span></div>',
					isset( $this->beamer_settings_options['top'] ) ? esc_attr( $this->beamer_settings_options['top']) : ''
				);
			}
			// Right
			public function right_callback() {
				printf(
					'<input class="regular-text" type="text" name="beamer_settings_option_name[right]" id="bmr-right" value="%s" placeholder="0"> <div class="bmrTip">Right position offset for the notification bubble. <span>Optional</span></div>',
					isset( $this->beamer_settings_options['right'] ) ? esc_attr( $this->beamer_settings_options['right']) : ''
				);
			}
			// Bottom
			public function bottom_callback() {
				printf(
					'<input class="regular-text" type="text" name="beamer_settings_option_name[bottom]" id="bmr-bottom" value="%s" placeholder="0"> <div class="bmrTip">Bottom position offset for the notification bubble. <span>Optional</span></div>',
					isset( $this->beamer_settings_options['bottom'] ) ? esc_attr( $this->beamer_settings_options['bottom']) : ''
				);
			}
			// Left
			public function left_callback() {
				printf(
					'<input class="regular-text" type="text" name="beamer_settings_option_name[left]" id="bmr-left" value="%s" placeholder="0"> <div class="bmrTip">Left position offset for the notification bubble. <span>Optional</span></div>',
					isset( $this->beamer_settings_options['left'] ) ? esc_attr( $this->beamer_settings_options['left']) : ''
				);
			}
			// Button Position
			public function button_position_callback() {
				?> <select name="beamer_settings_option_name[button_position]" id="bmr-button_position">
					<?php $selected = (isset( $this->beamer_settings_options['button_position'] ) && $this->beamer_settings_options['button_position'] === 'right-right') ? 'selected' : '' ; ?>
					<option value="bottom-right" <?php echo $selected; ?>>Bottom Right</option>
					<?php $selected = (isset( $this->beamer_settings_options['button_position'] ) && $this->beamer_settings_options['button_position'] === 'bottom-left') ? 'selected' : '' ; ?>
					<option value="bottom-left" <?php echo $selected; ?>>Bottom Left</option>
					<?php $selected = (isset( $this->beamer_settings_options['button_position'] ) && $this->beamer_settings_options['button_position'] === 'top-left') ? 'selected' : '' ; ?>
					<option value="top-left" <?php echo $selected; ?>>Top Left</option>
					<?php $selected = (isset( $this->beamer_settings_options['button_position'] ) && $this->beamer_settings_options['button_position'] === 'top-right') ? 'selected' : '' ; ?>
					<option value="top-right" <?php echo $selected; ?>>Top Right</option>
				</select> <div class="bmrTip">Position for the notification button (which opens the Beamer panel) that shows up when the selector parameter is not set. <span>Optional</span></div> <?php
			}
			// Language
			public function language_callback() {
				printf(
					'<input class="regular-text" type="text" name="beamer_settings_option_name[language]" id="bmr-language" value="%s" placeholder="EN"> <div class="bmrTip">Retrieve only posts that have a translation in this language. <span>Optional</span></div>',
					isset( $this->beamer_settings_options['language'] ) ? esc_attr( $this->beamer_settings_options['language']) : ''
				);
			}
			// Filters
			public function filters_callback() {
				printf(
					'<input class="regular-text" type="text" name="beamer_settings_option_name[filter]" id="bmr-filter" value="%s"> <div class="bmrTip">Retrieve only posts with a segment filter that matches or includes this value. <span>Optional</span></div>',
					isset( $this->beamer_settings_options['filter'] ) ? esc_attr( $this->beamer_settings_options['filter']) : ''
				);
			}
			// Lazy
			public function lazy_callback() {
				printf(
					'<input type="checkbox" name="beamer_settings_option_name[lazy]" id="bmr-lazy" value="lazy" %s> <label for="lazy">If <b>checked</b>, the Beamer plugin won’t be initialized automatically</label>',
					( isset( $this->beamer_settings_options['lazy'] ) && $this->beamer_settings_options['lazy'] === 'lazy' ) ? 'checked' : ''
				);
			}
			// Alert
			public function alert_callback() {
				printf(
					'<input type="checkbox" name="beamer_settings_option_name[alert]" id="bmr-alert" value="alert" %s> <label for="alert">If <b>checked</b>, the selector parameter will be ignored and it won\'t open the panel when clicked</label>',
					( isset( $this->beamer_settings_options['alert'] ) && $this->beamer_settings_options['alert'] === 'alert' ) ? 'checked' : ''
				);
			}
			// Callbacks
			public function callback_callback() {
				printf(
					'<input class="regular-text" type="text" name="beamer_settings_option_name[callback]" id="bmr-callback" value="%s"> <div class="bmrTip">Function to be called once the plugin is initialized. Learn more in our <a href="https://www.getbeamer.com/docs/" target="_blank">documentation page</a></div>',
					isset( $this->beamer_settings_options['callback'] ) ? esc_attr( $this->beamer_settings_options['callback']) : ''
				);
			}
			// User
			public function user_callback() {
				printf(
					'<input type="checkbox" name="beamer_settings_option_name[user]" id="bmr-user" value="user" %s> <label for="user">If <b>checked</b>, the Beamer plugin will register the user\'s name, surname and email as long as they are logged to be shown in your accounts statistics</label>',
					( isset( $this->beamer_settings_options['user'] ) && $this->beamer_settings_options['user'] === 'user' ) ? 'checked' : ''
				);
			}
			// Mobile
			public function mobile_callback() {
				printf(
					'<input type="checkbox" name="beamer_settings_option_name[mobile]" id="bmr-mobile" value="mobile" %s> <label for="mobile">If <b>checked</b>, the Beamer plugin will not be called on any mobile device</label>',
					( isset( $this->beamer_settings_options['mobile'] ) && $this->beamer_settings_options['mobile'] === 'mobile' ) ? 'checked' : ''
				);
			}
			// No Front
			public function nofront_callback() {
				printf(
					'<input type="checkbox" name="beamer_settings_option_name[nofront]" id="bmr-nofront" value="nofront" %s> <label for="nofront">If <b>checked</b>, the Beamer plugin will not be called on the front page</label>',
					( isset( $this->beamer_settings_options['nofront'] ) && $this->beamer_settings_options['nofront'] === 'nofront' ) ? 'checked' : ''
				);
			}
			// No Posts
			public function noposts_callback() {
				printf(
					'<input type="checkbox" name="beamer_settings_option_name[noposts]" id="bmr-noposts" value="noposts" %s> <label for="noposts">If <b>checked</b>, the Beamer plugin will not be called on any Post</label>',
					( isset( $this->beamer_settings_options['noposts'] ) && $this->beamer_settings_options['noposts'] === 'noposts' ) ? 'checked' : ''
				);
			}
			// No Pages
			public function nopages_callback() {
				printf(
					'<input type="checkbox" name="beamer_settings_option_name[nopages]" id="bmr-nopages" value="nopages" %s> <label for="nopages">If <b>checked</b>, the Beamer plugin will not be called on any Pages</label>',
					( isset( $this->beamer_settings_options['nopages'] ) && $this->beamer_settings_options['nopages'] === 'nopages' ) ? 'checked' : ''
				);
			}
			// No Archive
			public function noarchive_callback() {
				printf(
					'<input type="checkbox" name="beamer_settings_option_name[noarchive]" id="bmr-noarchive" value="noarchive" %s> <label for="noarchive">If <b>checked</b>, the Beamer plugin will not be called on any Archive, Category or Tag</label>',
					( isset( $this->beamer_settings_options['noarchive'] ) && $this->beamer_settings_options['noarchive'] === 'noarchive' ) ? 'checked' : ''
				);
			}
			// No ID
			public function noid_callback() {
				printf(
					'<input class="regular-text" type="text" name="beamer_settings_option_name[noid]" id="bmr-noid" value="%s"> <div class="bmrTip">Add IDs separated by commas. Beamer will be deactivated for all pages or posts that have those IDs</div>',
					isset( $this->beamer_settings_options['noid'] ) ? esc_attr( $this->beamer_settings_options['noid']) : ''
				);
			}
			// Master
			public function master_callback() {
				printf(
					'<input type="checkbox" name="beamer_settings_option_name[master]" id="bmr-master" value="master" %s> <label for="master" style="color:#fd5c63;">Beamer will be disabled completely if this is <b>checked</b> (in all devices)</label>',
					( isset( $this->beamer_settings_options['master'] ) && $this->beamer_settings_options['master'] === 'master' ) ? 'checked' : ''
				);
			}
	}

	if ( is_admin() )
		$beamer_settings = new BeamerSettings();