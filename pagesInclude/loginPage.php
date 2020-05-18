<?php
require_once('../header.php')
?>
<head>
    <link rel="stylesheet" href="../assets/css/header.css">
    <link rel="stylesheet" href="../assets/css/loginPageStyle.css">
</head>

<div id="page-wrapper">
    <form name="login" method="POST" enctype="multipart/form-data" action=" ">
        <h3>Inloggen</h3>
        <p>Email</p>
        <input required type="email" name="email" placeholder="bij@voorbeeld.com"  />
        <p>Wachtwoord</p>
        <input required type="password" name="password" placeholder="Wachtwoord" />
        <input type="hidden" name="submit" value="true" />
        <input type="submit" id="submit" value="Inloggen" />
    </form>

    <form class="registerForm" name="register" method="POST" enctype="multipart/form-data" action=" ">
        <h3>Registreren</h3>
        <p>Email</p>
        <input required type="email" name="emailRegister" placeholder="bij@voorbeeld.com"  />
        <p>Wachtwoord</p>
        <input required type="password" name="passwordRegister" placeholder="Wachtwoord" />
        <input type="hidden" name="submit" value="true" />
        <input type="submit" id="submit" value="Registreren" />
    </form>
</div>


</body>
</html>