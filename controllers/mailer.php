<?php
require "phpmailer/PHPMailerAutoload.php";
require_once('models/Database.php');

function sendMail($email, $objet, $body) {
                    try {
                        $query = $dbh->prepare("SELECT firstname FROM user WHERE email = :email;");
                        $query->execute([
                            'email' => $email
                        ]);
                        $response = $query->fetchAll();
                        $username = $response[0]['firstname'];
                        // Tentative de création d’une nouvelle instance de la classe PHPMailer, avec les exceptions activées
                        $mail = new PHPMailer (true);
                        $mail = initMailer($mail);
                        // Expéditeur
                        $mail->setFrom('noreplycardbindex@gmail.com', 'No reply - Fun Fair');
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
    $mail->Host = 'smtp.gmail.com'; // Your SMTP server
    $mail->SMTPAuth = true;
    $mail->Username = 'noreplycardbindex@gmail.com'; // Your Mailtrap username
    $mail->Password = 'vtlwswtcphagplaw'; // Your Mailtrap password
    $mail->Port = 465;
    return $mail;
}
?>
