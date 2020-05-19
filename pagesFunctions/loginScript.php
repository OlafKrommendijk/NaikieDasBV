<?php
require_once '../pagesInclude/DBconfig.php';
$db = DBConnection();
$error = " ";

if (isset($_POST["submit"])) {
//checks if the form email is filled in
    if (empty($_POST['email']) || empty($_POST['password'])) {
        echo "<script>alert('Inloggegevens ongeldig!');</script>";
        echo "<script>window.location.href = '../pagesInclude/loginPage.php';</script>";
        exit;
    }
    $email = htmlspecialchars($_POST["email"]);
    $password = htmlspecialchars($_POST["password"]);


//here we create an sql statement that will search in the database for the email that matches the form first searching with managers
    $sql = "SELECT * FROM manager WHERE email = ?";
    $stmt = $db->prepare($sql);
    $stmt->execute(array($email));
    $resultManager = $stmt->fetch(PDO::FETCH_ASSOC);

    //If we have an result we will check if the password matches
    if ($resultManager) {
        $hash = $resultManager["manPassword"];
        //If the password is right we send them through
        if (password_verify($password, $hash)) {
            $_SESSION["email"] = $resultManager["manEmail"];
            $_SESSION["status"] = 1;
            $_SESSION["manager"] = 1;
            $_SESSION['userId']=$resultManager["managerID"];

            echo "<script>window.location.href = '../pagesInclude/homepage.php';</script>";
            exit;
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
                $_SESSION["email"] = $result["email"];
                $_SESSION["status"] = 1;
                $_SESSION['userId'] = $result["userID"];

                echo "<script>window.location.href = '../pagesInclude/homepage.php';</script>";
                exit;
            }
        }
    }
    echo "<script>alert('Inloggegevens ongeldig!');</script>";
    echo "<script>window.location.href = '../pagesInclude/loginPage.php';</script>";
}

function logout()
{
    require_once '../pagesInclude/header.php';
    session_destroy();
    header("Location: ../index.php");
    exit;
}
