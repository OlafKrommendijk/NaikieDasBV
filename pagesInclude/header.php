<?php
//Load in necessary files
include("DBconfig.php");
session_start();

//Checks if an user is logged in. If so shows another header
if (isset($_SESSION["loggedIn"]) && $_SESSION["STATUS"] === 1) {
    include('loggedinHeader.php');
}else{
    include('loggedoutHeader.php');
}

