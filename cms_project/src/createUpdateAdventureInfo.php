<?
include "getDBConnection.php";
include "createUpdateTextContent.php";
$link = getConnection();

//this is for text content creation/update
$fieldsTextContent["shortname"] = "nameShort";
$tagKey="adventure";
$foreignID = -1;

		$query = "INSERT INTO adventure VALUES('','no_tag','','1',0,0,0,0,0,0,0,0,0,
					'0','1','0','0','0')";
		@mysqli_real_query($link,$query);
		$foreignID=mysqli_insert_id($link);

createUpdateTextContent($fieldsTextContent, $_POST, $foreignID, $tagKey, $link);

$JSONFile["adventureID"] = $foreignID;

$json = json_encode($JSONFile);
header("Content-type:text/json");
echo $json;
exit();

?>