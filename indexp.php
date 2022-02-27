<?php
session_start();
if (
  isset($_POST['fn']) &&
  isset($_POST['sn'])
) {
  echo <<<_HEAD1
  <html>
  <head>
    <title> Home Page </title>
  </head>
  <body>
_HEAD1;
  include 'menuf.php';
  $_SESSION['forname'] = $_POST['fn'];
  $_SESSION['surname'] = $_POST['sn'];
  $smask =  $_SESSION['supmask'];
  echo <<<_TAIL1
<pre>

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

_TAIL1;
include 'footer.html';
echo '</html>';
} else {
  header('location: http://mscidwd.bch.ed.ac.uk/s2160628/complib.php');
}
