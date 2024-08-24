
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
          <h1>Réserver - <?php echo(getNom($idstripe))?></h1>
          <p>Choisissez la date et l'heure de votre réservation</p>
      </header>
  
      <div class="reservation-form">
          <form action="chekoutsession.view.php" method="POST">
              <input type="text" id="name" name="name" placeholder="Nom :" required>
  
              <input type="email" id="email" name="email" placeholder="Email :" required>
  
              <input type="date" id="date" name="date" placeholder="Date de la visite :" required>
  
              <select id="time" name="time" placeholder="Heure :" required>
                  <option value="10:00">10:00</option>
                  <option value="12:00">12:00</option>
                  <option value="14:00">14:00</option>
                  <option value="16:00">16:00</option>
              </select>
  
              <input type="number" id="people" name="people" min="1" max="10" placeholder="Nombre de personnes :" required>
              
              <!--input vide qui permet de récupérer l'article à payer-->
              <input type="hidden" name="lookup_key" value="<?php echo($idstripe)?>" />
  
              <button type="submit">Réserver</button>
          </form>
      </div>
  </body>
  
  </html>