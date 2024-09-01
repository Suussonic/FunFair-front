<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Mon compte</title>
</head>
<body>

    <h1>Bienvenue <?php echo htmlspecialchars($_SESSION['firstname'])?></h1>

    <form action="" method="POST">
        <!-- PRENOM -->
        <div>
            <label for="firstname">Prenom</label>
            <input
                id="firstname"
                type="text"
                name="firstname"
                placeholder="Prenom"
                value="<?php echo htmlspecialchars($user['firstname']); ?>"
                required
            >
        </div>
        <!-- NOM -->
        <div>
            <label for="lastname">Nom</label>
            <input 
                id="lastname" 
                type="text" 
                name="lastname" 
                value="<?php echo htmlspecialchars($user['lastname']); ?>"
                required
            >
        </div>
        <!-- EMAIL -->
        <div>
            <label for="email">Email</label>
            <input 
                id="email" 
                type="email" 
                name="email" 
                value="<?php echo htmlspecialchars($user['email']); ?>"
                required
            >
        </div>
        <!-- GENRE (RADIO button) -->
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
        <input type="submit" value="Modifier">
    </form>
</body>
</html>
