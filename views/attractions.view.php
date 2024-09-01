<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fun Fair - Attractions</title>
    <script type="text/javascript" src="/public/assets/js/attractionsfilter.js"></script>
    <link rel="stylesheet" type="text/css" href="/public/assets/css/partials.css">
    <link rel="stylesheet" href="/public/assets/css/attractions.css">
    <link rel="shortcut icon" href="/public/assets/images/logo.png" type="image/x-icon">
</head>

<body>
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
        <div class="attraction-item" data-age="5">
            <h2>La Grande Roue</h2>
            <p>Profitez d'une vue imprenable sur le parc depuis les hauteurs.</p>
            <p class="age-requirement">Âge minimum: 5+</p>
            <a class="reserve-button" href="/checkout?name=La+Grande+Roue&stripeid=lagranderoue">Réserver</a>
        </div>
        <div class="attraction-item" data-age="10">
            <h2>Intimidator 305</h2>
            <p>Des sensations fortes garanties pour les amateurs d'adrénaline.</p>
            <p class="age-requirement">Âge minimum: 10+</p>
            <a class="reserve-button" href="/checkout?name=Intimidator+305&stripeid=intimidator">Réserver</a>
        </div>
    </div>

    <div class="back-to-home">
        <a href="/">Retour à l'accueil</a>
    </div>

    <?php include 'partials/footer.php'; ?>
</body>

</html>