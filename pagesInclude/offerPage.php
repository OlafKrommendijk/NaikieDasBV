<?php
session_start();
require_once('header.php');
?>

<head>
    <link rel="stylesheet" href="../assets/css/offerPageStyle.css">
</head>
<body>

<div id="page-wrapper">



    <?php
    $oId = $_GET['id'];
    require_once '../pagesFunctions/jobOffer.php';
    $offer = getOfferById($oId);


    echo '<div class="offerBox">';
    echo '<div class="offer">';
    echo '<div class="offerTitle">';
    echo $offer['offerName'];
    echo '</div><br>';
    echo '<div class="offerDescription">';
    echo $offer['description'];
    echo '</div>';
    echo '</div>';
    echo '</div>';

    require_once '../pagesFunctions/jobOffer.php';
    $jobOfferId = $offer['jobofferID'];

    if (isset($_POST['submit'])) {
        offerReaction();
    }
    ?>

    <form action="" method="post" enctype="multipart/form-data">
        <h3>Reageren op de vacature</h3>
        <p>CV</p>
        <input type="file" name="fileToUpload" id="fileToUpload" accept=".pdf,.doc">
        <br>
        <p>Motivatie</p>
        <input title="motivation" type="text" name="motivation" id="motivation">
        <br>
        <input type="hidden" id="offerId" name="offerId" value="<?php echo $jobOfferId;?>">
        <input type="submit" value="Verstuur" name="submit">
    </form>
    
</div>
