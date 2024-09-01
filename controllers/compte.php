<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="/public/assets/css/partials.css">
    <link rel="stylesheet" href="/public/assets/css/compte.css">
    <title>Mon compte</title>
</head>
<body>
    <h1>Modifier les informations de votre compte</h1>

    <form action="" method="POST">
        <div>
            <label for="firstname">Prénom:</label>
            <input type="text" id="firstname" name="firstname" value="<?php echo htmlspecialchars($_SESSION['firstname'], ENT_QUOTES); ?>" required>
        </div>
        <div>
            <label for="lastname">Nom:</label>
            <input type="text" id="lastname" name="lastname" value="<?php echo htmlspecialchars($_SESSION['lastname'], ENT_QUOTES); ?>" required>
        </div>
        <div>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($_SESSION['email'], ENT_QUOTES); ?>" required>
        </div>
        <div>
            <label for="gender">Genre:</label>
            <select id="gender" name="gender" required>
                <option value="male" <?php echo $_SESSION['gender'] === 'male' ? 'selected' : ''; ?>>Homme</option>
                <option value="female" <?php echo $_SESSION['gender'] === 'female' ? 'selected' : ''; ?>>Femme</option>
                <option value="other" <?php echo $_SESSION['gender'] === 'other' ? 'selected' : ''; ?>>Autre</option>
            </select>
        </div>
        <div>
            <button type="submit">Mettre à jour</button>
        </div>
    </form>
</body>
</html>
