<?php
include 'DBconfig.php';
include 'header.php';

$oId = $_GET['id'];
require_once '../pagesFunctions/jobOffer.php';
$offer = getOfferById($oId);

?>

<head>
    <link rel="stylesheet" href="../assets/css/offerPageStyle.css">
</head>
<body>

<div id="page-wrapper">
    <div class="offerStatus">
        <?php
        if (isset($_SESSION["MANAGER"])) {
            $oId = $offer['jobofferID'];
            //Shows if an offer is on or off
            if ($offer['status'] == 1) {
                echo 'Vacature staat aan';
            } else {
                echo 'Vacature staat uit';
            }

            if (isset($_POST['changeStatus'])) {
                changeOfferStatus($oId);
            }
            if (isset($_POST['deleteOffer'])) {
                deleteJobOffer($oId);
            }
            echo '<form action="" method="post" enctype="multipart/form-data">
            <label for="status">Kies een status:</label>
            <br>
            <select id="status" name="status">
                <option value="0">Uit</option>
                <option value="1">Aan</option>  
            </select>
            <br>
            <input type="submit" value="Bijwerken!" name="changeStatus">
            </form>';


            echo '<form action="" method="post" enctype="multipart/form-data">
                    <input type="submit" value="Verwijderen!" name="deleteOffer">
                  </form>
                  </div>';
        }

        echo '<div class="offerBox">';
        echo '<div class="offer">';
        echo '<div class="offerTitle">';
        echo $offer['offerName'];
        echo '</div><br>';
        echo '<div class="offerDescription">';
        if (file_exists($offer['description'])) {
            $offerLocation = $offer['description'];
            $offerName = $offer['offerName'];
            echo '<a href="' . $offerLocation . '" download="offer' . $offerName . '">Download Offer</a><br>';
        } else {
            echo $offer['description'];
        }
        echo '</div>';
        echo '</div>';
        echo '</div>';

        $jobOfferId = $offer['jobofferID'];

        if (isset($_POST['addOfferReaction'])) {
            offerReaction();
        }
        ?>

        <?php
            if(!isset($_SESSION["MANAGER"])){
        echo '
            <form action="" method="post" enctype="multipart/form-data">
                <h3>Reageren op de vacature</h3>
                <p>CV</p>
                <input type="file" name="fileToUpload" id="fileToUpload" accept=".pdf,.doc">
                <br>
                <p>Motivatie</p>
                <input title="motivation" type="text" name="motivation" id="motivation">
                <br>
                <input type="hidden" id="offerId" name="offerId" value="'.$jobOfferId.'">
                <input type="submit" value="Verstuur" name="addOfferReaction">
            </form>
        <div class="reactionBox">';
        }
        ?>

            <?php
            if (isset($_SESSION["MANAGER"])) {
                $allReactions = getAllReactions($oId);

                //loop through all reactions for this offer and show them so they are easily accepted or rejected.
                foreach ($allReactions as $offerReaction) {
                    $offerReactionID = $offerReaction['offerReactionID'];
                    $offerMotivation = $offerReaction['motivation'];
                    $cvLocation = $offerReaction['cv'];
                    echo '<div class="singleReaction">';
                    echo '<a href="' . $cvLocation . '" download="cv' . $offerReactionID . '">Download CV</a><br>';
                    echo '<p>'.$offerMotivation.'</p>';
                    echo '<a href="./acceptReaction.php?id=' . $offerReactionID . '">Accepteren</a><br>';
                    echo '<form method="post"> 
                          <input type="hidden" id="reactionId" name="reactionId" value="' . $offerReactionID . '">
                          <input type="submit" name="button" value="Afwijzen"/> 
                          </form> ';
                    echo '</div>';

                    if (isset($_POST['button'])) {
                        require_once '../pagesFunctions/mailFunctions.php';

                        $rId = htmlspecialchars($_POST['reactionId']);
                        sendRejectMail($rId);
                    }

                }
            }

            ?>
        </div>
    </div>
