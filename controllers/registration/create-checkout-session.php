<?php
require_once '../../stripe/init.php';
$YOUR_DOMAIN = 'https://funfair.ovh';
$quantity = $_POST['people'];
$email = $_POST['email'];
$date = $_POST['date'];
$heure = $_POST['heure'];
use Stripe\Stripe;

$stripeSecretKey = "sk_test_51PrNEeIpuwwZKBGaVhN6YsIQeDn7BQ8CEaBNCLrB9Iw8IFX0Q5yNe6Mssxb5khU4FG4jsm6TWvOWWWdqmIBtsrm700gE3NazR4";
Stripe::setApiKey($stripeSecretKey);

$prices = \Stripe\Price::all([
    'lookup_keys' => [$_POST['lookup_key']], // This should be an array of lookup keys
    'expand' => ['data.product'],
]);

if (empty($prices->data)) {
    http_response_code(400);
    echo json_encode(['error' => 'Price not found for the given lookup key.']);
    exit;
}

$priceId = $prices->data[0]->id; // Access the first price's ID

try {
    
    $checkout_session = \Stripe\Checkout\Session::create([
        'line_items' => [[
            'price' => $priceId,
            'quantity' => $quantity,
        ]],

        'mode' => 'payment',
        'success_url' => $YOUR_DOMAIN . '/controllers/success.php?q='.$quantity.'&i='.$_POST['lookup_key'].'&p='.$prices->data[0]['unit_amount'].'&email='.$email.'&date='.$date.'&heure='.$heure,
        'cancel_url' => $YOUR_DOMAIN . '/',
    ]);
    header("HTTP/1.1 303 See Other");
    header("Location: " . $checkout_session->url);
} catch (Error $e) {
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);

}

?>