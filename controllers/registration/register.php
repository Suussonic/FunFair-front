<?php

include_once('models/Database.php');
include('config/register.php');


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

            $cle = rand(10000,90000);  //creation de la cle
            $confirme = 0;
            $insererUsers = $bdd->prepare('INSERT INTO users (firstname, lastname, email, password, gender, confirme, cle) 
                                            VALUES (:firstname, :lastname, :email, :password, :gender, :confirme, :cle)'); 
            $insererUsers->execute([
                'firstname' => $firstname,
                'lastname' => $lastname,
                'email' => $email,
                'password' => $hasedPassword,
                'gender' => $gender,
                'confirme' => $confirme,
                'cle' => $cle,
            ]);                    

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

require 'views/registration/register.view.php';
