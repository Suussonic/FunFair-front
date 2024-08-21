<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fun Fair - Attractions</title>
    <script type="text/javascript" src="/public/assets/js/attractionsfilter.js"></script>
    <link rel="stylesheet" type="text/css" href="/public/assets/css/partials.css">
    <link rel="stylesheet" href="/public/assets/css/attractions.css">
</head>

<body>
<?php include 'partials/nav.php'; ?>
    <h1>Nos Attractions</h1>

    <div class="filter">
        <label for="ageFilter">Filtrer par âge minimum:</label>
        <select id="ageFilter" onchange="filterAttractions()">
            <option>Tous les âges</option>
            <option value="0">0+</option>
            <option value="5">5+</option>
            <option value="10">10+</option>
            <option value="15">15+</option>
        </select>
    </div>

    <div class="attraction-list" id="attractionList">
        <div class="attraction-item" data-age="0">
            <h2>Le Petit Train</h2>
            <p>Une balade tranquille à travers le parc pour toute la famille.</p>
            <p class="age-requirement">Âge minimum: 0+</p>
            <a class="reserve-button" href="/reservation/petit-train">Réserver</a>
        </div>
        <div class="attraction-item" data-age="5">
            <h2>La Grande Roue</h2>
            <p>Profitez d'une vue imprenable sur le parc depuis les hauteurs.</p>
            <p class="age-requirement">Âge minimum: 5+</p>
            <a class="reserve-button" href="/reservation/grande-roue">Réserver</a>
        </div>
        <div class="attraction-item" data-age="10">
            <h2>Les Montagnes Russes</h2>
            <p>Des sensations fortes garanties pour les amateurs d'adrénaline.</p>
            <p class="age-requirement">Âge minimum: 10+</p>
            <a class="reserve-button" href="/reservation/montagnes-russes">Réserver</a>
        </div>
        <div class="attraction-item" data-age="15">
            <h2>Le Manoir Hanté</h2>
            <p>Oserez-vous entrer dans ce manoir effrayant ? Âmes sensibles s'abstenir.</p>
            <p class="age-requirement">Âge minimum: 15+</p>
            <a class="reserve-button" href="/reservation/manoir-hante">Réserver</a>
        </div>
        <div class="attraction-item" data-age="5">
            <h2>Les Tasses Tournantes</h2>
            <p>Faites tourner votre tasse à toute vitesse, un classique pour les plus jeunes.</p>
            <p class="age-requirement">Âge minimum: 5+</p>
            <a class="reserve-button" href="/reservation/tasses-tournantes">Réserver</a>
        </div>
        <div class="attraction-item" data-age="10">
            <h2>La Rivière Sauvage</h2>
            <p>Une descente aquatique pleine de rebondissements et de surprises.</p>
            <p class="age-requirement">Âge minimum: 10+</p>
            <a class="reserve-button" href="/reservation/riviere-sauvage">Réserver</a>
        </div>
        <div class="attraction-item" data-age="0">
            <h2>Le Carrousel</h2>
            <p>Un tour de manège enchanteur pour les petits et les grands.</p>
            <p class="age-requirement">Âge minimum: 0+</p>
            <a class="reserve-button" href="/reservation/carrousel">Réserver</a>
        </div>
        <div class="attraction-item" data-age="15">
            <h2>La Tour de Chute Libre</h2>
            <p>Faites le grand saut depuis les hauteurs et ressentez l'adrénaline pure.</p>
            <p class="age-requirement">Âge minimum: 15+</p>
            <a class="reserve-button" href="/reservation/tour-chute-libre">Réserver</a>
        </div>
    </div>

    <div class="back-to-home">
        <a href="/">Retour à l'accueil</a>
    </div>

    <?php include 'partials/footer.php'; ?>
</body>

</html>