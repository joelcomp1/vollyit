$(function(){
		$("#search-text").animate({"width":"229px"});
		$("#results").fadeOut();
		$.ajax({
			type:"GET",
			data: $(this).serialize(),
			url: "populate-program-page.php",
			success: function(msg)
				{
				$("#results").html(msg);
				$("#results").fadeIn();
				}
		});


});	