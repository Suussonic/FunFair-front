<?php
session_start();


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once('models/Database.php'); 

if (isset($_SESSION['firstname']) && isset($_SESSION['id'])) {
 
    $userId = $_SESSION['id']; 

    try {
       
        $stmt = $dbh->prepare('SELECT role FROM users WHERE id = :id');
        $stmt->execute(['id' => $userId]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

     
        echo '<a class="cta-button" href="/account">Mon compte</a>';
        echo '<a class="cta-button" href="/logout">Déconnexion</a>';
        echo '<a class="cta-button" href="/avis">Avis</a>';

       
        if ($user && $user['role'] == 'admin') {
            echo '<a class="cta-button" href="https://admin.funfair.ovh/">Admin Panel</a>';
        }

    } catch (PDOException $e) {
       
        echo 'Erreur lors de la requête SQL : ' . $e->getMessage();
    }

} else {
    
    echo '<a class="cta-button" href="/login">Se Connecter</a>';
}
?>
