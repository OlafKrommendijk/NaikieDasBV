<?php
session_start();
include 'header.php';
var_dump($_SESSION);
?>
<head>
    <link rel="stylesheet" href="../assets/css/homepageStyle.css">
    <link rel="stylesheet" href="../assets/css/header.css">
    <link rel="stylesheet" href="../assets/css/header.css">
</head>

<div id="page-wrapper">
    <div class="left-bar">
        <p>Zoek een vacature</p>
        <form action="/action_page.php">
            <input type="text" placeholder="Vacature zoeken" name="search">
            <button type="submit">Zoeken</button>
        </form>

        <label for="categorise">Categoriseer:</label>
        <br>
        <select id="categorise">
            <option value="branch">Filiaal</option>
            <option value="job">Functie</option>
        </select>
        <br>
        <label for="filter">Filter:</label>
        <br>
        <select id="filter">
            <option value="branch">Filiaal</option>
            <option value="job">Functie</option>
        </select>
<!--if (isset($_SESSION["manager"])) {-->
        <?php
            echo '<br>
        <div class="buttonShell">
            <a class="newOfferButton" href=./addJobOffer.php>Nieuwe vacature toevoegen</a>
        </div>';

        ?>
    </div>

    <div class="right-bar">
        <div class="offers">
            <?php
                require_once '../pagesFunctions/jobOffer.php';

                $offers = getAllOffers();
                foreach ($offers as $offer){
                    echo '<div class="offer">';
                    echo '<a href="./offerpage.php?id='.$offer["jobofferID"].'">';
                    echo $offer['name'];
                    echo '</div>';
                }
                ?>

        </div>
    </div>
</div>


</body>
</html>