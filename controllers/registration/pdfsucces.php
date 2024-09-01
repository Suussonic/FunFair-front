<?php
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

// Suppression de la base de données, car les informations sont passées directement par GET

// Vérifier si les paramètres GET sont passés
if (!isset($_GET['q']) || !isset($_GET['i']) || !isset($_GET['p']) || !isset($_GET['email']) || !isset($_GET['date']) || !isset($_GET['heure'])) {
    die("Paramètres manquants.");
}

$reservation = [
    'attraction_name' => $_GET['i'], // Nom de l'attraction
    'montant' => $_GET['p'],         // Montant
    'quantity' => $_GET['q'],        // Quantité
    'jour' => $_GET['date'],         // Date
    'heure' => $_GET['heure'],       // Heure
    'email' => $_GET['email'],       // Email
];

// Générer le PDF
$pdf = new PDF();
$pdf->AddPage();
$pdf->ReservationTable($reservation);
$pdf->Output('D', 'reservation_' . $reservation['email'] . '_' . $reservation['jour'] . '.pdf');
?>
