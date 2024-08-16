<?php

if (isset($_SESSION['userId'])) { 
    $userId = $_SESSION['userId'];

    $getUser = "SELECT theme FROM users WHERE id = :id";
    
    $preparedGetUser = $dbh->prepare($getUser);
    $preparedGetUser->execute([
        'id' => $userId
    ]);

    $result = $preparedGetUser->fetch(PDO::FETCH_ASSOC);

    if ($result) { 
        if ($result['theme'] == 1) {
            echo '<link rel="stylesheet" href="../CSS/black.css">';
        } elseif ($result['theme'] == 0) { 
            echo '<link rel="stylesheet" href="../CSS/white.css">';
        } else {
            echo '<link rel="stylesheet" href="../CSS/default.css">';
        }
    } else {
        echo '<link rel="stylesheet" href="../CSS/default.css">';
    }
} else {
    echo '<link rel="stylesheet" href="../CSS/default.css">';
}
?>