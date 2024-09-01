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
    <div>
        <h1>Bienvenue à Fun Fair</h1>
        <p>Le parc d'attractions où le plaisir ne s'arrête jamais !</p>
    </div>

    <h3>Liens rapides</h3>
            <nav class=".nav-bar">
                <a href="/attractions">Attractions</a>
                <a href="/horaire">Horaires</a>
                <a href="/billets">Billets</a>
                <a href="/forum">Forum</a>
                <a href="/avis">Laissez un Avis</a>
                <a href="/contact">Contact</a>
            </nav>

    <a href="/attractions" class="cta-button">Découvrez nos attractions</a>
    <?php include 'partials/footer.php'; ?>
</body>

</html>
