<?php
require_once 'login.php';
echo<<<_HEAD1
<html>
<body>
_HEAD1;
$db_server = mysql_connect($db_hostname,$db_username,$db_password);
if(!$db_server) die("Unable to connect to database: " . mysql_error());
mysql_select_db($db_database,$db_server) or die ("Unable to select database: " . mysql_error());
$query = "select MAX(cat) from cathv2 ";
$result = mysql_query($query);
if(!result) die("unable to process query: " . mysql_error());
$max_cat = mysql_fetch_row($result);
$query = "select MIN(cat)  from cathv2 ";
$result = mysql_query($query);
if(!result) die("unable to process query: " . mysql_error());
$min_cat = mysql_fetch_row($result);
$query = "select MAX(arch) from cathv2 ";
$result = mysql_query($query);
if(!result) die("unable to process query: " . mysql_error());
$max_arch = mysql_fetch_row($result);
$query = "select MIN(arch) from cathv2 ";
$result = mysql_query($query);
if(!result) die("unable to process query: " . mysql_error());
$min_arch = mysql_fetch_row($result);
$query = "select MAX(topol) from cathv2 ";
$result = mysql_query($query);
if(!result) die("unable to process query: " . mysql_error());
$max_topol = mysql_fetch_row($result);
$query = "select MIN(topol) from cathv2 ";
$result = mysql_query($query);
if(!result) die("unable to process query: " . mysql_error());
$min_topol = mysql_fetch_row($result);
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
     echo "Results\n";
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
<script>
   function validate(form) {
     max_cat = $max_cat[0] 
     min_cat = $min_cat[0] 
     max_arch = $max_arch[0] 
     min_arch = $min_arch[0] 
     max_topol = $max_topol[0] 
     min_topol = $min_topol[0] 
     fail = validateCat(form.cat.value)
       fail  += validateArc(form.arc.value)
       fail += validateTop(form.top.value)
       if(fail =="") return true
	 else {alert(fail); return false}
   }
function validateCat(field) {
  if(field == "") return "No category entered "
  if (isNaN(field)) return "Category is not a number  "
    else if  (field < min_cat || field > max_cat) return "category must be between "+min_cat+" and " + max_cat
    return ""
}
function validateArc(field) {
  if (field == "") return "No Architecture entered "
  if (isNaN(field)) return "Architecture is not a number "
   else if  (field < min_arch || field > max_arch) return "architecture must be between "+min_arch+" and " + max_arch
    return ""
}function validateTop(field) {
  if (field =="" ) return "No Topology entered  "
  if (isNaN(field)) return  "Topology is not a number "
   else if  (field < min_topol || field > max_topol) return "topology must be between "+min_topol+" and " + max_topol
    return ""
}
</script>
   <form action="queryver2.php" method="post" onSubmit="return validate(this)"><pre>
       Category ID <input type="text" name="cat"/>
       Arch ID     <input type="text" name="arc"/>
       Topol ID    <input type="text" name="top"/>
                   <input type="submit" value="list" />
</pre></form>
_EOP;
mysql_close($db_server);
echo <<<_TAIL1
</pre>
</body>
</html>
_TAIL1;
function get_post($var)
{
  return mysql_real_escape_string($_POST[$var]);
}
?>
