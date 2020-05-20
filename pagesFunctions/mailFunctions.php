<?php

function sendAcceptMail($rId)
{
    include '../pagesInclude/DBconfig.php';

    $query = "SELECT * FROM offerreaction WHERE offerReactionID = $rId";
    $stmt = $db->prepare($query);
    $stmt->execute();
    $reaction = $stmt->fetch(PDO::FETCH_ASSOC);

    $userId = $reaction['idUser'];

    $query = "SELECT email FROM usertable WHERE userID =".$userId;
    $stmt = $db->prepare($query);
    $stmt->execute();
    $userEmail = implode($stmt->fetch(PDO::FETCH_ASSOC));

    $personalMessage = htmlspecialchars($_POST['personalMessage']);
    $date = htmlspecialchars($_POST['date']);


    try {
        require 'libraries/phpmailerautoload.php';
        $mail = new PHPMailer();

        $mail->isSMTP();                            // Set mailer to use SMTP
        $mail->Host = 'smtp.mailtrap.io';             // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                     // Enable SMTP authentication
        $mail->Username = '8f7e2c39d606b5';          // SMTP username
        $mail->Password = '630a1bc2ea9d34';         // SMTP password
        $mail->SMTPSecure = 'tls';                  // Enable TLS encryption, `ssl` also accepted
        $mail->Port = 25;                          // TCP port to connect to

        $mail->setFrom('c4d4a7e294-4e75f4@inbox.mailtrap.io', 'Webshop');
        $mail->addReplyTo('c4d4a7e294-4e75f4@inbox.mailtrap.io', 'Webshop');
        $mail->addAddress($userEmail);   // Add a recipient
        $mail->Subject = "Uitnodiging gesprek NaikieDas BV";

        $mail->Body = "".$personalMessage. " ".$date;
        $mail->isHTML(true);  // Set email format to HTML


        $mail->send();
        echo '<script language="javascript">';
        echo 'alert("Uw uitnodiging is verstuurd.")';
        echo '</script>';
        echo "<script>window.location.href = '../pagesInclude/homepage.php';</script>";
    }catch (PDOException $e) {
        echo $e->getMessage();
        echo("<script>alert('Probleem met email versturen.');</script>");
    }
}

function sendRejectMail($rId){
    include '../pagesInclude/DBconfig.php';

    //select the right email and offer from db
    $query = "SELECT * FROM offerreaction WHERE offerReactionID = $rId";
    $stmt = $db->prepare($query);
    $stmt->execute();
    $reaction = $stmt->fetch(PDO::FETCH_ASSOC);

    $userId = $reaction['idUser'];

    $query = "SELECT email FROM usertable WHERE userID =".$userId;
    $stmt = $db->prepare($query);
    $stmt->execute();
    $userEmail = implode($stmt->fetch(PDO::FETCH_ASSOC));

    //fills in the right data and sends the email
    try {
        require 'libraries/phpmailerautoload.php';
        $mail = new PHPMailer();

        $mail->isSMTP();                            // Set mailer to use SMTP
        $mail->Host = 'smtp.mailtrap.io';             // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                     // Enable SMTP authentication
        $mail->Username = '8f7e2c39d606b5';          // SMTP username
        $mail->Password = '630a1bc2ea9d34';         // SMTP password
        $mail->SMTPSecure = 'tls';                  // Enable TLS encryption, `ssl` also accepted
        $mail->Port = 25;                          // TCP port to connect to

        $mail->setFrom('c4d4a7e294-4e75f4@inbox.mailtrap.io', 'Webshop');
        $mail->addReplyTo('c4d4a7e294-4e75f4@inbox.mailtrap.io', 'Webshop');
        $mail->addAddress($userEmail);   // Add a recipient
        $mail->Subject = "Afwijzing vacature NaikieDas BV";

        $mail->Body = "Geachte, Wij bij NaikieDas BV moeten helaas mededelen dat uw sollicitatie bij ons is afgewezen en u hoeft niet op gesprek te komen.";
        $mail->isHTML(true);  // Set email format to HTML


        $mail->send();
        echo '<script language="javascript">';
        echo 'alert("U hebt iemand afgewezen.")';
        echo '</script>';
        echo "<script>window.location.href = '../pagesInclude/homepage.php';</script>";
    }catch (PDOException $e) {
        echo $e->getMessage();
        echo("<script>alert('Probleem met email versturen.');</script>");
    }
}