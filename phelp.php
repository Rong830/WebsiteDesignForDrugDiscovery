<?php
session_start();
#get the database access credentials
require_once 'login.php';
#get the page that redirects to the front page is not logged in
include 'redir.php';
# this block sends out the header html
echo<<<_HEAD1
<html>
<head>
<link href="style/mybasic.css" rel="stylesheet" type="text/css" />
</head>
<body>
_HEAD1;
#include the file that has the menu code
include 'menuf.php';
echo <<<_TAIL1
<!DOCTYPE html>
<html>
<head>
	<title>COMPLIB Help Page</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<style type="text/css">
		body{
			font-family: optimal, sans-serif;
		}

		.mySlide{display: none;}

	</style>
</head>


<body>


<div id="navDemo" class="w3-bar-block w3-black w3-hide w3-hide-large w3-hide-medium w3-top" style="margin-top:46px">
  <a href="#Manufacturers" class="w3-bar-item w3-button w3-padding-large">Manufacturers</a>
  <a href="#Features" class="w3-bar-item w3-button w3-padding-large">Features</a>
  <a href="#Correlation" class="w3-bar-item w3-button w3-padding-large">Correlation</a>
  <a href="#Compounds" class="w3-bar-item w3-button w3-padding-large">Compounds</a>
  <a href="#Property" class="w3-bar-item w3-button w3-padding-large">Property</a>
  <a href="#catName" class="w3-bar-item w3-button w3-padding-large">catName</a>
  <a href="#Logout" class="w3-bar-item w3-button w3-padding-large">Logout</a>
</div>

