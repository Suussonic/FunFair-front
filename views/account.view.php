<?php
session_start();
include 'models/Database.php';
$db = new Database();
$dbh = $db->dbh;
$user_id = $_SESSION['user_id'];
$sql = "SELECT first_name, last_name, email, username, phone, address FROM users WHERE id = :id";
$stmt = $dbh->prepare($sql);
$stmt->bindParam(':id', $user_id, PDO::PARAM_INT);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);
include 'header.php'; 
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="public/assets/css/account.css">
    <title>Mon Compte</title>
</head>
<body>
    <div class="account-container">
        <h1>Mon Compte</h1>
        <div class="user-info">
            <p><strong>Prénom :</strong> <?php echo htmlspecialchars($user['first_name']); ?></p>
            <p><strong>Nom :</strong> <?php echo htmlspecialchars($user['last_name']); ?></p>
            <p><strong>Email :</strong> <?php echo htmlspecialchars($user['email']); ?></p>
            <p><strong>Nom d'utilisateur :</strong> <?php echo htmlspecialchars($user['username']); ?></p>
            <p><strong>Téléphone :</strong> <?php echo htmlspecialchars($user['phone']); ?></p>
            <p><strong>Adresse :</strong> <?php echo htmlspecialchars($user['address']); ?></p>
        </div>
        <div class="account-actions">
            <a href="edit_account.php" class="action-button">Modifier</a>
            <a href="logout.php" class="action-button">Déconnexion</a>
        </div>
    </div>
</body>
<
</html>
