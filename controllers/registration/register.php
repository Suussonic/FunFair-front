<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


include_once('models/Database.php');
include('config/register.php');

// Vérification de la réponse au captcha
if (isset($_POST['captcha_answer']) && isset($_POST['captcha_id'])) {
    $captcha_id = $_POST['captcha_id'];
    $captcha_answer = trim($_POST['captcha_answer']);

    // Récupérer la réponse correcte depuis la base de données
    $sql = "SELECT r FROM captcha WHERE id = :captcha_id";
    $stmt = $pdo->prepare($sql); // Utilisation de l'objet PDO ($pdo) pour préparer la requête
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

        // Vérifier la validité du mot de passe (assurez-vous que la fonction verifierMotDePasse() existe)
        if (verifierMotDePasse($pass)) {
            $hashedPassword = password_hash($pass, PASSWORD_BCRYPT);

            $insertUser = "
                INSERT INTO users (firstname, lastname, email, password, gender)
                VALUES (:firstname, :lastname, :email, :password, :gender)
            ";

            $preparedQuery = $pdo->prepare($insertUser); // Utilisation de l'objet PDO ($pdo) pour préparer la requête
            $preparedQuery->execute([
                'firstname' => $firstname,
                'lastname' => $lastname,
                'email' => $email,
                'password' => $hashedPassword,
                'gender' => $gender,
            ]);
            
            // Rediriger vers la page de connexion après une inscription réussie
            header("Location: /controllers/registration/login.php");
            exit;
        } else {
            header('Location: /controllers/registration/register.php?error=Votre mot de passe doit posséder un minimum de 8 caractères, dont une majuscule, une minuscule, un caractère spécial et un chiffre.');
            exit;
        }
    } else {
        header('Location: /controllers/registration/register.php?error=Réponse au captcha incorrecte. Veuillez réessayer.');
        exit;
    }
} else {
    header('Location: /controllers/registration/register.php?error=Veuillez répondre au captcha.');
    exit;
}

// Inclure la vue du formulaire d'inscription

require 'views/registration/register.view.php';?>
