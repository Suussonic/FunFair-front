<?php
session_start();
include_once('./PHP/db.php');
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fun Fair - Parc d'Attractions</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #121212;
            color: #f0f0f0;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        header {
            text-align: center;
            margin-bottom: 50px;
        }

        h1 {
            font-size: 3em;
            color: #ff6f61;
            margin: 0;
        }

        p {
            font-size: 1.2em;
            margin: 10px 0;
        }

        nav {
            margin-top: 20px;
        }

        nav a {
            color: #ff6f61;
            text-decoration: none;
            font-size: 1.2em;
            margin: 0 15px;
            transition: color 0.3s;
        }

        nav a:hover {
            color: #ffa07a;
        }

        .cta-button {
            display: inline-block;
            padding: 15px 30px;
            margin-top: 30px;
            font-size: 1.2em;
            background-color: #ff6f61;
            color: #121212;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            transition: background-color 0.3s;
        }

        .cta-button:hover {
            background-color: #ffa07a;
        }

        footer {
            margin-top: auto;
            background-color: #1f1f1f;
            width: 100%;
            padding: 20px 0;
            text-align: center;
        }

        footer p {
            font-size: 0.9em;
            margin: 5px 0;
            color: #a0a0a0;
        }

        footer h2 {
            font-size: 1.2em;
            color: #f0f0f0;
            margin: 10px 0;
        }

        footer a {
            color: #ff6f61;
            text-decoration: none;
            margin: 0 10px;
            transition: color 0.3s;
        }

        footer a:hover {
            color: #ffa07a;
        }

        footer img {
            margin-top: 10px;
            width: 24px;
            height: 24px;
            transition: transform 0.3s;
        }

        footer img:hover {
            transform: scale(1.2);
        }
    </style>
</head>
<body>
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
    </nav>

    <a href="HTML/attractions.html" class="cta-button">Découvrez nos attractions</a>
    
    <footer>
        <p>© 2024, Fun-Fair. Les autres marques, images ou noms de produit appartiennent à leurs propriétaires respectifs.</p>
        <h2>Nous Contacter</h2>
        <p>Email: projet.annuel3tan@gmail.com</p>
        <h2>Nos réseaux :</h2>
        <a href="https://github.com/Suussonic/Fun-Fair" target="_blank">
            <img src="./ASSET/GITHUB.png" alt="GITHUB">
        </a>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>
