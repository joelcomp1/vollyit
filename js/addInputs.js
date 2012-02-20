var counter = 2;
var limit = 5;
var counter2 = 2;
var limit2 = 10;
var counter3 = 2;
var limit3 = 5;
var counter4 = 1;
var limit4 = 20;
var counter5 = 1;
var limit5 = 10;
function removeEmailOpen(parentDiv, childDiv , childDiv2)
{
          parentDiv.removeChild(childDiv);
		  parentDiv.removeChild(childDiv2);
}

function removeEmail(parentDiv, childDiv)
{
		  counter4--;
          parentDiv.removeChild(childDiv);
}

function removePosition(parentDiv, childDiv)
{
		  counter5--;
		  var secondChild = childDiv.name + 'open';
		  var secondParent = document.getElementById('resultsOpen');
          parentDiv.removeChild(childDiv);
		  
		  secondParent.removeChild(document.getElementById(secondChild));
}


function editPositions(parentDiv, childDiv, number)
{
		  counter5--;
		  document.getElementById('addPosButton').value = 'Edit Position';
		  var secondChild = childDiv.name + 'open';
		  var secondParent = document.getElementById('resultsOpen');
		  var positionNameGive = "positionNameGiven" + number;
		  var numPosGiven = "numPosGiven" + number;
		  var positionDescrip = "positionDescrip" + number;
		  document.getElementById("Field8").value = document.getElementById(positionNameGive).innerText;
		  document.getElementById("Field9").value = document.getElementById(positionDescrip).value;
		  document.getElementById("Field11").value = document.getElementById(numPosGiven).value;
		  
		  parentDiv.removeChild(childDiv);
		  
		  secondParent.removeChild(document.getElementById(secondChild));
}

