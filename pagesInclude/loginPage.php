<?php
include 'DBconfig.php';
include 'header.php';
?>
    <head>
        <link rel="stylesheet" href="../assets/css/header.css">
        <link rel="stylesheet" href="../assets/css/loginPageStyle.css">
    </head>

    <div id="page-wrapper">
        <form name="login" method="POST" enctype="multipart/form-data" action=""
              accept-charset="UTF-8">
            <h3>Inloggen</h3>
            <p>Email</p>
            <input required type="email" name="email" placeholder="bij@voorbeeld.com"/>
            <p>Wachtwoord</p>
            <input required type="password" name="password" placeholder="Wachtwoord"/>
            <input type="hidden" name="submit" value="true"/>
            <input type="submit" id="login" name="login" value="Inloggen"/>
            <?php
            if (isset($_POST['login'])) {
                include '../pagesFunctions/loginScript.php';
                include 'DBconfig.php';
                login();
            }
            ?>
        </form>

        <form class="registerForm" name="register" method="POST" enctype="multipart/form-data"
              action="">
            <h3>Registreren</h3>
            <p>Email</p>
            <input required type="email" name="email" placeholder="bij@voorbeeld.com"/>
            <p>Wachtwoord</p>
            <input required type="password" name="password" placeholder="Wachtwoord"/>
            <input type="hidden" name="submit" value="true"/>
            <input type="submit" id="register" name="register" value="Registreren"/>
        </form>
        <?php
        if (isset($_POST['register'])) {
            include '../pagesFunctions/registerScript.php';
            include 'DBconfig.php';
            register();
        }
        ?>
    </div>
    </body>
