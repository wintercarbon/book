<?php
session_start();    
// update bookid = 1
require_once('php/function.php');
$connect = new Connect();
$staff = new Staff();

$r = $staff->checkStaffIdNextSeq();

var_dump($r);
?>