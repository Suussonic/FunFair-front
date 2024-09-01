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
    
    require('../../fpdf186/fpdf.php');

// Classe PDF personnalisée
class PDF extends FPDF
{
    // En-tête du document PDF
    function Header()
    {
        $this->SetFont('Arial', 'B', 14);
        $this->Cell(0, 10, 'Confirmation de Réservation', 0, 1, 'C');
        $this->Ln(10);
    }

    // Fonction pour afficher les détails de la réservation
    function ReservationTable($reservation)
    {
        // Largeurs des colonnes
        $w = array(40, 150);

        // Affichage des données de la réservation
        $this->SetFont('Arial', '', 12);
        
        $this->Cell($w[0], 6, 'Attraction:', 1);
        $this->Cell($w[1], 6, $reservation['attraction_name'], 1);
        $this->Ln();

        $this->Cell($w[0], 6, 'Montant:', 1);
        $this->Cell($w[1], 6, $reservation['montant'] . ' EUR', 1);
        $this->Ln();

        $this->Cell($w[0], 6, 'Quantité:', 1);
        $this->Cell($w[1], 6, $reservation['quantity'], 1);
        $this->Ln();

        $this->Cell($w[0], 6, 'Date:', 1);
        $this->Cell($w[1], 6, $reservation['jour'], 1);
        $this->Ln();

        $this->Cell($w[0], 6, 'Heure:', 1);
        $this->Cell($w[1], 6, $reservation['heure'], 1);
        $this->Ln();

        $this->Cell($w[0], 6, 'Email:', 1);
        $this->Cell($w[1], 6, $reservation['email'], 1);
        $this->Ln();
    }
}

// Récupérer les détails de la réservation à partir de la base de données
function getReservationDetails($reservationId, $dbh) {
    $query = $dbh->prepare("SELECT r.id, r.attractionid, r.montant, r.quantity, r.jour, r.heure, r.email, a.nom AS attraction_name 
                            FROM reservations r 
                            JOIN attractions a ON r.attractionid = a.id 
                            WHERE r.id = :id");
    $query->bindParam(':id', $reservationId, PDO::PARAM_INT);
    $query->execute();
    return $query->fetch(PDO::FETCH_ASSOC);
}

// Supposons que l'ID de la réservation soit passé par un paramètre GET
if (!isset($_GET['reservation_id'])) {
    die("ID de réservation manquant.");
}

$reservationId = $_GET['reservation_id'];

// Connexion à la base de données (vous pouvez adapter cette partie selon votre configuration)
$user = 'root';
$password = 'root';

try {
    $dbh = new PDO('mysql:host=localhost;dbname=pa;charset=utf8mb4', $user, $password);
} catch (PDOException $e) {
    die("Erreur de connexion à la base de données : " . $e->getMessage());
}

// Récupérer les détails de la réservation
$reservation = getReservationDetails($reservationId, $dbh);

if (!$reservation) {
    die("Aucune réservation trouvée pour cet ID.");
}

// Générer le PDF
$pdf = new PDF();
$pdf->AddPage();
$pdf->ReservationTable($reservation);
$pdf->Output('D', 'reservation_' . $reservation['email'] . '_' . $reservation['jour'] . '.pdf');
    //ou les deux
    }
    require_once('../../views/registration/success.view.php');
?>