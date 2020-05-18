<?php
//Load in necessary files
include("config/DBconfig.php");
session_start();

//Checks if an user is logged in. If so shows another header
//if ($_SESSION["STATUS"] === 1) {
//    include_once('loggedinHeader.php');
//}else{
    include_once('pagesInclude/loggedoutHeader.php');
//}

