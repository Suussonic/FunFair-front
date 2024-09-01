<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require 'views/avis.view.php';
?>

<?php

include 'models/Database.php';
session_start();


if ($connexion->connect_error) {
    die("Connexion échouée : " . $connexion->connect_error);
}

// Si la méthode de requête est POST, nous allons insérer un nouvel avis
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Capture des données du formulaire
    $nom = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $note = htmlspecialchars($_POST['rating']);
    $contenu = htmlspecialchars($_POST['message']);

    // Insertion des données dans la base de données
    $requete = "INSERT INTO Avis (nom, email, note, contenu) VALUES ('$nom', '$email', '$note', '$contenu')";

    if ($connexion->query($requete) === TRUE) {
        $message = "Merci pour votre avis, $nom !";
    } else {
        $message = "Erreur : " . $connexion->error;
    }
}

// Récupération de tous les avis de la base de données
$requete = "SELECT nom, note, contenu, created_at FROM Avis ORDER BY created_at DESC";
$resultat = $connexion->query($requete);

// Inclure la vue pour afficher la page
require 'views/avis.view.php';

// Fermeture de la connexion à la base de données
$connexion->close();
?>

