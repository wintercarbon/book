<?php

require_once('php/function.php');

// logout

session_start();

$_SESSION = array();

session_destroy();

$connect = new Connect();
$connect->logout();

exit;

?>

?>