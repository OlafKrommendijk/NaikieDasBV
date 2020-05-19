<?php
//error_reporting(0);
session_start();
require_once('header.php');
?>

<head>
    <link rel="stylesheet" href="../assets/css/offerPageStyle.css">
</head>
<body>

<div id="page-wrapper">
    <div class="offerStatus">
        <?php
        $oId = $_GET['id'];
        require_once '../pagesFunctions/jobOffer.php';
        $offer = getOfferById($oId);

        if ($offer['status'] == 1) {
            echo 'Vacature staat aan';
        } else {
            echo 'Vacature staat uit';
        }

        if (isset($_POST['changeStatus'])) {
            changeOfferStatus($oId);
        }
        ?>

        <form action="" method="post" enctype="multipart/form-data">
            <label for="status">Kies een status:</label>
            <br>
            <select id="status" name="status">
                <option value="0">Uit</option>
                <option value="1">Aan</option>
            </select>
            <br>
            <input type="submit" value="Bijwerken!" name="changeStatus">
        </form>
    </div>

    <?php

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
        <input type="hidden" id="offerId" name="offerId" value="<?php echo $jobOfferId; ?>">
        <input type="submit" value="Verstuur" name="submit">
    </form>

    <div class="reactionBox">

    <?php

    $allReactions = getAllReactions($oId);

    foreach ($allReactions as $offerReaction) {
        echo '<div class="singleReaction">';
        echo '<a href="download.php">Download CV</a>';
        echo $offerReaction['motivation'];
        echo '<a href="download.php">Accepteren</a>';
        echo '<a href="download.php">Afwijzen</a>';
        echo '</div>';
    }

    ?>
    </div>
</div>
