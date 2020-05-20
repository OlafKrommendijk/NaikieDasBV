<?php
include '../pagesInclude/DBconfig.php';
$error = " ";


if (isset($_POST["submit"])) {
//checks if the form email is filled in
    if (empty($_POST['email']) || empty($_POST['password'])) {
        echo "<script>alert('Inloggegevens ongeldig!');</script>";
        echo "<script>location.href = '../pagesInclude/loginPage.php';</script>";
        exit;
    }
    $email = htmlspecialchars($_POST["email"]);
    $password = htmlspecialchars($_POST["password"]);


//here we create an sql statement that will search in the database for the email that matches the form first searching with managers
    $sql = "SELECT * FROM manager WHERE manEmail = ?";
    $stmt = $db->prepare($sql);
    $stmt->execute(array($email));
    $resultManager = $stmt->fetch(PDO::FETCH_ASSOC);

    //If we have an result we will check if the password matches
    if ($resultManager) {
        $hash = $resultManager["manPassword"];
        //If the password is right we send them through
        if (password_verify($password, $hash)) {
            $_SESSION["ID"] = 2;
            $_SESSION["EMAIL"] = $resultManager["manEmail"];
            $_SESSION["STATUS"] = 1;
            echo "<script>location.href = '../pagesInclude/homepage.php';</script>";
        }
    }else {
        //here we try for normal user
        $sql = "SELECT * FROM userTable WHERE email = ?";
        $stmt = $db->prepare($sql);
        $stmt->execute(array($email));
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

//If we have an result we will check if the password matches
        if ($result) {
            $hash = $result["password"];
            //If the password is right we send them through
            if (password_verify($password, $hash)) {
                $_SESSION["ID"] = 1;
                $_SESSION["EMAIL"] = $result["email"];
                $_SESSION["STATUS"] = 1;
                echo "<script>location.href = '../pagesInclude/homepage.php';</script>";
            }
        }
    }
    echo "<script>alert('Inloggegevens ongeldig!');</script>";
    echo "<script>location.href = '../pagesInclude/loginPage.php';</script>";
}

