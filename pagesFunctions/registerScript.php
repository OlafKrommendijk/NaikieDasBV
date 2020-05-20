<?php

function register()
{
    include '../pagesInclude/DBconfig.php';
//Gets data from from
    $email = htmlspecialchars($_POST["email"]);
    $password = htmlspecialchars($_POST["password"]);
//hashes the password for safety
    $password = password_hash($password, PASSWORD_DEFAULT);

//Checks if an right email is entered and checks if it already exists in DB
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $checkedEmail = filter_var($email, FILTER_VALIDATE_EMAIL);
        $sql = "SELECT * FROM userTable WHERE email = ?";
        $stmt = $db->prepare($sql);
        $stmt->execute(array($email));

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $response = null;

        //If email exists shows an error window
        if ($result > 0) {
            echo "<script>alert('Dit emailadres is al in gebruik!');</script>";
            echo "<script>window.location.href = '../pagesInclude/loginPage.php';</script>";

        } else {
            //enters the data into the database
            $query = "INSERT INTO userTable (email, password)  VALUES ('$email', '$password')";
            $stmt = $db->prepare($query);
            $stmt->execute();

            echo "<script>alert('Account aangemaakt');</script>";
            echo "<script>window.location.href = '../pagesInclude/loginPage.php';</script>";
        }
    }
}

?>