<!-- Page content -->
<div class="w3-content" style="max-width:2000px;margin-top:46px">
	<!-- Login/Home -->
	<div class="w3-container w3-content w3-center w3-padding-64" style="max-width:1500px" id="Login">
		<h2 class="w3-wide">Login and Home page<hr></h2>
		<p class="w3-justify">To use the database, you need to login first.<br><br>The first pictures shows the login page. You need to input your forename and surname. Note that only English case letters are allowed, other languages and special characters are not allowed. Then click the 'login' button.<br><br>Once you submit your login information, the page jumps to the database welcome page (shows in the second ficture). <br><br>And then you can click on the red text or "Home'" in the page navigation bar to go to the homepage.<br><br>Brief information about the database is displayed on the home page.<br><br><a href="Home.php" style="color: red">Go back to Database</a><br></p>
      	<div class="w3-row w3-padding-32">
      		<div class="w3-third">
      			<p>Fig1. Login page</p>
      			<img src="./images/1_login.png" class="w3-round w3-margin-bottom" alt="Random Name" style="width:90%">
      		</div>
      		<div class="w3-third">
      			<p>Fig2. Welcome page</p>
      			<img src="./images/2_click.png" class="w3-round" alt="Random Name" style="width:90%">
      		</div>
      		<div class="w3-third">
      			<p>Fig3. Home page</p>
      			<img src="./images/3_home.png" class="w3-round" alt="Random Name" style="width:90%">
      		</div>
      	</div>
	</div><!-- Login/Home -->

	<!-- Stats Manufacturers -->
	<div class="w3-container w3-content w3-center w3-padding-64" style="max-width:1500px" id="Manufacturers">
		<h2 class="w3-wide">Stats by Manufacturers<hr></h2>
		<p class="w3-justify">All the compounds in the database is from five different manufacturers. And for each compound it has 12 basic features.<br><br>This tool provides a wat to demostrate compounds overall features by manufacturers classification.<br><br>You need to choose feature statistics from which one or several manufacturer you want to dispaly.<br><br><a href="Home.php" style="color: red">Go back to Database</a><br></p>
      	<div class="w3-row w3-padding-32">
      			<img src="./images/4_manufacturer_select.png" class="w3-round w3-margin-bottom" alt="Random Name" style="width:60%">
      			<p class="w3-opacity"><i>Fig1. Select Manufacturers.</i></p>
      	</div>
      	<p class="w3-justify">Then click the 'Submit' button. The results will displayed right below.<br><br><a href="Home.php" style="color: red">Go back to Database</a><br></p>
      	<div class="w3-row w3-padding-32">
      			<img src="./images/5_manufacture_result.png" class="w3-round w3-margin-bottom" alt="Random Name" style="width:60%">
      			<p class="w3-opacity"><i>Fig2. Statistics results of compounds features for each manufacturer.</i></p>
      	</div>	
	</div><!-- Stats Manufacturers -->

	<!-- Stats Features -->
	<div class="w3-container w3-content w3-center w3-padding-64" style="max-width:1500px" id="Features">
		<h2 class="w3-wide">Stats by Features<hr></h2>
		<p class="w3-justify">All the compounds from five manufacturers are used to calculate the statistic of 12 features. For this part you can have a overview of the whole database.<br><br><a href="Home.php" style="color: red">Go back to Database</a><br></p>
      	<div class="w3-row w3-padding-32">
      			<img src="./images/7_features_result.png" class="w3-round w3-margin-bottom" alt="Random Name" style="width:60%">
      			<p class="w3-opacity"><i>Fig1. Statistics results of compounds features over the whole database.</i></p>
      	</div>	
	</div><!-- Stats Features -->

	<!-- Stats Correlation -->
	<div class="w3-container w3-content w3-center w3-padding-64" style="max-width:1500px" id="Correlation">
		<h2 class="w3-wide">Stats by Correlation<hr></h2>
		<p class="w3-justify">Here we provide a method to see the correlation between two features.<br><br>Data from all compounds based on the sepecific one or more manufacturers are used to calculate the correlation.<br><br>Step 1 is to select the manufacturers you want to use, and click the 'Submit' button. All the five manufacturers are used by default.<br><br><a href="Home.php" style="color: red">Go back to Database</a><br></p>
      	<div class="w3-row w3-padding-32">
      			<img src="./images/8_correlation_select.png" class="w3-round w3-margin-bottom" alt="Random Name" style="width:60%">
      			<p class="w3-opacity"><i>Fig1. Select Manufacturers to use.</i></p>
      	</div>
      	<p class="w3-justify">The selected manufacturers are marked in red in the text line.<br><br>Step 2 is to choose 2 features. The features' name and their abbriviations are given in the left gray box.<br><br>Then click the 'Submit' button. And the result will be shown.<br><br><a href="Home.php" style="color: red">Go back to Database</a><br></p>
      	<div class="w3-row w3-padding-32">
      			<img src="./images/9_correlation_result.png" class="w3-round w3-margin-bottom" alt="Random Name" style="width:60%">
      			<p class="w3-opacity"><i>Fig2. Select two features and get the correlation result.</i></p>
      	</div>	
	</div><!-- Stats Correlation -->


	<!-- Search compound -->
	<div class="w3-container w3-content w3-center w3-padding-64" style="max-width:1500px" id="Compounds">
		<h2 class="w3-wide">Search by Compounds Stats range<hr></h2>
		<p class="w3-justify">Here we provide a way to search compunds which are satisfied the feature statistic ranges given by the user.<br><br>The fisrt step is to choose manufacturers, and click the 'Submit' button.<br><br>All the five manufacturers are selected by default.<br><br><a href="Home.php" style="color: red">Go back to Database</a><br></p>
      	<div class="w3-row w3-padding-32">
      			<img src="./images/10_compound_select.png" class="w3-round w3-margin-bottom" alt="Random Name" style="width:60%">
      			<p class="w3-opacity"><i>Fig1. Select Manufacturers to use.</i></p>
      	</div>
      	<p class="w3-justify">The selected manufacturers are marked in red in the text line.<br><br>Step 2 is to set the feature statistic range<br><br>The suitable range of each feature is given in the input box. You should be careful not to go out of range.<br><br>Having a overview of these statistics in the three 'Stats' pages are recommanded.<br><br>After setting the range, click the 'Submit' button.<br><br><a href="Home.php" style="color: red">Go back to Database</a><br></p>
      	<div class="w3-row w3-padding-32">
      			<img src="./images/11_compound_setRange.png" class="w3-round w3-margin-bottom" alt="Random Name" style="width:60%">
      			<p class="w3-opacity"><i>Fig2. Set the statistic range of features.</i></p>
      	</div>

      	<p class="w3-justify">The result will be shown in a new page.<br><br>The totoal number of results will be calculated and the results will only show the first 100 pices of information of compounds.<br><br>The last colounm provides a link to show the 2D, 3D and SDF format of the compound. This display will be introduced more in the <b>catName search page.</b><br><br><a href="Home.php" style="color: red">Go back to Database</a><br></p>
      	<div class="w3-row w3-padding-32">
      			<img src="./images/12_compound_result.png" class="w3-round w3-margin-bottom" alt="Random Name" style="width:60%">
      			<p class="w3-opacity"><i>Fig3. Compound search results.</i></p>
      	</div>	
	</div><!-- Stats Correlation -->

	<!-- Search property -->
	<div class="w3-container w3-content w3-center w3-padding-64" style="max-width:1500px" id="Property">
		<h2 class="w3-wide">Search by Property value<hr></h2>
		<p class="w3-justify">The compound have three properties, molecular weight (MW), polar surface area (TPSA) and estimated LogP (XLog).<br><br>Here we provide a way to search compunds by property value. <br><br>The fisrt step is to choose manufacturers, and click the 'Submit' button.<br><br>All the five manufacturers are selected by default.<br><br><a href="Home.php" style="color: red">Go back to Database</a><br></p>
      	<div class="w3-row w3-padding-32">
      			<img src="./images/13_Property_select.png" class="w3-round w3-margin-bottom" alt="Random Name" style="width:60%">
      			<p class="w3-opacity"><i>Fig1. Select Manufacturers to use.</i></p>
      	</div>
      	<p class="w3-justify">The selected manufacturers are marked in red in the text line.<br><br>Step 2 is to choose a property among the three. And set a reasonable value to filter the result.<br><br>To set a suitable value, having a overview of these statistics in the three 'Stats' pages are recommanded.<br><br>After choosing the property and setting the value, then click the 'Submit' button.<br><br><a href="Home.php" style="color: red">Go back to Database</a><br></p>
      	<div class="w3-row w3-padding-32">
      			<img src="./images/14_property_setValue.png" class="w3-round w3-margin-bottom" alt="Random Name" style="width:60%">
      			<p class="w3-opacity"><i>Fig2. Select a property and give a value.</i></p>
      	</div>

      	<p class="w3-justify">The result will be shown in a new page.<br><br>The totoal number of results will be calculated and the results will only show the first 1000 pices of information of compounds.<br><br>The last colounm provides a link to show the 2D, 3D and SDF format of the compound. This display will be introduced more in the <b>catName search page.</b><br><br><a href="Home.php" style="color: red">Go back to Database</a><br></p>
      	<div class="w3-row w3-padding-32">
      			<img src="./images/15_property_result.png" class="w3-round w3-margin-bottom" alt="Random Name" style="width:60%">
      			<p class="w3-opacity"><i>Fig3. Compound search results.</i></p>
      	</div>	
	</div><!-- Stats property -->

	<!-- Search catname -->
	<div class="w3-container w3-content w3-center w3-padding-64" style="max-width:1500px" id="catName">
		<h2 class="w3-wide">Search by Catalogue Name<hr></h2>
		<p class="w3-justify">Each compound have a catalogue name like SPH1-000-419. Here we provide a tool that user can search one specific compound by inputing its catalogue name in the box, and click 'Submit' button.<br><br><a href="Home.php" style="color: red">Go back to Database</a><br></p>
      	<div class="w3-row w3-padding-32">
      			<img src="./images/16_catName_select.png" class="w3-round w3-margin-bottom" alt="Random Name" style="width:60%">
      			<p class="w3-opacity"><i>Fig1. Input a catalogue name.</i></p>
      	</div>
      	<p class="w3-justify">The compound is displayed in three format.<br><br>One is the 2D model along with the molecular string based on the support of <a href="https://www.daylight.com/dayhtml_tutorials/languages/smiles/index.html">SMILES (Simplified Molecular Input Line Entry System).</a><br><br>And the 3D model supported by <a href="http://jmol.sourceforge.net/">JSmol</a>. You can zoom and rotate the model by cliking the 'spin on/off' button or with your mouce.<br><br>Last, we provide the SDF format file of the corresponding compound. It holds the complete molecule coordinates information.<br><br><a href="Home.php" style="color: red">Go back to Database</a><br></p>
      	<div class="w3-row w3-padding-32">
      		<div class="w3-third">
      			<p>SMILES Display</p>
      			<img src="./images/17_SMILE.png" class="w3-round w3-margin-bottom" alt="Random Name" style="width:90%">
      		</div>
      		<div class="w3-third">
      			<p>JSmol Display</p>
      			<img src="./images/18_JSmol.png" class="w3-round" alt="Random Name" style="width:90%">
      		</div>
      		<div class="w3-third">
      			<p>SDF format</p>
      			<img src="./images/19_SDF.png" class="w3-round" alt="Random Name" style="width:90%">
      		</div>
      	</div>
      	<p class="w3-opacity"><i>Fig2. Molecule Display.</i></p>
	</div><!-- Stats catname -->



	<!-- Logout -->
	<div class="w3-container w3-content w3-center w3-padding-64" style="max-width:1500px" id="Logout">
		<h2 class="w3-wide">Logout<hr></h2>
		<p class="w3-justify">You can exit the base by clicking the 'Logout' button, and return to the Login page to re-login the database follow the link provided.<br><br><a href="Home.php" style="color: red">Go back to Database</a><br></p>
	</div><!-- Logout -->
</div>






<script>
// Automatic Slideshow - change image every 4 seconds
var myIndex = 0;
carousel();

function carousel() {
  var i;
  var x = document.getElementsByClassName("mySlides");
  for (i = 0; i < x.length; i++) {
    x[i].style.display = "none";  
  }
  myIndex++;
  if (myIndex > x.length) {myIndex = 1}    
  x[myIndex-1].style.display = "block";  
  setTimeout(carousel, 4000);    
}

// Used to toggle the menu on small screens when clicking on the menu button
function myFunction() {
  var x = document.getElementById("navDemo");
  if (x.className.indexOf("w3-show") == -1) {
    x.className += " w3-show";
  } else { 
    x.className = x.className.replace(" w3-show", "");
  }
}

// When the user clicks anywhere outside of the modal, close it
var modal = document.getElementById('ticketModal');
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}
</script>


</body>
</html>
_TAIL1;
?>
