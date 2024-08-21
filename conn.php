<?php

$host = "localhost";
$username = "root";
$password = "";
$db = "kelas_a";

$conn = mysqli_connect($host, $username, $password, $db);

if(!$conn){
    die("ERROR : " . mysqli_connect_error());
}

?>