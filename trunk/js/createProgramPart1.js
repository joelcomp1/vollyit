function lookup(inputString) {
		if(inputString.length == 0) {
			// Hide the suggestion box.
			$('#suggestions').hide();
		} else {
			$.post("search-keywords-tags.php", {queryString: ""+inputString+""}, function(data){
				if(data.length >0) {
					$('#suggestions').show();
					$('#autoSuggestionsList').html(data);
				}
			});
		}
	} // lookup
	
	function fillTags(thisValue) {
		$('#inputString').val(thisValue);
		setTimeout("$('#suggestions').hide();", 200);
	}
	
		function lookupPrograms(inputString2) {
		if(inputString2.length == 0) {
			// Hide the suggestion box.
			$('#suggestions2').hide();
		} else {
			$.post("search-programs.php", {queryString: ""+inputString2+""}, function(data1){
				if(data1.length >0) {
					$('#suggestions2').show();
					$('#autoSuggestionsList2').html(data1);
				}
			});
		}
	} // lookup
	function fillPrograms2(thisValue4) {
		$('#inputString4').val(thisValue4);
		setTimeout("$('#suggestions4').hide();", 200);
	}
		function lookupPrograms2(inputString4) {
		if(inputString4.length == 0) {
			// Hide the suggestion box.
			$('#suggestions4').hide();
		} else {
			$.post("search-programs2.php", {queryString: ""+inputString4+""}, function(data4){
				if(data4.length >0) {
					$('#suggestions4').show();
					$('#autoSuggestionsList4').html(data4);
				}
			});
		}
	} // lookup
	
	function fillPrograms(thisValue2) {
		$('#inputString2').val(thisValue2);
		setTimeout("$('#suggestions2').hide();", 200);
	}
	
		function lookupOrgs(inputString3) {
		if(inputString3.length == 0) {
			// Hide the suggestion box.
			$('#suggestions3').hide();
		} else {
			$.post("search-orgs.php", {queryString: ""+inputString3+""}, function(data2){
				if(data2.length >0) {
					$('#suggestions3').show();
					$('#autoSuggestionsList3').html(data2);
				}
			});
		}
	} // lookup
	
	function fillOrgs(thisValue3) {
		$('#inputString3').val(thisValue3);
		setTimeout("$('#suggestions3').hide();", 200);
	}
	