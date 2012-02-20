$(function(){

	
		$.ajax({
			type:"GET",
			data: $(this).serialize(),
			url: "org-notifications.php",
			success: function(msg)
				{
				$(".panel3").html(msg);
	
				}
		});
});	
	