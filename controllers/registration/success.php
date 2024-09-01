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
        $query = $dbh -> prepare("INSERT INTO reservations (id, attractionid, montant, quantity, jour, heure, email) VALUES(:id, :attraction, :montant, :quantity, :jour, :heure, :email)");
        $query -> bindParam(':id', $rowid);
        $query -> bindParam(':attraction',$attraction);
        $query -> bindParam(':montant', $total);
        $query -> bindParam(':quantity', $quantity);
        $query -> bindParam(':jour', $date);
        $query -> bindParam(':heure', $heure);
        $query -> bindParam(':email', $email);
        $query -> execute();
        return $rowid;
    }

    function getAttractionIdByStripeId($stripeid): int 
    {
        global $dbh;
        $query = $dbh -> prepare("SELECT id FROM attractions where idstripe = :idstripe");
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
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Merci pour votre achat !</title>
    <link rel="shortcut icon" href="/public/assets/images/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="/public/assets/css/succes.css">
</head>

<body>
    <div class="container">
        <h1>Merci !</h1>
        <p>Nous apprécions votre confiance et espérons que vous apprécierez votre achat.</p>
        <a href="/" class="btn">Retour à l'accueil</a>
        <a href="pdfsucces.php" class="action-button">Télécharger PDF</a>
    </div>
</body>

</html>
