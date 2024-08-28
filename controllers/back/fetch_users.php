<?php
include 'models/Database.php'; // Inclure le fichier de connexion à la base de données

// Requête SQL pour récupérer les utilisateurs
$sql = "SELECT id, firstname, lastname, email, gender FROM users";
$stmt = $dbh->query($sql);

// Préparer les données pour l'affichage
$users = [];
if ($stmt->rowCount() > 0) {
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $users[] = $row;
    }
} else {
    $users = []; // Pas de résultats trouvés
}

// Inclure le fichier de vue
include 'views/users.view.php';
?>
