$(function() {

	// Enable the plan/promote tabs
	$("#tab-plan-btn").click(function() {
		$("#tab-plan").show();
		$("#tab-promote").hide();
		
		$("#tab-plan-btn").addClass("btn-inverse");
		$("#tab-promote-btn").removeClass("btn-inverse");
	});
	
	$("#tab-promote-btn").click(function() {
		$("#tab-plan").hide();
		$("#tab-promote").show();
		
		$("#tab-plan-btn").removeClass("btn-inverse");
		$("#tab-promote-btn").addClass("btn-inverse");
	});
	
	var sideLocked = true;
	$(window).bind('scroll', function(){
	    var $nav = $('#navbar-top');
	    if(sideLocked && ($(window).scrollTop() > ($nav.offset().top+$nav.height()))) {
	    	sideLocked = false;
	        //console.log('out');
	        
	    } else if(!sideLocked && ($(window).scrollTop() < ($nav.offset().top+$nav.height()))) {
	    	sideLocked = true;
	    	//console.log('in');
	    }
	});


});