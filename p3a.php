<?php
session_start();
include 'redir.php';
require_once 'login.php';
echo <<<_HEAD1
<html>
<body>
_HEAD1;
include 'menuf.php';
$dbfs = array("natm", "ncar", "nnit", "noxy", "nsul", "ncycl", "nhdon", "nhacc", "nrotb", "mw", "TPSA", "XLogP");
$nms = array("n atoms", "n carbons", "n nitrogens", "n oxygens", "n sulphurs", "n cycles", "n H donors", "n H acceptors", "n rot bonds", "mol wt", "TPSA", "XLogP");
echo <<<_MAIN1
    <pre>
This is the histogram page
    </pre>
_MAIN1;
if (isset($_POST['tgval'])) {
    $chosen = 0;
    $tgval = $_POST['tgval'];
    for ($j = 0; $j < sizeof($dbfs); ++$j) {
        if (strcmp($dbfs[$j], $tgval) == 0) $chosen = $j;
    }
    $db_server = mysql_connect($db_hostname, $db_username, $db_password);
    if (!$db_server) die("Unable to connect to database: " . mysql_error());
    mysql_select_db($db_database, $db_server) or die("Unable to select database: " . mysql_error());
    $query = "select * from Manufacturers";
    $result = mysql_query($query);
    if (!$result) die("unable to process query: " . mysql_error());
    $rows = mysql_num_rows($result);
    $smask = $_SESSION['supmask'];
    $firstmn = False;
    $mansel = "(";
    for ($j = 0; $j < $rows; ++$j) {
        $row = mysql_fetch_row($result);
        $sid[$j] = $row[0];
        $snm[$j] = $row[1];
        $sact[$j] = 0;
        $tvl = 1 << ($sid[$j] - 1);
        if ($tvl == ($tvl & $smask)) {
            $sact[$j] = 1;
            if ($firstmn) $mansel = $mansel . " or ";
            $firstmn = True;
            $mansel = $mansel . " (ManuID = " . $sid[$j] . ")";
        }
    }
    $mansel = $mansel . ")";
    $comtodo = "./plot.py " . $dbfs[$chosen] . " \"" . $nms[$chosen] . "\" \"" . $mansel . "\"";
    $output = base64_encode(shell_exec($comtodo));
    echo <<<_imgput
    <pre>
    <img  src="data:image/png;base64,$output" />
    </pre>
_imgput;
}
echo '<form action="p3a.php" method="post"><pre>';
for ($j = 0; $j < sizeof($dbfs); ++$j) {
    if ($j == 0) {
        printf(' %15s <input type="radio" name="tgval" value="%s" checked"/>', $nms[$j], $dbfs[$j]);
    } else {
        printf(' %15s <input type="radio" name="tgval" value="%s"/>', $nms[$j], $dbfs[$j]);
    }
    echo "\n";
}
echo '<input type="submit" value="OK" />';
echo '</pre></form>';
echo <<<_TAIL1
</body>
</html>
_TAIL1;
?>
