<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once('db.php');
include('verifmdp.php');

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
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

            $insertUser = "
                INSERT INTO users (firstname, lastname, email, password, gender)
                VALUES (:firstname, :lastname, :email, :password, :gender)
            ";

            $preparedQuery = $dbh->prepare($insertUser);
            $preparedQuery->execute([
                'firstname' => $firstname,
                'lastname' => $lastname,
                'email' => $email,
                'password' => $hashedPassword,
                'gender' => $gender,
            ]);
            
            // Rediriger vers la page de connexion après une inscription réussie
            header("Location: loginForm.php");
            exit;
        } else {
            header('Location: form.php?error=Votre mot de passe doit posséder un minimum de 8 caractères, dont une majuscule, une minuscule, un caractère spécial et un chiffre.');
            exit;
        }
    } else {
        header('Location: form.php?error=Réponse au captcha incorrecte. Veuillez réessayer.');
        exit;
    }
} else {
    header('Location: form.php?error=Veuillez répondre au captcha.');
    exit;
}
?>
