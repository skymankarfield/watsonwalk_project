var adventureData = new Object();
var currentAdventureID = 2;
var currentWalkID = 4;
var currentPOIID = -1;
var currentMediaID = -1;
var URLRepositoryLocal = "http://localhost/watsonwalk_cms%20/cms_project/src/pullAdventure.php?operation=generateAdventure&language=en&adventureID=";
var POIProfilePage = "http://localhost/watsonwalk_cms%20/cms_project/poi.php";
var mediaFileProfilePage = "http://localhost/watsonwalk_cms%20/cms_project/addmedia.php";
var postCreateUpdatePOIInfoScript = "http://localhost/watsonwalk_cms%20/cms_project/src/createUpdatePOIInfo.php";
var postCreateUpdateMediaInfoScript = "http://localhost/watsonwalk_cms%20/cms_project/src/createUpdateMediaInfo.php";
var walks = new Object();
var POIs = new Object();
var maps = new Object();
var jqxhr = null;
var currentModeMediaFiles = null;

function createUpdatePOIInfo()
{
	postJsonBody = new Object();
	postJsonBody["currentPOIID"] = currentPOIID;
	postJsonBody["currentWalkID"] = currentWalkID;
	postJsonBody["currentAdventureID"] = currentAdventureID;
	postJsonBody["status"] = $('#status').val();
	postJsonBody["shortname"] = document.getElementById("shortname").value;
	postJsonBody["longname"] = document.getElementById("longname").value;
	postJsonBody["latitude"] = document.getElementById("latitude").value;
	postJsonBody["longitude"] = document.getElementById("longitude").value;
	postJsonBody["distanceavailable"] = document.getElementById("distanceavailable").value;
	postJsonBody["shortdescription"] = document.getElementById("shortdescription").value;
	postJsonBody["longdescription"] = document.getElementById("longdescription").value;
	postJsonBody["poiimagegeneral"] = document.getElementById("poiimagegeneral").src;
	
	t=setTimeout("checkInternetConnection()",10000);
	jqxhr = $.post( postCreateUpdatePOIInfoScript, postJsonBody, function( data ) {
		clearTimeout(t);
    	t=null;
    	currentPOIID = data.currentPOIID;
  		downloadAdventure(true);
	});
}

function createUpdateMediaInfo()
{
	postJsonBody = new Object();
	postJsonBody["currentPOIID"] = currentPOIID;
	postJsonBody["currentWalkID"] = currentWalkID;
	postJsonBody["currentAdventureID"] = currentAdventureID;
	postJsonBody["currentMediaID"] = currentMediaID;
	postJsonBody["shorttitle"] = document.getElementById("shorttitle").value;
	postJsonBody["caption"] = document.getElementById("caption").value;
	postJsonBody["longdescription"] = document.getElementById("longdescription").value;
	postJsonBody["permissions"] = document.getElementById("permissions").value;
	postJsonBody["notes"] = document.getElementById("notes").value;
	postJsonBody["mediaimage"] = document.getElementById("mediaimage").src;
	
	t=setTimeout("checkInternetConnection()",10000);
	jqxhr = $.post( postCreateUpdateMediaInfoScript, postJsonBody, function( data ) {
		clearTimeout(t);
    	t=null;
    	currentMediaID = data["currentMediaID"];
  		downloadMediaFile();
	});
}

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
    }else
    {
    	currentAdventureID = -1;
    }
    if (result["walkID"] != null)
	{
		currentWalkID = result["walkID"];
	}else
	{
		currentWalkID = -1;
	}
	if (result["poiID"] != null)
	{
		currentPOIID = result["poiID"];
	}else
	{
		currentPOIID = -1;
	}
	if (result["mediaID"] != null)
	{
		currentMediaID = result["mediaID"];
	}else
	{
		currentMediaID = -1;
	}
    
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

