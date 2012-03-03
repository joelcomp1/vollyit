$(document).ready(function(){


    $(".slidingDiv").hide();
	$(".slidingDiv2").hide();
    $(".show_hide").show();
	$(".wrapLanding").show();
	$(".learnAboutVolly").show();
	$(".slidingDiv3").hide();
	$(".slidingDiv4").hide();
	$(".slidingDiv5").hide();
	$(".slidingDiv6").hide();
	$(".homepageOrg").show();
	


	if(plan == "free" || planSaved == "free" ||
	plan == "supreme" || planSaved == "supreme" || 
	plan == "pro" || planSaved == "pro") //if a plan was picked, go back to create org and set the plan 
	{
		$(".slidingDiv5").slideToggle();
		$(".wrapLanding").hide();
		$(".learnAboutVolly").hide();
		$(".slidingDiv3").show();
	}
	else if(volerror == "true")  //we had a volunteer error, go back to page and fill in fields if we can
	{
		$(".slidingDiv6").slideToggle();
		$(".slidingDiv5").hide();
		$(".wrapLanding").hide();
		$(".learnAboutVolly").hide();
		$(".slidingDiv3").show();
	}
	else if(orgerror == "true") //we had a org error, go back to page and fill in fields if we can
	{
		$(".slidingDiv5").slideToggle();
		$(".slidingDiv6").hide();
		$(".wrapLanding").hide();
		$(".learnAboutVolly").hide();
		$(".slidingDiv3").show();
	}
	
	$('.show_hide').click(function(){
	
	if((!$('.wrapLanding').is(':visible')) && ($('.slidingDiv2').is(':visible'))) //the about volly it is visable
	{
		$(".slidingDiv2").slideToggle(); //slide out the about volly it and bring in the login info
		$(".slidingDiv").slideToggle();
	}
	else if ($('.wrapLanding').is(':visible')) {
		$(".slidingDiv").slideToggle();
		$(".slidingDiv3").show();
		$(".wrapLanding").hide();
		$(".learnAboutVolly").hide();
	}
	else
	{
		$(".slidingDiv").slideToggle();
		$(".wrapLanding").show();
		$(".learnAboutVolly").show();
	}
	});
	
	$('.learnAboutVolly').click(function(){
		$(".slidingDiv2").slideToggle();
		$(".slidingDiv3").show();
		$(".wrapLanding").hide();
		$(".learnAboutVolly").hide();
	});
	
	$('.slidingDiv3').click(function(){
	if((!$('.wrapLanding').is(':visible')) && ($('.slidingDiv2').is(':visible')))
	{
		$(".slidingDiv2").slideToggle();
		$(".wrapLanding").show();
		$(".slidingDiv3").hide();
		$(".learnAboutVolly").show();

	}
	else if ($('.wrapLanding').is(':visible')) {
		$(".slidingDiv").slideToggle();
		$(".slidingDiv3").show();
		$(".wrapLanding").hide();
		$(".learnAboutVolly").hide();
	}
	else if((!$('.wrapLanding').is(':visible')) && ($('.slidingDiv5').is(':visible'))) //Click home and the Org Create account page is active
	{
		$(".wrapLanding").show(); //show the login button
		$(".slidingDiv5").slideToggle(); //slide out the org create content
		$(".slidingDiv3").hide(); //hide the home button
		$(".learnAboutVolly").show(); //bring back the learn about volly it
	}
	else if((!$('.wrapLanding').is(':visible')) && ($('.slidingDiv6').is(':visible'))) //Click home and the Org Create account page is active
	{
		$(".wrapLanding").show(); //show the login button
		$(".slidingDiv6").slideToggle(); //slide out the org create content
		$(".slidingDiv3").hide(); //hide the home button
		$(".learnAboutVolly").show(); //bring back the learn about volly it
	}
	else
	{
		$(".slidingDiv").slideToggle();
		$(".wrapLanding").show();
		$(".learnAboutVolly").show();
		$(".slidingDiv3").hide();
	}
	});
	
	
	$('.homepageOrg').click(function(){
	if ($('.wrapLanding').is(':visible')) {
	
		$(".slidingDiv5").slideToggle();
		$(".wrapLanding").hide();
		$(".learnAboutVolly").hide();
		$(".slidingDiv3").show();
	}});
	
	$('.homepageVol').click(function(){
	if ($('.wrapLanding').is(':visible')) {
	
		$(".slidingDiv6").slideToggle();
		$(".wrapLanding").hide();
		$(".learnAboutVolly").hide();
		$(".slidingDiv3").show();
	}});
	
});