<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fun Fair - Parc d'Attractions</title>
    <link rel="stylesheet" type="text/css" href="/public/assets/css/partials.css">
    <link rel="stylesheet" type="text/css" href="/public/assets/css/index.css">
    <link rel="shortcut icon" href="/public/assets/images/logo.png" type="image/x-icon">
</head>

<body>
    <header>
        <?php include 'partials/nav.php'; ?>
    </header>
     <div style="flex: 1; min-width: 200px; padding: 10px;">
                <h3 style="color: #ff6f61; margin-bottom: 15px;">Liens rapides</h3>
                <ul style="list-style: none; padding: 0;">
                    <li><a href="views/attractions.views/php" style="color: #f0f0f0; text-decoration: none;">Attractions</a></li>
                    <li><a href="views/horaires.views.php" style="color: #f0f0f0; text-decoration: none;">Horaires</a></li>
                    <li><a href="views/billets.views.php" style="color: #f0f0f0; text-decoration: none;">Billets</a></li>
                    <li><a href="views/avis.views.php" style="color: #f0f0f0; text-decoration: none;">Laissez un Avis</a></li>
                    <li><a href="views/contact.views.php" style="color: #f0f0f0; text-decoration: none;">Contact</a></li>
                </ul>
            </div>
    <div>
        <h1>Bienvenue à Fun Fair</h1>
        <p>Le parc d'attractions où le plaisir ne s'arrête jamais !</p>
    </div>

    <a href="/attractions" class="cta-button">Découvrez nos attractions</a>
    <?php include 'partials/footer.php'; ?>
</body>

</html>
