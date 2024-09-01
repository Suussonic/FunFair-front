<?php
// Connexion à la base de données
$host = 'localhost';
$dbname = 'fun_fair';
$username = 'root'; // Remplacez par votre nom d'utilisateur MySQL
$password = ''; // Remplacez par votre mot de passe MySQL

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Impossible de se connecter à la base de données : " . $e->getMessage());
}

// Vérification si le formulaire est soumis
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Récupération des données du formulaire
    $nom = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $note = intval($_POST['rating']);
    $message = htmlspecialchars($_POST['message']);
    
    // Insertion des données dans la base de données
    $sql = "INSERT INTO avis (nom, email, note, message) VALUES (:nom, :email, :note, :message)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':nom', $nom);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':note', $note);
    $stmt->bindParam(':message', $message);

    if ($stmt->execute()) {
        echo "Merci pour votre avis!";
    } else {
        echo "Une erreur est survenue. Veuillez réessayer.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fun Fair - Laissez un Avis</title>
    <link rel="stylesheet" type="text/css" href="/public/assets/css/partials.css">
    <link rel="stylesheet" href="/public/assets/css/avis.css">
    <link rel="shortcut icon" href="/public/assets/images/logo.png" type="image/x-icon">
</head>
    
<body>
    <h1>Laissez un Avis</h1>

    <form action="#" method="POST">
        <label for="name">Nom :</label>
        <input type="text" id="name" name="name" required>

        <label for="email">Email :</label>
        <input type="email" id="email" name="email" required>

        <label for="rating">Note :</label>
        <select id="rating" name="rating" required>
            <option value="5">5 - Excellent</option>
            <option value="4">4 - Très bien</option>
            <option value="3">3 - Bien</option>
            <option value="2">2 - Moyen</option>
            <option value="1">1 - Mauvais</option>
        </select>

        <label for="message">Votre avis :</label>
        <textarea id="message" name="message" required></textarea>

        <input type="submit" value="Envoyer">
    </form>

    <div class="back-to-home">
        <a href="/">Retour à l'accueil</a>
    </div>
</body>
     <?php include 'partials/footer.php'; ?>
</html>
