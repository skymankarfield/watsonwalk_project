<?php

$urlimage_localhost = 'http://localhost/watsonwalk_cms%20/restful/src/img';
$urlimage_production = '';

$uploaddir_localhost = '/Applications/MAMP/htdocs/watsonwalk_cms /restful/src/img';
$uploaddir_production = '/var/www/vhosts/javakafe.com/html/location-based_App/restful/src/img';

$active_uploaddir = $uploaddir_localhost;
$active_urlimage = $urlimage_localhost;

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
