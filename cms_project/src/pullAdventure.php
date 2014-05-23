<?php

$link = false;

$operation = $_GET['operation'];
$adventureID = $_GET['adventureID'];
$language = $_GET['language'];
$online = 1;//$_GET['online'];
$JSONFile = array();
$mediaFiles = array();

function getMediaContent($elementID,$tagKey,&$link,$baseURL)
{
	global $mediaFiles;
	$contentArray = array();
	$query = "SELECT * FROM mediaContent WHERE element_ID=".$elementID." AND tagKey='".$tagKey."' AND active='1'";
	@mysqli_real_query($link,$query);
	$result = mysqli_store_result($link);
	//$i = 0;
	if(mysqli_num_rows($result)>0)
	{
		$row = mysqli_fetch_assoc($result);
		do{
			if (strpos($row['value'], 'http://') !== FALSE)
			{
				$contentArray[$row['paramKey']]['value'] = $row['value'];
			}else
				{
					$contentArray[$row['paramKey']]['value'] = $baseURL.$row['value'];
				}
			$contentArray[$row['paramKey']]['fileType'] = $row['fileType'];
			//$i++;
			if(!in_array($baseURL.$row['value'], $mediaFiles))
			{
				$mediaFiles[count($mediaFiles)] = $baseURL.$row['value'];
			}
			
		}while($row = mysqli_fetch_assoc($result));
	}
	
	return $contentArray;
}

function convert_smart_quotes($string) 
{ 
    $search = array(chr(145), 
                    chr(146), 
                    chr(147), 
                    chr(148),
                    chr(150), 
                    chr(151),
					chr(133)); 
 
    $replace = array("'", 
                     "'", 
                     '"', 
                     '"',
                     '-', 
                     '-',
                     '...'); 
 
    return str_replace($search, $replace, $string); 
} 

function getTextContent($elementID,$tagKey,&$link,$language)
{
	$contentArray = array();
	$query = "SELECT * FROM textContent WHERE element_ID=".$elementID." AND tagKey='".$tagKey."' AND (languageKey='".$language."' OR languageKey='*') AND active='1'";
	@mysqli_real_query($link,$query);
	$result = mysqli_store_result($link);
	//$i = 0;
	if(mysqli_num_rows($result)>0)
	{
		$row = mysqli_fetch_assoc($result);
		do{
			$temporalContent = convert_smart_quotes($row['value']);
			$contentArray[$row['paramKey']] = htmlentities($temporalContent,ENT_COMPAT | ENT_IGNORE,"ISO8859-15");//;str_replace("'", "&#39;",$row['value']);
			//$i++;
		}while($row = mysqli_fetch_assoc($result));
	}
	
	return $contentArray;
}

function getParameters($elementID,$tagKey,&$link,$language,$baseURL)
{
	$contentArray = array();
	$query = "SELECT * FROM parameters WHERE element_ID=".$elementID." AND tagKey='".$tagKey."' AND active='1'";
	@mysqli_real_query($link,$query);
	$result = mysqli_store_result($link);
	//$i = 0;
	if(mysqli_num_rows($result)>0)
	{
		$row = mysqli_fetch_assoc($result);
		do{
			if($row['individualValue']!="")
			{
				$contentArray[$row['paramKey']]["individualValue"] = str_replace("'", "&#39;",$row['individualValue']);
			}
			
			$contentArray[$row['paramKey']]["containsMediaContent"] = ($row['mediaContentActive'] == '1') ? "1" : "0";
			$contentArray[$row['paramKey']]["containsTextContent"] = ($row['textContentActive'] == '1') ? "1" : "0";
			
			if($row['mediaContentActive'] == '1')
			{
				$contentArray[$row['paramKey']]["mediaContent"] = getMediaContent($row['parameters_ID'],"parameters-".$tagKey,$link,$baseURL);
			}
			
			if($row['textContentActive'] == '1')
			{
				$contentArray[$row['paramKey']]["textContent"] = getTextContent($row['parameters_ID'],"parameters-".$tagKey,$link,$language);
			}
			
			if($row['valuesSet']!="")
			{
				$contentArray[$row['paramKey']]["valuesSet"] = explode(",",$row['valuesSet']);
			}
			
			//$i++;
		}while($row = mysqli_fetch_assoc($result));
	}
	
	return $contentArray;
}

