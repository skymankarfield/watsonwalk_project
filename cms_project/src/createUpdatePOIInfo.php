<?php

include "getDBConnection.php";
include "createUpdateTextContent.php";
include "createUpdateMediaContent.php";
$link = getConnection();

//this is for text content creation/update
$fieldsTextContent["shortname"] = "titleShort";
$fieldsTextContent["longname"] = "titleLong";
$fieldsTextContent["shortdescription"] = "descriptionShort";
$fieldsTextContent["longdescription"] = "descriptionLong";
//this is for media content creation/update
$fieldsMediaContent["poiimagegeneral"] = "generalImage";
$fileType = "img";

$tagKey="POI";
$foreignID = -1;

if ($_POST["currentPOIID"] != -1)
{
	$foreignID = $_POST["currentPOIID"];
	$query = "UPDATE POI SET lat=".mysqli_real_escape_string($link,($_POST["latitude"]*1000000)).",
				lon=".mysqli_real_escape_string($link,($_POST["longitude"]*1000000)).",
				distanceAvailable=".mysqli_real_escape_string($link,$_POST["distanceavailable"]).",
				active='".mysqli_real_escape_string($link,$_POST["active"])."'
				WHERE POI.POI_ID=".$foreignID."";
	@mysqli_real_query($link,$query);
	
}else
	{
		$query = "INSERT INTO POI VALUES('','no_tag',0,
					".mysqli_real_escape_string($link,($_POST["latitude"]*1000000)).",
					".mysqli_real_escape_string($link,($_POST["longitude"]*1000000)).",
					".mysqli_real_escape_string($link,$_POST["distanceavailable"]).",
					'".mysqli_real_escape_string($link,$_POST["active"])."',
					'1','1','0','1')";
		@mysqli_real_query($link,$query);
		$foreignID=mysqli_insert_id($link);
		
		$query = "INSERT INTO story VALUES('',".$foreignID.",0,".$_POST["currentWalkID"].",'1','0','0')";
		@mysqli_real_query($link,$query);
		
	}

createUpdateTextContent($fieldsTextContent, $_POST, $foreignID, $tagKey, $link);
createUpdateMediaContent($fieldsMediaContent, $_POST, $foreignID, $tagKey, $fileType, $link);

$JSONFile["currentPOIID"] = $foreignID;

$json = json_encode($JSONFile);
header("Content-type:text/json");
echo $json;
exit();

?>