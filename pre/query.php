<html>
<body>
<?php
require_once 'login.php';
$db_server = mysql_connect($db_hostname,$db_username,$db_password);
if(!$db_server) die("Unable to connect to database: " . mysql_error());
mysql_select_db($db_database,$db_server) or die ("Unable to select database: " . mysql_error());
if(isset($_POST['cat']) &&
   isset($_POST['arc']) &&
   isset($_POST['top'])) 
   {
     $cat = get_post('cat');
     $arc = get_post('arc');
     $top = get_post('top');
     $query = "select * from cathv2 where cat='$cat' and arch='$arc' and topol='$top'";
     $result = mysql_query($query);
     if(!result) die("unable to process query: " . mysql_error());
     $rows = mysql_num_rows($result);
     for($j = 0 ; $j < $rows ; ++$j)
     {
       $row = mysql_fetch_row($result);
       echo <<<_EOP1
       <pre>
       Category id  $row[1];
       Arch id      $row[2];
       Topol id     $row[3];
       Homol fam id $row[4];
       Name         $row[6];
       </pre>
_EOP1;
     }
   }
   echo <<<_EOP
   <form action="query.php" method="post"><pre>
       Category ID <input type="text" name="cat"/>
       Arch ID     <input type="text" name="arc"/>
       Topol ID    <input type="text" name="top"/>
                   <input type="submit" value="list" />
</pre></form>
_EOP;
mysql_close($db_server);

function get_post($var)
{
  return mysql_real_escape_string($_POST[$var]);
}
?>
</pre>
</body>
</html>
