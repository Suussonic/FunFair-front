<?php
require "phpmailer/PHPMailerAutoload.php";
require_once('models/Database.php');


function sendMail($dbh, $email, $objet, $body) {  
    try {
        $query = $dbh->prepare("SELECT firstname FROM users WHERE email = :email;");
        $query->execute([
            'email' => $email
        ]);
        $response = $query->fetchAll();
        $username = $response[0]['firstname'];
        // Tentative de création d’une nouvelle instance de la classe PHPMailer, avec les exceptions activées
        $mail = new PHPMailer (true);
        $mail = initMailer($mail);
        // Expéditeur
        $mail->setFrom('funfair-no-reply@echovps.fr', 'No reply - Fun Fair'); 
        // Destinataire dont le nom peut également être indiqué en option
        $mail->addAddress($email, $username);

        $mail->isHTML(true);
        // Objet
        $mail->Subject = $objet;
        // HTML-Content
        $mail->Body = $body;

        // Ajouter une pièce jointe
        $mail->CharSet = 'UTF-8';
        $mail->Encoding = 'base64';
        $mail->send();
    } catch (Exception $e) {
        echo "Mailer Error: " . $e->getMessage();
    }
}


function initMailer($mail) {
    $mail->isSMTP();
    $mail->Host = 'live.smtp.mailtrap.io'; // Your SMTP server
    $mail->SMTPAuth = true;
    $mail->Username = 'api'; // Your Mailtrap username
    $mail->Password = '5e1169d1cf99606bbbb2480f5177958f'; // Your Mailtrap password
    $mail->Port = 587;
    return $mail;
}
?>
