<?php
session_start();
require_once 'login.php';
include 'redir.php';
$cid = 1;
if(isset($_GET['cid'])) {
  $cid = $_GET['cid'];
}
echo <<<_endstart
<!DOCTYPE html>
<html>
<head>
<title>JSmol demo with DB access</title>
<meta charset="utf-8">
<script type="text/javascript" src="jsmol/JSmol.min.js"></script>

<script type="text/javascript"> 
$(document).ready(function() {
Info = {
	width: 400,
	height: 400,
	debug: false,
	j2sPath: "../s2160628/jsmol/j2s",
	color: "0xC0C0C0",
    disableJ2SLoadMonitor: true,
    disableInitialConsole: true,
	addSelectionOptions: false,
        readyFunction: null,
        src: "http://mscidwd.bch.ed.ac.uk/s2160628/getmol_resp.php?cid=$cid"

}
$("#mydiv").html(Jmol.getAppletHtml("jmolApplet0",Info))
});
</script>

</head>
<body>
_endstart;
include 'menuf.php';
echo <<<_endpage
<div class="w3-container w3-content w3-center w3-padding-64" style="max-width:1500px">
	<h2 class="w3-wide">3D Structure Display</h2>
	<p>
	This illustrates that the applet
	</p>

	<div align="center"><span id=mydiv></span></div>
	is inline 
	<p>
	<a href="javascript:Jmol.script(jmolApplet0, 'spin on')">spin on</a>
	<a href="javascript:Jmol.script(jmolApplet0, 'spin off')">spin off</a>
	<br><br>
	</p>

	<p><a href="http://mscidwd.bch.ed.ac.uk/s2160628/p2.php" style="color: blue">Go Back to Search Compounds Page</a><br></p>
</div>
</body>
<!-- Footer -->
<footer class="w3-container w3-padding-32 w3-theme-d1 w3-center" style="position: relative;">
	<h4> This is the end </h4>
	<p> Thank you </p>
	<p> Thanks w3schools for the website template </p>
</footer>
</html>
_endpage;
?>
