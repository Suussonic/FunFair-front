<?php

require_once('db.php');
include('logs.php');

$errorInfo = false;

if (!$dbh) {
    die('Connexion à la base de données échouée.');
}

if (isset($_POST['email']) && isset($_POST['password'])) {

    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'];

    $loginSql = 'SELECT * FROM users WHERE email = :email';

    try {
        $preparedLoginRequest = $dbh->prepare($loginSql);
        $preparedLoginRequest->execute(['email' => $email]);
    } catch (PDOException $e) {
        die('Erreur lors de l\'exécution de la requête SQL : ' . $e->getMessage());
    }

    $user = $preparedLoginRequest->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        session_start();

        $_SESSION['userId'] = $user['id'];
        $_SESSION['firstname'] = $user['firstname'];
        $_SESSION['lastname'] = $user['lastname'];
        $_SESSION['user'] = $user;
        $_SESSION['theme'] = $user['theme'] ?? 'default';

        insert_logs('connexion');
        header('location:../index.php');
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