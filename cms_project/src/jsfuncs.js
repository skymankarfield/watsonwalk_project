var adventureData = new Object();
var currentAdventureID = 2;
var currentWalkID = 4;
var currentPOIID = -1;
var currentMediaID = -1;
var URLRepositoryLocal = "http://localhost/watsonwalk_cms%20/cms_project/src/pullAdventure.php?operation=generateAdventure&language=en&adventureID=";
var POIProfilePage = "http://localhost/watsonwalk_cms%20/cms_project/poi.php";
var mediaFileProfilePage = "http://localhost/watsonwalk_cms%20/cms_project/addmedia.php";
var walks = new Object();
var POIs = new Object();
var maps = new Object();
var jqxhr = null;
var currentModeMediaFiles = null;

function getURLParameters(url)
{
    var result = {};
    var searchIndex = url.indexOf("?");
    if (searchIndex == -1 ) return result;
    var sPageURL = url.substring(searchIndex+1);
    var sURLVariables = sPageURL.split('&');
    for (var i = 0; i < sURLVariables.length; i++)
    {       
        var sParameterName = sURLVariables[i].split('=');      
        result[sParameterName[0]] = sParameterName[1];
    }
    if (result["adventureID"] != null)
    {
    	currentAdventureID = result["adventureID"];
    }
    if (result["walkID"] != null)
	{
		currentWalkID = result["walkID"];
	}
	if (result["poiID"] != null)
	{
		currentPOIID = result["poiID"];
	}
	if (result["mediaID"] != null)
	{
		currentMediaID = result["mediaID"];
	}
    //alert(JSON.stringify(result));
}

function goToPage(page)
{
	switch(page)
	{
		case "poiprofile":
			get_params = "?adventureID="+currentAdventureID+"&walkID="+currentWalkID+"&poiID="+currentPOIID;
			window.location.href = POIProfilePage+get_params;
			break;
		
		case "mediafileprofile":
			get_params = "?adventureID="+currentAdventureID+"&walkID="+currentWalkID+"&poiID="+currentPOIID+"&mediaID=0";
			window.location.href = mediaFileProfilePage+get_params;
		
		default:
		
			break;
	}
}

function checkInternetConnection()
{
	jqxhr.abort();
    clearTimeout(t);
    t=null;
    alert("The server is not reachable. Please, make sure you are connected to the Internet. Thanks.");

}

function showMediaFileProfile(adventureID, walkID, POIID, mediaID)
{
	currentMediaID = mediaID
	count2=0;
			while(POIs[POIID].mediaInfo[count2] != null)
			{
				if (POIs[POIID].mediaInfo[count2].mediaInfo_ID == mediaID)
				{
					document.getElementById("caption").value = getHTMLDecoded(POIs[POIID].mediaInfo[count2].textContent.footnote);
					document.getElementById("longdescription").value = getHTMLDecoded(POIs[POIID].mediaInfo[count2].textContent.description);
					document.getElementById("mediaimage").src = POIs[POIID].mediaInfo[count2].mediaContent.photo.value;
				}
        		count2++;
        	}
}

function showPOIProfile(adventureID, walkID, POIID)
{
	currentPOIID = POIID;
	document.getElementById("shortname").value = getHTMLDecoded(POIs[POIID].textContent.titleShort);
	document.getElementById("longname").value = getHTMLDecoded(POIs[POIID].textContent.titleLong);
	document.getElementById("latitude").value = (POIs[POIID].lat/1000000);
	document.getElementById("longitude").value = (POIs[POIID].lon/1000000);
	document.getElementById("distanceavailable").value = POIs[POIID].distanceAvailable;
	document.getElementById("shortdescription").value = getHTMLDecoded(POIs[POIID].textContent.descriptionShort);
	document.getElementById("longdescription").value = getHTMLDecoded(POIs[POIID].textContent.descriptionLong);
	document.getElementById("poiimage").src = POIs[POIID].mediaContent.generalImage.value;
	showListOfMediaFiles(adventureID, walkID, POIID);
}

function downloadAdventure(displayPOI) 
{
	getURLParameters(window.location.href);
	t=setTimeout("checkInternetConnection()",10000);
	jqxhr = $.getJSON(URLRepositoryLocal+currentAdventureID, function(data) {

  		clearTimeout(t);
    	t=null;
  		adventureData = data;
  		walks = adventureData.walks;
  		POIs = adventureData.POIs;
  		maps = adventureData.adventure.maps;
	
		if (currentAdventureID != -1 && currentWalkID != -1 && currentPOIID != -1 && displayPOI ==  true)
		{
			addPOIs();
			showPOIProfile(currentAdventureID, currentWalkID, currentPOIID);
			currentModeMediaFiles = "external"
		}
		else if (displayPOI ==  false && currentMediaID != -1)
		{
			showListOfMediaFiles(currentAdventureID, currentWalkID, currentPOIID);
			showMediaFileProfile(currentAdventureID, currentWalkID, currentPOIID, currentMediaID);
			currentModeMediaFiles = "internal";
		}
		else
		{
			addPOIs();
			currentModeMediaFiles = "external";
		}
		
	});
}

function downloadMediaFile()
{
	downloadAdventure(false);
	
}

function getHTMLDecoded(stringSource)
{
	return $("<div/>").html(stringSource).text();
}

function showListOfMediaFiles(adventureID, walkID, POIID)
{
    $("#mediafiles").html("<ul>");
   		count2=0;
   		
			while(POIs[POIID].mediaInfo[count2] != null)
			{
       			$("#mediafiles").append("<li><a href='#' onclick='doAction("+adventureID+","+walkID+","+POIID+","+POIs[POIID].mediaInfo[count2].mediaInfo_ID+")' >"
       									+POIs[POIID].mediaInfo[count2].textContent.footnote
        								+"</a></li>");
        		count2++;
        	}
    $("#mediafiles").append("</ul><hr />");
    //$('#mediafiles').listview('refresh');	
}

function doAction(adventureID, walkID, POIID, mediaID)
{
	switch(currentModeMediaFiles)
	{
		case "external":
				window.location.href = mediaFileProfilePage+"?adventureID="+adventureID+"&walkID="+walkID+"&poiID="+POIID+"&mediaID="+mediaID;
			break;
			
		case "internal":
				showMediaFileProfile(adventureID, walkID, POIID, mediaID);
			break;
			
		default:
		
			break;
		
	}
}

function toggle() {
 var ele = document.getElementById("toggleText");
 var text = document.getElementById("displayText");
 if(ele.style.display == "block") {
  ele.style.display = "none";
  text.innerHTML = "Show Control Panel for Default Values";
  }
 else {
  ele.style.display = "block";
  text.innerHTML = "Hide Control Panel for Default Values";
 }
} 

function addPOIs()
{
    $("#listPOIs").html("<ul>");
   		count2=0;
   		
			while(walks[currentWalkID].POIsReferences[count2] != null)
			{
       			$("#listPOIs").append("<hr /><li><img src='"+POIs[walks[currentWalkID].POIsReferences[count2]].mediaContent.generalImage.value+"' height='200' width='200'/>"
       									+"<br />"
        								+"<a href='#' onclick='showPOIProfile("+currentAdventureID+","+currentWalkID+","+walks[currentWalkID].POIsReferences[count2]+")' >"
        								+ POIs[walks[currentWalkID].POIsReferences[count2]].textContent.titleShort
        								+"</a></li>");
        		count2++;
        	}
    $("#listPOIs").append("</ul>");
    //$('#listPOIs').listview('refresh');
}

