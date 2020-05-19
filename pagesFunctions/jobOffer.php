<?php
//Here can you find all the function that have a correlation to job offers
function changeOfferStatus($oId)
{
    $db = DBConnection();

    $offerStatus = htmlspecialchars($_POST['status']);

    $query = "UPDATE joboffer SET status = " . $offerStatus . " WHERE jobOfferID = " . $oId;
    $stmt = $db->prepare($query);
    $stmt->execute();

    echo "<script>window.location.href = '../pagesInclude/homepage.php';</script>";
    exit;
}

function offerReaction()
{
    $db = DBConnection();

    if (empty($_POST['motivation']) || empty($_FILES['fileToUpload'])) {
        echo "<script>alert('Vergeet niet de verplichte velden in te vullen');</script>";
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
        exit;
    }

    $motivation = htmlspecialchars($_POST['motivation']);
    $cv = $_FILES['fileToUpload'];
    $offerId = htmlspecialchars($_POST['offerId']);
    $userId = $_SESSION['userId'];

    $query = "INSERT INTO offerreaction (idUser, idJoboffer, motivation, cv )  VALUES ('$userId', '$offerId', '$motivation', '$cv')";
    $stmt = $db->prepare($query);
    $stmt->execute();
    echo "<script>window.location.href = '../pagesInclude/homepage.php';</script>";
}

function getAllReactions($oId)
{
    $db = DBConnection();

    $sql = "SELECT * FROM offerreaction WHERE idJobOffer =".$oId;
    $stmt = $db->prepare($sql);
    $stmt->execute(array());

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getAllOffers()
{
    $db = DBConnection();


    $sql = "SELECT * FROM joboffer;";
    $stmt = $db->prepare($sql);
    $stmt->execute(array());


    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getOfferById($oId)
{
    $db = DBConnection();

    $query = "SELECT * FROM joboffer WHERE jobOfferId = ?";
    $stmt = $db->prepare($query);
    $stmt->execute(array($_GET['id']));

    return $stmt->fetch();
}

function getJobFunctions()
{
    $db = DBConnection();


    $sql = "SELECT * FROM jobfunction;";
    $stmt = $db->prepare($sql);
    $stmt->execute(array());

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getJobBranches()
{
    $db = DBConnection();


    $sql = "SELECT * FROM jobbranch;";
    $stmt = $db->prepare($sql);
    $stmt->execute(array());

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function addNewJobOffer()
{
    $db = DBConnection();

    if (empty($_POST['jobName']) || empty($_POST['jobFunction']) || empty($_POST['jobBranch'])) {
        echo "<script>alert('Vergeet niet de verplichte velden in te vullen');</script>";
        echo "<script>window.location.href = '../pagesInclude/addJobOffer.php';</script>";
        exit;
    }
    $jobFile = $_FILES['fileToUpload'];
    if ((!empty($_POST['jobDescription'])) && !empty($jobFile['name'])) {
        echo "<script>alert('Voeg of alleen een bestand toe of schrijf alleen een beschrijving');</script>";
        echo "<script>window.location.href = '../pagesInclude/addJobOffer.php';</script>";
        exit;
    }

    $jobName = htmlspecialchars($_POST['jobName']);
    $jobFunction = htmlspecialchars($_POST['jobFunction']);
    $jobBranch = htmlspecialchars($_POST['jobBranch']);
    $jobDescription = htmlspecialchars($_POST['jobDescription']);

    if (!empty($jobFile['name'])) {
        $target_dir = "../assets/uploads/joboffers/";
        $jobDescription = $target_dir . basename($_FILES["fileToUpload"]["name"]);

        //Trying to upload file
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $jobDescription)) {
            echo "<script>alert('bestand is geupload');</script>";
        } else {
            echo "<script>alert('Bestand uploaden mislukt');</script>";
            echo "<script>window.location.href = '../pagesInclude/addJobOffer.php';</script>";
            exit;
        }
    }

    $query = "INSERT INTO joboffer (idJobbranch, idJobfunction, offerName, description )  VALUES ('$jobBranch', '$jobFunction', '$jobName', '$jobDescription')";
    $stmt = $db->prepare($query);
    $stmt->execute();
    echo "<script>window.location.href = '../pagesInclude/homepage.php';</script>";
}