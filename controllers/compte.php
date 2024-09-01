<?php
global $dbh;
session_start();
include_once('models/Database.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $editUserSql = '
        UPDATE users
        SET firstname = :firstname,
            lastname = :lastname,
            email = :email,
            gender = :gender
        WHERE id = :id
    ';

    $preparedEditUser = $dbh->prepare($editUserSql);
    $preparedEditUser->execute([
        'firstname' => $_POST['firstname'],
        'lastname' => $_POST['lastname'],
        'email' => $_POST['email'],
        'gender' => $_POST['gender'],
        'id' => $_SESSION['userId']  // Assurez-vous que la variable de session 'userId' est bien définie
    ]);

    // Mettre à jour les variables de session après la mise à jour réussie
    $_SESSION['firstname'] = $_POST['firstname'];
    $_SESSION['lastname'] = $_POST['lastname'];
    $_SESSION['email'] = $_POST['email']; // Ajout si nécessaire
    $_SESSION['gender'] = $_POST['gender']; // Ajout si nécessaire
}

// Récupérer les données actuelles de l'utilisateur
$getUser = "SELECT id, firstname, lastname, email, gender FROM users WHERE id = :id";

$preparedGetUser = $dbh->prepare($getUser);
$preparedGetUser->execute([
    'id' => $_SESSION['userId']
]);

$user = $preparedGetUser->fetch(PDO::FETCH_ASSOC);

// Inclure la vue qui affiche les informations du compte utilisateur
require 'views/compte.view.php';

?>
