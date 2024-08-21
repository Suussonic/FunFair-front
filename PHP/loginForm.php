<?php
// Inclure le fichier de connexion à la base de données et les fonctions de logging
require_once('db.php');
include('logs.php');

$errorInfo = false;

// Vérifier si la connexion à la base de données est réussie
if (!$dbh) {
    die('Connexion à la base de données échouée.');
}

// Vérifier si le formulaire a été soumis
if (isset($_POST['email']) && isset($_POST['password'])) {
    // Sanitize les données de l'utilisateur
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'];

    // Préparer la requête pour récupérer l'utilisateur par email
    $loginSql = 'SELECT * FROM users WHERE email = :email';

    try {
        $preparedLoginRequest = $dbh->prepare($loginSql);
        $preparedLoginRequest->execute(['email' => $email]);
    } catch (PDOException $e) {
        die('Erreur lors de l\'exécution de la requête SQL : ' . $e->getMessage());
    }

    // Récupérer l'utilisateur depuis la base de données
    $user = $preparedLoginRequest->fetch(PDO::FETCH_ASSOC);

    // Vérifier si l'utilisateur existe et si le mot de passe est correct
    if ($user && password_verify($password, $user['password'])) {
        session_start();
        // Stocker les informations utilisateur dans la session
        $_SESSION['userId'] = $user['id'];
        $_SESSION['firstname'] = $user['firstname'];
        $_SESSION['lastname'] = $user['lastname'];
        $_SESSION['user'] = $user;

        insert_logs('connexion');
        header('location:../index.php'); // Rediriger vers la page d'accueil
        exit;
    } else {
        $errorInfo = true;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="shortcut icon" href="../ASSET/CARDBINDEX V5.png" type="image/x-icon">
    <link rel="stylesheet" href="../CSS/LoginForm.css">
    <?php include 'theme.php'; ?>
    <title>Connexion</title>
</head>
<body>
    <form action="loginForm.php" method="POST">
        <h1>Se connecter</h1>
        <div>
            <input id="email" placeholder="Mail" type="email" name="email" required>
        </div>
        <div>
            <input id="password" placeholder="Mot de passe" type="password" name="password" required>
        </div>
        <?php
        // Afficher un message d'erreur si les informations sont incorrectes
        if ($errorInfo) {
            echo "<p class='error'>Utilisateur ou Mot de passe incorrect</p>";
        }
        ?>
        <input type="submit" class="btn" value="Se connecter">
        <a href="form.php">
            <div id="btn2">S'inscrire</div>
        </a>
    </form>
    <p>Mot de passe oublié ? <u style="color:#f1c40f;">Cliquez ici !</u></p>
</body>
</html>