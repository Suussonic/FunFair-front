<?php

include_once('/models/Database.php');
require "/phpmailer/PHPMailerAutoload.php";
include('./verif.php');

include('/config/register.php');


if (isset($_POST['captcha_answer']) && isset($_POST['captcha_id'])) {
    $captcha_id = $_POST['captcha_id'];
    $captcha_answer = trim($_POST['captcha_answer']);

    // Récupérer la réponse correcte depuis la base de données
    $sql = "SELECT r FROM captcha WHERE id = :captcha_id";
    $stmt = $dbh->prepare($sql);
    $stmt->bindParam(':captcha_id', $captcha_id, PDO::PARAM_INT);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    // Vérifier si la réponse est correcte
    if ($row && strcasecmp($row['r'], $captcha_answer) == 0) {
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $email = $_POST['email'];
        $pass = $_POST['password'];
        $gender = $_POST['gender'];

        // Vérifier la validité du mot de passe
        if (verifierMotDePasse($pass)) {
            $hashedPassword = password_hash($pass, PASSWORD_BCRYPT);

            $cle = rand(1000000, 9000000);  //creation de la cle
            $insererUsers = $bdd->prepare('INSERT INTO users (firstname, lastname, email, password, gender, confirme, cle) 
                                            VALUES (:firstname, :lastname, :email, :password, :gender, ?, :cle)'); 
            $insererUsers->execute([
                'firstname' => $firstname,
                'lastname' => $lastname,
                'email' => $email,
                'password' => $hasedPassword,
                'gender' => $gender,
                'confirme' => 0,
                'cle' => $cle,
            ]);                    
    
            $recupUser = $bdd->prepare('SELECT * FROM users WHERE email = ?');
            $recupUser->execute(array($email));
            if($recupUser->rowCount() > 0){
                $userInfos = $recupUser->fetch();
                $_SESSION['id'] = $userInfos['id'];
    
    
                function smtpmailer($to, $from, $from_name, $subject, $body)
                    {
                        $mail = new PHPMailer();
                        $mail->IsSMTP();
                        $mail->SMTPAuth = true; 
                
                        $mail->SMTPSecure = 'ssl'; 
                        $mail->Host = 'smtp.gmail.com';
                        $mail->Port = 465;  
                        $mail->Username = 'noreplycardbindex@gmail.com';
                        $mail->Password = 'vtlwswtcphagplaw';   
                
                //   $path = 'reseller.pdf';
                //   $mail->AddAttachment($path);
                
                        $mail->IsHTML(true);
                        $mail->From="noreplycardbindex@gmail.com";
                        $mail->FromName=$from_name;
                        $mail->Sender=$from;
                        $mail->AddReplyTo($from, $from_name);
                        $mail->Subject = $subject;
                        $mail->Body = $body;
                        $mail->AddAddress($to);
                        if(!$mail->Send())
                        {
                            $error ="Please try Later, Error Occured while Processing...";
                            return $error; 
                        }
                        else 
                        {
                            $error = "Thanks You !! Your email is sent.";  
                            return $error;
                        }
                    }
                    
                    $to   = $email;
                    $from = 'noreplycardbindex@gmail.com';
                    $name = 'FunFair';
                    $subj = 'Email de Confirmation';
                    $msg = '
                    <!DOCTYPE html>
                    <html lang="fr">
                    <head>
                        <meta charset="UTF-8">
                        <meta name="viewport" content="width=device-width, initial-scale=1.0">
                        <title>Confirmation de votre adresse e-mail</title>
                        <style>
                            body {
                                font-family: Arial, sans-serif;
                                background-color: #f4f4f4;
                                margin: 0;
                                padding: 0;
                            }
                            .container {
                                width: 100%;
                                max-width: 600px;
                                margin: 0 auto;
                                background-color: #ffffff;
                                padding: 20px;
                                border-radius: 8px;
                                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                            }
                            .header {
                                text-align: center;
                                padding: 10px 0;
                            }
                            .content {
                                padding: 20px;
                                text-align: center;
                            }
                            .button {
                                display: inline-block;
                                padding: 10px 20px;
                                margin: 20px 0;
                                font-size: 16px;
                                color: #ffffff;
                                background-color: #007bff;
                                text-decoration: none;
                                border-radius: 5px;
                            }
                            .footer {
                                text-align: center;
                                padding: 10px;
                                font-size: 12px;
                                color: #777777;
                            }
                        </style>
                    </head>
                    <body>
                        <div class="container">
                            <div class="header">
                                <h1>Confirmation de votre adresse e-mail</h1>
                            </div>
                            <div class="content">
                                <p>Bonjour,</p>
                                <p>Merci de vous être inscrit sur FunFair. Pour finaliser votre inscription et vérifier votre adresse e-mail, veuillez cliquer sur le bouton ci-dessous :</p>
                                <a href="https://funfair.ovh/controllers/verif.php?id='.$_SESSION['id'].'&cle='.$cle.'" class="button">Vérifier mon e-mail</a>
                                <p>Si le bouton ne fonctionne pas, copiez et collez le lien suivant dans votre navigateur :</p>
                                <p><a href="https://funfair.ovh/controllers/verif.php?id='.$_SESSION['id'].'&cle='.$cle.'">https://funfair.ovh/controllers/verif.php?id='.$_SESSION['id'].'&cle='.$cle.'</a></p>
                                <p>Si vous n\'avez pas créé de compte sur FunFair, veuillez ignorer cet e-mail.</p>
                            </div>
                            <div class="footer">
                                <p>Nous vous remercions de votre confiance et restons à votre disposition pour toute question ou assistance.</p>
                                <p><a href="mailto:noreplycardbindex@gmail.com">noreplycardbindex@gmail.com</a></p>
                                <p>FunFair</p>
                                <p>Note : Cet e-mail a été envoyé automatiquement, merci de ne pas y répondre.</p>
                            </div>
                        </div>
                    </body>
                    </html>';
                    
                    $error=smtpmailer($to,$from, $name ,$subj, $msg);
            }

            header("Location: /login");
            exit;
        } else {
            header('Location: register?error=Votre mot de passe doit posséder un minimum de 8 caractères, dont une majuscule, une minuscule, un caractère spécial et un chiffre.');
            exit;
        }
    } else {
        header('Location: register?error=Captcha invalide.');
        exit;
    }
}

require '/views/registration/register.view.php';
