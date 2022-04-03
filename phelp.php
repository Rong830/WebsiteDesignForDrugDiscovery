<?php
session_start();
#get the database access credentials
require_once 'login.php';
#get the page that redirects to the front page is not logged in
include 'redir.php';
# this block sends out the header html
include 'help.html';


?>
