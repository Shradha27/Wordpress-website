jQuery(document).ready(function() {
	// widget settings
 	
	var options_monthly_mortgage_calc_widget_free = { 
		target:        '#result_monthly_mortgage_calc_widget_free'
		}; 

	jQuery('#monthly_mortgage_calc_form_widget_free').validate({
		rules: {
			monthly_mortgage_monthly_mortgage_calc_free: {
				required: true,
				number: true,
				min: 100
			},
			rate_monthly_mortgage_calc_free: {
				required: true,
				number: true,
				max: 30
			},
			years_monthly_mortgage_calc_free: {
				required: true,
				number: true,
				max: 30
			}
		},
		submitHandler: function(form) {
			jQuery('#monthly_mortgage_calc_form_widget_free').ajaxSubmit(options_monthly_mortgage_calc_widget_free);
		}	
	});
	
	//plugin settings
	var date = new Date();
	jQuery('#advanced_mortgage_calc_month_start_date').val(date.getMonth()+1);
	jQuery('#advanced_mortgage_calc_day_start_date').val(date.getDate());
	jQuery('#advanced_mortgage_calc_year_start_date').val(date.getFullYear());
	
	jQuery('#advanced_mortgage_calc_monthly_mortgate').val('');
	
	jQuery('#advanced_mortgage_calc_years').blur(function() {   
		if (this.value == ''){  
			this.value = (this.defaultValue ? this.defaultValue : '');  
		}
		else{
			jQuery('#advanced_mortgage_calc_months').val(this.value*12);
		}
	});
	
	jQuery('#advanced_mortgage_calc_months').blur(function() {   
		if (this.value == ''){  
			this.value = (this.defaultValue ? this.defaultValue : '');  
		}
		else{
			jQuery('#advanced_mortgage_calc_years').val(Math.round((this.value/12)*100)/100);
		}
	});

	var advanced_mortgage_calc_options_free = { 
		target : '#advanced_mortgage_calc_result'
	};
	
	jQuery('#advanced_mortgage_calc').validate({
		rules: {
			advanced_mortgage_calc_rate: {
				required: true,
				max: 30
			}
		},
		submitHandler: function(form) {
			console.log(form);
			jQuery('#advanced_mortgage_calc').ajaxSubmit(advanced_mortgage_calc_options_free);
		}
		
	});
});