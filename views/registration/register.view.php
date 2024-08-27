<?php

<<<<<<< HEAD
include_once('../models/Database.php');
=======
include_once('/models/Database.php');
>>>>>>> a8231ba42149b08b6244bb613244fadd194bf00f

$query = "SELECT * FROM captcha ORDER BY RAND() LIMIT 1";
$result = $dbh->query($query);
$captcha = $result->fetch(PDO::FETCH_ASSOC);


session_start();
$_SESSION['captcha_id'] = $captcha['id'];
$_SESSION['captcha_question'] = $captcha['q'];

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="/public/assets/css/createaccount.css">
    <title>Inscription</title>
</head>

<body>

    <div class="main-container">
        <?php if (isset($_GET['error'])) { ?>
            <h1><?php echo $_GET['error']; ?> </h1>
        <?php } ?>
        <form method="POST">
            <h1>Inscription :</h1>
            <div>
                <input id="firstname" type="text" name="firstname" placeholder="Pseudo" required>
            </div>
            <div>
                <input id="lastname" type="text" name="lastname" placeholder="Nom" required>
            </div>
            <div>
                <input id="email" placeholder="Mail" type="email" name="email" required>
            </div>
            <div>
                <input id="password" type="password" name="password" placeholder="Mot de passe" required>
            </div>
            <div id="radioS">
                <label for="man">Homme</label>
                <input id="man" type="radio" name="gender" value="man">

                <label for="woman">Femme</label>
                <input id="woman" type="radio" name="gender" value="woman">

                <label for="other">Autre</label>
                <input id="other" type="radio" name="gender" value="other">
            </div>
            <div id="captcha-box">
                <label for="captcha_input" class="captcha-label"><?php echo $_SESSION['captcha_question']; ?></label>
                <input type="text" id="captcha-input" placeholder="Votre réponse" name="captcha_answer" required>
                <input type="hidden" name="captcha_id" value="<?php echo $_SESSION['captcha_id']; ?>">
            </div>
            <label for="captcha"><a href="/conditions" target="_blank">Accepter le contrat d'utilisation.</a></label>
            <input type="checkbox" id="captcha" class="hidden-checkbox" required>
            <input class="btn" type="submit">
        </form>
    </div>
</body>

</html>
