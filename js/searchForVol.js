function lookup(inputString) {
		if(inputString.length == 0) {
			// Hide the suggestion box.
			$('#suggestions').hide();
		} else {
			$.post("search-program-org-name.php", {queryString: ""+inputString+""}, function(data){
				if(data.length >0) {
					$('#suggestions').show();
					$('#autoSuggestionsList').html(data);
				}
			});
		}
	} // lookup
	
	function fill(thisValue) {
		$('#inputString').val(thisValue);
		setTimeout("$('#suggestions').hide();", 200);
	}
	
	function lookupTags(inputString2) {
		if(inputString2.length == 0) {
			// Hide the suggestion box.
			$('#suggestions2').hide();
		} else {
			$.post("search-keywords-tags.php", {queryString: ""+inputString2+""}, function(data1){
				if(data1.length >0) {
					$('#suggestions2').show();
					$('#autoSuggestionsList2').html(data1);
				}
			});
		}
	} // lookup
	
	function fillTags(thisValue2) {
		$('#inputString2').val(thisValue2);
		setTimeout("$('#suggestions2').hide();", 200);
	}
	
	function lookupLocation(inputString3) {
		if(inputString3.length == 0) {
			// Hide the suggestion box.
			$('#suggestions3').hide();
		} else {
			$.post("search-city-state.php", {queryString: ""+inputString3+""}, function(data2){
				if(data2.length >0) {
					$('#suggestions3').show();
					$('#autoSuggestionsList3').html(data2);
				}
			});
		}
	} // lookup
	
	function fillLocation(thisValue3) {
		$('#inputString3').val(thisValue3);
		setTimeout("$('#suggestions3').hide();", 200);
	}
	
$(function(){
	$("form#search-form").submit(function(){
		$.ajax({
			type:"GET",
			data: $(this).serialize(),
			url: "search.php",
			success: function(msg)
				{
				$("#results").html(msg);
				$("#results").fadeIn();
				}
		});
	return false;
	});
	
});	