function getMediaInfo($elementID,$tagKey,$online,&$link,$baseURL,$language)
{
	$mediaInfoArray = array();
	$query = "SELECT * FROM mediaInfo WHERE element_ID=".$elementID." AND active='1' AND tagKey='".$tagKey."' ORDER BY orderElement ASC";
	@mysqli_real_query($link,$query);
	$result = mysqli_store_result($link);
	$i = 0;
	if(mysqli_num_rows($result)>0)
	{
		$row = mysqli_fetch_assoc($result);
		do{
			$mediaInfoArray[$i]["mediaInfo_ID"] = $row["mediaInfo_ID"];
			$mediaInfoArray[$i]["tag"] = $row['tagMediaInfoElement'];
			$mediaInfoArray[$i]["containsMediaContent"] = ($row['mediaContentActive'] == '1') ? "1" : "0";
			$mediaInfoArray[$i]["containsTextContent"] = ($row['textContentActive'] == '1') ? "1" : "0";
			
			if($row['mediaContentActive'] == '1')
			{
				$mediaInfoArray[$i]["mediaContent"] = getMediaContent($row['mediaInfo_ID'],"mediaInfo",$link,$baseURL);
			}
			
			if($row['textContentActive'] == '1')
			{
				$mediaInfoArray[$i]["textContent"] = getTextContent($row['mediaInfo_ID'],"mediaInfo",$link,$language);
			}
			$i++;
		}while($row = mysqli_fetch_assoc($result));
	}
	return $mediaInfoArray;
}

function getPOI($POIID,$online,&$link,$baseURL,$language,$adventureID)
{
	$POIArray = array();
	$query = "SELECT * FROM POI WHERE POI_ID=".$POIID."";
	@mysqli_real_query($link,$query);
	$result = mysqli_store_result($link);
	//$i = 0;
	if(mysqli_num_rows($result)>0)
	{
		$row = mysqli_fetch_assoc($result);
		do{
			$POIArray["POI_ID"] = $row['POI_ID'];
			$POIArray["tag"] = $row['tag'];
			$POIArray["reference_POI_ID"] = $row['reference_POI_ID'];
			$POIArray["lat"] = $row['lat'];
			$POIArray["lon"] = $row['lon'];
			$POIArray["distanceAvailable"] = $row['distanceAvailable'];
			$POIArray["active"] = $row['active'];
			$POIArray["containsMediaContent"] = ($row['mediaContentActive'] == '1') ? "1" : "0";
			$POIArray["containsTextContent"] = ($row['textContentActive'] == '1') ? "1" : "0";
			$POIArray["containsParameters"] = ($row['parametersActive'] == '1') ? "1" : "0";
			$POIArray["containsMediaInfo"] = ($row['mediaInfoActive'] == '1') ? "1" : "0";
			
			if($row['mediaContentActive'] == '1')
			{
				$POIArray["mediaContent"] = getMediaContent($row['POI_ID'],"POI",$link,$baseURL);
			}
			
			if($row['textContentActive'] == '1')
			{
				$POIArray["textContent"] = getTextContent($row['POI_ID'],"POI",$link,$language);
			}
			
			if($row['parametersActive'] == '1')
			{
				$POIArray["parameters"] = getParameters($row['POI_ID'],"POI",$link,$language,$baseURL);
			}
			
			if($row['mediaInfoActive'] == '1')
			{
				$POIArray["mediaInfo"] = getMediaInfo($row['POI_ID'],"POI",$online,$link,$baseURL,$language);
			}
			
			//$i++;
		}while($row = mysqli_fetch_assoc($result));
	}
	
	$query = "SELECT story.walk_ID FROM story, walk WHERE walk.adventure_ID=".$adventureID." AND walk.active='1' AND walk.walk_ID=story.walk_ID AND story.active='1' AND story.POI_ID=".$POIID." GROUP BY story.walk_ID";
	@mysqli_real_query($link,$query);
	$result = mysqli_store_result($link);
	$i = 0;
	if(mysqli_num_rows($result)>0)
	{
		$row = mysqli_fetch_assoc($result);
		do{
			$POIArray["walksReferences"][$i] = $row['walk_ID'];
			$i++;
		}while($row = mysqli_fetch_assoc($result));
	}
	
	return $POIArray;
}

