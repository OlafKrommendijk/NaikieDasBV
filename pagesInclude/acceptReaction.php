<?php
include 'DBconfig.php';
include 'header.php';

$rId = $_GET['id'];
require_once '../pagesFunctions/jobOffer.php';
$reaction = getOfferReaction();
?>

<div id="page-wrapper">
    <div class="offerMotivation">
        <?php
        echo $reaction['motivation'];

        $id = $reaction['offerReactionID'];
        if (isset($_POST['submit'])) {
            include_once '../pagesFunctions/mailFunctions.php';
            sendAcceptMail($rId);
        }
        ?>
    </div>
    <form name="acceptOffer" method="POST" enctype="multipart/form-data" action=" ">
        <p>Persoonlijk bericht</p>
        <input required type="text" name="personalMessage" placeholder="Persoonlijk bericht"/>
        <br>
        <input type="date" id="date" name="date">
        <br>
        <input type="submit" id="submit" name="submit" value="Uitnodiging versturen">
    </form>
</div>
