<?php
session_start();
include 'redir.php';
require_once 'login.php';
// Set the style sheet
echo<<<_HEAD1
<html>

<link rel="stylesheet" href="http://mscidwd.bch.ed.ac.uk/s2160628/css/check_box.css">
<link rel="stylesheet" href="http://mscidwd.bch.ed.ac.uk/s2160628/css/table.css">
<link rel="stylesheet" href="http://mscidwd.bch.ed.ac.uk/s2160628/css/highlight-9.5.0.min.css">
<link rel="stylesheet" href="http://mscidwd.bch.ed.ac.uk/s2160628/css/checkbix.min.css">
<link rel="stylesheet" href="http://mscidwd.bch.ed.ac.uk/s2160628/css/demo.css">


<style>
.main{
  position: relative;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
}
</style>

<head>
</head>
<body>
_HEAD1;
include 'menuf.php';
$dbfs = array("natm","ncar","nnit","noxy","nsul","ncycl","nhdon","nhacc","nrotb","mw","TPSA","XLogP");
$nms = array("n atoms","n carbons","n nitrogens","n oxygens","n sulphurs","n cycles","n H donors","n H acceptors","n rot bonds","mol wt","TPSA","XLogP");
echo <<<_MAIN1
    <pre>
This is the correlation Page  
    </pre>
_MAIN1;
// The input radio form
echo '<h2 style="text-align: center">Choose two correlation that you are interested in </h2>';
echo '<div class="main" style="top: -200px;"><div class="container"style="position: relative; top:300px;">';
echo '<form action="p4.php" method="post" style="display: -webkit-box;display: flex;flex-wrap: wrap;-webkit-box-orient: vertical;-webkit-box-direction: normal;flex-direction: column;"><pre>';
for($j = 0 ; $j <sizeof($dbfs) ; ++$j) {
  if($j == 0) {
    printf(' %15s <input type="radio" name="tgval" value="%s" checked"/> %15s <input type="radio" name="tgvalb" value="%s" checked"/>',$nms[$j],$dbfs[$j],$nms[$j],$dbfs[$j]);
  } else {
    printf(' %15s <input type="radio" name="tgval" value="%s"/>  %15s <input type="radio" name="tgvalb" value="%s"/>',$nms[$j],$dbfs[$j],$nms[$j],$dbfs[$j]);
  }
  echo "\n";
}
$tgvalSelect .= "</select>";
$tgvalbSelect = "</select";
echo '<p><button type="reset" class="w3-button w3-center"> Reset </button><input type="submit" class="w3-button w3-center w3-theme" value="Done" /></p>';
echo '</pre></form></div>';

echo '<div class="table-wrapper" align="center" style="position:relative;top:300px;">';
if(isset($_POST['tgval']) && isset($_POST['tgvalb']))
  {
    $chosen = 0;
    $tgval = $_POST['tgval'];
    $tgvalb = $_POST['tgvalb'];
    for($j = 0 ; $j <sizeof($dbfs) ; ++$j) {
      if(strcmp($dbfs[$j],$tgval) == 0) $chosen = $j;
    }
    for($j = 0 ; $j <sizeof($dbfs) ; ++$j) {
      if(strcmp($dbfs[$j],$tgvalb) == 0) $chosenb = $j;
    }
    $db_server = mysql_connect($db_hostname,$db_username,$db_password);
    if(!$db_server) die("Unable to connect to database: " . mysql_error());
    mysql_select_db($db_database,$db_server) or die ("Unable to select database: " . mysql_error());
    $query = "select * from Manufacturers";
    $result = mysql_query($query);
    if(!$result) die("unable to process query: " . mysql_error());
    $rows = mysql_num_rows($result);
    $smask = $_SESSION['supmask'];
    $firstmn = False;
    $mansel = "(";
    for($j = 0 ; $j < $rows ; ++$j)
    {
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
    $comtodo = "./correlate3.py ".$dbfs[$chosen]." ".$dbfs[$chosenb]." \"".$mansel."\"";
    // echo $comtodo;
    printf(" Correlation for %s (%s) vs %s (%s) <br />\n",$dbfs[$chosen],$nms[$chosen],$dbfs[$chosenb],$nms[$chosenb]);

    // print($comtodo);
    $rescor = system($comtodo);
    printf("\n");

    // Adding plots using python scripts
    $comtodo = "./p4_plot.py ".$dbfs[$chosen]." ".$dbfs[$chosenb]." \"".$mansel."\"";
    $output = base64_encode(shell_exec($comtodo));
    // echo $output;
    echo '<pre><img src="data:image/png;base64,'.$output.'" class="center"/></pre>';
  }

echo <<<_TAIL1
</div></div>
</body>
<div class="main" style="top: 200;">
  <footer class="w3-container w3-padding-32 w3-theme-d1 w3-center" style="position: relative;">
    <h4> This is the end </h4>
    <p> Thank you </p>
    <p> Thanks w3schools for the website template </p>
  </footer>
</div>
</html>
_TAIL1;

?>
