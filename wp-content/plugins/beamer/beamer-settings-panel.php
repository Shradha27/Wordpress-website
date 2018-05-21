<div class="wrap">
	<h2>Beamer Settings</h2>
	<div class="bmrCard">
		<div class="bmrBanner">
			<span>You don't have a Beamer account?</span>
			<a class="bmrButton" href="https://www.getbeamer.com/?ref=wordpress_plugin" target="_blank" rel="nofollow">Get one for free</a>
		</div>
		<div class="bmrHeader">
			<a class="bmrLogo"></a>
		</div>
		<div class="bmrContent">
			<?php //settings_errors(); ?>
			<form method="post" action="options.php">
				<?php
					settings_fields( 'beamer_settings_option_group' );
					do_settings_sections( 'beamer-settings-admin' );
					submit_button();
				?>
			</form>
		</div>
		<div class="bmrAdd"></div>
		<div class="bmrCoda">
			<p><b>©2017-2018 Beamer.</b> Designed with &#10084; by <a href="http://www.hibox.co/?ref=wordpress_plugin" target="_blank" rel="nofollow">Hibox</a> – Version <?php echo bmr_version(); ?>
		</div>
	</div>
</div>