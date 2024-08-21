<?php
session_start();
include_once('PHP/db.php');
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fun Fair - Parc d'Attractions</title>
    <link rel="stylesheet" href="CSS/index.css">
    <?php include 'PHP/theme.php'; ?>
    
</head>
    
<body>
    <?php include 'PHP/nav.php'; ?>
    <header>
        <h1>Bienvenue à Fun Fair</h1>
        <p>Le parc d'attractions où le plaisir ne s'arrête jamais !</p>
    </header>

    <nav>
        <a href="HTML/attractions.html">Attractions</a>
        <a href="HTML/horaire.html">Horaires</a>
        <a href="HTML/billets.html">Billets</a>
        <a href="HTML/avis.html">Laissez un Avis</a>
        <a href="HTML/contact.html">Contact</a>
        <a href="HTML/forum.html">Forum</a>
    </nav>

    <a href="HTML/attractions.html" class="cta-button">Découvrez nos attractions</a>
    
    <footer>
        <p>© 2024, Fun-Fair. Les autres marques, images ou noms de produit appartiennent à leurs propriétaires respectifs.</p>
        <h2>Nous Contacter</h2>
        <p>Email: projet.annuel3tan@gmail.com</p>
        <h2>Nos réseaux :</h2>
        <a href="https://github.com/Suussonic/Fun-Fair" target="_blank">
            <img src="ASSET/GITHUB.png" alt="GITHUB">
        </a>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>
