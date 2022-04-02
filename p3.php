<?php
session_start();
include 'redir.php';
require_once 'login.php';

echo <<<_HEAD1
<html>
<link rel="stylesheet" href="http://mscidwd.bch.ed.ac.uk/s2160628/css/check_box.css">
<link rel="stylesheet" href="http://mscidwd.bch.ed.ac.uk/s2160628/css/table.css">

<style>
.main{
  position: relative;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
}
</style>

<body>
_HEAD1;
include 'menuf.php';
$dbfs = array("natm", "ncar", "nnit", "noxy", "nsul", "ncycl", "nhdon", "nhacc", "nrotb", "mw", "TPSA", "XLogP");
$nms = array("n atoms", "n carbons", "n nitrogens", "n oxygens", "n sulphurs", "n cycles", "n H donors", "n H acceptors", "n rot bonds", "mol wt", "TPSA", "XLogP");
echo <<<_MAIN1
    <pre>
This is the Statistics Page  (not Complete)
    </pre>
_MAIN1;
/**
 * Make a container for user to choose from different manufactures.
 * @param str $snm the manufactures form the SQL database.
 */
echo '<h2 style="text-align: center">Which statics are you interested in. </h2>';
echo '<div class="main" style="top: -200px;"><div class="container"style="position: relative; top:200px;">';
// Below is the check box
echo '<form action="p3.php" method="post" style="display: -webkit-box;display: flex;flex-wrap: wrap;justify-content: center;
-webkit-box-orient: vertical;-webkit-box-direction: normal;flex-direction: row;">';
for ($j = 0; $j < sizeof($dbfs); ++$j) {
  if ($j == 0) {
    echo '<label style="width: 300px">';
    echo '<input type="radio" name="tgval" value="';
    echo $dbfs[$j];
    echo'"/> <span>';
    echo $nms[$j];
    echo '</span> </label>';
    // printf(' %15s <input type="checkbox" name="tgval" value="%s" checked"/>', $nms[$j], $dbfs[$j]);
  } else {
    echo '<label style="width: 300px">';
    echo '<input type="radio" name="tgval" value="';
    echo $dbfs[$j];
    echo'"/> <span>';
    echo $nms[$j];
    echo '</span> </label>';
    // printf(' %15s <input type="checkbox" name="tgval" value="%s"/>', $nms[$j], $dbfs[$j]);
  }
  echo "\n";
}
echo '<p><button type="reset" class="w3-button w3-center"> Reset </button><input type="submit" class="w3-button w3-center w3-theme" value="Done" /></p>';
echo '</form></div>';

echo '<div class="table-wrapper" align="center" style="position:relative;top:300px;">';
if (isset($_POST['tgval'])) {
  $chosen = 0;
  $tgval = $_POST['tgval'];
  for ($j = 0; $j < sizeof($dbfs); ++$j) {
    if (strcmp($dbfs[$j], $tgval) == 0) $chosen = $j;
  }
  /**
   * Add the title for the table.
  */
  printf(" Statistics for %s (%s)<br />\n", $dbfs[$chosen], $nms[$chosen]);
  //Your mysql and statistics calculation goes here
  $db_server = mysql_connect($db_hostname, $db_username, $db_password);
  if (!$db_server) die("Unable to connect to database: " . mysql_error());
  mysql_select_db($db_database, $db_server) or die("Unable to select database: " . mysql_error());
  $query = sprintf("select AVG(%s), STD(%s) from Compounds", $dbfs[$chosen], $dbfs[$chosen]);
  $result = mysql_query($query);
  if (!$result) die("unable to process query: " . mysql_error());
  $row = mysql_fetch_row($result);
  // printf(" Average %f  Standard Dev %f <br />\n", $row[0], $row[1]);
  // Add a tabular to show the statistic result
  echo '<table class="fl-table"><thead><tr>';
  echo '<th> Average </th>';
  echo '<th> Standard Dev </th>';
  echo '</tr></thead><tbody>';

  echo "<tr>";
  echo '<td>' . $row[0] . '</td>';
  echo '<td>' . $row[1] . '</td>';
  echo "</tr>";
  echo "</tbody></table>";


  $chosen = 0;
  $tgval = $_POST['tgval'];
  for($j = 0 ; $j <sizeof($dbfs) ; ++$j) {
      if(strcmp($dbfs[$j],$tgval) == 0) $chosen = $j;            #figure out which radio button was chosen
  }
  $db_server = mysql_connect($db_hostname,$db_username,$db_password);
  if(!$db_server) die("Unable to connect to database: " . mysql_error());
  mysql_select_db($db_database,$db_server) or die ("Unable to select database: " . mysql_error());
  $query = "select * from Manufacturers";                     #get manufacturers
  $result = mysql_query($query);
  if(!$result) die("unable to process query: " . mysql_error());
  $rows = mysql_num_rows($result);
  $smask = $_SESSION['supmask'];
  $firstmn = False;
  $mansel = "(";
  for($j = 0 ; $j < $rows ; ++$j) {              #Figure out the manufacturer clause for the where statement
      $row = mysql_fetch_row($result);
      $sid[$j] = $row[0];
      $snm[$j] = $row[1];
      $sact[$j] = 0;
      $tvl = 1 << ($sid[$j] - 1);
      if($tvl == ($tvl & $smask)) {
          $sact[$j] = 1;
          if($firstmn) $mansel = $mansel." or ";
          $firstmn = True;
          $mansel = $mansel." (ManuID = ".$sid[$j].")";
          }
  }
  $mansel = $mansel.")";
  $comtodo = './histog.py '.$dbfs[$chosen].' "'.$nms[$chosen].'" "'.$mansel.'"';
  // $comtodo = "./histog.py ".$dbfs[$chosen]." \"".$nms[$chosen]."\" \"".$mansel."\"";         #Prepare command to run external program
  // echo $comtodo;
  $output = base64_encode(shell_exec($comtodo));                                             #Run command and capture output converting to base64
  printf('<pre><img src="data:image/gif;base64,%s"></img></pre>',$output);
  }

// Add a footer at the bottom of this page. Since I used relative position, so this footer can adjust to the previous search result.
// I used 'top:300' to make sure this footer won't connect to the end of previous table.
echo <<<_TAIL1
</div></body>
<div class="main" style="top: 300;">
  <footer class="w3-container w3-padding-32 w3-theme-d1 w3-center" style="position: relative;">
    <h4> This is the end </h4>
    <p> Thank you </p>
    <p> Thanks w3schools for the website template </p>
  </footer>
</div>
</html>
_TAIL1;

?>
