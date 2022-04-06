<?php
session_start();
include 'redir.php';
echo <<<_HEAD1
<html>
<body>
_HEAD1;
$fn = $_SESSION['forname'];
echo <<<_MAIN1
<p id="image_logo"><img src="http://mscidwd.bch.ed.ac.uk/s2160628/images/background.png" style="width:100%;"></p>

<div class="main">
<h1 style="text-align: center;
top: 200px;
position: fixed;
font-weight: bold;
width: 100%;
left: 0;
right: 0;"> Goodbye  $fn; </h1>

<h1 style="text-align: center;
top: 300px;
position: fixed;
font-weight: bold;
width: 100%;
left: 0;
right: 0;"> You have now exited Complib </h1>

_MAIN1;
$_SESSION = array();
if (session_id() != "" || isset($_COOKIE[session_name()]))
  setcookie(session_name(), '', time() - 2592000, '/');
session_destroy();
echo <<<_TAIL1
</pre>
</body>
</html>
_TAIL1;