function getAllPOIs($adventureID,$online,&$link,$baseURL,$language)
{
	$POIsArray = array();
	$query = "SELECT story.POI_ID FROM story, walk WHERE walk.adventure_ID=".$adventureID." AND walk.active='1' AND walk.walk_ID=story.walk_ID AND story.active='1'";
	@mysqli_real_query($link,$query);
	$result = mysqli_store_result($link);
	//$i = 0;
	if(mysqli_num_rows($result)>0)
	{
		$row = mysqli_fetch_assoc($result);
		do{
			$POIsArray[$row['POI_ID']] = getPOI($row['POI_ID'],$online,$link,$baseURL,$language,$adventureID);
			//$i++;
		}while($row = mysqli_fetch_assoc($result));
	}
	
	return $POIsArray;
}

function getAllPOIsReferences($adventureID,&$link)
{
	$POIsArray = array();
	$query = "SELECT story.POI_ID FROM story, walk WHERE walk.adventure_ID=".$adventureID." AND walk.active='1' AND walk.walk_ID=story.walk_ID AND story.active='1' GROUP BY story.POI_ID";
	@mysqli_real_query($link,$query);
	$result = mysqli_store_result($link);
	$i = 0;
	if(mysqli_num_rows($result)>0)
	{
		$row = mysqli_fetch_assoc($result);
		do{
			$POIsArray[$i] = $row['POI_ID'];
			$i++;
		}while($row = mysqli_fetch_assoc($result));
	}
	
	return $POIsArray;
}

function getSection($sectionID,$online,&$link,$baseURL,$language)
{
	$sectionArray = array();
	$query = "SELECT * FROM sections WHERE section_ID=".$sectionID." AND active='1'";
	@mysqli_real_query($link,$query);
	$result = mysqli_store_result($link);
	//$i = 0;
	if(mysqli_num_rows($result)>0)
	{
		$row = mysqli_fetch_assoc($result);
		do{
			$sectionArray["section_ID"] = $row['section_ID'];
			$sectionArray["tag"] = $row['tag'];
			$sectionArray["sectionKey"] = $row['sectionKey'];
			
			$sectionArray["containsMediaContent"] = ($row['mediaContentActive'] == '1') ? "1" : "0";
			$sectionArray["containsTextContent"] = ($row['textContentActive'] == '1') ? "1" : "0";
			$sectionArray["containsParameters"] = ($row['parametersActive'] == '1') ? "1" : "0";
			$sectionArray["containsMediaInfo"] = ($row['mediaInfoActive'] == '1') ? "1" : "0";
		
			if($row['mediaContentActive'] == '1')
			{
				$sectionArray["mediaContent"] = getMediaContent($row['section_ID'],"sections",$link,$baseURL);
			}
			
			if($row['textContentActive'] == '1')
			{
				$sectionArray["textContent"] = getTextContent($row['section_ID'],"sections",$link,$language);
			}
			
			if($row['parametersActive'] == '1')
			{
				$sectionArray["parameters"] = getParameters($row['section_ID'],"sections",$link,$language,$baseURL);
			}
			
			if($row['mediaInfoActive'] == '1')
			{
				$sectionArray["mediaInfo"] = getMediaInfo($row['section_ID'],"sections",$online,$link,$baseURL,$language);
			}
			
			//$i++;
		}while($row = mysqli_fetch_assoc($result));
	}
	
	return $sectionArray;
		
}

