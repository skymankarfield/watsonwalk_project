<!DOCTYPE html>
<head>
<link rel='stylesheet' id=''  href='src/style.css' type='text/css' media='all' />
<script src="src/jquery-2.1.0.js"></script>
<script src="src/jsfuncs.js"></script>
</head>
<body>
<div id="container">
<div id="head">
 <a href="poi.php"><img src="img/logo.png" style="padding-top: 10px;"/></a>
</div>    
<div id="primary">
 <h3>MAIN PANEL</h3>
 <hr />
<img src="img/watson.jpg"  />
 <br />
</div>
<div id="content">
 <H3>Create Point of Interest (POI)</H3>
 <form>
 <ul><hr />				
  <li class="field">
  <p>This POI is <span> <a title="Lorem ipsum ad his scripta blandit partiendo, eum fastidii accumsan euripidis in, eum liber hendrerit an. Qui ut wisi vocibus suscipiantur, quo dicit ridens inciderint id. Quo mundi lobortis reformidans eu, legimus senserit definiebas an eos. Eu sit tincidunt incorrupte definitionem, vis mutat affert percipit cu, eirmod consectetuer signiferumque eu per. In usu latine equidem dolores. Quo no falli viris intellegam, ut fugit veritus placerat per.">?</a></span></p>
  <div class="picker" style="float: right; top: -35px;" >
  <select name="status" id="status">
  <option value="1" selected="selected">PUBLIC</option>
  <option value="0">NOT PUBLIC</option>
  </select>
  </div>
 </li>	
<div>
<center>
<div class="">
 <a href="javascript:void(0)" class="btn" onclick="createUpdatePOIInfo()">SAVE</a>		
 <a href="javascript:void(0)" class="btn" name="clear_delete" id="clear_delete">DELETE</a>
</div>
</center>
<br />
</div>				
<hr />	
 <li class="field">
  <label class="inline" for="shortname">Short Name * <span> <a title="Lorem ipsum ad his scripta blandit partiendo, eum fastidii accumsan euripidis in, eum liber hendrerit an. Qui ut wisi vocibus suscipiantur, quo dicit ridens inciderint id. Quo mundi lobortis reformidans eu, legimus senserit definiebas an eos. Eu sit tincidunt incorrupte definitionem, vis mutat affert percipit cu, eirmod consectetuer signiferumque eu per. In usu latine equidem dolores. Quo no falli viris intellegam, ut fugit veritus placerat per.">?</a></span></label>
  <input class="input" name="shortname" id="shortname" placeholder="Type Short name here" />
 </li>	
 <li class="field">
  <label class="inline" for="longname">Long Name <span> <a title="Lorem ipsum ad his scripta blandit partiendo, eum fastidii accumsan euripidis in, eum liber hendrerit an. Qui ut wisi vocibus suscipiantur, quo dicit ridens inciderint id. Quo mundi lobortis reformidans eu, legimus senserit definiebas an eos. Eu sit tincidunt incorrupte definitionem, vis mutat affert percipit cu, eirmod consectetuer signiferumque eu per. In usu latine equidem dolores. Quo no falli viris intellegam, ut fugit veritus placerat per.">?</a></span></label>
  <input class="input" name="longname" id="longname"  placeholder="Type Long name here (optional)" />
 </li>	
