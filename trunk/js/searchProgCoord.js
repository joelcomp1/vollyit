	function lookupTags(inputString2) {
		if(inputString2.length == 0) {
			// Hide the suggestion box.
			$('#suggestions2').hide();
		} else {
			$.post("search-program-coordinators.php", {queryString: ""+inputString2+""}, function(data1){
				if(data1.length >0) {
					$('#suggestions2').show();
					$('#autoSuggestionsList2').html(data1);
				}
			});
		}
	} // lookup
	var counterProgOrg = 1;
	function fillTags(thisValue2, image, login) {
	if(counterProgOrg == 10)
	{
		alert("Max value of 10 Program Coordinators reached");
	}
	else
	{
		$('#inputString2').val(thisValue2);
			var divNameChild = "progCoordTop" + counterProgOrg;
			var divNameinput = "progCoord" + counterProgOrg;
			var divName = "dynamicProgramCoords";
			var newdiv = document.createElement('div');
			newdiv.id = divNameChild;
			newdiv.name = divNameChild
			newdiv.style.display = "none";
			var comma = ',';	
			
			newdiv.innerHTML = "<img src='uploaded_files/" + image + "' alt='Volunteer Picture' width='50' height='50'><input id=" + divNameinput + " name=" + divNameinput + " value=" + login + " type='hidden'>"+ thisValue2 +"<a href='#' onClick='removeOrg(" + divName + comma + divNameChild +");'>Remove</a>";
			document.getElementById(divName).appendChild(newdiv);
			/document.getElementById("inputString2").value = "Start Typing Name";*/
			
		setTimeout("$('#suggestions2').hide();", 200);
		}
	}
	
function removeOrg(parentDiv, childDiv)
{
		  counterProgOrg--;
          parentDiv.removeChild(childDiv);
}


function unhideInput(){
	var divNameChild = "#progCoordTop" + counterProgOrg;
	$(divNameChild).show();
	counterProgOrg++;
	$('#inputString2').val("Start Typing Name");
	
}