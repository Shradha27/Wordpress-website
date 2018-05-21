<?php
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) )
	exit();

function uninstal_loan_calc() {
	
	require_once(ABSPATH."wp-includes/widgets.php");
	$widget_loan_calc = "loan_calculator";
	
	// These are the widgets grouped by sidebar
	$sidebars_widgets = wp_get_sidebars_widgets();
	if ( empty( $sidebars_widgets ) )
		$sidebars_widgets = wp_get_widget_defaults();
	// for the sake of PHP warnings
	if ( empty( $sidebars_widgets[$sidebar] ) )
		$sidebars_widgets[$sidebar] = array();
	
	foreach ($sidebars_widgets as $key1 => $sidebar_widget){
		foreach ($sidebar_widget as $key2 => $s_widget){
			$found = strpos($s_widget, $widget_loan_calc);
			if ($found !== false){
				unset($sidebars_widgets[$key1][$key2]);
			}
		}
	}
	
	wp_set_sidebars_widgets( $sidebars_widgets );
	
}

uninstal_loan_calc();

?>