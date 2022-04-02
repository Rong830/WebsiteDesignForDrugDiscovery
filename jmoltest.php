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
This illustrates that the applet
<span id=mydiv></span>
is inline 
<p>

<a href="javascript:Jmol.script(jmolApplet0, 'spin on')">spin on</a>

<a href="javascript:Jmol.script(jmolApplet0, 'spin off')">spin off</a>
</p>
</body>
</html>
_endpage;
?>
