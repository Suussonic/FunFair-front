<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Réservation</title>
  <link rel="stylesheet" href="/public/assets/css/reservation.css">
</head>

<body>
  <header>
    <h1>Réserver - <?php echo ($name) ?></h1>
  </header>

  <div class="reservation-form">
  <form method="POST" action="/controllers/registration/checkout.php">
            <!--<input type="text" id="name" name="name" placeholder="Nom :" required>-->

            <input type="email" id="email" name="email" placeholder="Email :" required>

            <input type="date" id="date" name="date" placeholder="Date" required>

            <select id="time" name="time" placeholder="Heure" required>
                <option value="10:00">10:00</option>
                <option value="12:00">12:00</option>
                <option value="14:00">14:00</option>
                <option value="16:00">16:00</option>
            </select>

            <input type="number" id="people" name="people" min="1" max="10" placeholder="Nombre de personne" required>

            <button type="submit">Réserver</button>
        </form>
  </div>
</body>

</html>