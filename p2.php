<?php
session_start();
require_once 'login.php';
include 'redir.php';

// Add style change settings.
echo<<<_HEAD1
<html>
<link rel="stylesheet" href="http://mscidwd.bch.ed.ac.uk/s2160628/css/table.css">

<style type="text/css">
	.container{padding: 0em 0;}
	.custom-input {
    position: relative;
    padding-top: 0px;
    margin-bottom: 0px;
	}

	.custom-input input {
    padding-left: 15px;
	}

	.custom-input label {
    cursor: text;
    margin: 0;
    padding: 0;
    left: 0px;
    top: 0px;
    position: relative;
    font-size: 16px;
    color: #000000;
    font-weight: normal;
    transition: all .3s ease;
	}

	.custom-input label.active {
    top: 0;
    left: 0;
    font-size: 24px;
	}

	.custom-input label.active.focusIn {
      color: #57900c;
	}
  
  .main{
    background-color: #fff;
    border-radius: 20px;
    width: 800px;
    height: 200px;
    margin: auto;
    position: relative;
    top: 100;
    left: 0;
    right: 0;
    bottom: 0;
  }
</style>

<style>
input[type=text] {
  width: 35%;
  padding: 12px 20px;
  margin: 8px 0;
  box-sizing: border-box;
  border: 1px solid #555;
  outline: none;
}

input[type=text]:focus {
  background-color: lightgrey;
}
</style>

<body>
_HEAD1;
include 'menuf.php';

// The page title.
echo <<<_MAIN1
<div style="position: relative;top: 100; bottom: 200;" align="center">
  <h1>This is the Catalogue Retrieval Page  </h1>
</div>
_MAIN1;

// Adding anamie using JavaScript.
// Beatified the input box.
// Using the label <pre> can show the same format as what I wrote under this label. So the same feature for max and min can be in the same line.
echo <<<_TABLE
<div style="position: relative;top: 100; bottom: 200;" align="center">
<form><pre>
      Max Atoms     <input type="text" id="natmax" name="natmax">    Min Atoms      <input type="text" id="natmin" name="natmin"></p>
      Max Carbons   <input type="text" id="ncrmax" name="ncrmax">    Min Carbons    <input type="text" id="ncrmiin" name="ncrmiin"></p>
      Max Nitrogens <input type="text" id="nntmax" name="nntmax">    Min Nitrogens  <input type="text" id="nntmin" name="nntmin"></p>
      Max Oxygens   <input type="text" id="noxmax" name="noxmax">    Min Oxygense   <input type="text" id="noxmin" name="noxmin"></p>
      <div align="center"><input type="submit" value="List All Results" class="w3-button w3-center w3-theme" /></div>
</pre></form>
</div>

<!--
<div class="main" style="top:150px;"><div class="container"><form action="p2.php" method="post" class="w3-container w3-card-4 w3-padding-16 w3-white"><pre>
  <div class="w3-row-padding"><div class="custom-input w3-half">  <label for="natmax" >Max Atoms</label><input type="text" class="w3-input w3-border" name="natmax" id="natmax"/></div><div class="custom-input w3-half">  <label for="natmin">Min Atoms</label><input type="text" class="w3-input w3-border" name="natmin" id="natmin"/></div></div>
  <div class="w3-row-padding"><div class="custom-input w3-half">  <label for="ncrmax" >Max Carbons</label><input type="text" class="w3-input w3-border" name="ncrmax" id="ncrmax"/></div><div class="custom-input w3-half">  <label for="ncrmin">Min Carbons</label><input type="text" class="w3-input w3-border" name="ncrmin" id="ncrmin"/></div></div>
  <div class="w3-row-padding"><div class="custom-input w3-half">  <label for="nntmax" >Max Nitrogens</label><input type="text" class="w3-input w3-border" name="nntmax" id="nntmax"/></div><div class="custom-input w3-half">  <label for="nntmin">Min Nitrogens</label><input type="text" class="w3-input w3-border" name="nntmin" id="nntmin"/></div></div>
  <div class="w3-row-padding"><div class="custom-input w3-half">  <label for="noxmax" >Max Oxygens</label><input type="text" class="w3-input w3-border" name="noxmax" id="noxmax"/></div><div class="custom-input w3-half">  <label for="noxmin">Min Oxygens</label><input type="text" class="w3-input w3-border" name="noxmin" id="noxmin"/></div></div>
  <div class="w3-row-padding"><div align="center">  <input type="submit" value="list" class="w3-button w3-center w3-theme" /></div>
</pre></div></form></div>
</div>

<script src="js/jquery-2.1.1.min.js" type="text/javascript"></script>
<script type="text/javascript" src="js/phanimate.jquery.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
    $('.custom-input input').phAnim();
	}
</script>
-->
_TABLE;

// Log in to the MySQL database using the information settings from the login.php.
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
$setpar = isset($_POST['natmax']); 

if($setpar) {
  $firstsl = False;
  $compsel = "select catn from Compounds where (";
  if (($_POST['natmax'] != "") && ($_POST['natmin']!="")) {
    $compsel = $compsel."(natm > ".get_post('natmin')." and  natm < ".get_post('natmax').")";
    $firstsl = True;
  }
  if (($_POST['ncrmax']!="") && ($_POST['ncrmin']!="")) {
    if($firstsl) $compsel = $compsel." and ";
    $compsel = $compsel."(ncar > ".get_post('ncrmin')." and  ncar < ".get_post('ncrmax').")";
    $firstsl = True;
  }
  if (($_POST['nntmax']!="") && ($_POST['nntmin']!="")) {
    if($firstsl) $compsel = $compsel." and ";
    $compsel = $compsel."(nnit > ".get_post('nntmin')." and  nnit < ".get_post('nntmax').")";
    $firstsl = True;
  }
  if (($_POST['noxmax']!="") && ($_POST['noxmin']!="")) {
    if($firstsl) $compsel = $compsel." and ";
    $compsel = $compsel."(noxy > ".get_post('noxmin')." and  noxy < ".get_post('noxmax').")";
    $firstsl = True;
  }
  // echo "<pre>";
  // Put the output results under a <div> label, which is easier to manage the position.
  echo '<div class="main" style="top: 600; bottom: 0;" align="center">';
  if($firstsl) {
    $compsel = $compsel.") and ".$mansel;
    echo $compsel;
    echo "\n";
      $result = mysql_query($compsel);
      if(!result) die("unable to process query: " . mysql_error());
      $rows = mysql_num_rows($result);
      if($rows > 100) {
        echo "Too many results ",$rows," Max is 100\n";
      } else  {
        // Creat the result column names.
        echo '<div class="table-wrapper" align="center" style="position: relative; top: 00px;">';
        echo '<table class="fl-table">';
        echo '<thead><tr>';
        echo '<th> Catalogue Name </th>';
        echo '</tr></thead>';
        echo '<tbody>';
        for($j = 0 ; $j < $rows ; ++$j)
        {
          $row = mysql_fetch_row($result);
          // echo $row[0],"\n";
          // Show the search result output.
          echo "<tr>";
          echo '<td>' . $row[0] . '</td>';
          echo "</tr>"; 
        }
        echo "</tbody></table></div>";
      }
  } else {
    echo "No Query Given\n";
  }
  // echo "</pre>";
} 
echo "</div>";

echo <<<_TAIL1
</body>
</html>
_TAIL1;

function get_post($var)
{
  return mysql_real_escape_string($_POST[$var]);
}
?>