function getWalk($walkID,$online,&$link,$baseURL,$language)
{
	$walkArray = array();
	$query = "SELECT * FROM walk WHERE walk_ID=".$walkID." AND active='1'";
	@mysqli_real_query($link,$query);
	$result = mysqli_store_result($link);
	//$i = 0;
	if(mysqli_num_rows($result)>0)
	{
		$row = mysqli_fetch_assoc($result);
		do{
			$walkArray["walk_ID"] = $row['walk_ID'];
			$walkArray["tag"] = $row['tag'];
			$walkArray["containsMediaContent"] = ($row['mediaContentActive'] == '1') ? "1" : "0";
			$walkArray["containsTextContent"] = ($row['textContentActive'] == '1') ? "1" : "0";
			$walkArray["containsParameters"] = ($row['parametersActive'] == '1') ? "1" : "0";
			$walkArray["containsMediaInfo"] = ($row['mediaInfoActive'] == '1') ? "1" : "0";
			$walkArray["POIsReferences"] = array();
			$walkArray["POIFirst"] = 0;
			$walkArray["POILast"] = 0;
			if($row['mediaContentActive'] == '1')
			{
				$walkArray["mediaContent"] = getMediaContent($row['walk_ID'],"walk",$link,$baseURL);
			}
			
			if($row['textContentActive'] == '1')
			{
				$walkArray["textContent"] = getTextContent($row['walk_ID'],"walk",$link,$language);
			}
			
			if($row['parametersActive'] == '1')
			{
				$walkArray["parameters"] = getParameters($row['walk_ID'],"walk",$link,$language,$baseURL);
			}
			
			if($row['mediaInfoActive'] == '1')
			{
				$walkArray["mediaInfo"] = getMediaInfo($row['walk_ID'],"walk",$online,$link,$baseURL,$language);
			}
			
			//$i++;
		}while($row = mysqli_fetch_assoc($result));
	}
	
	$query = "SELECT * FROM story WHERE walk_ID=".$walkID." AND active='1'";
	@mysqli_real_query($link,$query);
	$result = mysqli_store_result($link);
	$i = 0;
	if(mysqli_num_rows($result)>0)
	{
		$row = mysqli_fetch_assoc($result);
		do{
			$walkArray["POI"][$row['POI_ID']]["POI_ID"] = $row['POI_ID'];
			$walkArray["POI"][$row['POI_ID']]["POI_ID_father"] = $row['POI_ID_father'];
			$walkArray["POI"][$row['POI_ID']]["first"] = $row['first'];
			$walkArray["POI"][$row['POI_ID']]["last"] = $row['last'];
			//$walkArray["POI"][$row['POI_ID']]["POIFound"] = 0;
			$walkArray["POIsReferences"][$i] = $row['POI_ID'];
			$walkArray["POIFirst"] = ($row['first'] == '1' && $walkArray["POIFirst"] == 0) ? $row['POI_ID'] : $walkArray["POIFirst"];
			$walkArray["POILast"] = ($row['last'] == '1' && $walkArray["POILast"] == 0) ? $row['POI_ID'] : $walkArray["POILast"];
			$i++;
		}while($row = mysqli_fetch_assoc($result));
	}
	//$walkArray["totalPOIs"] = $i;
	//$walkArray["textContent"] = getTextContent($walkID, "walk", $link,$language);
	//$walkArray["POIsFound"] = 0;
	
	return $walkArray;
		
}

function getAllSections($adventureID,$online,&$link,$baseURL,$language)
{
	$sectionsArray = array();
	$query = "SELECT * FROM sections WHERE adventure_ID=".$adventureID." AND active='1'";
	@mysqli_real_query($link,$query);
	$result = mysqli_store_result($link);
	//$i = 0;
	if(mysqli_num_rows($result)>0)
	{
		$row = mysqli_fetch_assoc($result);
		do{
			$sectionsArray[$row['sectionKey']] = getSection($row['section_ID'],$online,$link,$baseURL,$language);
			//$i++;
		}while($row = mysqli_fetch_assoc($result));
	}
	
	return $sectionsArray;
}

function getAllWalks($adventureID,$online,&$link,$baseURL,$language)
{
	$walksArray = array();
	$query = "SELECT * FROM walk WHERE adventure_ID=".$adventureID." AND active='1'";
	@mysqli_real_query($link,$query);
	$result = mysqli_store_result($link);
	//$i = 0;
	if(mysqli_num_rows($result)>0)
	{
		$row = mysqli_fetch_assoc($result);
		do{
			$walksArray[$row['walk_ID']] = getWalk($row['walk_ID'],$online,$link,$baseURL,$language);
			//$i++;
		}while($row = mysqli_fetch_assoc($result));
	}
	
	return $walksArray;
}

