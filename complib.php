<?php
session_start();
require_once 'login.php';
echo <<<_HEAD1
<html>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-black.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<!-- ref: https://www.w3schools.com/w3css/tryit.asp?filename=tryw3css_templates_website&stacked=h -->

<style>
.main{
	background-color: #fff;
	border-radius: 20px;
	width: 300px;
	height: 200px;
	margin: auto;
	position: absolute;
	top: 0;
	left: 0;
	right: 0;
	bottom: 0;
}
ref: blog.csdn.net/qq_32623363/article/details/77101971
</style>


<head>
   <meta charset="UTF-8">
   <title> Log In </title>
   <link rel="stylesheet" type="text/css" href="/localdisk/www/html/s2160628/css/login.css"/>
</head>

<body>
_HEAD1;

$db_server = mysql_connect($db_hostname, $db_username, $db_password);

if (!$db_server) die("Unable to connect to database: " . mysql_error());
mysql_select_db($db_database, $db_server) or die("Unable to select database: " . mysql_error());
$query = "select * from Manufacturers";
$result = mysql_query($query);
if (!$result) die("unable to process query: " . mysql_error());
$rows = mysql_num_rows($result);
$mask = 0;
mysql_close($db_server);
for ($j = 0; $j < $rows; ++$j) {
   $mask = (2 * $mask) + 1;
}
$_SESSION['supmask'] = $mask;
// img source: https://www.alamy.com/
echo <<<_EOP
<p id="image_logo"><img src="http://mscidwd.bch.ed.ac.uk/s2160628/images/background.png" style="width:100%;"></p>

<script>
function validate(form) {
fail = ""
if(form.fn.value =="") fail = "Must Give Forname "
if(form.sn.value == "") fail += "Must Give Surname"
if(fail =="") return true
   else {alert(fail); return false}
}
</script>

<div class="main">
<h1 style="text-align: center;
top: 100px;
position: fixed;
font-weight: bold;
width: 100%;
left: 0;
right: 0;"> Welcome to CompLib! </h1>
   <form class="w3-container w3-card-4 w3-padding-16 w3-white" action="indexp.php" method="post" onSubmit="return validate(this)">

      <div class="w3-section">
         <label> First Name </label>
         <input class="w3-input" type="text" name="fn" />
      </div>

      <div class="w3-section">
         <label> Second Name </label>
         <input class="w3-input" type="text" name="sn" />
      </div>

      <input type="submit" class="w3-button w3-right w3-theme" value="Log in" />

   </form>
</div>  
_EOP;

echo <<<_TAIL1
</body>
</html>
_TAIL1;
