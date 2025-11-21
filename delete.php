<?php
// include db connection
include 'db.php';

//get the student id from the url
$id = $_GET['id'];

//build delete query
$qry = "DELETE FROM students WHERE id=$id";

// run
mysqli_query($conn, $qry);

// go back
header("Location: index.php");
exit;
?>