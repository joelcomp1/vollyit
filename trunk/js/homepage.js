$(document).ready(function(){


    $(".slidingDiv").hide();
	$(".slidingDiv2").hide();
    $(".show_hide").show();
	$(".wrapLanding").show();
	$(".learnAboutVolly").show();
	$(".slidingDiv3").hide();
	$(".slidingDiv4").hide();
		

	$('.show_hide').click(function(){
	
	if((!$('.wrapLanding').is(':visible')) && ($('.slidingDiv2').is(':visible')))
	{
		$(".slidingDiv2").slideToggle();
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
	else
	{
		$(".slidingDiv").slideToggle();
		$(".wrapLanding").show();
		$(".learnAboutVolly").show();
		$(".slidingDiv3").hide();
	}
	});

});