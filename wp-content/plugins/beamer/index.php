<?php
	/*
	Plugin Name: Beamer
	Plugin URI: http://www.getbeamer.com/
	Description: Beamer is a smart and easy-to-use newsfeed and changelog you can install on your site or app to announce relevant news, latest features, and updates.
	Version: 2.5.2
	Author: Hibox
	Author URI: http://www.hibox.co/
	License: GPLv2 or later
	Text Domain: beamer

	This program is free software; you can redistribute it and/or
	modify it under the terms of the GNU General Public License
	as published by the Free Software Foundation; either version 2
	of the License, or (at your option) any later version.

	This program is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
	GNU General Public License for more details.

	You should have received a copy of the GNU General Public License
	along with this program; if not, write to the Free Software
	Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA 02110-1301, USA.
	*/

	// BEAMER VERSION ---------------------------------------------------------------------------
	function bmr_version(){
		$ver = "2.5.2";
		return $ver;
	}

	// BEAMER URLs ---------------------------------------------------------------------------
	// (just a shorthand for the most used external urls)
	function bmr_url($target, $ref = true, $echo = false) {
		$appUrl = 'https://app.getbeamer.com';
		$webUrl = 'https://www.getbeamer.com';
		if($target == 'signup'){
			$url = $appUrl.'/signup?ref=wp_plugin';
		}elseif($target == 'login'){
			$url = $appUrl;
		}elseif($target =='docs'){
			$url = $webUrl.'/docs';
		}else{
			$url = $webUrl;
		}
		if($echo == false){
			return $url;
		}elseif($echo == true){
			echo($url);
		}
	}

	// BEAMER OPTIONS PAGE ---------------------------------------------------------------------------
	// (add admin options page)
	include('beamer-settings.php');

	function bmr_enqueue_styles() {
		global $pagenow;
		if ($pagenow != 'options-general.php?page=beamer-settings') {
			wp_enqueue_style('beamer-styles', plugins_url('css/beamer-admin.min.css',__FILE__ ));
		}
	}
	add_action('admin_enqueue_scripts', 'bmr_enqueue_styles');

	// CALL SETTINGS ---------------------------------------------------------------------------
	// (get the settings)
	function bmr_get_settings() {
		$options = get_option( 'beamer_settings_option_name' );
		return $options;
	}

	// CALL SETTING ---------------------------------------------------------------------------
	// (get the individual setting)
	// $field : product_id, selector, advanced_settings, top, right, language, filter, lazy, alert, callback
	function bmr_get_setting($field = 'product_id'){
		$options = bmr_get_settings();
		if(isset($options[$field])){
			$value = $options[$field];
			return $value;
		}else{
			return null;
		}
	}

	// BEAMER NOTICE ---------------------------------------------------------------------------
	// (if admin hasn't set the product ID or selector show alert and links to settings and account creation)
	add_action('admin_notices', 'bmr_notice');
	function bmr_notice() {
		// product ID missing
		if( bmr_get_setting('product_id') == '' ):
			$link = get_admin_url().'options-general.php?page=beamer-settings';
			$notice = 'You activated Beamer in your Wordpress site but you haven\'t <a href="'.$link.'">set a product ID.</a> If you don\'t have a Beamer account, <a href="'.bmr_url('signup').'">get one for free.</a>';
			echo('<div class="notice update-nag is-dismissable"><p>'.$notice.'</p></div>');
	    endif;
	}

	// BEAMER CORE ---------------------------------------------------------------------------
	// (check all settings and create an array and discard those that are not in use)
	function bmr_parse_settings() {
		if( bmr_get_setting('product_id') != ''){
			$bmrscript = array();
			// Product ID (always required)
			$bmrscript['product_id'] = 'product_id : "'.bmr_get_setting('product_id').'"';
			// Selector (required unless alert is checked)
			if( bmr_get_setting('selector') ){
				$bmrscript['selector'] = 'selector : "'.bmr_get_setting('selector').'"';
			}
			$top = bmr_get_setting('top');
			$right = bmr_get_setting('right');
			$bottom = bmr_get_setting('bottom');
			$left = bmr_get_setting('left');
			// Advenced settings
			if( bmr_get_setting('display') ){
				$bmrscript['display'] = 'display : "'.bmr_get_setting('display').'"';
			}
			if( isset($top) && !empty($top) && $top != 0 ){
				$bmrscript['top'] = 'top : '.bmr_get_setting('top');
			}
			if( isset($right) && !empty($right) && $right != 0 ){
				$bmrscript['right'] = 'right : '.bmr_get_setting('right');
			}
			if( isset($bottom) && !empty($bottom) && $bottom != 0 ){
				$bmrscript['bottom'] = 'bottom : '.bmr_get_setting('bottom');
			}
			if( isset($left) && !empty($left) && $left != 0 ){
				$bmrscript['left'] = 'left : '.bmr_get_setting('left');
			}
			if( bmr_get_setting('button_position') ){
				$bmrscript['button_position'] = 'button_position : "'.bmr_get_setting('button_position').'"';
			}
			if( bmr_get_setting('language') ){
				$bmrscript['language'] = 'language : "'.bmr_get_setting('language').'"';
			}
			if( bmr_get_setting('filter') ){
				$bmrscript['filter'] = 'filter : "'.bmr_get_setting('filter').'"';
			}
			if( bmr_get_setting('mobile') == true ){
				$bmrscript['mobile'] = 'mobile : false';
			}
			if( bmr_get_setting('lazy') == true ){
				$bmrscript['lazy'] = 'lazy : true';
			}
			if( bmr_get_setting('alert') == true ){
				$bmrscript['alert'] = 'alert : false';
			}
			if( bmr_get_setting('callback') ){
				$bmrscript['callback'] = 'callback : '.bmr_get_setting('callback');
			}
			// User Settings
			if( bmr_get_setting('user') == true ){
				if( is_user_logged_in() ){
					$this_user = wp_get_current_user();
					$this_name = $this_user->user_firstname;
					$this_surname = $this_user->user_lastname;
					$this_alias = $this_user->user_login;
					$this_email = $this_user->user_email;
					if($this_name != '' && $this_surname != ''){
						$bmrscript['user_firstname'] = 'user_firstname : "'.$this_name.'"';
						$bmrscript['user_lastname'] = 'user_lastname : "'.$this_surname.'"';
					}else{
						$bmrscript['user_firstname'] = 'user_firstname : "'.$this_alias.'"';
					}
					$bmrscript['user_email'] = 'user_email : "'.$this_email.'"';
				}
			}
			// Compile Beamer Script
			return $bmrscript;
		}else{
			return null;
		}
	}

	// BEAMER TRIGGER (beta) ---------------------------------------------------------------------------
	if ( !class_exists('bmr_menu_metabox')) {
	    class bmr_menu_metabox {
	        public function add_nav_menu_meta_boxes() {
	        	add_meta_box(
	        		'bmr_nav_link',
	        		__('Beamer'),
	        		array( $this, 'nav_menu_link'),
	        		'nav-menus',
	        		'side',
	        		'low'
	        	);
	        }
	        public function nav_menu_link() {?>
	        	<div id="posttype-bmr-custom-button" class="posttypediv">
	        		<div id="tabs-panel-wishlist-login" class="tabs-panel tabs-panel-active">
	        			<ul id ="wishlist-login-checklist" class="categorychecklist form-no-clear">
	        				<li>
	        					<label class="menu-item-title">
	        						<input type="checkbox" class="menu-item-checkbox" name="menu-item[-1][menu-item-object-id]" value="-1"> 									Beamer Trigger
	        					</label>
	        					<input type="hidden" class="menu-item-type" name="menu-item[-1][menu-item-type]" value="custom">
	        					<input type="hidden" class="menu-item-title" name="menu-item[-1][menu-item-title]" value="What's New">
	        					<input type="hidden" class="menu-item-url" name="menu-item[-1][menu-item-url]" value="">
	        					<input type="hidden" class="menu-item-classes" name="menu-item[-1][menu-item-classes]" value="beamerTrigger">
	        				</li>
	        			</ul>
	        		</div>
	        		<p class="button-controls">
	        			<span class="add-to-menu">
	        				<input type="submit" class="button-secondary submit-add-to-menu right" value="Add to Menu" name="add-post-type-menu-item" id="submit-posttype-bmr-custom-button">
	        				<span class="spinner"></span>
	        			</span>
	        		</p>
	        	</div>
	        <?php }
	    }
	}
	$custom_nav = new bmr_menu_metabox;
	add_action('admin_init', array($custom_nav, 'add_nav_menu_meta_boxes'));

	// BEAMER SCRIPT ---------------------------------------------------------------------------
	function bmr_create_script() {
		// This calls the current settings
		$settings = bmr_parse_settings();
		// This creates the embedded script
		if($settings != null && $settings != ''){
			return 'var beamer_config = { '.implode(", ", $settings).' };';
		}else{
			return null;
		}
	}

	function bmr_filter($name, $condition, $ignore = false){
		// Check for the filter if it is active on settings page
		if(bmr_get_setting($name) == true){
			// Check for the condition (e.g. is_page, is_archive)
			if($condition == true){
				// Check if the ignore variable is set don't include filter for frontpage
				if($ignore == true && is_front_page()){
					return false;
				}else{
					// Adds the filter to the filters array
					return true;
				}
			}
		}
	}

	function bmr_filter_script() {
		// This create a filters array
		$filters = array();
		if(bmr_filter('nofront', is_front_page()) == true){ $filters['nofront'] = true; }
		if(bmr_filter('noposts', is_singular('post'), true) == true){ $filters['noposts'] = true; }
		if(bmr_filter('nopages', is_page(), true) == true){ $filters['nopages'] = true; }
		if(bmr_filter('noarchive', is_archive(), true) == true){ $filters['nopages'] = true; }
		if(bmr_filter('master', true) == true){ $filters['master'] = true; }
		// Check if the special ID filter is on
		if(bmr_get_setting('noid') != ''){
			$ignore = bmr_get_setting('noid');
			$parsed = str_replace(' ', '', $ignore);
			$list = explode(',', $parsed);
			foreach($list as $filter){
				if(get_the_ID() == $filter){ $filters['noid-'.$filter] = true; }
			}
		}
		// Check if any filter in the array is true
		if(!empty($filters) && in_array(true, $filters, true)){
			return true;
		}else{
			return false;
		}
	}

	function bmr_enqueue_scripts() {
		// Get the script
		$script = bmr_create_script();
		// check always that there is a product ID
		if(bmr_get_setting('product_id') != '' && bmr_filter_script() == false){
		    wp_enqueue_script( 'beamer', 'https://app.getbeamer.com/js/beamer-embed.js');
		    wp_add_inline_script('beamer', $script, 'before');
		}
	}
	add_action('wp_enqueue_scripts', 'bmr_enqueue_scripts');
?>