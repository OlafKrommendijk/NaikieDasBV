<?php
require_once('header.php')
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

        <!--        Create a way to check if someone is logged in and a manager, if the user is show the following button-->
        <br>
        <div class="buttonShell">
            <a class="newOfferButton" href=./loggedinHeader.php>Nieuwe vacature toevoegen</a>
        </div>
    </div>

    <div class="right-bar">
        <div class="offers">
            <?php
                require_once '../pagesFunctions/jobOffer.php';

                $offers = getAllOffers();
                foreach ($offers as $offer){
                    echo '<div class="offer">';
                    echo $offer['name'];
                    echo '</div>';
                }
                ?>

        </div>
    </div>
</div>


</body>
</html>