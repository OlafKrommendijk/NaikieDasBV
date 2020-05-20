<?php
include '../pagesInclude/DBconfig.php';
session_destroy();
header("Location: ../index.php");
exit;
?>