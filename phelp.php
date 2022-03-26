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
<h1> This is the help Page</h1>

<!-- Help -->
<div class="w3-container w3-padding-64 w3-center" id="Help">
  <h2> About This Website </h2>
  <p> This web using </p>
</div>


<div class="w3-container w3-padding-64 w3-center" id="Main">
<h2> The main functions </h2>

</div>



</pre>
</body>

<p> in this page we provide general help and instrutions on how to use this website</p>
<pre>
  .
  .
  .
  .
</pre>
<h2> Contact Details </h2>
<p> the author of this web site is J. Random User </p>
<p> it is based in part on the demostration web site provided in the course introduction to web site and database design</p>
<p> Images were source from..... </p>
<p> the following javascript libraries were used, library names and source web sites are given </p>
</body>
</html>
_TAIL1;
?>