function addInput(divName, value, value2, value3){
	if(divName == "dynamicInput")
	{
		if (counter == limit)  {
			alert("You have reached the limit of adding " + counter + " Links");
		}
		else {
			var newdiv = document.createElement('div');
			newdiv.innerHTML = "<div class = 'f1'><span><select id='Field1335" + counter + "' name='Field1335" + counter + "' class='field select medium' tabindex='0' > <option value='Website' selected='selected'>Website</option><option value='Facebook' >Facebook</option><option value='Twitter' >Twitter</option><option value='LinkedIn' >LinkedIn</option><option value='Blog'>Blog</option><option value='YouTube'>YouTube</option></select></span></div><div class = 'f2'><span><input id='Field1116" + counter + "' name='Field1116" + counter + "' type='text' spellcheck='false' class='field text medium' value='' maxlength='255' tabindex='1' required /> </span></div>";
			document.getElementById(divName).appendChild(newdiv);
			counter++;
		}
	}
	if(divName == "dynamicInputAdmins")
	{
		if (counter2 == limit2)  {
			alert("You have reached the limit of adding " + counter2 + " Admins");
		}
		else {
			var newdiv = document.createElement('div');
			newdiv.innerHTML = "<input id='Field26" + counter2 + "' name='Field26" + counter2 +"' type='email' spellcheck='false' class='field text medium' value='E-Mail' maxlength='255' tabindex='1' required /> ";
			document.getElementById(divName).appendChild(newdiv);
			counter2++;
		}
	}
	if(divName == "emailAdd")
	{
		if (counter4 == limit4)  {
			alert("You have reached the limit of adding " + counter4 + " E-mails");
		}
		else {
		var comma = ',';
			var divNameChild = "emailAdder" + counter4;

			var divNameChild2 = "emailAddress" + counter4;
			var newdiv = document.createElement('div');
			newdiv.id = divNameChild;
			newdiv.name = divNameChild
			newdiv.innerHTML = "<input type='button' value='X' onClick='removeEmail(" + divName + comma + divNameChild +");'><input id='" + divNameChild2 + "' name='" + divNameChild2 + "' type='text' spellcheck='false' value='" + value + "'/> ";
			document.getElementById(divName).appendChild(newdiv);
			document.getElementById("Field1116").value = "Enter e-mail...";
			counter4++;
		}
	}
	
	if(divName == "programcoord")
	{
		if(value != '')
		{
			if(document.getElementById('addPosButton').value == 'Edit Position')
			{
				document.getElementById('addPosButton').value = 'Add Position'

			}
		
			var comma = ',';
			var quotes = '"';
			var divNameChild = "progCoordChild" + counter5;
			var positionNameGive = "positionNameGiven" + counter5;
			var numPosGiven = "numPosGiven" + counter5;
			var positionDescrip = "positionDescrip" + counter5;
			var divNameChild2 = divNameChild
			divNameChild2 = divNameChild2 + 'open';
			var newdiv = document.createElement('div');
			newdiv.id = divNameChild;
			newdiv.name = divNameChild;
			var newdiv2 = document.createElement('div');
			newdiv2.id = divNameChild2;
			newdiv2.name = divNameChild2;
			var parentdiv = 'results';
			var divOpen = 'resultsOpen';
			var name = value;
			if(value3 == '')
			{
				value3 = 'No Description';
			}
			newdiv.innerHTML = "<div id=" + positionNameGive + " style='margin-right: 300px; float:left;'>" + value + "</div><div style='margin-right: 200px; float:left;' id='numPosGiven'>" + value2 + "</div><div style='float:left;'><a href='#' onClick='editPositions(" + parentdiv + comma + divNameChild + comma + counter5 +"); '>Edit</a></div><div style='float:left;  margin-left: 20px;'><a href='#' onClick='removePosition(" + parentdiv + comma + divNameChild +");'>Remove</a></div><input id=" + positionNameGive + " name=" + positionNameGive + " value=" + value + " type='hidden'><input id=" + numPosGiven + " name=" + numPosGiven + " value=" + value2 + " type='hidden'><input id=" + positionDescrip + " name=" + positionDescrip + " value=" + value3 + " type='hidden'><div id='positionDescrip' style='display:none'>" + value3 + "</div>";
			document.getElementById('results').appendChild(newdiv);
			newdiv2.innerHTML = "<div id='positionNameGiven' style='margin-right: 100px; float:left;'><input type='button' onclick='addVols(" + divOpen + comma + divNameChild2 + comma + quotes + value + quotes +");' value='+'>" + value + "</div><div id='numPosGiven'>" + value2 + "</div>";
			document.getElementById('resultsOpen').appendChild(newdiv2);

			document.getElementById("Field8").value = "";
			document.getElementById("Field9").value = "";
			document.getElementById("Field11").value = "1";
			counter5++;
			
		}
	}
	
	
}
function addVols(parentDiv, childDiv, positionName)
{
			var maxVols = '10';
			for(loop = 1; loop <= 3;loop = loop + 1)
			{
				var divNameChild = "userImage" + loop;
				var checkbox = document.getElementById(divNameChild).childNodes[0].childNodes[0];
				if(checkbox.checked == true)
				{	
					if(document.getElementById(childDiv.name).childNodes[1].innerHTML != 'Filled')
					{
						var newdiv = document.createElement('div');
						var newChild = 'positionTakenDiv' + loop;
						var hiddenNameElement = 'positionTaken' + loop;
						var hiddenPositionName = 'positionName' + loop;
						newdiv.id = newChild;
						newdiv.name = newChild;
						var comma = ',';
						var name = document.getElementById(divNameChild).childNodes[1].childNodes[0].innerHTML; //get the name of the user we are adding
						var login = document.getElementById(divNameChild).childNodes[1].childNodes[1].value; //get the login of the user we are adding
						newdiv.innerHTML = "<div id='positionNameTaken' style='margin-left: 2px; float:left;'><input id=" + hiddenNameElement + " name=" + hiddenNameElement + " value=" + login + " type='hidden'><input id=" + hiddenPositionName + " name=" + hiddenPositionName + " value=" + positionName + " type='hidden'><input type='button' onclick='removeVols(" + childDiv.name + comma + newChild + ");' value='X'>" + name + "</div>";
						document.getElementById(childDiv.name).appendChild(newdiv);
						var modifyCount = document.getElementById(childDiv.name);
						var currentCount = parseInt(modifyCount.childNodes[1].innerHTML);
						var currentCount = currentCount - 1;
						if(currentCount == 0)
						{
							document.getElementById(childDiv.name).childNodes[1].innerHTML = 'Filled';
						}	
						else
						{
							document.getElementById(childDiv.name).childNodes[1].innerHTML = currentCount;
						}
					}
					
				}
			}
}


function removeVols(parentDiv, childDiv)
{
	parentDiv.removeChild(childDiv);
	if(document.getElementById(parentDiv.name).childNodes[1].innerHTML == 'Filled')
	{
		document.getElementById(parentDiv.name).childNodes[1].innerHTML = '1';
	}	
	else
	{
		var modifyCount = document.getElementById(parentDiv.name);
		var currentCount = parseInt(modifyCount.childNodes[1].innerHTML);
		var currentCount = currentCount + 1;
		document.getElementById(parentDiv.name).childNodes[1].innerHTML = currentCount;
	}
}