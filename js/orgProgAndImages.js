
$(function(){

		$.ajax({
			type:"GET",
			data: $(this).serialize(),
			url: "populate-org-page.php",
			success: function(msg)
				{
				$("#results").html(msg);
				$("#results").fadeIn();
				}
		});
		
		
		$.ajax({
			type:"GET",
			data: $(this).serialize(),
			url: "populate-org-page-bottom.php",
			success: function(msg)
				{
				$("#results2").html(msg);
				$("#results2").fadeIn();
				}
		});
		
		$.ajax({
			type:"GET",
			data: $(this).serialize(),
			url: "populate-vol-images.php",
			success: function(msg)
			{
				$("#slider").html(msg);
				$('#slider').movingBoxes({
				startPanel   : 1,      // start with this panel
				wrap         : true,   // if true, the panel will "wrap" (it really rewinds/fast forwards) at the ends
				buildNav     : true,   // if true, navigation links will be added
				navFormatter : function(){ return "&#9679;"; } // function which returns the navigation text for each panel
				});
			}
		});
		
		
		$.ajax({
			type:"GET",
			data: $(this).serialize(),
			url: "populate-org-upcoming-programs.php",
			success: function(msg)
				{
				$("#results6").html(msg);
				
				}
		});
		
		$.ajax({
			type:"GET",
			data: $(this).serialize(),
			url: "populate-org-past-programs.php",
			success: function(msg)
				{
				$("#results7").html(msg);
				
				}
		});

		
		$.ajax({
			type:"GET",
			data: $(this).serialize(),
			url: "populate-org-volunteer-list.php",
			success: function(msg)
				{
				$("#results8").html(msg);
				
				}
		});
		
		
		$.ajax({
			type:"GET",
			data: $(this).serialize(),
			url: "populate-org-staff.php",
			success: function(msg)
				{
				$("#results9").html(msg);
				
				}
		});
				
		
		$.ajax({
			type:"GET",
			data: $(this).serialize(),
			url: "populate-org-staff-list.php",
			success: function(msg)
				{
				$("#results10").html(msg);
				
				}
		});
		
	});