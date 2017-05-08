<?php
    session_start();
require_once('connectvars.php');

$dbc = mysqli_connect(HOST,USER,PASS,DBNAME) or die('Error 2!');
$user_check = $_SESSION['user'];
$sql = mysqli_query($dbc, "SELECT user FROM members WHERE user='$user_check'");
$row = mysqli_fetch_array($sql, MYSQLI_ASSOC);
$login_user = $row['user'];

if (!isset($user_check)){
    header ("location: login.php");
}


?>