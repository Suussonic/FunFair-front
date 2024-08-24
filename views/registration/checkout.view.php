<?php

include_once('models/Database.php');
require_once('../stripe/init.php');

use Stripe\Stripe;

$stripeSecretKey = 'sk_test_51PrNEeIpuwwZKBGaVhN6YsIQeDn7BQ8CEaBNCLrB9Iw8IFX0Q5yNe6Mssxb5khU4FG4jsm6TWvOWWWdqmIBtsrm700gE3NazR4';

$stripe = new \Stripe\StripeClient($stripeSecretKey);
header('Content-Type: application/json');

$idstripe = $_POST['idstripe'];

function getNom($idstripe):string{
  $query = $dbh -> prepare("Select nom from attractions where idstripe = :idstripe");
  $query -> bindParam(':idstripe', $idstripe);
  $query -> execute();
  $result = $query -> fetch();
  return $result['nom'];
}

$YOUR_DOMAIN = 'http://localhost:4242';

$checkout_session = $stripe->checkout->sessions->create([
  'ui_mode' => 'embedded',
  'line_items' => [[
    # Provide the exact Price ID (e.g. pr_1234) of the product you want to sell
    'price' => '{{PRICE_ID}}',
    'quantity' => 1,
  ]],
  'mode' => 'payment',
  'return_url' => $YOUR_DOMAIN . '/return.html?session_id={CHECKOUT_SESSION_ID}',
]);

  echo json_encode(array('clientSecret' => $checkout_session->client_secret));
  ?>
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