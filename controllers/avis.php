<?php
require 'views/avis.view.php';
    // Création de la connexion
    $connexion = new mysqli($serveur, $utilisateur, $motdepasse, $basededonnees);

    // Vérification de la connexion
    if ($connexion->connect_error) {
        die("Connexion échouée : " . $connexion->connect_error);
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Capture des données du formulaire
        $nom = htmlspecialchars($_POST['name']);
        $email = htmlspecialchars($_POST['email']);
        $note = htmlspecialchars($_POST['rating']);
        $contenu = htmlspecialchars($_POST['message']);

        // Insertion des données dans la base de données
        $requete = "INSERT INTO Avis (nom, email, note, contenu) VALUES ('$nom', '$email', '$note', '$contenu')";

        if ($connexion->query($requete) === TRUE) {
            echo "<p class='success-message'>Merci pour votre avis, $nom !</p>";
        } else {
            echo "<p class='error-message'>Erreur : " . $requete . "<br>" . $connexion->error . "</p>";
        }
    }

    // Récupération de tous les avis de la base de données
    $requete = "SELECT nom, note, contenu, created_at FROM Avis ORDER BY created_at DESC";
    $resultat = $connexion->query($requete);
?>
 <?php
        if ($resultat->num_rows > 0) {
            // Affichage de chaque avis
            while($row = $resultat->fetch_assoc()) {
                echo "<div class='review'>";
                echo "<p><strong>" . htmlspecialchars($row['nom']) . "</strong> (" . htmlspecialchars($row['note']) . "/5)</p>";
                echo "<p>" . nl2br(htmlspecialchars($row['contenu'])) . "</p>";
                echo "<p class='date'>" . date('d/m/Y H:i', strtotime($row['created_at'])) . "</p>";
                echo "</div>";
            }
        } else {
            echo "<p>Aucun avis pour le moment. Soyez le premier à laisser un avis !</p>";
        }

        // Fermeture de la connexion à la base de données
        $connexion->close();
        ?>
    ?>
?>
