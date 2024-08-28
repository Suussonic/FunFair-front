<?php
// Inclure le fichier de connexion à la base de données

include 'models/Database.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (isset($_SESSION['firstname'])) {
    // Récupérer le rôle de l'utilisateur depuis la base de données
    $id = $_SESSION['id']; // Supposons que l'ID de l'utilisateur est stocké dans $_SESSION['id']
    $sql = "SELECT role FROM users WHERE id = $id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $role = $row['role'];
    }

    // Affichage des boutons selon le rôle
    echo '<a class="Connexion" href="/logout">deconnexion</a>';
    echo '<a class="Connexion" href="/back">back</a>';
    if ($role === 'admin') {
        echo '<a class="Connexion" href="/admin">Admin Panel</a>';
    }
} else {
    echo '<a class="Connexion" href="/login">Se Connecter</a>';
    echo '<a class="Connexion" href="/back">back</a>';
}
?>
