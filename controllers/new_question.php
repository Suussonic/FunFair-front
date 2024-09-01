<?php
include 'models/Database.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $content = $_POST['content'];
    $id_author = $_SESSION['user_id'];
    $name_author = $_SESSION['username'];

    $stmt = $dbh->prepare("INSERT INTO forum (title, description, content, id_author, name_author) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$title, $description, $content, $id_author, $name_author]);

    header("Location: /forum");
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nouvelle Question</title>
</head>
<body>

<h1>Poser une nouvelle question</h1>

<form method="post">
    <input type="text" name="title" placeholder="Titre de la question" required>
    <textarea name="description" placeholder="Description courte" required></textarea>
    <textarea name="content" placeholder="Contenu détaillé" required></textarea>
    <button type="submit">Envoyer</button>
</form>

<a href="forum.php">Retour au forum</a>

</body>
</html>
