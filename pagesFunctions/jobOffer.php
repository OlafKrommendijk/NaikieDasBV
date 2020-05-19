<?php


function getAllOffers()
{
    require_once '../pagesInclude/DBconfig.php';
    $db = DBConnection();


    $sql = "SELECT * FROM joboffer;";
    $stmt = $db->prepare($sql);
    $stmt->execute(array());


    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getOfferById($oId)
{
    require_once '../pagesInclude/DBconfig.php';
    $db = DBConnection();

    $query = "SELECT * FROM joboffer WHERE jobOfferId = ?";
    $stmt = $db->prepare($query);
    $stmt->execute(array($_GET['id']));

    return $stmt->fetch();
}

function offerReaction()
{
    require_once '../pagesInclude/DBconfig.php';
    $db = DBConnection();

    if (empty($_POST['motivation']) || empty($_FILES['fileToUpload'])) {
        echo "<script>alert('Vergeet niet de verplichte velden in te vullen');</script>";
        echo "<script>window.location.href = '../pagesInclude/homepage.php';</script>";
        exit;
    }
    if (!isset($_SESSION['userId'])) {
        echo "<script>alert('U moet ingelogd zijn');</script>";
        echo "<script>window.location.href = '../pagesInclude/homepage.php';</script>";
        exit;
    }


    $target_dir = "../assets/uploads/offerreactions";
    $cv = $target_dir . basename($_FILES["fileToUpload"]["name"]);

    //Trying to upload file
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $cv)) {
        echo "<script>alert('bestand is geupload');</script>";
    } else {
        echo "<script>alert('Bestand uploaden mislukt');</script>";
        echo "<script>window.location.href = '../pagesInclude/homepage.php';</script>";
        exit;
    }

    $motivation = htmlspecialchars($_POST['motivation']);
    $cv = $_FILES['fileToUpload'];
    $offerId = htmlspecialchars($_POST['offerId']);
    $userId = $_SESSION['userId'];

    $query = "INSERT INTO offerreaction (idUser, idJoboffer, motivation, cv )  VALUES ('$userId', '$offerId', '$motivation', '$cv')";
    $stmt = $db->prepare($query);
    $stmt->execute();


}