<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once('models/Database.php');

if (isset($_POST['upload'])) {
    if(!isset($_SESSION['id'])) {
        header('Location: https://funfair.ovh/login');
    }
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $image_name = $_FILES['image']['name'];
        $image_data = file_get_contents($_FILES['image']['tmp_name']);
        $author = $_SESSION['firstname'];

        $stmt = $dbh->prepare("INSERT INTO images (image_name, image_data, author) VALUES (:image_name, :image_data, :author)");
        $stmt->bindParam(':image_name', $image_name);
        $stmt->bindParam(':image_data', $image_data, PDO::PARAM_LOB);
        $stmt->bindParam(':author', $author);

        if ($stmt->execute()) {
            echo "<p class='message'>Image uploadée avec succès !</p>";
        } else {
            echo "<p class='message'>Erreur lors de l'upload de l'image.</p>";
        }
    }
}

$query = $dbh->prepare("SELECT id, image_name, image_data, author, like_count FROM images ORDER BY like_count DESC");
$query->execute();
$result = $query->fetchAll();

require 'views/concours.view.php';
?>
