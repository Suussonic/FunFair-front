<?php
$YOUR_DOMAIN = 'https://funfair.ovh';
$quantity = $_POST['poeple'];
$email = $_POST["email"];
$date = $_POST["date"];
$heure = $_POST["heure"];

$stripeSecretKey = "sk_test_51PrNEeIpuwwZKBGaVhN6YsIQeDn7BQ8CEaBNCLrB9Iw8IFX0Q5yNe6Mssxb5khU4FG4jsm6TWvOWWWdqmIBtsrm700gE3NazR4";

$stripe = new \Stripe\StripeClient($stripeSecretKey);

try {
    
    $prices = \Stripe\Price::all([
        'lookup_keys' => 'iIntimidator305',//[$_POST['lookup_key']],
        'expand' => ['data.product'],
    ]);

    $checkout_session = \Stripe\Checkout\Session::create([
        'line_items' => [[
            'price' => $prices->data[0]->id,
            'quantity' => $quantity,
        ]],

        'mode' => 'payment',
        'success_url' => $YOUR_DOMAIN . 'success.php?q='.$quantity.'&i='.$_POST['lookup_key'].'&p='.$prices->data[0]['unit_amount'].'&email='.$email.'&date='.$date.'&heure='.$heure,
        'cancel_url' => $YOUR_DOMAIN . '/',
    ]);
    header("HTTP/1.1 303 See Other");
    header("Location: " . $checkout_session->url);
} catch (Error $e) {
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);

}

?>