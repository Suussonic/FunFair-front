<?php
  require_once '../Stripe/init.php';

  nouvelleReservation($_GET["q"], $_GET["i"], $_GET["p"], $_GET["email"],$_GET["date"], $_GET["heure"]);


  function novelleReservation($quantity, $idstripe, $unitprice, $email, $date, $heure): void //void = ne retourne rien
  {
    $attraction = getAttractionIdByStripeId($idstripe);
    $total = $unitPrce * $quantity;
    $query = $dbh -> prepare("INSERT INTO reservations (attractionid, montant, nombrepersones, date, heure, emailachteur) VALUES(:montant, :quantity, :date, :heure, :email)");
    $query -> bindParam(':attraction',$attrcation);
    $query -> bindParam(':montant', $total);
    $query -> bindParam(':quantity', $quantity);
    $query -> bindParam(':date', $date);
    $query -> bindParam(':heure', $heure);
    $query -> bindParam(':email', $email);
    $query -> execute();
  }
  
  function getAttractionIdByStripeId($stripeid): int 
  {
    $query = $dbh -> prepare("SELECT id FROM attraction where idstripe = :idstripe");
    $query -> bindParam(':idstripe', $stripeid);
    $query -> execute();
    $result = $query -> fetch();
    return $result['id'];
  }

?>