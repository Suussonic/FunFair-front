<?php
$YOUR_DOMAIN = 'https://funfair.ovh';
$quantity = $_POST['poeple'];
$email = $_POST["email"];
$date = $_POST["date"];
$heure = $_POST["heure"];

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