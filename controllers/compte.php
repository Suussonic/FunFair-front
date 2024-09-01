<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="/public/assets/css/partials.css">
    <link rel="stylesheet" href="/public/assets/css/compte.css">
    <title>Mon compte</title>
</head>
<body>
    <h1>Bienvenue <?php echo htmlspecialchars($_SESSION['firstname'] . ' ' . $_SESSION['lastname'], ENT_QUOTES); ?></h1>

    <form action="" method="POST">

        <div>
            <label for="firstname">Prenom</label>
            <input
                    id="firstname"
                    type="text"
                    name="firstname"
                    placeholder="Prenom"
                    value="<?php echo htmlspecialchars($user['firstname'], ENT_QUOTES); ?>"
            >
        </div>
        <!--  NOM  -->
        <div>
            <label for="lastname">Nom</label>
            <input id="lastname" type="text" name="lastname" value="<?php echo htmlspecialchars($user['lastname'], ENT_QUOTES); ?>">
        </div>
        <!--  EMAIL  -->
        <div>
            <label for="email">Email</label>
            <input id="email" type="email" name="email" value="<?php echo htmlspecialchars($user['email'], ENT_QUOTES); ?>">
        </div>
        <!--  GENRE (RADIO button)  -->
        <div>
            <label for="man">Homme</label>
            <input
                    id="man"
                    type="radio"
                    name="gender"
                    value="man"
                <?php echo $user['gender'] === "man" ? 'checked' : ''; ?>
            >

            <label for="woman">Femme</label>
            <input
                    id="woman"
                    type="radio"
                    name="gender"
                    value="woman"
                <?php echo $user['gender'] === "woman" ? 'checked' : ''; ?>
            >

            <label for="other">Autre</label>
            <input
                    id="other"
                    type="radio"
                    name="gender"
                    value="other"
                <?php echo $user['gender'] === "other" ? 'checked' : ''; ?>
            >
        </div>

        <div>
            <input type="submit" value="Modifier">
            <a href="/index.php" class="btn">Retour à l'accueil</a>
        </div>

    </form>
</body>
</html>
