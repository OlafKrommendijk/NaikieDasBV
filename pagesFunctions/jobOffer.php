<?php

function getAllOffers(){

    try {
        $db = new PDO("mysql:host=localhost;dbname=naikiedasbv",DB_USER,DB_PASS);
        $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    }
    catch(PDOException $e) {
        echo $e->getMessage();
    }


    $sql = "SELECT * FROM joboffer;";
    $stmt = $db->prepare($sql);
    $stmt->execute(array());


    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

