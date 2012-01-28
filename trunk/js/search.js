
	function showAllPrograms(){
			$(".orgProgHeadingOrganizations").hide();
			$("#pageOrgs1").hide();
			$("#extraPrograms").hide();
			$("#extraOrgs").hide();
			$("#backToResults").show();
			var classToShow = "#page";
			var maxClass = <?php echo $displayProgs ?>;
			for(loop = 2; loop <= maxClass;loop = loop + 1)
			{
				classToShow = classToShow + loop;
				$(classToShow).show();
			}

	
	}
	
	function showAllOrgs(){
			$(".orgProgHeadingPrograms").hide();
			$("#page1").hide();
			$("#extraPrograms").hide();
			$("#extraOrgs").hide();
			$("#backToResults").show();
			var classToShow = "#pageOrgs";
			var maxClass = <?php echo $displayOrgs ?>;
			for(loop = 2; loop <= maxClass;loop = loop + 1)
			{
				classToShow = classToShow + loop;
				$(classToShow).show();
			}

	
	}
	
		
	function showResults(){
			$(".orgProgHeadingPrograms").show();
			$(".orgProgHeadingOrganizations").show();
			$("#extraPrograms").show();
			$("#extraOrgs").show();
			$("#backToResults").hide();
			$("#pageOrgs1").show();			
			$("#page1").show();
			
			var classToShow1 = "#page";
			var classToShow2 = "#pageOrgs";
			var maxClass1 = <?php echo $displayOrgs ?>;
			var maxClass2 = <?php echo $displayProgs ?>;
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

	
	}