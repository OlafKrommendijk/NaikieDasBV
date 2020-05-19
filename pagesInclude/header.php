<?php
//Checks if an user is logged in. If so shows another header
if (isset($_SESSION["loggedIn"]) && $_SESSION["STATUS"] === 1) {
    include_once('./loggedinHeader.php');
}else{
    include_once('./loggedoutHeader.php');
}

