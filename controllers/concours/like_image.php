<?php
require_once('../../models/Database.php');
session_start();
if (!isset($_SESSION['id'])) {
    header('Location: https://funfair.ovh/login');
    exit();
}

$user_id = $_SESSION['id'];
$image_id = isset($_POST['image_id']) ? (int)$_POST['image_id'] : 0;
$action = isset($_POST['action']) ? $_POST['action'] : '';

if ($image_id > 0) {
    if ($action === 'like') {
        $stmt = $dbh->prepare("SELECT COUNT(*) FROM likes WHERE user_id = :user_id AND image_id = :image_id");
        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':image_id', $image_id);
        $stmt->execute();

        if ($stmt->fetchColumn() > 0) {
            header('Location: https://funfair.ovh/concours');
            exit();
        }

        $stmt = $dbh->prepare("INSERT INTO likes (user_id, image_id) VALUES (:user_id, :image_id)");
        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':image_id', $image_id);

        if ($stmt->execute()) {
            $stmt = $dbh->prepare("UPDATE images SET like_count = like_count + 1 WHERE id = :image_id");
            $stmt->bindParam(':image_id', $image_id);
            $stmt->execute();

            header('Location: https://funfair.ovh/concours');
            exit();
        } else {
            header('Location: https://funfair.ovh/concours');
            exit();
        }
    } elseif ($action === 'unlike') {
        $stmt = $dbh->prepare("SELECT COUNT(*) FROM likes WHERE user_id = :user_id AND image_id = :image_id");
        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':image_id', $image_id);
        $stmt->execute();

        if ($stmt->fetchColumn() === 0) {
            header('Location: https://funfair.ovh/concours');
            exit();
        }

        $stmt = $dbh->prepare("DELETE FROM likes WHERE user_id = :user_id AND image_id = :image_id");
        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':image_id', $image_id);

        if ($stmt->execute()) {
            $stmt = $dbh->prepare("UPDATE images SET like_count = like_count - 1 WHERE id = :image_id");
            $stmt->bindParam(':image_id', $image_id);
            $stmt->execute();

            header('Location: https://funfair.ovh/concours');
            exit();
        } else {
            header('Location: https://funfair.ovh/concours');
            exit();
        }
    } else {
        header('Location: https://funfair.ovh/concours');
        exit();
    }
} else {
    header('Location: https://funfair.ovh/concours');
    exit();
}
