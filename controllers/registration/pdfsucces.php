<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Inclure le fichier de connexion à la base de données
include_once('models/Database.php');

// Inclure la bibliothèque FPDF
require('../fpdf186/fpdf.php');

// Récupérer les informations de réservation pour l'utilisateur
$reservationId = $_GET['reservation_id'];
$sql = "SELECT r.id, a.name as attraction_name, r.montant, r.quantity, r.jour, r.heure, r.email 
        FROM reservations r
        JOIN attractions a ON r.attractionid = a.id
        WHERE r.id = :reservation_id";

try {
    $stmt = $dbh->prepare($sql);
    $stmt->bindParam(':reservation_id', $reservationId, PDO::PARAM_INT);
    $stmt->execute();
    $reservation = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$reservation) {
        die("Aucune réservation trouvée pour cet ID.");
    }
} catch (PDOException $e) {
    die("Erreur lors de la récupération des données : " . $e->getMessage());
}

// Générer le PDF
class PDF extends FPDF
{
    function Header()
    {
        $this->SetFont('Arial', 'B', 14);
        $this->Cell(0, 10, 'Confirmation de Reservation', 0, 1, 'C');
        $this->Ln(10);
    }

    function ReservationTable($reservation)
    {
        // Largeurs des colonnes
        $w = array(40, 150);

        // Affichage des données de la réservation
        $this->SetFont('Arial', '', 12);
        
        $this->Cell($w[0], 6, 'Reservation ID:', 1);
        $this->Cell($w[1], 6, $reservation['id'], 1);
        $this->Ln();

        $this->Cell($w[0], 6, 'Attraction:', 1);
        $this->Cell($w[1], 6, $reservation['attraction_name'], 1);
        $this->Ln();

        $this->Cell($w[0], 6, 'Montant:', 1);
        $this->Cell($w[1], 6, $reservation['montant'] . ' EUR', 1);
        $this->Ln();

        $this->Cell($w[0], 6, 'Quantite:', 1);
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

$pdf = new PDF();
$pdf->AddPage();

$pdf->ReservationTable($reservation);
$pdf->Output('D', 'reservation_' . $reservationId . '.pdf');
exit;
?>
