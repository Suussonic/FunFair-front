<?php

    $user = 'root';
    $password = 'root';
    
    try {
        $dbh = new PDO('mysql:host=localhost;dbname=pa;charset=utf8mb4', $user, $password);
    } catch (PDOException $e) {
        var_dump($e);
    }
    sendReservation(nouvelleReservation($_GET["q"], $_GET["i"], $_GET["p"], $_GET["email"],$_GET["date"], $_GET["heure"], $dbh));
        


    function nouvelleReservation($quantity, $idstripe, $unitprice, $email, $date, $heure, $dbh): int //int =  retourne un int
    {
        
        $query = $dbh->prepare("SELECT count(id) as total FROM reservations");
        $query->execute();
       
        $result = $query->fetch(PDO::FETCH_ASSOC);
        $rowid = $result["total"] + 1;
        
        $attraction = getAttractionIdByStripeId($idstripe);
        $total = ($unitprice * $quantity)/100;
        $query = $dbh -> prepare("INSERT INTO reservations (id, attractionid, montant, quantity, date, heure, email) VALUES(:id, :attraction,:montant, :quantity, :date, :heure, :email)");
        $query -> bindParam(':id', $rowid);
        $query -> bindParam(':attraction',$attraction);
        $query -> bindParam(':montant', $total);
        $query -> bindParam(':quantity', $quantity);
        $query -> bindParam(':date', $date);
        $query -> bindParam(':heure', $heure);
        $query -> bindParam(':email', $email);
        $query -> execute();
        header("Location: ../index-home.php");
        return $rowid;
    }

    function getAttractionIdByStripeId($stripeid): int 
    {
        kill("salut c'est jean pierre");
        global $dbh;
        $query = $dbh -> prepare("SELECT id FROM attractions where idstripe = :idstripe");
        $query -> bindParam(':idstripe', $stripeid);
        $query -> execute();
        $result = $query -> fetch();
        return $result['id'];
    }

    function sendreservation($id): void
    {
        kill("salut c'est jean pierre");
    //construire le pdf avec fpdf ou un truc du genre 
    //envoiyer par mail
    //ou telecharger
    //ou les deux
    }
    require_once('../../views/registration/success.view.php');
?>