function getAllWalksReferences($adventureID,&$link)
{
	$walksArray = array();
	$query = "SELECT * FROM walk WHERE adventure_ID=".$adventureID." AND active='1'";
	@mysqli_real_query($link,$query);
	$result = mysqli_store_result($link);
	$i = 0;
	if(mysqli_num_rows($result)>0)
	{
		$row = mysqli_fetch_assoc($result);
		do{
			$walksArray[$i] = $row['walk_ID'];
			$i++;
		}while($row = mysqli_fetch_assoc($result));
	}
	
	return $walksArray;
}

function getAllMapsReferences($adventureID,&$link)
{
	$mapsArray = array();
	$query = "SELECT * FROM maps WHERE adventure_ID=".$adventureID." AND active='1'";
	@mysqli_real_query($link,$query);
	$result = mysqli_store_result($link);
	$i = 0;
	if(mysqli_num_rows($result)>0)
	{
		$row = mysqli_fetch_assoc($result);
		do{
			$mapsArray[$i] = $row['map_ID'];
			$i++;
		}while($row = mysqli_fetch_assoc($result));
		
	}
	
	return $mapsArray;
}

function getAdventure($adventureID,$online,&$link,$language)
{
	$adventureArray = array();
	$query = "SELECT * FROM adventure WHERE adventure_ID=".$adventureID." AND active='1'";
	@mysqli_real_query($link,$query);
	$result = mysqli_store_result($link);
	//$i = 0;
	if(mysqli_num_rows($result)>0)
	{
		$row = mysqli_fetch_assoc($result);
		do{
			$adventureArray["adventure_ID"] = $row['adventure_ID'];
			$adventureArray["tag"] = $row['tag'];
			$adventureArray["baseURL"] = $row['baseURL'];
			$adventureArray["boundingCornerBottomLeftLat"] = $row['boundingCornerBottomLeftLat'];
			$adventureArray["boundingCornerBottomLeftLon"] = $row['boundingCornerBottomLeftLon'];
			$adventureArray["boundingCornerTopRightLat"] = $row['boundingCornerTopRightLat'];
			$adventureArray["boundingCornerTopRightLon"] = $row['boundingCornerTopRightLon'];
			$adventureArray["zoomLevelStart"] = $row['zoomLevelStart'];
			$adventureArray["zoomLevelEnd"] = $row['zoomLevelEnd'];
			$adventureArray["centerMapLocationLat"] = $row['centerMapLocationLat'];
			$adventureArray["centerMapLocationLon"] = $row['centerMapLocationLon'];
			$adventureArray["defaultZoom"] = $row['defaultZoom'];
			$adventureArray["walksReferences"] = getAllWalksReferences($adventureID,$link);
			$adventureArray["POIsReferences"] = getAllPOIsReferences($adventureID,$link);
			$adventureArray["mapsReferences"] = getAllMapsReferences($adventureID,$link);
			$adventureArray["containsMediaContent"] = ($row['mediaContentActive'] == '1') ? "1" : "0";
			$adventureArray["containsTextContent"] = ($row['textContentActive'] == '1') ? "1" : "0";
			$adventureArray["containsParameters"] = ($row['parametersActive'] == '1') ? "1" : "0";
			$adventureArray["containsMediaInfo"] = ($row['mediaInfoActive'] == '1') ? "1" : "0";
			$adventureArray["containsSectionsActive"] = ($row['sectionsActive'] == '1') ? "1" : "0";
			
			if($row['mediaContentActive'] == '1')
			{
				$adventureArray["mediaContent"] = getMediaContent($row['adventure_ID'],"adventure",$link,$adventureArray["baseURL"]);
			}
			
			if($row['textContentActive'] == '1')
			{
				$adventureArray["textContent"] = getTextContent($row['adventure_ID'],"adventure",$link,$language);
			}
			
			if($row['parametersActive'] == '1')
			{
				$adventureArray["parameters"] = getParameters($row['adventure_ID'],"adventure",$link,$language,$adventureArray["baseURL"]);
			}
			
			if($row['mediaInfoActive'] == '1')
			{
				$adventureArray["mediaInfo"] = getMediaInfo($row['adventure_ID'],"adventure",$online,$link,$adventureArray["baseURL"],$language);
			}
			
			if($row['sectionsActive'] == '1')
			{
				$adventureArray["sections"] = getAllSections($row['adventure_ID'],$online,$link,$adventureArray["baseURL"],$language);
			}
			//$i++;
		}while($row = mysqli_fetch_assoc($result));
		
	}
	
	$query = "SELECT * FROM maps WHERE adventure_ID=".$adventureID." AND active='1'";
	@mysqli_real_query($link,$query);
	$result = mysqli_store_result($link);
	//$i = 0;
	if(mysqli_num_rows($result)>0)
	{
		$row = mysqli_fetch_assoc($result);
		do{
			$adventureArray["maps"][$row['map_ID']]["map_ID"] = $row['map_ID'];
			$adventureArray["maps"][$row['map_ID']]["tag"] = $row['tag'];
			$adventureArray["maps"][$row['map_ID']]["containsMediaContent"] = ($row['mediaContentActive'] == '1') ? "1" : "0";
			$adventureArray["maps"][$row['map_ID']]["containsTextContent"] = ($row['textContentActive'] == '1') ? "1" : "0";
			$adventureArray["maps"][$row['map_ID']]["containsParameters"] = ($row['parametersActive'] == '1') ? "1" : "0";
			$adventureArray["maps"][$row['map_ID']]["containsMediaInfo"] = ($row['mediaInfoActive'] == '1') ? "1" : "0";
			$adventureArray["maps"][$row['map_ID']]["boundingCornerBottomLeftLat"] = $row['boundingCornerBottomLeftLat'];
			$adventureArray["maps"][$row['map_ID']]["boundingCornerBottomLeftLon"] = $row['boundingCornerBottomLeftLon'];
			$adventureArray["maps"][$row['map_ID']]["boundingCornerTopRightLat"] = $row['boundingCornerTopRightLat'];
			$adventureArray["maps"][$row['map_ID']]["boundingCornerTopRightLon"] = $row['boundingCornerTopRightLon'];
			$adventureArray["maps"][$row['map_ID']]["zoomLevelStart"] = $row['zoomLevelStart'];
			$adventureArray["maps"][$row['map_ID']]["zoomLevelEnd"] = $row['zoomLevelEnd'];
			$adventureArray["maps"][$row['map_ID']]["centerMapLocationLat"] = $row['centerMapLocationLat'];
			$adventureArray["maps"][$row['map_ID']]["centerMapLocationLon"] = $row['centerMapLocationLon'];
			
			if($row['mediaContentActive'] == '1')
			{
				$adventureArray["maps"][$row['map_ID']]["mediaContent"] = getMediaContent($row['map_ID'],"maps",$link,$adventureArray["baseURL"]);
			}
			
			if($row['textContentActive'] == '1')
			{
				$adventureArray["maps"][$row['map_ID']]["textContent"] = getTextContent($row['map_ID'],"maps",$link,$language);
			}
			
			if($row['parametersActive'] == '1')
			{
				$adventureArray["maps"][$row['map_ID']]["parameters"] = getParameters($row['map_ID'],"maps",$link,$language,$adventureArray["baseURL"]);
			}
			
			if($row['mediaInfoActive'] == '1')
			{
				$adventureArray["maps"][$row['map_ID']]["mediaInfo"] = getMediaInfo($row['map_ID'],"maps",$online,$link,$adventureArray["baseURL"],$language);
			}
			
			//$i++;
		}while($row = mysqli_fetch_assoc($result));
		
	}
	
	return $adventureArray;
}
	
