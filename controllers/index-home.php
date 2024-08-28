<?php
session_start();
include_once('models/Database.php');


if (isset($_SESSION['firstname'])) {
    // Si l'utilisateur est connecté
    $userId = $_SESSION['user_id']; // Assurez-vous que l'ID de l'utilisateur est stocké dans la session

    // Préparez une requête pour vérifier la valeur du captcha
    $stmt = $pdo->prepare('SELECT role FROM users WHERE id = :id');
    $stmt->execute(['id' => $userId]);
    $user = $stmt->fetch();

    if ($user && $user['role'] == 'admin') {
        echo '<a class="Connexion" href="/back">back</a>';
    } else {
        echo '<a class="Connexion" href="/logout">deconnexion</a>';
        echo '<a class="Connexion" href="/back">Back temporaire</a>';
    }
} else {
    // Si l'utilisateur n'est pas connecté
        echo '<a class="Connexion" href="/login">Se Connecter</a>';
        echo '<a class="Connexion" href="/back">autre back temporaire</a>';
}


require 'views/index.view.php';
?>