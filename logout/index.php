<?php

session_start();

include "../db.php";

//clear all session data
$_SESSION = [];

session_destroy();

header('Location: ../login');
exit;

?>