function getAdventuresAndWalksForJSTree($online,&$link,$language)
{
	$adventureArray = array();
	$i = 0;
	$adventureArray[$i]["id"] = "action/newadventure";
	$adventureArray[$i]["parent"] = "#";
	$adventureArray[$i]["text"] = "[New Adventure]";
	$i++;
	$query1 = "SELECT adventure.adventure_ID as adventureID, textContent.value as title 
				FROM adventure, textContent 
					WHERE textContent.element_ID = adventure.adventure_ID 
						AND textContent.tagKey = 'adventure'
						AND textContent.languageKey = '".$language."' 
						AND textContent.paramKey = 'nameShort'
						AND textContent.active = '1'
						AND adventure.active= '1' 
						ORDER BY adventure.adventure_ID ASC";
	@mysqli_real_query($link,$query1);
	$result1 = mysqli_store_result($link);
	if(mysqli_num_rows($result1)>0)
	{
		$row1 = mysqli_fetch_assoc($result1);
		
		do{
			//$tmparray1 = array();
			$adventureArray[$i]["id"] = "adventure".$row1["adventureID"];
			$adventureArray[$i]["parent"] = "#";
			$adventureArray[$i]["text"] = $row1["title"];
			//$adventureArray[$i] = $tmparray1;
			$i++;	
			
			$adventureArray[$i]["id"] = "action/newwalk/".$row1["adventureID"];
			$adventureArray[$i]["parent"] = "adventure".$row1["adventureID"];;
			$adventureArray[$i]["text"] = "[New Walk]";
			$i++;
			
			$tmp_adventureArray = array();
			$query2 = "SELECT walk.walk_ID as walkID, textContent.value as title 
						FROM walk, textContent 
							WHERE walk.adventure_ID = ".$row1["adventureID"]."
								AND textContent.element_ID = walk.walk_ID 
								AND textContent.tagKey = 'walk'
								AND textContent.languageKey = '".$language."' 
								AND textContent.paramKey = 'nameShort'
								AND textContent.active = '1' 
								AND walk.active = '1'
								ORDER BY walk.walk_ID ASC";
			@mysqli_real_query($link,$query2);
			$result2 = mysqli_store_result($link);
			if(mysqli_num_rows($result2)>0)
			{
				$row2 = mysqli_fetch_assoc($result2);
				
				do{
					//$tmparray2 = array();
					$adventureArray[$i]["id"] = $row1["adventureID"]."-".$row2["walkID"];
					$adventureArray[$i]["parent"] = "adventure".$row1["adventureID"];
					$adventureArray[$i]["text"] = $row2["title"];
					//$adventureArray[$i] = $tmparray2;
					$i++;	
					
				}while($row2 = mysqli_fetch_assoc($result2));
				
			}
						
		}while($row1 = mysqli_fetch_assoc($result1));
		
	}
	return $adventureArray;
}
	
