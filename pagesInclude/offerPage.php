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
        require_once '../pagesFunctions/jobOffer.php';
        $jobFunctions = getJobFunctions();

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
            if (isset($_POST['editOffer'])) {
                editJobOffer($oId);
            }

            echo '<form action="" method="post" enctype="multipart/form-data">
            <label for="status">Kies een status:</label>
            <br>
            <select id="status" name="status">
                <option value="0">Uit</option>
                <option value="1">Aan</option>  
            </select>
            <br>
            <input type="submit" value="Status veranderen!" name="changeStatus">
            </form>';


            echo '<form action="" method="post" enctype="multipart/form-data">
                    <input type="submit" value="Vacature verwijderen!" name="deleteOffer">
                  </form>
                  </div>';

            echo '<button class="openEditOffer" onClick="openEditForm()">Vacature bewerken</button>
                  <div class="editFormPop" id="editForm">
                   <form action="" method="post" enctype="multipart/form-data">
                       <p>Vacature naam</p>
                       <input title="jobName" type="text" name="jobName" id="jobName" value="'.$offer['offerName'].'">
                       <br>
                       <p>Vacature Functie</p>
                       <select title="jobFunction" name="jobFunction" id="jobFunction">';
                        foreach ($jobFunctions as $jobFunction) {
                            echo '<option value="' . $jobFunction['jobfunctionID'] . '"> ' . $jobFunction['functionName'] . ' </option>';
                        }
            echo       '</select><p>Vacature Branch</p>
                       <select title="jobBranch" name="jobBranch" id="jobBranch">';
                        $jobBranches = getJobBranches();
                        foreach ($jobBranches as $jobBranch) {
                            echo '<option value=" ' . $jobBranch['jobbranchID'] . ' "> ' . $jobBranch['brancheName'] . ' </option>';
                        }
            echo        '</select> <p>Bestand uploaden</p>
                        <input type="file" name="fileToUpload" id="fileToUpload" accept=".pdf,.doc">
                        <br>
                        <p>Of typ zelf een vacature</p>
                        <input title="jobDescription" type="text" name="jobDescription" id="jobDescription" value="'.$offer['description'].'">
                        <br>
                        <input type="submit" value="Vacature Aanpassen!" name="editOffer">
                  </form>
                  </div>
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
            if( isset($_SESSION["STATUS"]) && !isset($_SESSION["MANAGER"]) ){
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
                    echo '<div class="acceptOrReject"><a href="./acceptReaction.php?id=' . $offerReactionID . '">Accepteren</a><br>';
                    echo '<form method="post"> 
                          <input type="hidden" id="reactionId" name="reactionId" value="' . $offerReactionID . '">
                          <input type="submit" name="button" value="Afwijzen"/> 
                          </form> ';
                    echo '</div></div>';

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

<script>
    function openEditForm() {
        document.getElementById("editForm").style.display = "block";
    }
</script>
