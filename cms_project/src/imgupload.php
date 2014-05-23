<?php

include ("global_vars.php");

$uploadfile = $active_uploaddir ."/". basename($_FILES['file']['name']);

if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadfile)) {
	$JSONFile["status"] = 0;
  	$JSONFile["upload"] = "The image has been successfully uploaded to server.";
	$JSONFile["urlimage"] = $active_urlimage ."/". basename($_FILES['file']['name']);
	$json = json_encode($JSONFile);
}else
{
	$JSONFile["status"] = 1;
    $JSONFile["upload"] = "Unexpected error while loading image. Try again.";
	$json = json_encode($JSONFile);
}

header("Content-type:text/json");
echo $json;
exit();

?> 
