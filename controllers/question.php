<?php
include 'models/Database.php';
session_start();

$question_id = $_GET['id'];
$stmt = $dbh->prepare("SELECT * FROM forum WHERE id = ?");
$stmt->execute([$question_id]);
$question = $stmt->fetch();

if (!$question) {
    die("Question non trouvée.");
}

$stmt_responses = $dbh->prepare("SELECT * FROM responses WHERE question_id = ? ORDER BY id DESC");
$stmt_responses->execute([$question_id]);
$responses = $stmt_responses->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($question['title']) ?></title>
</head>
<body>

<h1><?= htmlspecialchars($question['title']) ?></h1>
<p><?= htmlspecialchars($question['description']) ?></p>
<p><?= htmlspecialchars($question['content']) ?></p>
<p><small>Posté par <?= htmlspecialchars($question['name_author']) ?> le <?= $question['date_publication'] ?></small></p>

<h2>Réponses</h2>
<ul>
    <?php foreach ($responses as $response): ?>
        <li><?= htmlspecialchars($response['content']) ?><br>
            <small>Posté par <?= htmlspecialchars($response['name_author']) ?> le <?= $response['date_publication'] ?></small>
        </li>
    <?php endforeach; ?>
</ul>

<?php if (isset($_SESSION['user_id'])): ?>
    <h2>Répondre à la question</h2>
    <form method="post" action="respond.php">
        <textarea name="content" placeholder="Votre réponse" required></textarea>
        <input type="hidden" name="question_id" value="<?= $question_id ?>">
        <button type="submit">Envoyer</button>
    </form>
<?php else: ?>
    <p><a href="login.php">Connectez-vous</a> pour répondre.</p>
<?php endif; ?>

<a href="forum.php">Retour au forum</a>

</body>
</html>