<br /><br />
 <li class="field">
  <label class="inline" for="latitude">Latitude * <span> <a title="Lorem ipsum ad his scripta blandit partiendo, eum fastidii accumsan euripidis in, eum liber hendrerit an. Qui ut wisi vocibus suscipiantur, quo dicit ridens inciderint id. Quo mundi lobortis reformidans eu, legimus senserit definiebas an eos. Eu sit tincidunt incorrupte definitionem, vis mutat affert percipit cu, eirmod consectetuer signiferumque eu per. In usu latine equidem dolores. Quo no falli viris intellegam, ut fugit veritus placerat per.">?</a></span></label>
  <input class="input" name="latitude" id="latitude" placeholder="Type Latitude here" />
 </li>	
 <li class="field">
  <label class="inline" for="longitude">Longitude * <span> <a title="Lorem ipsum ad his scripta blandit partiendo, eum fastidii accumsan euripidis in, eum liber hendrerit an. Qui ut wisi vocibus suscipiantur, quo dicit ridens inciderint id. Quo mundi lobortis reformidans eu, legimus senserit definiebas an eos. Eu sit tincidunt incorrupte definitionem, vis mutat affert percipit cu, eirmod consectetuer signiferumque eu per. In usu latine equidem dolores. Quo no falli viris intellegam, ut fugit veritus placerat per.">?</a></span></label>
  <input class="input" name="longitude" id="longitude" placeholder="Type Longitude here*" />
 </li>	
<a href="https://support.google.com/maps/answer/18539?hl=en" target="_blank" style="float: right; padding-right: 20px;" title="Instructions to get Latitude and Longitude">Instructions to get Latitude and Longitude</a>	
<br /><br />				
 <li class="field">
  <label class="inline" for="distanceavailable">Unlock range (meters)<span> <a title="Lorem ipsum ad his scripta blandit partiendo, eum fastidii accumsan euripidis in, eum liber hendrerit an. Qui ut wisi vocibus suscipiantur, quo dicit ridens inciderint id. Quo mundi lobortis reformidans eu, legimus senserit definiebas an eos. Eu sit tincidunt incorrupte definitionem, vis mutat affert percipit cu, eirmod consectetuer signiferumque eu per. In usu latine equidem dolores. Quo no falli viris intellegam, ut fugit veritus placerat per.">?</a></span><br /> (default is 5 meters)</label>
  <input class="input" name="distanceavailable" id="distanceavailable" placeholder="5" />
 </li>
 <br /><br />	
 <li class="field">
  <label class="inline" for="shortdescription">Short Description <span> <a title="Lorem ipsum ad his scripta blandit partiendo, eum fastidii accumsan euripidis in, eum liber hendrerit an. Qui ut wisi vocibus suscipiantur, quo dicit ridens inciderint id. Quo mundi lobortis reformidans eu, legimus senserit definiebas an eos. Eu sit tincidunt incorrupte definitionem, vis mutat affert percipit cu, eirmod consectetuer signiferumque eu per. In usu latine equidem dolores. Quo no falli viris intellegam, ut fugit veritus placerat per.">?</a></span></label>
  <textarea class="textarea input" name="shortdescription" id="shortdescription" placeholder="Type Short description here" rows="5"></textarea>				
 </li>																						
 <li class="field">
  <label class="inline" for="longdescription">Long Description <span> <a title="Lorem ipsum ad his scripta blandit partiendo, eum fastidii accumsan euripidis in, eum liber hendrerit an. Qui ut wisi vocibus suscipiantur, quo dicit ridens inciderint id. Quo mundi lobortis reformidans eu, legimus senserit definiebas an eos. Eu sit tincidunt incorrupte definitionem, vis mutat affert percipit cu, eirmod consectetuer signiferumque eu per. In usu latine equidem dolores. Quo no falli viris intellegam, ut fugit veritus placerat per.">?</a></span></label>
  <textarea class="textarea input" name="longdescription" id="longdescription" placeholder="Type Long description here" rows="5"></textarea>				
 </li>
 <br /><br /><hr /><br />
 <li>
<label class="inline" for="longdescription">Main image (to quickly identify this POI): <span> <a title="Lorem ipsum ad his scripta blandit partiendo, eum fastidii accumsan euripidis in, eum liber hendrerit an. Qui ut wisi vocibus suscipiantur, quo dicit ridens inciderint id. Quo mundi lobortis reformidans eu, legimus senserit definiebas an eos. Eu sit tincidunt incorrupte definitionem, vis mutat affert percipit cu, eirmod consectetuer signiferumque eu per. In usu latine equidem dolores. Quo no falli viris intellegam, ut fugit veritus placerat per.">?</a></span></label>							
<form enctype='multipart/form-data'>
   <input type='file' name='file' style="padding-left: 200px;">
  <input type='button' name='upload_btn' id="upload_btn" value='upload' style="float: right;">
