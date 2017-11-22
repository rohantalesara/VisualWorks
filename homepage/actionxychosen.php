
<?php
session_start();
$uploadOk=$_SESSION['uploadOk'];
$nameoffile=$_SESSION['nameoffile'];
extract($_POST);
$file=fopen("C:/xampp/htdocs/WT/xy.txt","w");
fwrite($file,$x);
fwrite($file,"\n");
fwrite($file,$y);
fclose($file);
if($plottype=='Scatter Plot'){
    exec('jupyter nbconvert --execute --inplace --to notebook C:/xampp/htdocs/WT/notebooks/scatterplot.ipynb');
}
else if($plottype=='Histogram'){
    exec('jupyter nbconvert --execute --inplace --to notebook C:/xampp/htdocs/WT/notebooks/histogram.ipynb');
}
else if($plottype=='Pie Chart'){
    exec('jupyter nbconvert --execute --inplace --to notebook C:/xampp/htdocs/WT/notebooks/piechart.ipynb');
}
else if($plottype=='Bar Chart'){
    exec('jupyter nbconvert --execute --inplace --to notebook C:/xampp/htdocs/WT/notebooks/barplot.ipynb');
}
else if($plottype=='Line Chart'){
    exec('jupyter nbconvert --execute --inplace --to notebook C:/xampp/htdocs/WT/notebooks/linechart.ipynb');
}
else{
    exec('jupyter nbconvert --execute --inplace --to notebook C:/xampp/htdocs/WT/notebooks/boxplot.ipynb');
}

?>
<!DOCTYPE html>
<html lang="en">
    
    <head>
        <meta width="device-width" name="viewport">
        <title>Plot Area</title>
        <link rel="stylesheet" type="text/css" href="plotpage.css"/>

        <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.2.1.min.js"></script>
        <script>
            $(document).ready(function(){
                $("#choosefile").text("<?php echo  $nameoffile?>");
            });
        </script>
    </head>

    <body>
        <img src="/WT/homepage/plot.jpeg" height="60%" width="60%" style="position: absolute;margin-left: 35%;margin-top: 10%;border: 2px solid black;">
        <div class="v2"></div>
        <div class="vl">
            <nav class="navbar" id="navbar">
                <a href="home.html" class="linkback">Home</a>
                <a href="help.html" class="linkback">Help</a>
                <a href="home.htm#aboutl" class="linkback">About Us</a>
                <a href="home.html#contact" class="linkback">Contact Us</a>
            </nav>
            <p id="load" class="lighttext" style="margin-top: 60%;visibility: hidden;">Loading...</p>
        </div>

        <form action="chooseaction.php" method="post" enctype="multipart/form-data">
        <div class="b1">
            <label id="choosefile" class="fileinput">File Chosen<input type="file" onclick="document.querySelector('#filesubmit').removeAttribute('disabled');" class="button button1" name="fileToUpload" id="fileToUpload"></label>
            <br><br>
    		<input type="submit" disabled="disabled" class="button button1" id="filesubmit" value="Upload csv" name="submit">


        </div>
    	</form>
        

        <form action="actionxychosen.php" method="post">
            <div class="b2">

                <div class="dropdown">

                    <input type="text" name="plottype" value="Choose Action" id="btn2" class="button button2" style="width:70%" readonly="readonly">

                    <div class="dropdown-content">

                        <a href="#" onclick="test(event)">Pie Chart</a>

                        <a href="#" onclick="test(event)">Histogram</a>

                        <a href="#" onclick="test(event)">Bar Chart</a>

                        <a href="#" onclick="test(event)">Line Chart</a>

                        <a href="#" onclick="test(event)">Scatter Plot</a>

                        <a href="#" onclick="test(event)">Box Plot</a>

                    </div>
                </div>
            </div>

            <div class="x">
                <div class="dropdown">
                    <input type="text" name="x" value="x" id="x" class="button button2" style="width:25%;" readonly="readonly">

                    <div class="dropdown-content" id="xdropdown">
                    </div>

                </div>
            </div>

            <div class="y">
                <div class="dropdown">
                    <input type="text" name="y" value="y" id="y" class="button button2" style="width:25%;" readonly="readonly">

                    <div class="dropdown-content" id="ydropdown">
                        <a href="#" onclick="document.querySelector('#y').value='None'">None</a>
                    </div>
                
                </div>
            </div>


            <div class="b3">

                <input type="submit" id="plot" value="Plot  >>" class="button button3" onclick="justtext()">

            </div>
        </form>


        <script type="text/javascript">
            
            var xdropdown=document.querySelector("#xdropdown");
            var ydropdown=document.querySelector("#ydropdown");
            var uploadok=<?php echo $uploadOk?>;
            var changed=0;

            if(uploadok==1){
                <?php $fp=fopen("C:/xampp/htdocs/WT/CSVUpload/thefile.csv","r");
                $cols=explode("," , fgets($fp));
                $i=0;
                ?>
                var javarr=<?php echo json_encode($cols); ?>;
                var numofcols=<?php echo sizeof($cols) ?>;
                
                for(var count=0;count<numofcols;count++){
                    var content=javarr[count];

                    xdropdown.appendChild(document.createElement("a"));
                    xdropdown.lastChild.setAttribute("href","#");
                    xdropdown.lastChild.innerHTML=content;
                    xdropdown.lastChild.onclick=function (e){document.querySelector("#x").value=e.target.innerHTML;};
                    
                    ydropdown.appendChild(document.createElement("a"));
                    ydropdown.lastChild.setAttribute("href","#");
                    ydropdown.lastChild.innerHTML=content;
                    ydropdown.lastChild.onclick=function (e){document.querySelector("#y").value=e.target.innerHTML;};
                       
                }
            }

            function test(e){
                document.getElementById('btn2').value=e.target.innerHTML;
            
                if(e.target.innerHTML=='Pie Chart' || e.target.innerHTML=='Box Plot' || e.target.innerHTML=='Histogram'){
                    document.getElementById("ydropdown").style.visibility="hidden";
                    document.getElementById("x").style.position="relative";
                    document.getElementById("y").style.zIndex="-1";
                    document.getElementById("x").style.marginLeft="36%";
                    document.getElementById("y").style.marginLeft="-36%";
                    document.getElementById("y").style.visibility="hidden";
                    changed=1;
                }
                else if(changed==1){
                    document.getElementById("ydropdown").style.visibility="visible";
                    document.getElementById("y").style.zIndex="0";
                    document.getElementById("x").style.marginLeft="2%";
                    document.getElementById("y").style.marginLeft="3.5%";
                    document.getElementById("y").style.visibility="visible";
                    document.getElementById("x").style.position="static";
                    changed=0;
                }
            }

            function justtext(){
                document.querySelector("#load").style.visibility="visible";
            }

        </script>

    </body>


</html>

