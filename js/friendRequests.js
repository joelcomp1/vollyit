$(function(){

	
		$.ajax({
			type:"GET",
			data: $(this).serialize(),
			url: "friend-requests.php",
			success: function(msg)
				{
				$(".panel").html(msg);
	
				}
		});
});	
	