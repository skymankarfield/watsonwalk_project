<?php

function createUpdateTextContent($fields, $data, $foreignID, $tagKey, &$link)
{
	foreach ($fields as $key => $value) {
		$query = "SELECT * FROM textContent WHERE element_ID=".$foreignID." AND tagKey='".$tagKey."' 
					AND paramKey='".$value."' AND languageKey='en' AND active='1'";
		@mysqli_real_query($link,$query);
		$result = mysqli_store_result($link);
		if(mysqli_num_rows($result)==1)
		{
			$row = mysqli_fetch_assoc($result);
			$textContent_ID=$row['textContent_ID'];
			$query = "UPDATE textContent SET value='".mysqli_real_escape_string($link,$_POST[$key])."'
				WHERE textContent.textContent_ID=".$textContent_ID."";
			@mysqli_real_query($link,$query);
		}else
			{
			$query = "INSERT INTO textContent VALUES('',".$foreignID.",
					'".$tagKey."',
					'".$value."',
					'".mysqli_real_escape_string($link,$_POST[$key])."',
					'en','1')";
			@mysqli_real_query($link,$query);
				
			}
	}
}

?>