<?php
// database connection settings
$host = "localhost"; 
$user = "root";
$pass = "";
$db = "crud_demo";

// attempt to connect to db
$conn = mysqli_connect($host, $user, $pass, $db);
if (!$conn) die("Connection Failed: " . mysqli_connect_error());


?>