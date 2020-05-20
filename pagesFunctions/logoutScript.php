<?php
//destroys the session so you can log in again
include '../pagesInclude/DBconfig.php';
session_destroy();
header("Location: ../index.php");
exit;
?>