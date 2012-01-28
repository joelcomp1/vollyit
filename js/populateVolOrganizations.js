$(function(){
		
		
		$.ajax({
			type:"GET",
			data: $(this).serialize(),
			url: "populate-vol-organizations.php",
			success: function(msg)
				{
				$("#results").html(msg);
				}
		});

	});