<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Inclure le fichier de configuration de la base de données


// Check if the database connection is established
if (!isset($connexion)) {
    die("Erreur : La connexion à la base de données n'est pas définie.");
}

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Capture form data
    $nom = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $note = htmlspecialchars($_POST['rating']);
    $contenu = htmlspecialchars($_POST['message']);

    // Prepare the SQL insert query
    $requete = "INSERT INTO Avis (nom, email, note, contenu) VALUES (?, ?, ?, ?)";

    // Prepare and execute the query to prevent SQL injection
    if ($stmt = $connexion->prepare($requete)) {
        $stmt->bind_param('ssis', $nom, $email, $note, $contenu);
        if ($stmt->execute()) {
            $message = "Merci pour votre avis, $nom !";
        } else {
            $message = "Erreur lors de l'envoi de votre avis. Veuillez réessayer.";
        }
        $stmt->close();
    } else {
        $message = "Erreur de préparation de la requête.";
    }
}

// Fetch all existing reviews
$requete = "SELECT nom, note, contenu, created_at FROM Avis ORDER BY created_at DESC";
$resultat = $connexion->query($requete);

// Include the view to display the reviews and form
require 'views/avis.view.php';

// Close the database connection
$connexion->close();
?>
