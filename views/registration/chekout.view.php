<?php

$stripeSecretKey = 'sk_test_51PrNEeIpuwwZKBGaVhN6YsIQeDn7BQ8CEaBNCLrB9Iw8IFX0Q5yNe6Mssxb5khU4FG4jsm6TWvOWWWdqmIBtsrm700gE3NazR4';

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