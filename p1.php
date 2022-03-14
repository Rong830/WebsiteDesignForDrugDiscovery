<?php
session_start();
require_once 'login.php';
include 'redir.php';
echo <<<_HEAD1
<html>
<link rel="stylesheet" href="http://mscidwd.bch.ed.ac.uk/s2160628/css/check_box.css">
<link rel="stylesheet" href="http://mscidwd.bch.ed.ac.uk/s2160628/css/table.css">

<head>
  <title> Suppliers Information </title>
</head>

<body>
_HEAD1;

include 'menuf.php';

$db_server = mysql_connect($db_hostname, $db_username, $db_password);
if (!$db_server) die("Unable to connect to database: " . mysql_error());
mysql_select_db($db_database, $db_server) or die("Unable to select database: " . mysql_error());
$query = "select * from Manufacturers";
$result = mysql_query($query);
if (!$result) die("unable to process query: " . mysql_error());
$rows = mysql_num_rows($result);
$smask = $_SESSION['supmask'];
for ($j = 0; $j < $rows; ++$j) {
  $row = mysql_fetch_row($result);
  $sid[$j] = $row[0];
  $snm[$j] = $row[1];
  $sact[$j] = 0;
  $tvl = 1 << ($sid[$j] - 1);
  if ($tvl == ($tvl & $smask)) {
    $sact[$j] = 1;
  }
}
if (isset($_POST['supplier'])) {
  $supplier = $_POST['supplier'];
  $nele = sizeof($supplier);
  for ($k = 0; $k < $rows; ++$k) {
    $sact[$k] = 0;
    for ($j = 0; $j < $nele; ++$j) {
      if (strcmp($supplier[$j], $snm[$k]) == 0) $sact[$k] = 1;
    }
  }
  $smask = 0;
  for ($j = 0; $j < $rows; ++$j) {
    if ($sact[$j] == 1) {
      $smask = $smask + (1 << ($sid[$j] - 1));
    }
  }
  $_SESSION['supmask'] = $smask;
}

/**
 * Make a container for user to choose from different manufactures.
 * @param str $snm the manufactures form the SQL database.
 */
echo '<div class="container"> <form action="p1.php" method="post" style="display: -webkit-box;display: flex;flex-wrap: wrap;-webkit-box-orient: vertical;-webkit-box-direction: normal;flex-direction: column;">';
echo '<h2> Select the manufactures that you are interseted in. </h2>';
for($j = 0 ; $j < $rows ; ++$j)
{
  echo '<label> <input type="checkbox" name="supplier[]" value="';
  echo $snm[$j];
  echo'"/> <span>';
  echo $snm[$j];
  echo'</span> </label>';
}

/**
 * Make two button for user to reset the choices or submit the chossen manufactures.
 */
echo <<<_BODY1
<p>
  <button type="reset" class="w3-button w3-center"> Reset </button>
  <input type="submit" class="w3-button w3-center w3-theme" value="Done" />
</p>


_BODY1;

/**
 * Show the cuttent manufactures.
 * @param int $sact Whether the user have choosed this manufacture.
 */
echo '<div style="position: abusolute; top=20px;"> Currently selected Suppliers: ';
for ($j = 0; $j < $rows; ++$j) {
  if ($sact[$j] == 1) {
    echo $snm[$j];
    echo " ";
  }
}

echo <<<_TAIL1
</form> 
</div>
</div>
</body>
</html>
_TAIL1;
?>