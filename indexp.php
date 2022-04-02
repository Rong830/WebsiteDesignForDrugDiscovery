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
<img src="http://mscidwd.bch.ed.ac.uk/s2160628/images/header_background.jpg" style="width:100%;">
<div align="center">
<h1>Welcome to this website!</h1>
<p>You can start your searching and find more information about the database by cliking on the links!</p>

<p>For more information and guidance, you can click: <a href=="http://mscidwd.bch.ed.ac.uk/s2160628/phelp.php"> About this website </a></p>

<p>Choose the Suppliers that you are interested in by clicking: <a href="http://mscidwd.bch.ed.ac.uk/s2160628/p1.php"> Select Suppliers </a></p>

<p>Filtering compounds by its atom numbers clicking: <a href="http://mscidwd.bch.ed.ac.uk/s2160628/p2.php"> Search Compounds </a></p>

<p>Find out the statistics about the database, you can click: <a href="http://mscidwd.bch.ed.ac.uk/s2160628/p3.php"> Stats </a></p>

<p>Visualizing and looking for the correlation between features go here: <a href="http://mscidwd.bch.ed.ac.uk/s2160628/p4.php"> Correlations </a></p>

<p><a href="http://mscidwd.bch.ed.ac.uk/s2160628/p8a.php"> Properties by Manufacturer </a></p>

<p>If you are interested in the <a href="http://mscidwd.bch.ed.ac.uk/s2160628/p10b.php"> Property search </a></p>

<p>Click here to exit: <a href="http://mscidwd.bch.ed.ac.uk/s2160628/p5.php"> Exit </a></p>
</div>
</body>
</html>

_TAIL1;
include 'footer.html';
echo '</html>';
} else {
  header('location: http://mscidwd.bch.ed.ac.uk/s2160628/complib.php');
}
