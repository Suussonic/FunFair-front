<?php

include_once('models/Database.php');
require_once('../stripe/init.php');

$stripe = new \Stripe\StripeClient($stripeSecretKey);
header('Content-Type: application/json');

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

  
  $YOUR_DOMAIN = 'https://funfair.ovh';
  $quantity = $_POST['poeple'];
  try {
      
      $prices = \Stripe\Price::all([
          'lookup_keys' => [$_POST['lookup_key']],
          'expand' => ['data.product']
      ]);
  
      $checkout_session = \Stripe\Checkout\Session::create([
          'line_items' => [[
              'price' => $prices->data[0]->id,
              'quantity' => $quantity,
          ]],
  
          'mode' => 'payment',
          'success_url' => $YOUR_DOMAIN . '/php/payment/success.php?q='.$quantity.'&i='.$_POST['lookup_key'].'&p='.$prices->data[0]['unit_amount'],
          'cancel_url' => $YOUR_DOMAIN . '/php/index.php',
      ]);
      header("HTTP/1.1 303 See Other");
      header("Location: " . $checkout_session->url);
  } catch (Error $e) {
      http_response_code(500);
      echo json_encode(['error' => $e->getMessage()]);
  
  }