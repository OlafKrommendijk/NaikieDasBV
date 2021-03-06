<?php
include 'DBconfig.php';
include 'header.php';
?>
<head>
    <link rel="stylesheet" href="../assets/css/homepageStyle.css">
    <link rel="stylesheet" href="../assets/css/header.css">
    <link rel="stylesheet" href="../assets/css/header.css">
</head>

<div id="page-wrapper">
    <div class="left-bar">
        <p>Zoek een vacature</p>
        <form method="POST" enctype="multipart/form-data" action="" accept-charset="UTF-8">
            <input type="text" placeholder="Vacature zoeken" name="searchName">
            <input type="submit" id="submit" name="searchOffer" value="Zoeken!">
        </form>

        <label for="categorise">Categoriseer:</label>
        <br>
        <select id="categorise">
            <option value="branch">Branch</option>
            <option value="job">Functie</option>
        </select>
        <br>
        <label for="filter">Filter:</label>
        <br>
        <select id="filter">
            <option value="branch">Branch</option>
            <option value="job">Functie</option>
        </select>


        <?php
        if (isset($_SESSION["MANAGER"])) {
            echo '<br>
                  <div class="buttonShell">
                  <a class="newOfferButton" href="addJobOffer.php">Nieuwe vacature toevoegen</a>
                  </div>';
        }

        ?>
    </div>

    <div class="right-bar">
        <div class="offers">
            <?php
            //gets all offers and shows them, normal user can only see offers that are "on" managers are able to see offers that are "off"
            require_once '../pagesFunctions/jobOffer.php';

            require_once '../pagesFunctions/jobOffer.php';

            if (isset($_POST['searchOffer'])) {
                require_once '../pagesFunctions/jobOffer.php';
                $offers = searchOffers();
            }else {
                $offers = getAllOffers();
            }

            foreach ($offers as $offer) {
                if (isset($_SESSION["MANAGER"])) {
                    if ($offer['status'] == 0) {
                        echo '<div class="offer">';
                        echo '<a href="./offerpage.php?id=' . $offer["jobofferID"] . '">';
                        echo $offer['offerName'];
                        echo '</div>';
                    }
                }
                if ($offer['status'] == 1) {
                    echo '<div class="offer">';
                    echo '<a href="./offerpage.php?id=' . $offer["jobofferID"] . '">';
                    echo $offer['offerName'];
                    echo '</div>';
                }
            }
            ?>

        </div>
    </div>
</div>


</body>
</html>