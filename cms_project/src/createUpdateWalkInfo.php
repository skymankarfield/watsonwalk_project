<?
include "getDBConnection.php";
include "createUpdateTextContent.php";
$link = getConnection();

//this is for text content creation/update
$fieldsTextContent["shortname"] = "nameShort";
$tagKey="walk";
$foreignID = -1;

		$query = "INSERT INTO walk VALUES('',".mysqli_real_escape_string($link,$_POST["adventureID"]).",
					'','1','0','1','0','0')";
		@mysqli_real_query($link,$query);
		$foreignID=mysqli_insert_id($link);

createUpdateTextContent($fieldsTextContent, $_POST, $foreignID, $tagKey, $link);

$JSONFile["walkID"] = $foreignID;

$json = json_encode($JSONFile);
header("Content-type:text/json");
echo $json;
exit();

?>