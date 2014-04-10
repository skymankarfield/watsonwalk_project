<!DOCTYPE html>
<head>
	<link rel='stylesheet' id=''  href='src/style.css' type='text/css' media='all' />
</head>
<body>
<script src="js/jquery-1.10.2.min.js"></script>
<?
include("connect_db.php");
?>


    
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
		<a href="#" class="btn">SAVE</a>		
		<a href="#" class="btn">DELETE</a>
		</div>
		</center>
		<br />
		</div>
		<form>
			<ul>
				
				<li class="field">
								<label class="inline" for="title">Title * <span> <a title="Lorem ipsum ad his scripta blandit partiendo, eum fastidii accumsan euripidis in, eum liber hendrerit an. Qui ut wisi vocibus suscipiantur, quo dicit ridens inciderint id. Quo mundi lobortis reformidans eu, legimus senserit definiebas an eos. Eu sit tincidunt incorrupte definitionem, vis mutat affert percipit cu, eirmod consectetuer signiferumque eu per. In usu latine equidem dolores. Quo no falli viris intellegam, ut fugit veritus placerat per.">?</a></span></label>
								<input class="input" name="shortname" placeholder="Type Title" />
				</li>				
				<li class="field">
								<label class="inline" for="shortname">Caption * <span> <a title="Lorem ipsum ad his scripta blandit partiendo, eum fastidii accumsan euripidis in, eum liber hendrerit an. Qui ut wisi vocibus suscipiantur, quo dicit ridens inciderint id. Quo mundi lobortis reformidans eu, legimus senserit definiebas an eos. Eu sit tincidunt incorrupte definitionem, vis mutat affert percipit cu, eirmod consectetuer signiferumque eu per. In usu latine equidem dolores. Quo no falli viris intellegam, ut fugit veritus placerat per.">?</a></span></label>
								<input class="input" name="shortname" placeholder="Type Caption" />
				</li>	
																							
				<li class="field">
								<label class="inline" for="longdescription">Description * <span> <a title="Lorem ipsum ad his scripta blandit partiendo, eum fastidii accumsan euripidis in, eum liber hendrerit an. Qui ut wisi vocibus suscipiantur, quo dicit ridens inciderint id. Quo mundi lobortis reformidans eu, legimus senserit definiebas an eos. Eu sit tincidunt incorrupte definitionem, vis mutat affert percipit cu, eirmod consectetuer signiferumque eu per. In usu latine equidem dolores. Quo no falli viris intellegam, ut fugit veritus placerat per.">?</a></span></label>
								<textarea class="textarea input" placeholder="Type Description" rows="5"></textarea>				
				</li>
				<li class="field">
								<label class="inline" for="shortname">Rights and Permissions <span> <a title="Lorem ipsum ad his scripta blandit partiendo, eum fastidii accumsan euripidis in, eum liber hendrerit an. Qui ut wisi vocibus suscipiantur, quo dicit ridens inciderint id. Quo mundi lobortis reformidans eu, legimus senserit definiebas an eos. Eu sit tincidunt incorrupte definitionem, vis mutat affert percipit cu, eirmod consectetuer signiferumque eu per. In usu latine equidem dolores. Quo no falli viris intellegam, ut fugit veritus placerat per.">?</a></span></label>
								<input class="input" name="shortname" placeholder="Type Rights and Permissions" />
				</li>
				<li class="field">
								<label class="inline" for="longdescription">Notes <span> <a title="Lorem ipsum ad his scripta blandit partiendo, eum fastidii accumsan euripidis in, eum liber hendrerit an. Qui ut wisi vocibus suscipiantur, quo dicit ridens inciderint id. Quo mundi lobortis reformidans eu, legimus senserit definiebas an eos. Eu sit tincidunt incorrupte definitionem, vis mutat affert percipit cu, eirmod consectetuer signiferumque eu per. In usu latine equidem dolores. Quo no falli viris intellegam, ut fugit veritus placerat per.">?</a></span></label>
								<textarea class="textarea input" placeholder="Type Notes" rows="5"></textarea>				
				</li>								
				
				<li>
								<form action='' method='POST' enctype='multipart/form-data'>
								<label class="inline" for="longdescription">SELECT FILE * <span> <a title="Lorem ipsum ad his scripta blandit partiendo, eum fastidii accumsan euripidis in, eum liber hendrerit an. Qui ut wisi vocibus suscipiantur, quo dicit ridens inciderint id. Quo mundi lobortis reformidans eu, legimus senserit definiebas an eos. Eu sit tincidunt incorrupte definitionem, vis mutat affert percipit cu, eirmod consectetuer signiferumque eu per. In usu latine equidem dolores. Quo no falli viris intellegam, ut fugit veritus placerat per.">?</a></span></label>
							    <input type='file' name='userFile' style="padding-left: 200px;"><br>
							    <input type='submit' name='upload_btn' value='upload' style="float: right;">
								</form>	
				</li>

				<br />
					
			</ul>
		</form>
		<hr />
		<center>
		<div class="">
		<a href="#" class="btn">SAVE</a>		
		<a href="#" class="btn">DELETE</a>
		</div>
		</center>
		<br />
    </div>
    
    <div id="secondary" style="padding-bottom: 500px;">
        <h3>Media Files</h3>
        <br />
            	<center><a href="#" class="btn">ADD FILE</a></center>
        <br />
        <center>
        <div>
		<ul>
			<li><a target="_blank">Media file 1</a></li>
			<li><a target="_blank">Media file 2</a></li>
			<li><a target="_blank">Media file 3</a></li>
		</ul>
		<hr />
        </div>
        </center>
    </div>
    
</div>

</body>
    <div id="footer">
        <p>Watson Walk CMS</p>
    </div>
</html>