<?php
session_start();
include 'redir.php';
require_once 'login.php';
echo<<<_HEAD1
<html>
<body>
_HEAD1;
include 'menuf.php';
echo <<<_MAIN1
    <pre>
This is the Property search page
    </pre>
    </pre><form action="p10b.php" method="post"><pre>   MW <input type="radio" name="tgval" value="mw" checked"/>
    TPSA <input type="radio" name="tgval" value="TPSA"/>
XlogP <input type="radio" name="tgval" value="XlogP"/>
Value <input type="text" name="cval"/>
<input type="submit" value="OK" /></pre></form></body>
</body>
</html>
_MAIN1;
?>