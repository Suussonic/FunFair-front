<?php
session_start();
require_once('../models/Database.php');

if(isset($_GET['id']) AND !empty($_GET['id']) AND isset($_GET['cle']) AND !empty($_GET['cle'])){

    $getid = $_GET['id'];
    $getcle = $_GET['cle'];
    $recupUser = $bdd->prepare('SELECT * FROM users WHERE id = ? AND cle = ?');
    $recupUser->execute(array($getid, $getcle));
    if($recupUser->rowCount() > 0){
        $userInfos = $recupUser->fetch();
        if($userInfos['confirme'] != 1){
            $updateConfirmation = $bdd->prepare('UPDATE user SET confirme = ? WHERE id = ?');
            $updateConfirmation->execute(array(1, $getid));
            $_SESSION['cle'] = $getcle;
            header('Location: ../index.php');
        }else{
            $_SESSION['cle'] = $getcle;
            header('Location: ../index.php');
        }
    }else{
        echo "Votre identifiant est incorrect";
    }

}else{
    echo "Aucun utilisateur trouvé"; 
}

?>
