<?php
session_start();
include_once('./PHP/db.php');
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="sUTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="ASSET/CARDBINDEX V5.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link rel="stylesheet" href="CSS/Index.css">
    <?php include 'PHP/theme.php'; ?>
    <title>Accueil</title>
</head>

<body>
    <?php include 'PHP/nav.php'; ?>
    <header>
        <h1>Bienvenue à Fun-Fair</h1>
        <p>Le parc d'attractions où le plaisir ne s'arrête jamais !</p>
    </header>

    <nav>
        <a href="HTML/attractions.html">Attractions</a>
        <a href="#horaires">Horaires</a>
        <a href="#billets">Billets</a>
        <a href="#contact">Contact</a>
    </nav>

    <a href="#billets" class="cta-button">Achetez vos billets maintenant</a>

    <footer>
        <div id="Credit">
            <p>© 2024, Fun-Fair. Les autres marques, images ou noms de produit appartiennent à leurs propriétaires respectifs.</p>
        </div>
        <div id="Lien">
            <h2>Nous Contacter</h2>
            <h2>projet.annuel3tan@gmail.com</h2>
            <h2>Nos réseaux :</h2>
            <a href="https://github.com/Suussonic/Fun-Fair" target="_blank"><img src="./ASSET/GITHUB.png" alt="GITHUB" width="24px" height="24px"></a>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>
