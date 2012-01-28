$(document).ready(function(){
	$(".trigger").click(function(){
		$(".panel").toggle("fast");
		$(".panel2").hide();
		$(".panel3").hide();
		$(this).toggleClass("active");
		return false;
	});
	
	$(".trigger2").click(function(){
		$(".panel2").toggle("fast");
		$(".panel3").hide();
		$(".panel").hide();
		$(this).toggleClass("active");
		return false;
	});
	
	$(".trigger3").click(function(){
		$(".panel3").toggle("fast");
		$(".panel2").hide();
		$(".panel").hide();
		$(this).toggleClass("active");
		return false;
	});
});
