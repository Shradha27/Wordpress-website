jQuery(document).ready(function($) {
	
	$("#calculateDebt").bind('click submit', function() {
		calculate(this.form);
		return false;
	});

		
	/* 
	This script and many more are available free online at 
	The JavaScript Source!! http://javascript.internet.com
	Created by: Chris Crenshaw | http://www.creditcarddebtnegotiation.org/ 
	Updated by: Katz Web Services, Inc. | http://www.katzwebservices.com
	*/


	// validation function
	function isValid(entry, a, b) {
	  if (isNaN(entry.value) || (entry.value==null) || (entry.value=="")) {
	  	//alert("Invalid entry. Your min payment should be between " + a + " and " + b + ".")
		entry.focus()
	  entry.select()
		return false
	  }
		return true
	}
	
	// clear results fields when input values changed
	function clearCalcs(form) {
		form.num_months.value = ""
		form.total_pay.value = ""
		form.total_int.value = ""
	}
	
	function calculate(form) {
	// send entries to validation function
	// exit if not valid
		if (!isValid(form.balance, 0, 100000)) {  
			return false
		} else if (!isValid(form.debt_interest, 0, 30)) {  
			return false
		} else {         
			var init_bal = eval(form.balance.value);
		}
		if (!isValid(form.mnth_pay, init_bal*.02, init_bal)) {
			return false
	  } else {
		// variables used in calculation
		var cur_bal = init_bal;		// used in loop
		var interest = eval(form.debt_interest.value/100);
		var mnth_pay = eval(form.mnth_pay.value);
		var fin_chg = 0;			// finance charge
		var num_mnths = 0;
		var tot_int = 0;
	  }
		
	  while (cur_bal > 0) {
	    fin_chg = cur_bal*interest/12;
	    cur_bal = cur_bal - mnth_pay + fin_chg;
	    num_mnths++;
		if (num_mnths > 1200) {
	    	$('.debtCalculator .errors').html("<div class='debt_error'><p>Based on the Current Monthly Payment you have entered, it will take <strong>over 100 years</strong> to pay off the debt you entered. As a calculator, I simply cannot fathom this. <label for=\"mnth_pay\">Please revise your monthly payment</label>.</p>" );
	    	form.mnth_pay.focus()
			form.mnth_pay.select()
			return
	    } else if (num_mnths > 1000) {
	      	$('.debtCalculator .errors').html("<div class='debt_error'><p>Based on the Current Monthly Payment you have entered, it will take longer to pay off your debt than the average life expectancy.</p></div>" );
	    } else {
	    	$('.debtCalculator .errors').text('');
	    }
	    tot_int += fin_chg;
	  }
		
	// display result
		form.num_months.value = num_mnths;
		form.num_years.value = Math.round(num_mnths/12);
		form.total_pay.value = asMoney(round(init_bal + tot_int));
		form.total_int.value = asMoney(round(tot_int));
	   }
	
	// round to 2 decimal places
	function round(x) {
		return Math.round(x*100)/100;
	}

});

function asMoney(a, b) {
        b = {
            cpos: true,
            currency: "$",
            precision: 2,
            decimals: ".",
            thousands: ","
        }
    a = formatNumber(a, b);
    if (b.cpos) {
        return b.currency + a
    }
    return a + b.currency
}

var asNumber = function (a) {
    if (!a) {
        a = 0
    }
    a = a.toString().replace(new RegExp(/[^0-9\.\,]/g), "");
    if (isNaN(new Number(a))) {
        a = a.replace(new RegExp(/\./g), "").replace(new RegExp(/\,/), ".")
    }
    return new Number(a)
};

function formatNumber(b, e) {
    if (!e) {
        e = {
            precision: 2,
            decimals: ".",
            thousands: ","
        }
    }
    b = asNumber(b);
    var f = b.toFixed(e.precision).toString().split(".");
    var b = "";
    if (e.indian) {
        var c = f[0].slice(0, -3);
        b = f[0].slice(-3, f[0].length) + ((b.length > 0) ? e.thousands + b : b);
        for (var a = 0; a < (c.length / 2); a++) {
            b = c.slice(-2 * (a + 1), c.length + (-2 * a)) + ((b.length > 0) ? e.thousands + b : b)
        }
    } else {
        for (var a = 0; a < (f[0].length / 3); a++) {
            b = f[0].slice(-3 * (a + 1), f[0].length + (-3 * a)) + ((b.length > 0) ? e.thousands + b : b)
        }
    }
    if (e.precision > 0) {
        b += e.decimals + f[1]
    }
    return b
}

