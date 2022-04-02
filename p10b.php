<?php
session_start();
require_once 'login.php';
include 'redir.php';
echo <<<_HEAD1
<html>
<link rel="stylesheet" href="http://mscidwd.bch.ed.ac.uk/s2160628/css/check_box.css">
<link rel="stylesheet" href="http://mscidwd.bch.ed.ac.uk/s2160628/css/table.css">
<link rel="stylesheet" href="http://mscidwd.bch.ed.ac.uk/s2160628/css/select.css">

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
$db_server = mysql_connect($db_hostname, $db_username, $db_password);
if (!$db_server) die("Unable to connect to database: " . mysql_error());
mysql_select_db($db_database, $db_server) or die("Unable to select database: " . mysql_error());
$query = "select * from Manufacturers";
$result = mysql_query($query);
if (!$result) die("unable to process query: " . mysql_error());
$rows = mysql_num_rows($result);
$manarray = array();
for ($j = 0; $j < $rows; ++$j) {
    $row = mysql_fetch_row($result);
    $manarray[$j] = $row[1];
}

echo <<<_SELECT

_SELECT;
$page = isset($_GET['page'])  ? $_GET['page']  : 1;
echo <<<_MAIN1
<div class="container" style="position: relative; top:100px;">
<h1>This is the Property search page</h1>
</div>
<div class="container" style="position: relative; top:200px;">
<form action="p10b.php" method="GET" style="display: -webkit-box;display: flex;flex-wrap: wrap;-webkit-box-orient: vertical;-webkit-box-direction: normal;flex-direction: column;">
    Please choose one feature to display.
    <input type='hidden' name='page' value='{$page }'>
   
    <label><input type="radio" name="tgval"  value="mw" /><span>Molecular Weight (MW)</span></label>
    <label><input type="radio" name="tgval" value="TPSA"/><span>Topological Polar Surface Area (TPSA)</span></label>
    <label><input type="radio" name="tgval" value="XlogP"/><span>Estimated LogP (XlogP)</span></label>


<!--
<div class="c-dropdown js-dropdown">
    <input type="hidden" name="Framework" id="Framework" class="js-dropdown__input">
    <span class="c-button c-button--dropdown js-dropdown__current">Select</span>
    <ul class="c-dropdown__list">
        <li class="c-dropdown__item" data-dropdown-value="mw"><label><input type="radio" name="tgval" value="mw" checked"/><span>Molecular Weight</span></label></li>
        <li class="c-dropdown__item" data-dropdown-value="TPSA">Topological Polar Surface Area</li>
        <li class="c-dropdown__item" name="tgval" data-dropdown-value="XlogP"><input type="radio" name="XlogP" value="XlogP"/>logP</li>
    </ul>
</div>

<script src='js/jquery.min.js'></script>
<script  src="js/index.js"></script>
-->

<p> Note: You should choose one feature above and enter a valid value before press submit.</p>

    <span> Please enter a Value to search </span><input type="text"  value="" name="cval"/>
    <button type="reset" class="w3-button w3-center"> Reset </button><input type="submit" class="w3-button w3-center w3-theme" value="Done" />
</form>
</div>
_MAIN1;

$p = new Page();
echo '<div class="table-wrapper" align="center" style="position:relative;top:300px;">';

$compsel = "select * from Compounds ";
$count = "select count(*) from Compounds ";
if (($_GET['tgval'] != "") && ($_GET['cval'] != "")) {
    $mychoice = get_post('tgval');
    $myvalue = get_post('cval');
    if ($mychoice == "mw") {
        $compsel = $compsel . " where ( mw > " . ($myvalue - 1.0) . " and  mw < " . ($myvalue + 1.0) . ")";
        $count = $count . " where ( mw > " . ($myvalue - 1.0) . " and  mw < " . ($myvalue + 1.0) . ")";
    }
    if ($mychoice == "TPSA") {
        $compsel = $compsel . " where ( TPSA > " . ($myvalue - 0.1) . " and  TPSA < " . ($myvalue + 0.1) . ")";
        $count = $count . " where( TPSA > " . ($myvalue - 0.1) . " and  TPSA < " . ($myvalue + 0.1) . ")";
    }
    if ($mychoice == "XlogP") {
        $compsel = $compsel . " where ( XlogP > " . ($myvalue - 0.1) . " and  XlogP < " . ($myvalue + 0.1) . ")";
        $count = $count . " where ( XlogP > " . ($myvalue - 0.1) . " and  XlogP < " . ($myvalue + 0.1) . ")";
    }
    $p->setCount(mysql_query($count));
    $result = mysql_query($compsel . " order by id desc " . $p->limit());
    if (!$result) die("unable to process query: " . mysql_error());
    $rows = mysql_num_rows($result);
    $p->setCount(mysql_query($count));

$result = mysql_query($compsel . " order by id desc " . $p->limit());
if (!$result) die("unable to process query: " . mysql_error());
$rows = mysql_num_rows($result);
    echo <<<_TABLE1
<table class="fl-table">
<thead>
<tr>
    <th>CAT Number</th>
    <th>Manufacturer</th>
    <th>Property</th>
</tr>
</thead>
<tbody>
_TABLE1;
        for ($j = 0; $j < $rows; ++$j) {
            echo "<tr>";
            $row = mysql_fetch_row($result);
            printf("<td>%s</td> <td>%s</td>", $row[11], $manarray[$row[10] - 1]);
            if ($mychoice == "mw") {
                printf("<td>%s</td> ", $row[12]);
            }
            if ($mychoice == "TPSA") {
                printf("<td>%s</td> ", $row[13]);
            }
            if ($mychoice == "XlogP") {
                printf("<td>%s</td> ", $row[14]);
            }
            echo "</tr>";
        }
        echo "</table>";

echo  $p->showPages() ;
echo "</pre></div>";
echo <<<_TAIL1
</body>
<div class="main" style="top: 500;">
  <footer class="w3-container w3-padding-32 w3-theme-d1 w3-center" style="position: relative;">
    <h4> This is the end </h4>
    <p> Thank you </p>
    <p> Thanks w3schools for the website template </p>
  </footer>
</div>
</html>
_TAIL1;

}

function get_post($var)
{
    return mysql_real_escape_string($_GET[$var]);
}
