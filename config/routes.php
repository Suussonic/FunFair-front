<?php
$routes = [
    '/' => 'controllers/index-home.php',
    '/attractions' => 'controllers/attractions.php',
    '/avis' => 'controllers/avis.php',
    '/billets' => 'controllers/billets.php',
    '/contact' => 'controllers/contact.php',
    '/horaire' => 'controllers/horaire.php',
    '/concours' => 'controllers/concours.php',

    '/checkout' => 'controllers/registration/checkout.php',
    '/checkoutsession' => 'controllers/registration/create-checkout-session.php',
    '/success' => 'controllers/registration/success.php',

    '/forum' => 'controllers/forum.php',

    '/login' => 'controllers/registration/login.php',
    '/register' => 'controllers/registration/register.php',
    '/logout' => 'controllers/registration/logout.php',
    '/condition' => 'controllers/registration/condition.php',
    '/forum' => 'controllers/forum.php',
    '/question' => 'controllers/new_question.php',
    '/fquestion' => 'controllers/question.php',

    
    '/account' => 'controllers/compte.php',
    
    '/back' => 'controllers/back/back.php',
    '/captcha' => 'controllers/back/captcha.php',
    '/user'=> 'controllers/back/fetch_user.php',
  ];
