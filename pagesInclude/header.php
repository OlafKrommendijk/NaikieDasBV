<!DOCTYPE html>
<html lang="nl">
<head>
    <link rel="stylesheet" href="../assets/css/header.css">
</head>
<body>
<header class="main-header">
    <div class="container">
        <nav class="main-nav">
            <ul class="main-nav-list">
                <?php
                    if (isset($_SESSION['STATUS'])){
                        include '../pagesFunctions/loginScript.php';
                        echo '<li>';
                        echo '<a class="loginButton" href="../pagesFunctions/logoutScript.php">Uitloggen</a>';
                        echo '</li>';
                    }else{
                        echo '<li>';
                        echo '<a class="loginButton" href="loginPage.php">Inloggen</a>';
                        echo '</li>';
                    }
                ?>

                <li>
                    <a class="homepageButton" href="homepage.php">HomePage</a>
                </li>
        </nav>
    </div>
</header>
