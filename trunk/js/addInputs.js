var counter = 2;
var limit = 5;
var counter2 = 2;
var limit2 = 10;
var counter3 = 2;
var limit3 = 10;
function addInput(divName){
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
	if(divName == "dynamicProgramCoords")
	{
		if (counter3 == limit3)  {
			alert("You have reached the limit of adding " + counter3 + " Program Coordinators");
		}
		else {
			var newdiv = document.createElement('div');
			newdiv.innerHTML = "<input id='Field16" + counter3 + "' name='Field16" + counter3 +"' type='text' spellcheck='false' class='field text medium' value='Start Typing Name' maxlength='255' tabindex='1' required /> ";
			document.getElementById(divName).appendChild(newdiv);
			counter3++;
		}
	}
	
}