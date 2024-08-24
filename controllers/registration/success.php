<?php
    require_once '../../models/database.php';
    global $dbh;
    sendReservation(nouvelleReservation($_GET["q"], $_GET["i"], $_GET["p"], $_GET["email"],$_GET["date"], $_GET["heure"]));
        


    function novelleReservation($quantity, $idstripe, $unitprice, $email, $date, $heure): int //int =  retourne un int
    {
        global $dbh;
        $query = $dbh->prepare("SELECT count(id) as total FROM reservations");
        $query->execute();
        $result = $query->fetch(PDO::FETCH_ASSOC);
        $rowid = $result["total"] + 1;
        $attraction = getAttractionIdByStripeId($idstripe);
        $total = $unitPrce * $quantity;
        $query = $dbh -> prepare("INSERT INTO reservations (id, attractionid, montant, quantity, date, heure, email) VALUES(:id, :attraction,:montant, :quantity, :date, :heure, :email)");
        $query -> bindParam(':id', $rowid);
        $query -> bindParam(':attraction',$attraction);
        $query -> bindParam(':montant', $total);
        $query -> bindParam(':quantity', $quantity);
        $query -> bindParam(':date', $date);
        $query -> bindParam(':heure', $heure);
        $query -> bindParam(':email', $email);
        $query -> execute();

        return $rowid;
    }

    function getAttractionIdByStripeId($stripeid): int 
    {
        global $dbh;
        $query = $dbh -> prepare("SELECT id FROM attraction where idstripe = :idstripe");
        $query -> bindParam(':idstripe', $stripeid);
        $query -> execute();
        $result = $query -> fetch();
        return $result['id'];
    }

    function sendreservation($id): void
    {
    //construire le pdf avec fpdf ou un truc du genre 
    //envoiyer par mail
    //ou telecharger
    //ou les deux
    }
    require_once('../views/registration/success.view.php');
?>