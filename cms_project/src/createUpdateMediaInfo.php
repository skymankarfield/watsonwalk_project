<?php

include "getDBConnection.php";
include "createUpdateTextContent.php";
include "createUpdateMediaContent.php";
$link = getConnection();

//this is for text content creation/update
$fieldsTextContent["shorttitle"] = "shorttitle";
$fieldsTextContent["caption"] = "footnote";
$fieldsTextContent["longdescription"] = "description";
$fieldsTextContent["permissions"] = "permissions";
$fieldsTextContent["notes"] = "notes";
//this is for media content creation/update
$fieldsMediaContent["mediaimage"] = "photo";
$fileType = "img";

$tagKey="mediaInfo";
$foreignID = -1;

if ($_POST["currentMediaID"] != -1)
{
	$foreignID = $_POST["currentMediaID"];
	
}else
	{
		$query = "INSERT INTO mediaInfo VALUES('',".$_POST["currentPOIID"].",'1','POI','no_tag','1','1',0)";
		@mysqli_real_query($link,$query);
		$foreignID=mysqli_insert_id($link);
	}

createUpdateTextContent($fieldsTextContent, $_POST, $foreignID, $tagKey, $link);
createUpdateMediaContent($fieldsMediaContent, $_POST, $foreignID, $tagKey, $fileType, $link);

$JSONFile["currentMediaID"] = $foreignID;

$json = json_encode($JSONFile);
header("Content-type:text/json");
echo $json;
exit();

?>