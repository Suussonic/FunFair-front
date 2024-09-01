<?php
include 'models/Database.php';
session_start();

$stmt = $dbh->query("SELECT * FROM question ORDER BY id DESC");
$questions = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forum</title>
</head>
<body>

<h1>Forum</h1>

<a href="new_question.php">Poser une nouvelle question</a>

<h2>Questions existantes</h2>
<ul>
    <?php foreach ($questions as $question): ?>
        <li>
            <a href="question.php?id=<?= $question['id'] ?>">
                <strong><?= htmlspecialchars($question['title']) ?></strong><br>
                <?= htmlspecialchars($question['description']) ?><br>
                <small>Posté par <?= htmlspecialchars($question['name_author']) ?> le <?= $question['date_publication'] ?></small>
            </a>
        </li>
    <?php endforeach; ?>
</ul>

</body>
</html>
