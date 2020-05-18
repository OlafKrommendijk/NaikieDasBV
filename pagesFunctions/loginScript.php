<?php

require_once('../DBconfig.php');

$error = " ";

if (isset($_POST["submit"])) {
//checks if the form email is filled in
    if (empty($_POST['email']) || empty($_POST['password'])) {
        echo "<script>alert('Inloggegevens ongeldig!');</script>";
    }

    $email = htmlspecialchars($_POST["email"]);
    $password = htmlspecialchars($_POST["password"]);


//here we create an sql statement that will search in the database for the email that matches the form
    $sql = "SELECT * FROM userTable WHERE email = ?";
    $stmt = $db->prepare($sql);
    $stmt->execute(array($email));
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

//If we have an result we will check if the password matches
    if ($result) {
        $hash = $result["password"];
        //If the password is right we send them through
        if (password_verify($password, $hash)) {
            echo "<script>alert('Inloggegevens geldig!');</script>";
            echo "<script>window.location.href = '../pagesInclude/homepage.php';</script>";
            exit;
        }
    }
    echo "<script>alert('Inloggegevens ongeldig!');</script>";
    echo "<script>window.location.href = '../pagesInclude/loginPage.php';</script>";
}


