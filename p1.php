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

/**
 * Log in to the MySQL database.
 * $db_hostname, $db_username, $db_password, $db_database are set in the login.php.
 */
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
    /**
     * Save the choosen Suppliers into an array. This could be used as a query key in MySQL.
     * @param int $sup The ManuID for each manufacturers, the id in the database is from 1 to 5, so here use $j+1.
     */
    $sup[] = $j+1;
    $sup_name[] = $snm[$j];
    echo " ";
  }
}
echo "<br>Below is the top 3 samples for each Supplier";
echo "</form></div>";

/**
 * Log in to the MySQL database.
 * $db_hostname, $db_username, $db_password, $db_database are set in the login.php.
 */
$db_server = mysql_connect( $db_hostname, $db_username, $db_password );
if ( !$db_server )die( "Unable to connect to database: " . mysql_error() );
mysql_select_db( $db_database, $db_server )or die( "Unable to select database: " . mysql_error() );

/**
 * Add the title for the table.
 */
echo <<<_TABLE1
<div class="table-wrapper" align="bottom" style="position:absolute;top:700px;">
    <table class="fl-table">
        <thead>
        <tr>
            <th> Suppliers </th>
            <th> id </th>
            <th>natm</th>
            <th>ncar</th>
            <th>nnit</th>
            <th>noxy</th>
            <th>nsul</th>
            <th>ncycl</th>
            <th>nhdon </th>
            <th>nhacc</th>
            <th>nrotb</th>
            <th>ManuID</th>
            <th>catn</th>
            <th>mw</th>
            <th>TPSA</th>
            <th>XLogP</th>
        </tr>
        </thead>
        <tbody>
_TABLE1;

for($j = 0 ; $j < sizeof($sup) ; ++$j)
{
  // echo $sup[$j];
  // echo $sup_name[$j];
    // if ($sup[$j]) {
        $query = "SELECT * FROM Compounds WHERE ManuID=$sup[$j] limit 3";
        $result = mysql_query($query);
        if(!$result) die("unable to process query: " . mysql_error());
        // $rows = mysql_fetch_row($result);
        // echo $sup[$j];
        // echo $query;
        // echo $result;
        // echo $row[1];
        while($row = mysql_fetch_row($result)) {
          // echo "编号：".$row[0]."，用户名: " . $row[1]. "<br>";
        
        // echo $row[1];
        // print_r($rows);
        // print_r($rows);
        echo "<tr>";
        echo "<td>";
        echo $sup_name[$j];
        echo "</td>";
        echo '<td>' . $row[0] . '</td>';
        echo '<td>' . $row[1] . '</td>';
        echo '<td>' . $row[2] . '</td>';
        echo '<td>' . $row[3] . '</td>';
        echo '<td>' . $row[4] . '</td>';
        echo '<td>' . $row[5] . '</td>';
        echo '<td>' . $row[6] . '</td>';
        echo '<td>' . $row[7] . '</td>';
        echo '<td>' . $row[8] . '</td>';
        echo '<td>' . $row[9] . '</td>';
        echo '<td>' . $row[10] . '</td>';
        echo '<td>' . $row[11] . '</td>';
        echo '<td>' . $row[12] . '</td>';
        echo '<td>' . $row[13] . '</td>';
        echo '<td>' . $row[14] . '</td>';
        echo "</tr>"; 
        // }
    }
}

echo "</tr> <tbody> </table> </div>";

echo <<<_TAIL1
</div>
</body>
_TAIL1;
// include 'footer.html';
echo "</html>";

?>