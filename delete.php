<!-- PROTECTED PAGE -->
 <?php
    session_start();

    if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true)
    {
        header("Location: login");
        exit;
    }
 ?>
<!-- PROTECTED PAGE -->

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