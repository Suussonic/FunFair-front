<?php
include 'models/Database.php';
session_start();

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer et valider les données du formulaire
    $title = trim($_POST['title']);
    $description = trim($_POST['description']);
    $content = trim($_POST['content']);
    $id_author = $_SESSION['user_id'];
    $name_author = $_SESSION['username'];

    // Vérification que les champs ne sont pas vides
    if (!empty($title) && !empty($description) && !empty($content)) {
        try {
            // Préparer la requête d'insertion
            $stmt = $dbh->prepare("INSERT INTO forum (title, description, content, id_author, name_author) VALUES (:title, :description, :content, :id_author, :name_author)");

            // Exécuter la requête avec les paramètres
            $stmt->execute([
                ':title' => $title,
                ':description' => $description,
                ':content' => $content,
                ':id_author' => $id_author,
                ':name_author' => $name_author
            ]);

            // Redirection vers le forum après insertion réussie
            header("Location: /forum");
            exit;
        } catch (PDOException $e) {
            // Gestion des erreurs SQL
            echo "Erreur lors de l'insertion dans la base de données : " . htmlspecialchars($e->getMessage());
        }
    } else {
        echo "Veuillez remplir tous les champs.";
    }
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
    <input type="text" name="title" placeholder="Titre de la question" value="<?php echo isset($title) ? htmlspecialchars($title) : ''; ?>" required>
    <textarea name="description" placeholder="Description courte" required><?php echo isset($description) ? htmlspecialchars($description) : ''; ?></textarea>
    <textarea name="content" placeholder="Contenu détaillé" required><?php echo isset($content) ? htmlspecialchars($content) : ''; ?></textarea>
    <button type="submit">Envoyer</button>
</form>

<a href="forum.php">Retour au forum</a>

</body>
</html>
