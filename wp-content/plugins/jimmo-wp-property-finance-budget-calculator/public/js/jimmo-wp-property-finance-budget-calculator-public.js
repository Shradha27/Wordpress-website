(function( $ ) {
	'use strict';

	/**
	 * Define global variables for configuration.
	 * 
	 * @since	1.0.0
	 */
	var CONTAINER_CLASS = '.jl-budget-widget';
	var STATUSBAR_CLASS = '.jl-statusbar-progress';
	var STATUSBAR_TEXT_CLASS = '.jl-step';
	var BUTTON_BACK_CLASS = '.back';
	var ERROR_CLASS_NAME = 'error';
	var BUTTON_CONTINUE_CLASS = '.continue';
	var BUTTON_SHOW_SCHEDULE = ".show-ammortization-schedule";
	var RENTAL_INCOME_CONTAINER_CLASS = '.rental-income-entry';
	var LOADING_ANIMATION_CONTAINER_CLASS = '.sk-fading-circle';
	var DISCLAIMER_CLASS = '.disclaimer';
	var SCHEDULE_CONTAINER = '.ammortization-plan';
	var SCHEDULE_TABLE_BODY_CONTAINER = '.ammortization-plan-data';
	var SCHEDULE_TABLE_FIELDS = [
		'liabilities',
		'mortgage',
		'payment',
		'redemption',
		'interest',
		'total_interest'
	];
	var INPUT_FIELDS = [
		{ propName: 'baseAmount',          domElement: '.base-amount',          optional: false },
		{ propName: 'administrationCosts', domElement: '.administration-costs', optional: false },
		{ propName: 'rentalIncome',        domElement: '.rental-income',        optional: true },
		{ propName: 'percentageRate',      domElement: '.percentage-rate',      optional: false },
		{ propName: 'repaymentRate',       domElement: '.repayment-rate',       optional: false },
		{ propName: 'equity',              domElement: '.equity',               optional: true },
		{ propName: 'brokerageCosts',      domElement: '.brokerage-costs',      optional: true },
		{ propName: 'notaryFees',          domElement: '.notary-fees',          optional: true },
		{ propName: 'transferTax',         domElement: '.transfer-tax',         optional: true }
	];
	var OUTPUT_FIELDS = [
		{ propName: 'realAmount',         domElement: '.real-amount' },
		{ propName: 'possibleInvestment', domElement: '.possible-investment' },
		{ propName: 'finalPrice',         domElement: '.final-price' }
	];
	var DATE_SELECTOR_FIELDS = {
		month: '.ammortization-start-month',
		year: '.ammortization-start-year'
	};
	var LOCALE_FIELD = '.jwb-locale';
	var FORM_PAGES = [
		{ name: 'financial-situation', percentage: 25 },
		{ name: 'loan-data',           percentage: 50 },
		{ name: 'cost-of-purchasing',  percentage: 75 },
		{ name: 'available-budget',    percentage: 90 }
	];


	/**
	 * Form Init Manager Module.
	 * 
	 * @since	1.0.0
	 */
	var FormInitManager = ( function() {

		/**
		 * Initialize form date selectors.
		 * 
		 * @since	1.0.0
		 */
		function publicInitForm() {
			var currentDate = new Date();
			var currentYear = currentDate.getFullYear();
			var nextMonth = currentDate.getMonth() + 2;
			
			// Add Next 20 years as options
			for ( var year = currentYear; year < currentYear + 20; year++ ) {
				$( CONTAINER_CLASS + ' ' + DATE_SELECTOR_FIELDS.year ).append( '<option value="' + year + '">' + year + '</option>' );
			}

			// Initialize Month selector with next month
			if (nextMonth >= 13) {
				nextMonth -= 12;
				$( CONTAINER_CLASS + ' ' + DATE_SELECTOR_FIELDS.year ).val( currentYear + 1 );
			}
			$( CONTAINER_CLASS + ' ' + DATE_SELECTOR_FIELDS.month ).val( nextMonth );
		}

		/**
		 * 
		 * 
		 * @since	1.0.0
		 */
		return {
			initForm: publicInitForm
		}
	})();

	/**
	 * Event Manager Module.
	 * 
	 * @since	1.0.0
	 */
	var eventManager = ( function() {

		/**
		 * Hold value of delay timer for form change events.
		 * 
		 * @since	1.0.0
		 */
		var formChangeEventDelayTimer;

		/**
		 * Handle all Button Click Events
		 * 
		 * @param {any} e 
		 */
		function buttonEventHandler( e ) {
			if ( e.hasClass( BUTTON_BACK_CLASS.replace( '.', '' ) ) || e.hasClass( BUTTON_CONTINUE_CLASS.replace( '.', '' ) ) ) {
				formStateManager.changePage( e );
			} else if ( e.hasClass( BUTTON_SHOW_SCHEDULE.replace( '.', '' ) ) ) {
				ammortizationScheduleManager.showAmmortizationSchedule( e )
			}
		}

		/**
		 * Handle all Form Change Events when input values change.
		 * 
		 * @param {any} e 
		 */
		function formChangeEventHandler( e ) {
			clearTimeout( formChangeEventDelayTimer );
			formChangeEventDelayTimer = setTimeout(function() {
				formDataManager.processFormData( e );
			}, 500);
		}
		
		/**
		 * Initialize all event handlers.
		 * 
		 */
		function publicInitEvents() {
			
			// Button Events
			$( CONTAINER_CLASS + ' input[type="button"]' ).click( function() {
				buttonEventHandler( $( this ) );
			} );
			// Rented Out Checkbox Event
			$( '.rented-out' ).change(function() {
				formStateManager.toggleRentedOut( $( this ) );
			} );

			// Form Value Change Event
			$( CONTAINER_CLASS + ' input[type="text"]' ).keyup( function() {
				formChangeEventHandler( $(this) );
			} );

			// Table row Click Event
			$( CONTAINER_CLASS + ' ' + SCHEDULE_CONTAINER ).on( 'click', '.year', function() {
				ammortizationScheduleManager.toggleYearRow( $( this ) );
			});
		}

		/**
		 * Expose public functions.
		 */
		return {
			initEvents: publicInitEvents
		}
	})();

	/**
	 * DOM Manager Module.
	 * 
	 * @since	1.0.0
	 */
	var domManager = ( function() {

		/**
		 * Find container element of element.
		 * 
		 * @param {any} e 
		 * @returns {any}
		 */
		function findContainer( e ) {
			var container = e.closest( CONTAINER_CLASS );
			return container;
		}

		/**
		 * Find element inside of container.
		 * 
		 * @param {any} container 
		 * @param {any} element 
		 * @returns {any}
		 */
		function findElement ( container, element ) {
			var element = container.find( element );
			return element;
		}

		/**
		 * Get element inside the same container.
		 * 
		 * @param {any} e 
		 * @param {any} target 
		 * @returns {any}
		 */
		function publicGetElement( e, target ) {
			var container = findContainer( e );
			var element = findElement ( container, target );
			return element;
		}

		/**
		 * Find Dield DOM Element by given property name.
		 * 
		 * @param {any} prop 
		 * @returns  {any} 
		 */
		function publicFindFieldDomElementByPropName( prop ) {
			var fields = INPUT_FIELDS.concat(OUTPUT_FIELDS);
			var domElement = fields.filter( function( field ) {
				return prop == field.propName;
			} );
			
			return domElement[0].domElement;
		}
		
		/**
		 * Expose public functions.
		 */
		return {
			getElement: publicGetElement,
			findFieldDomElementByPropName: publicFindFieldDomElementByPropName
		}
	})();

	/**
	 * Status Bar Manager Module.
	 * 
	 * @since	1.0.0
	 */
	var statusBarManager = ( function() {

		/**
		 * Set Progress Bar to given value and width
		 * 
		 * @param {any} e 
		 * @param {any} progress 
		 */
		function publicSetProgress( e, progress ) {
			var statusBar = domManager.getElement( e, STATUSBAR_CLASS );
			var statusBarText = domManager.getElement( e, STATUSBAR_TEXT_CLASS );
			
			statusBarText.html( progress );
			statusBar.innerWidth( progress + "%" );
		}

		/**
		 * Ecpose public functions.
		 */
		return {
			setProgress: publicSetProgress
		}
	})();

	/**
	 * Form State Manager Module.
	 * 
	 * @since	1.0.0
	 */
	var formStateManager = ( function() {

		/**
		 * Slide up current page, slide down new page.
		 * 
		 * @param {any} e 
		 * @param {any} currentPage 
		 * @param {any} newPage 
		 */
		function switchPage( e, currentPage, newPage ) {
			domManager.getElement( e, '.' + FORM_PAGES[ currentPage ]['name'] ).slideUp( 500 );
			domManager.getElement( e, '.' + FORM_PAGES[ newPage ]['name'] ).slideDown( 500 );
			statusBarManager.setProgress( e, FORM_PAGES[ newPage ]['percentage'] );
			if (3 === currentPage) {
				domManager.getElement( e, SCHEDULE_CONTAINER ).slideUp( 500 );
			}
		}
		
		/**
		 * Change Page when a button is clicked.
		 * 
		 * @param {any} e 
		 */
		function publicChangePage( e ) {
			var operation, currentPage, newPage;

			// Detect operation (continue or back).
			if ( e.hasClass( BUTTON_BACK_CLASS.replace( '.', '' ) ) ) {
				operation = BUTTON_BACK_CLASS.replace( '.', '' );
			} else {
				operation = BUTTON_CONTINUE_CLASS.replace( '.', '' );
			}

			// Find current page id
			FORM_PAGES.forEach( function( page, index ) {
				if ( e.hasClass( operation + '-' + page.name ) ) {
					currentPage = index;
				}
			} );

			// Find new page id
			if ( BUTTON_BACK_CLASS.replace( '.', '' ) === operation ) {
				newPage = currentPage - 1;
			} else {
				newPage = currentPage + 1;
			}

			// switch page
			switchPage( e, currentPage, newPage );
		}

		/**
		 * Toggle rented out section on checkbox change
		 * 
		 * @param {any} e 
		 */
		function publicToggleRentedOut( e ) {
				if ( e.prop( 'checked' ) ) {
					domManager.getElement( e, RENTAL_INCOME_CONTAINER_CLASS ).slideDown( 500 );
				} else {
					domManager.getElement( e, domManager.findFieldDomElementByPropName( 'rentalIncome' ) ).val( null );  
					domManager.getElement( e, RENTAL_INCOME_CONTAINER_CLASS ).slideUp( 500 );
					formDataManager.processFormData( e );
				}
		}

		/**
		 * Read form input values into object.
		 * 
		 * @param {any} e 
		 * @returns {any}
		 */
		function publicGetFormValues( e ) {
			var FormValues = {};
			INPUT_FIELDS.forEach( function( field ) {
				FormValues[ field.propName ] = domManager.getElement( e, field.domElement ).val().replace( ',', '.' ) ;
			} );
			return FormValues;
		}

		/**
		 * Write calculated results to form fields
		 * 
		 * @param {any} e 
		 * @param {any} resultValues 
		 * @param {any} inputValues 
		 */
		function publicWriteResults( e, resultValues, inputValues ) {
			OUTPUT_FIELDS.forEach( function( field ) {
				if ( ! isNaN( resultValues[field.propName] ) ) {
					domManager.getElement( e, field.domElement ).val( resultValues[ field.propName ] );
					if ( resultValues[field.propName] <= 0 ) {
						domManager.getElement( e, field.domElement ).addClass( ERROR_CLASS_NAME );
					} else {
						domManager.getElement( e, field.domElement ).removeClass( ERROR_CLASS_NAME );
					}
				} else {
					domManager.getElement( e, field.domElement ).val( '' );
					domManager.getElement( e, field.domElement ).removeClass( ERROR_CLASS_NAME );
				}
				
			} );

			setButtonStates( e, resultValues, inputValues );
		}

		/**
		 * Check for invalid form values, set class error on invalid values.
		 * 
		 * @param {any} e 
		 * @param {any} inputValues 
		 * @returns {any} 
		 */
		function publicSetInputErrorState(e, inputValues ) {
			INPUT_FIELDS.forEach( function( field ) {
				if ( inputValues[field.propName] != '' && isNaN( inputValues[field.propName] ) ) {
					domManager.getElement( e, field.domElement ).addClass( ERROR_CLASS_NAME );
					inputValues[field.propName] = NaN;
				} else {
					domManager.getElement( e, field.domElement ).removeClass( ERROR_CLASS_NAME );
				}
			} );
			return inputValues;
		}

		/**
		 * Set State of continue buttons according to form state.
		 * 
		 * @param {any} e 
		 * @param {any} resultValues 
		 * @param {any} inputValues 
		 */
		function setButtonStates( e, resultValues, inputValues ) {
			
			if ( 
				'' === domManager.getElement( e, domManager.findFieldDomElementByPropName( 'realAmount' ) ).val() ||
				domManager.getElement( e, domManager.findFieldDomElementByPropName( 'realAmount' ) ).val() <= 0
			) { 
				domManager.getElement( e, BUTTON_CONTINUE_CLASS + '-' + FORM_PAGES[0].name  ).attr( 'disabled', true );
			} else {
				domManager.getElement( e, BUTTON_CONTINUE_CLASS + '-' + FORM_PAGES[0].name  ).attr( 'disabled', false );
			}

			// TODO: Don't overwrite 
			if ( 
				'' == domManager.getElement( e, domManager.findFieldDomElementByPropName( 'possibleInvestment' ) ).val() ||
				domManager.getElement( e, domManager.findFieldDomElementByPropName( 'equity' ) ).val() < 0 
			) {
				domManager.getElement( e, BUTTON_CONTINUE_CLASS + '-' + FORM_PAGES[1].name ).attr( 'disabled', true );
				if ( domManager.getElement( e, domManager.findFieldDomElementByPropName( 'equity' ) ).val() < 0 ) {
					domManager.getElement( e, domManager.findFieldDomElementByPropName( 'equity' ) ).addClass( ERROR_CLASS_NAME );
				}
			} else {
				domManager.getElement( e, BUTTON_CONTINUE_CLASS + '-' + FORM_PAGES[1].name ).attr( 'disabled', false );
			}
			
			if ( 
				isNaN( inputValues.brokerageCosts ) || 
				isNaN( inputValues.notaryFees ) || 
				isNaN( inputValues.transferTax )
			) {
				domManager.getElement( e, BUTTON_CONTINUE_CLASS + '-' + FORM_PAGES[2].name ).attr( 'disabled', true );
			} else {
				domManager.getElement( e, BUTTON_CONTINUE_CLASS + '-' + FORM_PAGES[2].name ).attr( 'disabled', false );
			}
		}

		/**
		 * Expose public functions
		 */
		return {
			changePage: publicChangePage,
			toggleRentedOut: publicToggleRentedOut,
			getFormValues: publicGetFormValues,
			writeResults: publicWriteResults,
			setInputErrorState: publicSetInputErrorState
		}
	})();

	/**
	 * Process data in the form.
	 * 
	 * @since	1.0.0
	 */
	 var formDataManager = ( function() {
		
		/**
		 * Stores form input values
		 */
		var inputValues;
		
		/**
		 * Set optional values to 0 if missing.
		 * 
		 * @param {any} e 
		 */
		function setOptionalFields( e ) {
			INPUT_FIELDS.forEach( function( field ) {
				if ( field.optional  && '' === inputValues[field.propName] ) {
					inputValues[field.propName] = 0;
				}
			} );
		}

		/**
		 * Calculate results according to values entered in the form.
		 * 
		 * @param {any} e 
		 * @returns 
		 */
		function calculateOutputValues( e ) {
			var outputValues = {};
			outputValues.realAmount = parseFloat( parseFloat( inputValues.baseAmount ) - parseFloat( inputValues.administrationCosts ) +
				parseFloat( inputValues.rentalIncome ) ).toFixed( 2 );
			outputValues.possibleInvestment = parseFloat( parseFloat( outputValues.realAmount ) * 12 / ( parseFloat( inputValues.percentageRate ) /
			100 + parseFloat( inputValues.repaymentRate ) / 100 ) + parseFloat( inputValues.equity ) ).toFixed( 2 );
			var costPercentage = parseFloat( ( 100 + parseFloat( inputValues.brokerageCosts ) + parseFloat( inputValues.notaryFees ) +
				parseFloat( inputValues.transferTax ) ) / 100 ).toFixed( 2 );
			outputValues.finalPrice = parseFloat( parseFloat( outputValues.possibleInvestment ) / parseFloat( costPercentage ) ).toFixed( 2 );

			return outputValues;
		}

		/**
		 * Process input values of the form on every change.
		 * 
		 * @param {any} e 
		 */
		function publicProcessFormData( e ) {
			inputValues = formStateManager.getFormValues( e );
			inputValues = formStateManager.setInputErrorState( e, inputValues );
			setOptionalFields( e );
			var outputValues = calculateOutputValues( e );
			formStateManager.writeResults( e, outputValues, inputValues );
			inputValues = undefined;
		}

		/**
		 * Expose public functions
		 */
		return {
			processFormData: publicProcessFormData
		}

	 })();

	 /**
	  * Loading Animation Manager Module.
	 * 
	 * @since	1.0.0
	  */
	 var loadingAnimationManager = ( function() {

		/**
		 * Show loading animation.
		 * 
		 * @param {any} e 
		 */
		function publicShowLoadingAnimation( e ) {
			domManager.getElement(e, LOADING_ANIMATION_CONTAINER_CLASS ).slideDown(100);
		}

		/**
		 * Hide loading animation.
		 * 
		 * @param {any} e 
		 */
		function publicHideLoadinganimation( e ) {
			domManager.getElement(e, LOADING_ANIMATION_CONTAINER_CLASS ).slideUp(100);
		}

		/**
		 * Expose public functions.
		 */
		 return {
			 showLoadingAnimation: publicShowLoadingAnimation,
			 hideLoadingAnimation: publicHideLoadinganimation
		 }
	 } )();

	 /**
	  * Ammortization Schedule Manager Module.
	 * 
	 * @since	1.0.0
	  */
	 var ammortizationScheduleManager = ( function() {

		/**
		 * Get all form values (input and calculated).
		 * 
		 * @param {any} e 
		 * @returns {any} 
		 */
		function getCreditData( e ) {
			// Create array of all form fields, empty object for credit data
			var formFields = INPUT_FIELDS.concat( OUTPUT_FIELDS ), creditData = {};
			
			// Read credit data from form
			formFields.forEach( function( field ) {
				creditData[ field.propName ] = parseFloat( domManager.getElement( e, field.domElement ).val().replace( ',', '.' ) ).toFixed( 2 );
			} );

			// read start date from select elements
			creditData.startDate = {
				'startMonth': domManager.getElement( e, DATE_SELECTOR_FIELDS.month ).val(),
				'startYear': domManager.getElement( e, DATE_SELECTOR_FIELDS.year ).val()
			}

			creditData.locale = domManager.getElement( e, LOCALE_FIELD ).val();

			return creditData;
		}

		/**
		 * Get data for ammortization schedule from server.
		 * 
		 * @param {any} e 
		 * @param {any} creditData 
		 * @returns {promise}
		 */
		function getAmmortizationScheduleData( e, creditData ) {
			var plan = $.post( 
				jimmo_wp_property_finance_budget_calculator_ajax_obj.ajax_url, {
					_ajax_nonce: jimmo_wp_property_finance_budget_calculator_ajax_obj.nonce,
					action: 'calculate_ammortization_schedule',
					creditData: creditData				
				}
			);

			return plan;
			
		}

		/**
		 * Retrieve schedule data and render it into table element.
		 * 
		 * @param {any} e 
		 */
		function publicShowAmmortizationSchedule( e ) {
			var creditData = getCreditData( e );

			loadingAnimationManager.showLoadingAnimation( e );

			var scheduleDataPromise = getAmmortizationScheduleData( e, creditData );
			scheduleDataPromise.success( function( scheduleData ) {
				
				// Delete table data if exists
				domManager.getElement( e, SCHEDULE_TABLE_BODY_CONTAINER ).empty();
				domManager.getElement( e, '.error' ).remove();

				// Render year rows
				$.each( scheduleData, function(index, valueYear) {
					var TableRowYear = '<tr class="year">';
					TableRowYear += '<td>' + valueYear.year + '</td>';

					SCHEDULE_TABLE_FIELDS.forEach( function( field ) {
						TableRowYear += '<td>' + valueYear[ field ] + '</td>';
					} );

					TableRowYear += '</tr>'
					domManager.getElement( e, SCHEDULE_TABLE_BODY_CONTAINER ).append( TableRowYear );

					// Render month rows
					$.each( valueYear.single_months, function(index, valueMonth) {
						var TableRowMonth = '<tr class="month">';
						TableRowMonth += '<td>' + valueMonth.month + '</td>';

						SCHEDULE_TABLE_FIELDS.forEach( function( field ) {
							TableRowMonth += '<td>' +  valueMonth[ field ] + '</td>';
						} );
						
						TableRowMonth += '</tr>'
						domManager.getElement( e, SCHEDULE_TABLE_BODY_CONTAINER ).append( TableRowMonth );
					} );

					// Show error if table was cut off
					if ( valueYear['error'] ) {
						var error = '<div class="error">';
						error += valueYear.error.message;
						error += '</div>';
						domManager.getElement( e, DISCLAIMER_CLASS ).after( error );
					}
				} );
				
				statusBarManager.setProgress( e, 100 );

				// Hide loading animation, show data table
				domManager.getElement( e, SCHEDULE_TABLE_BODY_CONTAINER + " tr.year" ).first().nextUntil( 'tr.year' ).show();
				loadingAnimationManager.hideLoadingAnimation( e );
				domManager.getElement( e, SCHEDULE_CONTAINER ).slideDown( 500 );
			} );

		}

		/**
		 * Toggle Month Rows on tr.year click event.
		 * 
		 * @param {any} e 
		 */
		function publicToggleYearRow( e ) {
			e.nextUntil( 'tr.year' ).toggle();
		}

		/**
		 * Expose public functions.
		 */
		return {
			showAmmortizationSchedule: publicShowAmmortizationSchedule,
			toggleYearRow: publicToggleYearRow
		}
	} )();
	
	$(window).load(function() {
		FormInitManager.initForm();
		eventManager.initEvents();
	});

})( jQuery );
