<?php
    
$language = $_GET['language'];
$adventureID = $_GET['adventureID'];
$link = false;
$JSONFile = array();
$versionDictionary = "0.0";
$directory = "";

function getTextContent($adventureID,&$link,$language)
{
	$contentArray = array();
	$query = "SELECT * FROM textContent WHERE element_ID=".$adventureID." AND tagKey='dictionary' AND (languageKey='".$language."' OR languageKey='*') AND active='1' ORDER by textContent_ID DESC";
	@mysqli_real_query($link,$query);
	$result = mysqli_store_result($link);
	//$i = 0;
	if(mysqli_num_rows($result)>0)
	{
		$row = mysqli_fetch_assoc($result);
		do{
			$contentArray[$row['paramKey']] = $row['value'];
			//$i++;
		}while($row = mysqli_fetch_assoc($result));
	}
	
	return $contentArray;
}

if(!$link)
{
	$link = mysqli_connect("localhost","parisapp","appparis102938","locationBasedApp");
}
if($link)
{
	
	$JSONFile = getTextContent($adventureID,&$link,$language);
	
	//$json = json_encode($JSONFile);
	//header("Content-type:text/json");
	//echo $json;
	$query = "SELECT * FROM parameters WHERE element_ID=".$adventureID." AND tagKey='adventure' AND (paramKey='directoryFiles' OR paramKey='versionDictionary')";
	@mysqli_real_query($link,$query);
	$result = mysqli_store_result($link);
	//$i = 0;
	if(mysqli_num_rows($result)>0)
	{
		$row = mysqli_fetch_assoc($result);
		do{
			if($row['paramKey'] == "directoryFiles")
			{
				$directory = $row['individualValue'];
				
			}else if($row['paramKey'] == "versionDictionary")
			{
				$versionDictionary = $row['individualValue'];
			}
		
		}while($row = mysqli_fetch_assoc($result));
	}
	$fileHandler = fopen($directory."/dictionary-".$adventureID."-".$language."-".$versionDictionary.".js", 'w');
    fwrite($fileHandler, json_encode($JSONFile));
    fclose($fileHandler);
	
	exit();
}
    
?>