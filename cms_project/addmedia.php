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
 <h3>Media Panel</h3>
<hr />
 <img src="img/watson.jpg"  />
 <br />
</div>   
<div id="content">
 <H3>Add POI Media Files</H3>
 <hr />
<div>
 <center>
<div class="">
 <a href="#" onclick="goToPage('poiprofile')" class="btn">GO BACK</a>
 <a href="#" class="btn" onclick="createUpdateMediaInfo()">SAVE</a>		
 <a href="#" class="btn" name="clear_delete" id="clear_delete">DELETE</a>
</div>
 </center>
 <br />
</div>
 <form>
 <ul>			
   <li class="field">
   <label class="inline" for="title">Title * <span> <a title="Lorem ipsum ad his scripta blandit partiendo, eum fastidii accumsan euripidis in, eum liber hendrerit an. Qui ut wisi vocibus suscipiantur, quo dicit ridens inciderint id. Quo mundi lobortis reformidans eu, legimus senserit definiebas an eos. Eu sit tincidunt incorrupte definitionem, vis mutat affert percipit cu, eirmod consectetuer signiferumque eu per. In usu latine equidem dolores. Quo no falli viris intellegam, ut fugit veritus placerat per.">?</a></span></label>
   <input class="input" name="shorttitle" id="shorttitle" placeholder="Type Title" />
   </li>				
   <li class="field">
   <label class="inline" for="shortname">Caption * <span> <a title="Lorem ipsum ad his scripta blandit partiendo, eum fastidii accumsan euripidis in, eum liber hendrerit an. Qui ut wisi vocibus suscipiantur, quo dicit ridens inciderint id. Quo mundi lobortis reformidans eu, legimus senserit definiebas an eos. Eu sit tincidunt incorrupte definitionem, vis mutat affert percipit cu, eirmod consectetuer signiferumque eu per. In usu latine equidem dolores. Quo no falli viris intellegam, ut fugit veritus placerat per.">?</a></span></label>
   <input class="input" name="caption" id="caption" placeholder="Type Caption" />
   </li>																						
   <li class="field">
   <label class="inline" for="longdescription">Description * <span> <a title="Lorem ipsum ad his scripta blandit partiendo, eum fastidii accumsan euripidis in, eum liber hendrerit an. Qui ut wisi vocibus suscipiantur, quo dicit ridens inciderint id. Quo mundi lobortis reformidans eu, legimus senserit definiebas an eos. Eu sit tincidunt incorrupte definitionem, vis mutat affert percipit cu, eirmod consectetuer signiferumque eu per. In usu latine equidem dolores. Quo no falli viris intellegam, ut fugit veritus placerat per.">?</a></span></label>
   <textarea class="textarea input" name="longdescription" id="longdescription" placeholder="Type Description" rows="5"></textarea>				
   </li>
   <li class="field">
   <label class="inline" for="shortname">Rights and Permissions <span> <a title="Lorem ipsum ad his scripta blandit partiendo, eum fastidii accumsan euripidis in, eum liber hendrerit an. Qui ut wisi vocibus suscipiantur, quo dicit ridens inciderint id. Quo mundi lobortis reformidans eu, legimus senserit definiebas an eos. Eu sit tincidunt incorrupte definitionem, vis mutat affert percipit cu, eirmod consectetuer signiferumque eu per. In usu latine equidem dolores. Quo no falli viris intellegam, ut fugit veritus placerat per.">?</a></span></label>
   <input class="input" name="permissions" id="permissions" placeholder="Type Rights and Permissions" />
   </li>
   <li class="field">
   <label class="inline" for="longdescription">Notes <span> <a title="Lorem ipsum ad his scripta blandit partiendo, eum fastidii accumsan euripidis in, eum liber hendrerit an. Qui ut wisi vocibus suscipiantur, quo dicit ridens inciderint id. Quo mundi lobortis reformidans eu, legimus senserit definiebas an eos. Eu sit tincidunt incorrupte definitionem, vis mutat affert percipit cu, eirmod consectetuer signiferumque eu per. In usu latine equidem dolores. Quo no falli viris intellegam, ut fugit veritus placerat per.">?</a></span></label>
   <textarea class="textarea input" name="notes" id="notes" placeholder="Type Notes" rows="5"></textarea>				
   </li>			
   <li>
   	<label class="inline" for="longdescription">SELECT FILE * <span> <a title="Lorem ipsum ad his scripta blandit partiendo, eum fastidii accumsan euripidis in, eum liber hendrerit an. Qui ut wisi vocibus suscipiantur, quo dicit ridens inciderint id. Quo mundi lobortis reformidans eu, legimus senserit definiebas an eos. Eu sit tincidunt incorrupte definitionem, vis mutat affert percipit cu, eirmod consectetuer signiferumque eu per. In usu latine equidem dolores. Quo no falli viris intellegam, ut fugit veritus placerat per.">?</a></span></label>
   <form method='POST' enctype='multipart/form-data'>
  <input type='file' name='file' style="padding-left: 200px;">
  <input type='button' name='upload_btn' id="upload_btn" value='upload' style="float: right;">
   </form>
   <br /><br /><progress style="float: right;"></progress>
   <br />
   <br />
   <img name="mediaimage" id="mediaimage" width="200" height="200" src="http://javakafe.com/location-based_App/cms_project/img/poi-img.jpg" style=" padding-left: 240px;"/><br /><a href="#" style="padding-left: 240px;" ></a>	
   </li>
   <br />				
   </ul>
  </form>
  <hr />
<center>
<div class="">
 <a href="#" onclick="goToPage('poiprofile')" class="btn">GO BACK</a>	
 <a href="#" class="btn" onclick="createUpdateMediaInfo()">SAVE</a>		
 <a href="#" class="btn" name="clear_delete2" id="clear_delete2">DELETE</a>
</div>
</center>
<br />
</div>    
<div id="secondary" style="padding-bottom: 500px;">
 <h3>Media Files</h3>
 <br />
 <center><a href="#" class="btn" onclick="showMediaFileProfileEmpty()">ADD FILE</a></center>
 <br />
 <center>
<div id="mediafiles">
 <ul>
  <br /><br />
 </ul>
 <hr />
</div>
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
				  	document.getElementById("mediaimage").src = data["urlimage"];
				  }
				});
		});

    	downloadMediaFile();
 		
});	
</script>
</html>