function getAdventureMetadata($adventureID,$online,&$link,$language)
{
	$adventureArray = array();
	$query = "SELECT * FROM adventure WHERE adventure_ID=".$adventureID." AND active='1'";
	@mysqli_real_query($link,$query);
	$result = mysqli_store_result($link);
	//$i = 0;
	if(mysqli_num_rows($result)>0)
	{
		$row = mysqli_fetch_assoc($result);
		do{
			$adventureArray["adventure_ID"] = $row['adventure_ID'];
			$adventureArray["tag"] = $row['tag'];
			$adventureArray["baseURL"] = $row['baseURL'];
			$adventureArray["boundingCornerBottomLeftLat"] = $row['boundingCornerBottomLeftLat'];
			$adventureArray["boundingCornerBottomLeftLon"] = $row['boundingCornerBottomLeftLon'];
			$adventureArray["boundingCornerTopRightLat"] = $row['boundingCornerTopRightLat'];
			$adventureArray["boundingCornerTopRightLon"] = $row['boundingCornerTopRightLon'];
			$adventureArray["zoomLevelStart"] = $row['zoomLevelStart'];
			$adventureArray["zoomLevelEnd"] = $row['zoomLevelEnd'];
			$adventureArray["centerMapLocationLat"] = $row['centerMapLocationLat'];
			$adventureArray["centerMapLocationLon"] = $row['centerMapLocationLon'];
			$adventureArray["defaultZoom"] = $row['defaultZoom'];
			$adventureArray["walksReferences"] = getAllWalksReferences($adventureID,$link);
			$adventureArray["POIsReferences"] = getAllPOIsReferences($adventureID,$link);
			$adventureArray["mapsReferences"] = getAllMapsReferences($adventureID,$link);
			$adventureArray["containsMediaContent"] = ($row['mediaContentActive'] == '1') ? "1" : "0";
			$adventureArray["containsTextContent"] = ($row['textContentActive'] == '1') ? "1" : "0";
			$adventureArray["containsParameters"] = ($row['parametersActive'] == '1') ? "1" : "0";
			$adventureArray["containsMediaInfo"] = ($row['mediaInfoActive'] == '1') ? "1" : "0";
			$adventureArray["containsSectionsActive"] = ($row['sectionsActive'] == '1') ? "1" : "0";
			
			if($row['mediaContentActive'] == '1')
			{
				$adventureArray["mediaContent"] = getMediaContent($row['adventure_ID'],"adventure",$link,$adventureArray["baseURL"]);
			}
			
			if($row['textContentActive'] == '1')
			{
				$adventureArray["textContent"] = getTextContent($row['adventure_ID'],"adventure",$link,$language);
			}
			
			if($row['parametersActive'] == '1')
			{
				$adventureArray["parameters"] = getParameters($row['adventure_ID'],"adventure",$link,$language,$adventureArray["baseURL"]);
			}
			
			if($row['mediaInfoActive'] == '1')
			{
				$adventureArray["mediaInfo"] = getMediaInfo($row['adventure_ID'],"adventure",$online,$link,$adventureArray["baseURL"],$language);
			}
			
			if($row['sectionsActive'] == '1')
			{
				$adventureArray["sections"] = getAllSections($row['adventure_ID'],$online,$link,$adventureArray["baseURL"],$language);
			}	
			//$i++;
		}while($row = mysqli_fetch_assoc($result));
		
	}
	return $adventureArray;
}