function showMediaFileProfileEmpty()
{	
	currentMediaID = -1;
	document.getElementById("shorttitle").value = "";
	document.getElementById("caption").value = "";
	document.getElementById("longdescription").value = "";
	document.getElementById("permissions").value = "";
	document.getElementById("notes").value = "";
	document.getElementById("mediaimage").src = "img/poi-img.jpg";
	updateClearDeleteButton("mediapage");			
}

function showMediaFileProfile(adventureID, walkID, POIID, mediaID)
{
	currentMediaID = mediaID;
	count2=0;
			while(POIs[POIID].mediaInfo[count2] != null)
			{
				if (POIs[POIID].mediaInfo[count2].mediaInfo_ID == mediaID)
				{
					document.getElementById("shorttitle").value = getHTMLDecoded(POIs[POIID].mediaInfo[count2].textContent.shorttitle);
					document.getElementById("caption").value = getHTMLDecoded(POIs[POIID].mediaInfo[count2].textContent.footnote);
					document.getElementById("longdescription").value = getHTMLDecoded(POIs[POIID].mediaInfo[count2].textContent.description);
					document.getElementById("permissions").value = getHTMLDecoded(POIs[POIID].mediaInfo[count2].textContent.permissions);
					document.getElementById("notes").value = getHTMLDecoded(POIs[POIID].mediaInfo[count2].textContent.notes);
					document.getElementById("mediaimage").src = POIs[POIID].mediaInfo[count2].mediaContent.photo.value;
					
				}
        		count2++;
        	}
    updateClearDeleteButton("mediapage");
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
	document.getElementById("poiimagegeneral").src = POIs[POIID].mediaContent.generalImage.value;
	showListOfMediaFiles(adventureID, walkID, POIID);
	updateClearDeleteButton("poipage");
}

function showPOIProfileEmpty()
{
	currentPOIID = -1;
	document.getElementById("shortname").value = "";
	document.getElementById("longname").value = "";
	document.getElementById("latitude").value = "";
	document.getElementById("longitude").value = "";
	document.getElementById("distanceavailable").value = "";
	document.getElementById("shortdescription").value = "";
	document.getElementById("longdescription").value = "";
	document.getElementById("poiimagegeneral").src = "img/poi-img.jpg";
	document.getElementById("status").options[0].selected = true;
	showListOfMediaFilesEmpty();
	updateClearDeleteButton("poipage");
}

function updateClearDeleteButton(page)
{
	switch(page)
	{
		case "poipage":
			if (currentPOIID != -1)
			{
				document.getElementById("clear_delete").innerHTML="DELETE";
				document.getElementById("clear_delete2").innerHTML="DELETE";
			}else
			{
				document.getElementById("clear_delete").innerHTML="CLEAR FORM";
				document.getElementById("clear_delete2").innerHTML="CLEAR FORM";
			}
			
		break;
		
		case "mediapage":
			if (currentMediaID != -1)
			{
				document.getElementById("clear_delete").innerHTML="DELETE";
				document.getElementById("clear_delete2").innerHTML="DELETE";
			}else
			{
				document.getElementById("clear_delete").innerHTML="CLEAR FORM";
				document.getElementById("clear_delete2").innerHTML="CLEAR FORM";
			}
		
		break;
		
		default:
		
		break;
	}
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
			currentModeMediaFiles = "external";
			updateClearDeleteButton("poipage");
			
		}
		else if (displayPOI ==  false && currentMediaID != -1)
		{
			if (currentMediaID == 0)
			{
				currentMediaID = -1;
			}
			showListOfMediaFiles(currentAdventureID, currentWalkID, currentPOIID);
			showMediaFileProfile(currentAdventureID, currentWalkID, currentPOIID, currentMediaID);
			currentModeMediaFiles = "internal";
			updateClearDeleteButton("mediapage");
		}
		else
		{
			addPOIs();
			currentModeMediaFiles = "external";
			updateClearDeleteButton("poipage");
			
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

function showListOfMediaFilesEmpty()
{
    $("#mediafiles").html("<br /><br />");
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
    
}