</form>
<br /><br /><progress style="float: right;"></progress>
<br /><br />
<img name="poiimagegeneral" id="poiimagegeneral" width="200" height="200" src="http://javakafe.com/location-based_App/cms_project/img/poi-img.jpg" style=" padding-left: 240px;"/><br /><a href="javascript:void(0)" style="padding-left: 240px;" ></a>								
 </li>
<br /><hr />			
</ul>
</form>
<p>Add POI Media Files <span> <a title="Lorem ipsum ad his scripta blandit partiendo, eum fastidii accumsan euripidis in, eum liber hendrerit an. Qui ut wisi vocibus suscipiantur, quo dicit ridens inciderint id. Quo mundi lobortis reformidans eu, legimus senserit definiebas an eos. Eu sit tincidunt incorrupte definitionem, vis mutat affert percipit cu, eirmod consectetuer signiferumque eu per. In usu latine equidem dolores. Quo no falli viris intellegam, ut fugit veritus placerat per.">?</a></span></p>
<p style="padding-left: 240px;"><a href="javascript:void(0)" onclick="goToPage('mediafileprofile')" class="btn">ADD FILE</a>	</p>
<p>List of Media Files <span> <a title="Lorem ipsum ad his scripta blandit partiendo, eum fastidii accumsan euripidis in, eum liber hendrerit an. Qui ut wisi vocibus suscipiantur, quo dicit ridens inciderint id. Quo mundi lobortis reformidans eu, legimus senserit definiebas an eos. Eu sit tincidunt incorrupte definitionem, vis mutat affert percipit cu, eirmod consectetuer signiferumque eu per. In usu latine equidem dolores. Quo no falli viris intellegam, ut fugit veritus placerat per.">?</a></span></p>
 <div id="mediafiles">
 <ul>
  <br />
  <br />
 </ul>
 </div>
<center>
<div class="">
 <a href="javascript:void(0)" class="btn" onclick="createUpdatePOIInfo()">SAVE</a>		
 <a href="javascript:void(0)" class="btn" name="clear_delete2" id="clear_delete2">DELETE</a>
</div>
</center>
<br />
</div>    
<div id="secondary">
 <h3>POIs in this walk </h3>   	
 <br />
 <center><a href="javascript:void(0)" class="btn" onclick="showPOIProfileEmpty()">ADD POI</a></center>
 <br />
 <center>
<div id="listPOIs">        	
 <ul>
  <br /> <br />
 </ul>
</div>
</center>
</div>    
</div>
</body>
<div id="footer">
 <p>Watson Walk CMS</p>
</div>
<script language="javascript">

	$( document ).ready(function() {
 		$('progress').hide();
 		$(':button').click(function(){
		    var formData = new FormData($('form')[0]);
		    $.ajax({
		        url: imageUploadScript,  //Server script to process data
		        type: 'POST',
		        xhr: function() {  // Custom XMLHttpRequest
		            var myXhr = $.ajaxSettings.xhr();
		            if(myXhr.upload){ // Check if upload property exists
		                myXhr.upload.addEventListener('progress',progressHandlingFunction, false); // For handling the progress of the upload
		            }
		            return myXhr;
		        },
		        //Ajax events
		        beforeSend: beforeSendHandler,
		        success: completeHandler,
		        error: errorHandler,
		        // Form data
		        data: formData,
		        //Options to tell jQuery not to process data or worry about content-type.
		        cache: false,
		        contentType: false,
		        processData: false
		    }).done(function(data) {
		    	  if (data["status"] != 0)
		    	  {
				  	alert(JSON.stringify(data));
				  }else
				  {
				  	document.getElementById("poiimagegeneral").src = data["urlimage"];
				  }
				});
		});
 
    downloadAdventure(true);
 		
});

</script>
</html>