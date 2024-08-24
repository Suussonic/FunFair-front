<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Réservation - Les Tasses Tournantes</title>
    <link rel="stylesheet" href="/public/assets/css/reservation.css">
</head>

<body>
    <header>
        <h1>Réserver - Les Tasses Tournantes</h1>
        <p>Choisissez la date et l'heure de votre réservation</p>
    </header>

    <div class="reservation-form">
        <form method="POST">
            <label for="name">Nom:</label>
            <input type="text" id="name" name="name" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="date">Date de la visite:</label>
            <input type="date" id="date" name="date" required>

            <label for="time">Heure:</label>
            <select id="time" name="time" required>
                <option value="10:00">10:00</option>
                <option value="12:00">12:00</option>
                <option value="14:00">14:00</option>
                <option value="16:00">16:00</option>
            </select>

            <label for="people">Nombre de personnes:</label>
            <input type="number" id="people" name="people" min="1" max="10" required>

            <button type="submit">Réserver</button>
        </form>
    </div>
</body>

</html>