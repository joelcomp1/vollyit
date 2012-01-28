						
$(function(){
		//$("#search-form").hide();
		$("#search-text").animate({"width":"229px"});
		$("#results").fadeOut();
		$.ajax({
			type:"GET",
			data: $(this).serialize(),
			url: "search-website-query.php",
			success: function(msg)
				{
				$("#results").html(msg);
				$("#results").fadeIn();
				}
		});
	return false;
});	