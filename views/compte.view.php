<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../CSS/account.css">
    <link rel="shortcut icon" href="../ASSET/CARDBINDEX V5.png" type="image/x-icon">
    <?php include './theme.php'; ?>
    <title>Mon compte</title>
</head>

<body>

    <h1>Bienvenue <?php echo $_SESSION['firstname'] ?></h1>

    <form action="" method="POST">
        <div class="mb-3">
            <div>
                <label for="firstname">Pseudo</label>
                <input id="firstname" type="text" name="firstname" placeholder="Prenom" value="<?php echo $user['firstname'] ?>">
            </div>
        </div>
        <div class="mb-3">
            <!--  NOM  -->
            <div>
                <label for="lastname">Nom</label>
                <input id="lastname" type="text" name="lastname" value="<?php echo $user['lastname'] ?>">
            </div>
        </div>
        <div class="mb-3">
            <!--  EMAIL  -->
            <div>
                <label for="email">Email</label>
                <input id="email" type="email" name="email" value="<?php echo $user['email'] ?>">
            </div>
        </div>
        <div class="radio-container">
            <label for="man">Homme</label>
            <input id="man" type="radio" name="gender" value="man" <?php echo $user['gender'] === "man" ? 'checked' : '' ?>>

            <label for="woman">Femme</label>
            <input id="woman" type="radio" name="gender" value="woman" <?php echo $user['gender'] === "woman" ? 'checked' : '' ?>>

            <label for="other">Autre</label>
            <input id="other" type="radio" name="gender" value="other" <?php echo $user['gender'] === "other" ? 'checked' : '' ?>>
        </div>
        <div class="radio-container">
            <label for="noir">Noir</label>
            <input id="noir" type="radio" name="theme" value="1" <?php echo $user['theme'] == '1' ? 'checked' : ''; ?>>
            <label for="blanc">Blanc</label>
            <input id="blanc" type="radio" name="theme" value="0" <?php echo $user['theme'] == '0' ? 'checked' : ''; ?>>
        </div>



        <input type="submit" value="Modifier">
        <a id="deco" href="../PHP/logout.php">Se deconnecter</a>
    </form>
</body>

</html>

