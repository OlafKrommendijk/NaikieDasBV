<?php
include_once('header.php');
?>
    <head>
        <link rel="stylesheet" href="../assets/css/header.css">
        <link rel="stylesheet" href="../assets/css/loginPageStyle.css">
    </head>

    <div id="page-wrapper">
        <form name="login" method="POST" enctype="multipart/form-data" action="../pagesFunctions/loginScript.php"
              accept-charset="UTF-8">
            <h3>Inloggen</h3>
            <p>Email</p>
            <input required type="email" name="email" placeholder="bij@voorbeeld.com"/>
            <p>Wachtwoord</p>
            <input required type="password" name="password" placeholder="Wachtwoord"/>
            <input type="hidden" name="submit" value="true"/>
            <input type="submit" id="submit" value="Inloggen"/>
        </form>

        <form class="registerForm" name="register" method="POST" enctype="multipart/form-data"
              action="../pagesFunctions/registerScript.php">
            <h3>Registreren</h3>
            <p>Email</p>
            <input required type="email" name="email" placeholder="bij@voorbeeld.com"/>
            <p>Wachtwoord</p>
            <input required type="password" name="password" placeholder="Wachtwoord"/>
            <input type="hidden" name="submit" value="true"/>
            <input type="submit" id="submit" value="Registreren"/>
        </form>
    </div>
    </body>

<?php
require_once('../pagesFunctions/loginScript.php');
?>