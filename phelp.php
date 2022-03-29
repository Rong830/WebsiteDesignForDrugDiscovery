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
<!-- Help -->
<div class="w3-container w3-padding-64 w3-center" id="Help">
  <h1> This is the Help Page</h1>
  <p> In this page we provide general help and instrutions on how to use this website</p>

  <h2> About This Website </h2>
  <p> This website is connected with a MySQL database about compounds that allow users to search compound information. This website supports many kinds of search methods. The details are below.</p> 
  <p> Before using any functionality within the website, users need to log in by inputting their first and second names. </p>
</div>


<div class="w3-row-padding w3-padding-64 w3-theme-l1" id="work">
<div class="w3-quarter">
<h2>Before Starting</h2>
<p>This website is a compounds library. The data are extracted from structure-data files and made into three tabular forms. The tables are the compounds' molecular information, manufacturers, and smiles string.
</p>
</div>

<div class="w3-quarter">
<div class="w3-card w3-white">
  <img src="/w3images/snow.jpg" alt="Snow" style="width:100%">
  <div class="w3-container">
    <h3>Customer 1</h3>
    <h4>Trade</h4>
    <p>Blablabla</p>
    <p>Blablabla</p>
    <p>Blablabla</p>
    <p>Blablabla</p>
  </div>
  </div>
</div>

<div class="w3-quarter">
<div class="w3-card w3-white">
  <img src="/w3images/lights.jpg" alt="Lights" style="width:100%">
  <div class="w3-container">
  <h3>Customer 2</h3>
  <h4>Trade</h4>
  <p>Blablabla</p>
  <p>Blablabla</p>
  <p>Blablabla</p>
  <p>Blablabla</p>
  </div>
  </div>
</div>

<div class="w3-quarter">
<div class="w3-card w3-white">
  <img src="/w3images/mountains.jpg" alt="Mountains" style="width:100%">
  <div class="w3-container">
  <h3>Customer 3</h3>
  <h4>Trade</h4>
  <p>Blablabla</p>
  <p>Blablabla</p>
  <p>Blablabla</p>
  <p>Blablabla</p>
  </div>
  </div>
</div>

</div>



<div class="w3-container w3-padding-64 w3-center" id="Main">
<h2> The main functions </h2>

</div>

<div class="w3-container w3-padding-64 w3-center" id="Main">
<h2> Contact Details </h2>
<p> The author of this web site is B200735 </p>
<p> It is based in part on the demostration web site provided in the course introduction to web site and database design</p>
</div>

</body>

<!-- Footer -->
<footer class="w3-container w3-padding-32 w3-theme-d1 w3-center" style="position: relative;">
    <h4> This is the end </h4>
    <p> Thank you </p>
    <p> Thanks w3schools for the website template </p>
</footer>

</html>
_TAIL1;
?>
