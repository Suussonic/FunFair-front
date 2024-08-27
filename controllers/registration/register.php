<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once('db.php');
include('verifmdp.php');
include_once('models/Database.php');

include('config/register.php');


if (isset($_POST['captcha_answer']) && isset($_POST['captcha_id'])) {
    $captcha_id = $_POST['captcha_id'];
@@ -43,20 +41,17 @@
                'password' => $hashedPassword,
                'gender' => $gender,
            ]);

            // Rediriger vers la page de connexion après une inscription réussie
            header("Location: loginForm.php");

            header("Location: /login");
            exit;
        } else {
            header('Location: form.php?error=Votre mot de passe doit posséder un minimum de 8 caractères, dont une majuscule, une minuscule, un caractère spécial et un chiffre.');
            header('Location: register?error=Votre mot de passe doit posséder un minimum de 8 caractères, dont une majuscule, une minuscule, un caractère spécial et un chiffre.');
            exit;
        }
    } else {
        header('Location: form.php?error=Réponse au captcha incorrecte. Veuillez réessayer.');
        header('Location: register?error=Captcha invalide.');
        exit;
    }
} else {
    header('Location: form.php?error=Veuillez répondre au captcha.');
    exit;
}
?>

require 'views/registration/register.view.php';