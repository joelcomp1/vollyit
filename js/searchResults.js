function showAllPeople(){
			$(".orgProgHeadingOrganizations").hide();
			$(".orgProgHeadingPrograms").hide();
			$("#page1").hide();
			$("#pageOrgs1").hide();
			$("#extraPrograms").hide();
			$("#extraOrgs").hide();
			$("#extraPeople").hide();
			$("#backToResults").show();
			
			var classToShow = "#pagePe";
			var maxClass1 = <?php echo $displayPeople ?>;
			for(loop = 2; loop <= maxClass1;loop = loop + 1)
			{
				classToShow = classToShow + loop;
				$(classToShow).show();
			}

	
	}
	
	function showAllPrograms(){
			$(".orgProgHeadingOrganizations").hide();
			$(".orgProgHeadingPeople").hide();
			$("#pagePe1").hide();
			$("#pageOrgs1").hide();
			$("#extraPrograms").hide();
			$("#extraOrgs").hide();
			$("#extraPeople").hide();
			$("#backToResults").show();
			var classToShow = "#page";
			var maxClass = <?php echo $displayPrograms ?>;
			for(loop = 2; loop <= maxClass;loop = loop + 1)
			{
				classToShow = classToShow + loop;
				$(classToShow).show();
			}

	
	}
	
	function showAllOrgs(){
			$(".orgProgHeadingPrograms").hide();
			$(".orgProgHeadingPeople").hide();
			$("#pagePe1").hide();
			$("#page1").hide();
			$("#extraPrograms").hide();
			$("#extraOrgs").hide();
			$("#extraPeople").hide();
			$("#backToResults").show();
			var classToShow = "#pageOrgs";
			var maxClass = <?php echo $display ?>;
			for(loop = 2; loop <= maxClass;loop = loop + 1)
			{
				classToShow = classToShow + loop;
				$(classToShow).show();
			}

	
	}
	
		
	function showResults(){
			$(".orgProgHeadingPrograms").show();
			$(".orgProgHeadingPeople").show();
			$(".orgProgHeadingOrganizations").show();
			$("#extraPrograms").show();
			$("#extraOrgs").show();
			$("#extraPeople").show();
			$("#backToResults").hide();
			$("#pageOrgs1").show();			
			$("#pagePe1").show();
			$("#page1").show();
			
			var classToShow1 = "#page";
			var classToShow2 = "#pageOrgs";
			var classToShow3 = "#pagePe";
			var maxClass1 = <?php echo $display ?>;
			var maxClass2 = <?php echo $displayPrograms ?>;
			var maxClass3 = <?php echo $displayPeople ?>;
			for(loop = 2; loop <= maxClass1;loop = loop + 1)
			{
				classToShow2 = classToShow2 + loop;
				$(classToShow2).hide();
			}
			for(loop = 2; loop <= maxClass2;loop = loop + 1)
			{
				classToShow1 = classToShow1 + loop;
				$(classToShow1).hide();
			}
			for(loop = 2; loop <= maxClass3;loop = loop + 1)
			{
				classToShow3 = classToShow3 + loop;
				$(classToShow3).hide();
			}
	
	}