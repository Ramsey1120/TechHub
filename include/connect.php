<?php 

$servername = "";
$dbuser = "";
$dbpass = "";
$dbname = "";

$conn = mysqli_connect($servername,$dbuser,$dbpass,$dbname);

if (!$conn) { die(mysqli_error($conn)); } 

?>