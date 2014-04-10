<!DOCTYPE html>
<head>
	<link rel='stylesheet' id=''  href='src/style.css' type='text/css' media='all' />
</head>
<body>
<script src="src/jquery-2.1.0.js"></script>

    
	<div id="container">
    <div id="head">
    	<a href="poi.php"><img src="img/logo.png" style="padding-top: 10px;"/></a>
    </div>         
    
    <div id="primary">
    	<h3>MAIN PANEL</h3>
    	<hr />

        <img src="img/watson.jpg" />
		<br />
    </div>
    
    <div id="content">
        <H3>Create Point of Interest (POI)</H3>
        
		<form>
			<ul>
				<hr />
				
				<li class="field">
							<p>This POI is <span> <a title="Lorem ipsum ad his scripta blandit partiendo, eum fastidii accumsan euripidis in, eum liber hendrerit an. Qui ut wisi vocibus suscipiantur, quo dicit ridens inciderint id. Quo mundi lobortis reformidans eu, legimus senserit definiebas an eos. Eu sit tincidunt incorrupte definitionem, vis mutat affert percipit cu, eirmod consectetuer signiferumque eu per. In usu latine equidem dolores. Quo no falli viris intellegam, ut fugit veritus placerat per.">?</a></span></p>
							<div class="picker" style="float: right; top: -35px;" >
								<select>
									<option value="#" disabled>PUBLIC/NOT PUBLIC POI</option>
									<option>PUBLIC</option>
									<option>NOT PUBLIC</option>
								</select>
							</div>
				</li>	
		<div>
		<center>
		<div class="">
		<a href="#" class="btn">SAVE</a>		
		<a href="#" class="btn">DELETE</a>
		</div>
		</center>
		<br />
		</div>				
				<hr />	
				<li class="field">
								<label class="inline" for="shortname">Short Name * <span> <a title="Lorem ipsum ad his scripta blandit partiendo, eum fastidii accumsan euripidis in, eum liber hendrerit an. Qui ut wisi vocibus suscipiantur, quo dicit ridens inciderint id. Quo mundi lobortis reformidans eu, legimus senserit definiebas an eos. Eu sit tincidunt incorrupte definitionem, vis mutat affert percipit cu, eirmod consectetuer signiferumque eu per. In usu latine equidem dolores. Quo no falli viris intellegam, ut fugit veritus placerat per.">?</a></span></label>
								<input class="input" name="shortname" placeholder="Type Short name here" />
				</li>	
				<li class="field">
								<label class="inline" for="longname">Long Name <span> <a title="Lorem ipsum ad his scripta blandit partiendo, eum fastidii accumsan euripidis in, eum liber hendrerit an. Qui ut wisi vocibus suscipiantur, quo dicit ridens inciderint id. Quo mundi lobortis reformidans eu, legimus senserit definiebas an eos. Eu sit tincidunt incorrupte definitionem, vis mutat affert percipit cu, eirmod consectetuer signiferumque eu per. In usu latine equidem dolores. Quo no falli viris intellegam, ut fugit veritus placerat per.">?</a></span></label>
								<input class="input" name="longname"  placeholder="Type Long name here (optional)" />
				</li>	
				<br /><br />
				<li class="field">
								<label class="inline" for="latitude">Latitude * <span> <a title="Lorem ipsum ad his scripta blandit partiendo, eum fastidii accumsan euripidis in, eum liber hendrerit an. Qui ut wisi vocibus suscipiantur, quo dicit ridens inciderint id. Quo mundi lobortis reformidans eu, legimus senserit definiebas an eos. Eu sit tincidunt incorrupte definitionem, vis mutat affert percipit cu, eirmod consectetuer signiferumque eu per. In usu latine equidem dolores. Quo no falli viris intellegam, ut fugit veritus placerat per.">?</a></span></label>
								<input class="input" name="latitude"  placeholder="Type Latitude here" />
				</li>	
				<li class="field">
								<label class="inline" for="longitude">Longitude * <span> <a title="Lorem ipsum ad his scripta blandit partiendo, eum fastidii accumsan euripidis in, eum liber hendrerit an. Qui ut wisi vocibus suscipiantur, quo dicit ridens inciderint id. Quo mundi lobortis reformidans eu, legimus senserit definiebas an eos. Eu sit tincidunt incorrupte definitionem, vis mutat affert percipit cu, eirmod consectetuer signiferumque eu per. In usu latine equidem dolores. Quo no falli viris intellegam, ut fugit veritus placerat per.">?</a></span></label>
								<input class="input" name="longitude" placeholder="Type Longitude here*" />
				</li>	
				<a href="https://support.google.com/maps/answer/18539?hl=en" target="_blank" style="float: right; padding-right: 20px;" title="Instructions to get Latitude and Longitude">Instructions to get Latitude and Longitude</a>	
				<br /><br />
				
				<li class="field">
								<label class="inline" for="distanceavailable">Unlock range <span> <a title="Lorem ipsum ad his scripta blandit partiendo, eum fastidii accumsan euripidis in, eum liber hendrerit an. Qui ut wisi vocibus suscipiantur, quo dicit ridens inciderint id. Quo mundi lobortis reformidans eu, legimus senserit definiebas an eos. Eu sit tincidunt incorrupte definitionem, vis mutat affert percipit cu, eirmod consectetuer signiferumque eu per. In usu latine equidem dolores. Quo no falli viris intellegam, ut fugit veritus placerat per.">?</a></span><br /> (default is 5 meters)</label>
								<input class="input" name="distanceavailable" placeholder="5" />
				</li>
				<br /><br />	
				<li class="field">
								<label class="inline" for="shortdescription">Short Description <span> <a title="Lorem ipsum ad his scripta blandit partiendo, eum fastidii accumsan euripidis in, eum liber hendrerit an. Qui ut wisi vocibus suscipiantur, quo dicit ridens inciderint id. Quo mundi lobortis reformidans eu, legimus senserit definiebas an eos. Eu sit tincidunt incorrupte definitionem, vis mutat affert percipit cu, eirmod consectetuer signiferumque eu per. In usu latine equidem dolores. Quo no falli viris intellegam, ut fugit veritus placerat per.">?</a></span></label>
								<textarea class="textarea input" placeholder="Type Short description here" rows="5"></textarea>				
				</li>																						
				<li class="field">
								<label class="inline" for="longdescription">Long Description <span> <a title="Lorem ipsum ad his scripta blandit partiendo, eum fastidii accumsan euripidis in, eum liber hendrerit an. Qui ut wisi vocibus suscipiantur, quo dicit ridens inciderint id. Quo mundi lobortis reformidans eu, legimus senserit definiebas an eos. Eu sit tincidunt incorrupte definitionem, vis mutat affert percipit cu, eirmod consectetuer signiferumque eu per. In usu latine equidem dolores. Quo no falli viris intellegam, ut fugit veritus placerat per.">?</a></span></label>
								<textarea class="textarea input" placeholder="Type Long description here" rows="5"></textarea>				
				</li>
				<br /><br />	
				
							
				<hr />
				<br />
				<li>
								<form action='' method='POST' enctype='multipart/form-data'>
								<label class="inline" for="longdescription">Main image (to quickly identify this POI): <span> <a title="Lorem ipsum ad his scripta blandit partiendo, eum fastidii accumsan euripidis in, eum liber hendrerit an. Qui ut wisi vocibus suscipiantur, quo dicit ridens inciderint id. Quo mundi lobortis reformidans eu, legimus senserit definiebas an eos. Eu sit tincidunt incorrupte definitionem, vis mutat affert percipit cu, eirmod consectetuer signiferumque eu per. In usu latine equidem dolores. Quo no falli viris intellegam, ut fugit veritus placerat per.">?</a></span></label>
								
							    <input type='file' name='userFile' style="padding-left: 200px;"><br>
							    <input type='submit' name='upload_btn' value='upload' style="float: right;">
								</form>	
								<br /><br />
								<img src="img/poi-img.jpg" style=" padding-left: 240px;"/><br /><a href="#" style="padding-left: 240px;" ></a>
								
				</li>
				<br />
				
				<hr />
					
			</ul>
		</form>
		<p>Add POI Media Files <span> <a title="Lorem ipsum ad his scripta blandit partiendo, eum fastidii accumsan euripidis in, eum liber hendrerit an. Qui ut wisi vocibus suscipiantur, quo dicit ridens inciderint id. Quo mundi lobortis reformidans eu, legimus senserit definiebas an eos. Eu sit tincidunt incorrupte definitionem, vis mutat affert percipit cu, eirmod consectetuer signiferumque eu per. In usu latine equidem dolores. Quo no falli viris intellegam, ut fugit veritus placerat per.">?</a></span></p>
		<p style="padding-left: 240px;"><a href="addmedia.php" class="btn">ADD FILE</a>	</p>
		<p>List of Media Files <span> <a title="Lorem ipsum ad his scripta blandit partiendo, eum fastidii accumsan euripidis in, eum liber hendrerit an. Qui ut wisi vocibus suscipiantur, quo dicit ridens inciderint id. Quo mundi lobortis reformidans eu, legimus senserit definiebas an eos. Eu sit tincidunt incorrupte definitionem, vis mutat affert percipit cu, eirmod consectetuer signiferumque eu per. In usu latine equidem dolores. Quo no falli viris intellegam, ut fugit veritus placerat per.">?</a></span></p>
		<ul>
			<li><a href="http://javakafe.com/location-based_App/cms_project/addmedia.php">Media file 1</a></li>
			<li><a href="http://javakafe.com/location-based_App/cms_project/addmedia.php">Media file 2</a></li>
			<li><a href="http://javakafe.com/location-based_App/cms_project/addmedia.php">Media file 3</a></li>
		</ul>
		<br />
		<hr />
		
	<a id="displayText" href="javascript:toggle();">Show Control Panel for Automatic Values</a> 
	<div id="toggleText" style="display: none; list-style: none;">
		<br />	
		<p>These values should be set automatically and probably do not need to be edited:</p>
				<li class="field">
							<p>Is this the first POI in the walk? <span> <a title="Lorem ipsum ad his scripta blandit partiendo, eum fastidii accumsan euripidis in, eum liber hendrerit an. Qui ut wisi vocibus suscipiantur, quo dicit ridens inciderint id. Quo mundi lobortis reformidans eu, legimus senserit definiebas an eos. Eu sit tincidunt incorrupte definitionem, vis mutat affert percipit cu, eirmod consectetuer signiferumque eu per. In usu latine equidem dolores. Quo no falli viris intellegam, ut fugit veritus placerat per.">?</a></span></p>
							<div class="picker" style="float: right; top: -35px;" >
								<select>
									<option value="#" disabled>YES/NO</option>
									<option>YES</option>
									<option>NO</option>
								</select>
							</div>
				</li>	
				<li class="field">
							<p>Is this the last POI in the walk? <span> <a title="Lorem ipsum ad his scripta blandit partiendo, eum fastidii accumsan euripidis in, eum liber hendrerit an. Qui ut wisi vocibus suscipiantur, quo dicit ridens inciderint id. Quo mundi lobortis reformidans eu, legimus senserit definiebas an eos. Eu sit tincidunt incorrupte definitionem, vis mutat affert percipit cu, eirmod consectetuer signiferumque eu per. In usu latine equidem dolores. Quo no falli viris intellegam, ut fugit veritus placerat per.">?</a></span></p>
							<div class="picker" style="float: right; top: -35px;" >
								<select>
									<option value="#" disabled>YES/NO</option>
									<option>YES</option>
									<option>NO</option>
								</select>
							</div>
				</li>
				<li class="field">
								<label class="inline" for="parent">Parent POI ID <span> <a title="Lorem ipsum ad his scripta blandit partiendo, eum fastidii accumsan euripidis in, eum liber hendrerit an. Qui ut wisi vocibus suscipiantur, quo dicit ridens inciderint id. Quo mundi lobortis reformidans eu, legimus senserit definiebas an eos. Eu sit tincidunt incorrupte definitionem, vis mutat affert percipit cu, eirmod consectetuer signiferumque eu per. In usu latine equidem dolores. Quo no falli viris intellegam, ut fugit veritus placerat per.">?</a></span></label>
								<input class="input" name="parent" placeholder="ID" />
				</li>	
	</div>
		
	<hr />
		<center>
		<div class="">
		<a href="#" class="btn">SAVE</a>		
		<a href="#" class="btn">DELETE</a>
		</div>
		</center>
		<br />
    </div>
    
    <div id="secondary">
    	<h3>POIs in this walk </h3>
    	
    	<br />
    	    	<center><a href="#" class="btn">ADD POI</a></center>
        <br />
        <center>
        <div>
        	<ul>
        		<li><img src="img/poi-img.jpg" /><br /><a href="#">POI Name</a> </li>
        		<hr />
        		<li><img src="img/poi-img.jpg" /><br /><a href="#">POI Name</a> </li>
        		<hr />
        		<li><img src="img/poi-img.jpg" /><br /><a href="#">POI Name</a> </li>
        		<hr />
        		<li><img src="img/poi-img.jpg" /><br /><a href="#">POI Name</a> </li>
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
			function toggle() {
				var ele = document.getElementById("toggleText");
				var text = document.getElementById("displayText");
				if(ele.style.display == "block") {
			    		ele.style.display = "none";
					text.innerHTML = "Show Control Panel for Default Values";
			  	}
				else {
					ele.style.display = "block";
					text.innerHTML = "Hide Control Panel for Default Values";
				}
			} 
			</script>
 
</html>