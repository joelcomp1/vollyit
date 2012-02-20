$(document).ready(function(){
	$(".trigger").click(function(){
		$(".panel").toggle("fast");
		$(".panel2").hide();
		$(".panel3").hide();
		$(".searchPanel").hide();
		$("#navlist3").hide();
		$("#navlist4").hide();
		$("#navlist5").hide();
		$(this).toggleClass("active");
		return false;
	});
	
	$(".trigger2").click(function(){
		$(".panel2").toggle("fast");
		$(".panel3").hide();
		$(".panel").hide();
		$(".searchPanel").hide();
		$("#navlist3").hide();
		$("#navlist5").hide();
		var item = document.createElement("li");
		item.setAttribute("class", "active");
	
		$(this).toggleClass("active");
		return false;
	});
	
	$(".trigger3").click(function(){
		$(".panel3").toggle("fast");
		$(".panel2").hide();
		$(".searchPanel").hide();
		$(".panel").hide();
		$("#navlist4").hide();
		$("#navlist5").hide();
		$(this).toggleClass("active");
		return false;
	});
	
	$(".triggerSearch").click(function(){
		$(".searchPanel").toggle("fast");
		$(".panel").hide();
		$(".panel2").hide();
		$(".panel3").hide();
		$("#navlist4").hide();
		$("#navlist3").hide();
		$(this).toggleClass("active");
		return false;
	});
});
