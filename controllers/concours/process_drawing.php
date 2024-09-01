<?php
// Activer l'affichage des erreurs pour le débogage
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once('models/Database.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['canvasData']) && !empty($_POST['canvasData'])) {
        // Décoder les données base64
        $image_data = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $_POST['canvasData']));

        if ($image_data === false) {
            header('Location: https://funfair.ovh/concours');
            exit();
        } else {
            // Insertion dans la base de données
            $stmt = $dbh->prepare("INSERT INTO images (image_name, image_data, author) VALUES (:image_name, :image_data, :author)");
            $image_name = "Dessin_" . uniqid();  // Nom unique pour l'image
            $author = $_SESSION['firstname'];  // Remplacez par l'auteur réel si nécessaire

            $stmt->bindParam(':image_name', $image_name);
            $stmt->bindParam(':image_data', $image_data, PDO::PARAM_LOB);
            $stmt->bindParam(':author', $author);

            if ($stmt->execute()) {
                echo "Le dessin a été enregistré avec succès dans la base de données !";
                header('Location: https://funfair.ovh/concours');
                exit();
            } else {
                echo "Erreur lors de l'enregistrement du dessin dans la base de données.";
                header('Location: https://funfair.ovh/concours');
                exit();
            }
        }
    } else {
        header('Location: https://funfair.ovh/concours');
        exit();
    }
} else {
    header('Location: https://funfair.ovh/concours');
    exit();
}
?>
