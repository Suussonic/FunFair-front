<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

$user = 'root';
$password = 'root';

try {
    $dbh = new PDO('mysql:host=localhost;dbname=pa;charset=utf8mb4', $user, $password);
} catch (PDOException $e) {
    die("Erreur de connexion à la base de données : " . $e->getMessage());
}

// Inclure la bibliothèque FPDF
require('../../fpdf186/fpdf.php');

// Vérifier si les paramètres email et date sont passés dans l'URL
if (!isset($_GET['email']) || !isset($_GET['date'])) {
    die("Les paramètres 'email' et 'date' sont requis.");
}

$email = $_GET['email'];
$date = $_GET['date'];

// Récupérer les informations de réservation pour l'utilisateur en fonction de l'email et de la date
$sql = "SELECT a.name as attraction_name, r.montant, r.quantity, r.jour, r.heure, r.email 
        FROM reservations r
        JOIN attractions a ON r.attractionid = a.id
        WHERE r.email = :email AND r.jour = :date";

try {
    $stmt = $dbh->prepare($sql);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->bindParam(':date', $date, PDO::PARAM_STR);
    $stmt->execute();
    $reservation = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$reservation) {
        die("Aucune réservation trouvée pour cet utilisateur à cette date.");
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
        $this->Cell(0, 10, 'Confirmation de Réservation', 0, 1, 'C');
        $this->Ln(10);
    }

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

$pdf = new PDF();
$pdf->AddPage();

$pdf->ReservationTable($reservation);
$pdf->Output('D', 'reservation_' . $email . '_' . $date . '.pdf');
exit;
?>
