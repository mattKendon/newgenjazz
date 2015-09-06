/*  Table of Contents 
01. MENU ACTIVATION
02. GALLERY JAVASCRIPT
03. FITVIDES RESPONSIVE VIDEOS
04. FIXED NAVIGATION BAR
05. JQUERY FILTER SCHEDULE
*/

jQuery(document).ready(function($) {
	 'use strict';
	 

/*
=============================================== 01. MENU ACTIVATION  ===============================================
*/
	jQuery("ul.sf-menu").supersubs({ 
	        minWidth:    2,   // minimum width of sub-menus in em units 
	        maxWidth:    20,   // maximum width of sub-menus in em units 
		extraWidth:  0     // extra width can ensure lines don't sometimes turn over 
	                           // due to slight rounding differences and font-family 
	    }).superfish({ 
			animation:  {opacity:'show'},
			animationOut:  {opacity:'hide'},
			speed:         200,           // speed of the opening animation. Equivalent to second parameter of jQuery’s .animate() method
			speedOut:      'normal',
			autoArrows:    true,               // if true, arrow mark-up generated automatically = cleaner source code at expense of initialisation performance 
			dropShadows:   false,               // completely disable drop shadows by setting this to false 
			delay:     400               // 1.2 second delay on mouseout 
		});

/*
=============================================== 02. GALLERY JAVASCRIPT  ===============================================
*/
    $('.gallery-progression').flexslider({
		animation: "fade",      
		slideDirection: "horizontal", 
		slideshow: false,         
		slideshowSpeed: 7000,  
		animationDuration: 200,        
		directionNav: true,             
		controlNav: true
    });


/*
=============================================== 03. FITVIDES RESPONSIVE VIDEOS  ===============================================
*/
	 $(".width-container").fitVids();
		 
/*
=============================================== 04. FIXED NAVIGATION BAR  ===============================================
*/
	 $('#fixed-nav-pro nav').scrollToFixed();


/*
=============================================== 05. JQUERY FILTER SCHEDULE  ===============================================
*/	 
	
	$("#schedule-content-progression").hide(0).delay(250).fadeIn(250)

 	$('#filterOptions-pro li a').click(function() {
 		// fetch the class of the clicked item
		
		var ourClass = $(this).attr('class');
		
 		// reset the active class on all the buttons
 		$('#filterOptions-pro li').removeClass('current-cat');
 		// update the active state on our clicked button
 		$(this).parent().addClass('current-cat');
		
		
		// hide all elements that don't share ourClass
		$('#schedule-content-progression').children('li:not(.' + ourClass + ')').fadeOut(250);
		// show all elements that do share ourClass
		$('#schedule-content-progression').children('li.' + ourClass).delay(250).fadeIn(250);
		
 		return false;
 	});

});