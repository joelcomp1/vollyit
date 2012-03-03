
$(function(){

		$.ajax({
			type:"GET",
			data: $(this).serialize(),
			url: "populate-vol-page-programs.php",
			success: function(msg)
				{
				$("#results5").html(msg);
	
				}
		});
	
		$.ajax({
			type:"GET",
			data: $(this).serialize(),
			url: "friends-accepted.php",
			success: function(msg)
				{
				$("#results").html(msg);
	
				}
		});
		
	
		$.ajax({
			type:"GET",
			data: $(this).serialize(),
			url: "org-accepted.php",
			success: function(msg)
				{
				$("#results2").html(msg);
	
				}
		});
		
		$.ajax({
			type:"GET",
			data: $(this).serialize(),
			url: "org-accepted-fulllist.php",
			success: function(msg)
				{
				$("#results3").html(msg);
	
				}
		});
		
		$.ajax({
			type:"GET",
			data: $(this).serialize(),
			url: "friends-accepted-fulllist.php",
			success: function(msg)
				{
				$("#results4").html(msg);
	
				}
		});
		
		
		
		$.ajax({
			type:"GET",
			data: $(this).serialize(),
			url: "populate-vol-upcoming-programs.php",
			success: function(msg)
				{
				$("#results6").html(msg);
				
				}
		});
		
		$.ajax({
			type:"GET",
			data: $(this).serialize(),
			url: "populate-vol-past-programs.php",
			success: function(msg)
				{
				$("#results7").html(msg);
				
				}
		});
		
});	