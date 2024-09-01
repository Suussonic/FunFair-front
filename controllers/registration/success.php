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
  
    global $dbh;

   
    $query = $dbh->prepare("SELECT r.*, a.nom as attraction_name FROM reservations r JOIN attractions a ON r.attractionid = a.id WHERE r.id = :id");
    $query->bindParam(':id', $id);
    $query->execute();
    $reservation = $query->fetch(PDO::FETCH_ASSOC);

    if (!$reservation) {
        die("Réservation introuvable.");
    }

   
    require('../../fpdf186/fpdf.php');

  
    $pdf = new FPDF();
    $pdf->AddPage();
    $pdf->SetFont('Arial', 'B', 14);
    $pdf->Cell(0, 10, 'Confirmation de Réservation', 0, 1, 'C');
    $pdf->Ln(10);

    $pdf->SetFont('Arial', '', 12);
    $pdf->Cell(40, 6, 'Attraction:', 1);
    $pdf->Cell(150, 6, $reservation['attraction_name'], 1);
    $pdf->Ln();
    $pdf->Cell(40, 6, 'Montant:', 1);
    $pdf->Cell(150, 6, $reservation['montant'] . ' EUR', 1);
    $pdf->Ln();
    $pdf->Cell(40, 6, 'Quantité:', 1);
    $pdf->Cell(150, 6, $reservation['quantity'], 1);
    $pdf->Ln();
    $pdf->Cell(40, 6, 'Date:', 1);
    $pdf->Cell(150, 6, $reservation['jour'], 1);
    $pdf->Ln();
    $pdf->Cell(40, 6, 'Heure:', 1);
    $pdf->Cell(150, 6, $reservation['heure'], 1);
    $pdf->Ln();
    $pdf->Cell(40, 6, 'Email:', 1);
    $pdf->Cell(150, 6, $reservation['email'], 1);
    $pdf->Ln();

    
    $pdf->Output('D', 'reservation_' . $reservation['email'] . '_' . $reservation['jour'] . '.pdf');
    
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
    </div>
</body>

</html>