if(!$link)
{
	include "getDBConnection.php";
	$link = getConnection();
}
if($link)
{
	
	switch($operation)
	{
		case 'generateAdventuresAndWalksForJSTree':
			
			$JSONFile["data"] = getAdventuresAndWalksForJSTree($online,$link,$language);
			
			break;
			
		case 'generateWalk':
			
			break;
		
		case 'generateAllWalks':
			
			break;
		
		case 'generatePOI':
		
			break;
			
		case 'generateAllPOIs':
			
			break;
		
		case 'generateAdventureMetadata':
			
			$JSONFile["adventureMetadata"] = getAdventureMetadata($adventureID,$online,$link,$language);

			//$fileHandler = fopen("adventureMetadata.js", 'w');
    		//fwrite($fileHandler, json_encode($JSONFile));
    		//fclose($fileHandler);

			break;
		
		case 'generateAdventure':

			$JSONFile["adventure"] = getAdventure($adventureID,$online,$link,$language);
			$JSONFile["walks"] = getAllWalks($adventureID,$online,$link,$JSONFile["adventure"]["baseURL"],$language);
			$JSONFile["POIs"] = getAllPOIs($adventureID,$online,$link,$JSONFile["adventure"]["baseURL"],$language);
			
			/*for($i=0;$i<count($JSONFile["adventure"]["parameters"]["pathways"]["valuesSet"]);$i++)
			{
				getDirections($JSONFile["adventure"]["parameters"]["pathways"]["valuesSet"][$i],$JSONFile,$adventureID,$language);
			}*/
			
			$JSONFile["adventure"]["mediaFilesReferences"] = $mediaFiles;

			//$fileHandler = fopen($JSONFile["adventure"]["parameters"]["directoryFiles"]["individualValue"]."/adventure-".$adventureID."-".$language."-".$JSONFile["adventure"]["parameters"]["version"]["individualValue"].".js", 'w');
    		//fwrite($fileHandler, json_encode($JSONFile));
    		//fclose($fileHandler);
			
			break;
		 
		default: 
			
			break; 
		
	}

	//echo var_dump($JSONFile);
	$json = json_encode($JSONFile);
	header("Content-type:html/json");
	echo $json;
	
	exit();
}

?>