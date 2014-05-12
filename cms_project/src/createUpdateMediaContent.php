<?php

function createUpdateMediaContent($fields, $data, $foreignID, $tagKey, $fileType, &$link)
{
	foreach ($fields as $key => $value) {
		$query = "SELECT * FROM mediaContent WHERE element_ID=".$foreignID." AND tagKey='".$tagKey."' 
					AND paramKey='".$value."' AND fileType='".$fileType."' AND active='1'";
		@mysqli_real_query($link,$query);
		$result = mysqli_store_result($link);
		if(mysqli_num_rows($result)==1)
		{
			$row = mysqli_fetch_assoc($result);
			$mediaContent_ID=$row['mediaContent_ID'];
			$query = "UPDATE mediaContent SET value='".mysqli_real_escape_string($link,$_POST[$key])."'
				WHERE mediaContent.mediaContent_ID=".$mediaContent_ID."";
			@mysqli_real_query($link,$query);
		}else
			{
			$query = "INSERT INTO mediaContent VALUES('',".$foreignID.",
					'".$tagKey."',
					'".$value."',
					'".mysqli_real_escape_string($link,$_POST[$key])."',
					'".$fileType."','1')";
			@mysqli_real_query($link,$query);
				
			}
	}
}

?>