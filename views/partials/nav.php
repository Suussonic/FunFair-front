<?php
session_start();

// Activer l'affichage des erreurs pour le débogage
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once('models/Database.php'); // Assurez-vous que ce fichier initialise une connexion PDO nommée $pdo

if (isset($_SESSION['firstname'])) {
    // Si l'utilisateur est connecté
    if (!isset($_SESSION['id'])) {
        // Si l'ID de session n'est pas défini, afficher un message d'erreur et arrêter l'exécution
        echo 'Erreur : ID de session non défini';
        exit;
    }

    $userId = $_SESSION['id']; // Supposons que l'ID de l'utilisateur est stocké dans $_SESSION['id']

    try {
        // Préparer une requête pour récupérer le rôle de l'utilisateur
        $stmt = $pdo->prepare('SELECT role FROM users WHERE id = :id');
        $stmt->execute(['id' => $userId]);
        $user = $stmt->fetch();

        if ($user && $user['role'] == 'admin') {
            echo '<a class="Connexion" href="/admin">Admin Panel</a>'; // Ajout d'un lien pour l'admin panel
        }
        
        echo '<a class="Connexion" href="/logout">deconnexion</a>';
        echo '<a class="Connexion" href="/back">back</a>';
        
    } catch (PDOException $e) {
        // En cas d'erreur SQL, afficher l'erreur
        echo 'Erreur lors de la requête SQL : ' . $e->getMessage();
    }

} else {
    // Si l'utilisateur n'est pas connecté
    echo '<a class="Connexion" href="/login">Se Connecter</a>';
    echo '<a class="Connexion" href="/back">autre back temporaire</a>';
}
?>
