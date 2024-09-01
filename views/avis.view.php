<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fun Fair - Laissez un Avis</title>
    <link rel="stylesheet" type="text/css" href="/public/assets/css/partials.css">
    <link rel="stylesheet" href="/public/assets/css/avis.css">
    <link rel="shortcut icon" href="/public/assets/images/logo.png" type="image/x-icon">
</head>

<body>
    <h1>Laissez un Avis</h1>

    <?php if (isset($message)): ?>
        <p class="message"><?= htmlspecialchars($message) ?></p>
    <?php endif; ?>

    <form action="/controllers/registration/avis.php" method="POST">
        <label for="name">Nom :</label>
        <input type="text" id="name" name="name" required>

        <label for="email">Email :</label>
        <input type="email" id="email" name="email" required>

        <label for="rating">Note :</label>
        <select id="rating" name="rating" required>
            <option value="5">5 - Excellent</option>
            <option value="4">4 - Très bien</option>
            <option value="3">3 - Bien</option>
            <option value="2">2 - Moyen</option>
            <option value="1">1 - Mauvais</option>
        </select>

        <label for="message">Votre avis :</label>
        <textarea id="message" name="message" required></textarea>

        <input type="submit" value="Envoyer">
    </form>

    <div class="back-to-home">
        <a href="/">Retour à l'accueil</a>
    </div>

    <h2>Avis des autres visiteurs</h2>
    <div class="reviews">
        <?php if ($resultat->num_rows > 0): ?>
            <?php while($row = $resultat->fetch_assoc()): ?>
                <div class="review">
                    <p><strong><?= htmlspecialchars($row['nom']) ?></strong> (<?= htmlspecialchars($row['note']) ?>/5)</p>
                    <p><?= nl2br(htmlspecialchars($row['contenu'])) ?></p>
                    <p class="date"><?= date('d/m/Y H:i', strtotime($row['created_at'])) ?></p>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p>Aucun avis pour le moment. Soyez le premier à laisser un avis !</p>
        <?php endif; ?>
    </div>
</body>
<?php include 'partials/footer.php'; ?>
</html>
