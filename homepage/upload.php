<!DOCTYPE html>
<html lang="en">
    
    <head>
    	<meta width="device-width" name="viewport">
        <title>Upload a file</title>
        <link rel="stylesheet" type="text/css" href="plotpage.css"/>
    </head>

    <body>
    	<div class="v2"></div>
        <div class="vl">
        	<nav class="navbar" id="navbar">
	        	<a href="home.html" class="linkback">Home</a>
	        	<a href="help.html" class="linkback">Help</a>
	        	<a href="home.html#about" class="linkback">About Us</a>
	        	<a href="home.html#contact" class="linkback">Contact Us</a>
	    	</nav>
	    	<p class="lighttext">Board</p>
	    	
        </div>

        <form action="chooseaction.php" method="post" enctype="multipart/form-data">
        <div class="b1">
            <label class="fileinput">Choose File<input type="file" class="button button1" name="fileToUpload" id="fileToUpload" onmousedown="document.querySelector('#filesubmit').removeAttribute('disabled');"></label>
            <br><br>
    		<input type="submit" disabled="disabled" class="button button1" id="filesubmit" value="Upload csv" name="submit" onclick="updatelabel(event)">


        </div>
    	</form>
        
        <div class="b2">

	        <div class="dropdown">

	            <button id="btn2" class="button button2">Choose Action</button>

	            <div class="dropdown-content">

	                <a href="#" onclick="document.getElementById('btn2').innerHTML='Pie Chart'">Pie Chart</a>

	                <a href="#" onclick="document.getElementById('btn2').innerHTML='Histogram'">Histogram</a>

	                <a href="#" onclick="document.getElementById('btn2').innerHTML='Bar Chart'">Bar Chart</a>

	                <a href="#" onclick="document.getElementById('btn2').innerHTML='Line Chart'">Line Chart</a>

	                <a href="#" onclick="document.getElementById('btn2').innerHTML='Scatter Plot'">Scatter Plot</a>

	                <a href="#" onclick="document.getElementById('btn2').innerHTML='Box Plot'">Box Plot</a>

	            </div>     
	        </div>
        </div>

        

        <div class="b3">

        <button type="button" class="button button3">Plot &nbsp;&nbsp;>></button>

        </div>
    </body>

    

</html>

