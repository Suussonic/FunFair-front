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
        'id' => $_SESSION['userId']
    ]);

    // Update session variables after successful update
    $_SESSION['firstname'] = $_POST['firstname'];
    $_SESSION['lastname'] = $_POST['lastname'];
    $_SESSION['email'] = $_POST['email'];
    $_SESSION['gender'] = $_POST['gender'];
}

// Retrieve current user data
$getUser = "SELECT id, firstname, lastname, email, gender FROM users WHERE id = :id";

$preparedGetUser = $dbh->prepare($getUser);
$preparedGetUser->execute([
    'id' => $_SESSION['userId']
]);

$user = $preparedGetUser->fetch(PDO::FETCH_ASSOC);

// Include the view that displays the user account information
require 'views/compte.view.php';
?>