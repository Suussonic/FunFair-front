<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require 'views/avis.view.php';


include 'models/Database.php';
session_start();

// Inclure le fichier de configuration de la base de données et démarrer la session
include 'models/Database.php';
session_start();

// Vérifier si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Capture des données du formulaire
    $nom = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $note = htmlspecialchars($_POST['rating']);
    $contenu = htmlspecialchars($_POST['message']);

    // Préparer la requête d'insertion
    $requete = "INSERT INTO Avis (nom, email, note, contenu) VALUES (?, ?, ?, ?)";
    
    // Préparer et exécuter la requête pour éviter les injections SQL
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

// Récupérer tous les avis existants
$requete = "SELECT nom, note, contenu, created_at FROM Avis ORDER BY created_at DESC";
$resultat = $connexion->query($requete);

// Inclure la vue pour afficher les avis et le formulaire
require 'views/avis.view.php';

// Fermeture de la connexion à la base de données
$connexion->close();
?>
