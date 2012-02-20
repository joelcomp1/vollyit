$(function(){

		$.ajax({
			type:"GET",
			data: $(this).serialize(),
			url: "populate-program-coords.php",
			success: function(msg)
				{
				$("#results").html(msg);
				$("#results").fadeIn();
				}
		});
});