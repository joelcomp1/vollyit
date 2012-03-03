$(function(){
		
		
		$.ajax({
			type:"GET",
			data: $(this).serialize(),
			url: "populate-vol-programs.php",
			success: function(msg)
				{
				$("#results").html(msg);
				}
		});

	});