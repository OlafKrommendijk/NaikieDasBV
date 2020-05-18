<?php
?>
<head>
    <link rel="stylesheet" href="./assets/css/homepageStyle.css">
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
            <a class="newOfferButton" href=loggedinHeader.php>Nieuwe vacature toevoegen</a>
        </div>
    </div>

    <div class="right-bar">
        <div class="offer">
            <p>Offer Title</p>
        </div>
    </div>
</div>


</body>
</html>