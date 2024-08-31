<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="public/assets/css/confirmation.css">
    <title>Confirmation de Réservation</title>
</head>
<body>
    <div class="confirmation-container">
        <h1>Votre réservation a été prise en compte !</h1>
        <?php if ($reservation_id): ?>
            <p>Merci d'avoir réservé avec nous. Votre numéro de réservation est <strong><?php echo htmlspecialchars($reservation_id); ?></strong>.</p>
        <?php else: ?>
            <p>Merci d'avoir réservé avec nous.</p>
        <?php endif; ?>
        <p>Nous vous enverrons un email de confirmation avec tous les détails de votre réservation.</p>
        <a href="index.php" class="action-button">Retour à l'accueil</a>
    </div>
</body>
</html>

<?php
include 'footer.php'; // Inclure le pied de page
?>