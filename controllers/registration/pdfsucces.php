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

// Récupérer les détails de la réservation à partir de la base de données
function getReservationDetails($jour, $heure, $email, $dbh) {
    $query = $dbh->prepare("SELECT r.id, r.attractionid, r.montant, r.quantity, r.jour, r.heure, r.email, a.nom AS attraction_name 
                            FROM reservations r 
                            JOIN attractions a ON r.attractionid = a.id 
                            WHERE r.jour = :jour AND r.heure = :heure AND r.email = :email");
    $query->bindParam(':jour', $jour, PDO::PARAM_STR);
    $query->bindParam(':heure', $heure, PDO::PARAM_STR);
    $query->bindParam(':email', $email, PDO::PARAM_STR);
    $query->execute();
    return $query->fetch(PDO::FETCH_ASSOC);
}

// Vérifier si les paramètres nécessaires sont passés
if (!isset($_GET['jour']) || !isset($_GET['heure']) || !isset($_GET['email'])) {
    die("Paramètres manquants.");
}

$jour = $_GET['jour'];
$heure = $_GET['heure'];
$email = $_GET['email'];

// Connexion à la base de données (vous pouvez adapter cette partie selon votre configuration)
$user = 'root';
$password = 'root';

try {
    $dbh = new PDO('mysql:host=localhost;dbname=pa;charset=utf8mb4', $user, $password);
} catch (PDOException $e) {
    die("Erreur de connexion à la base de données : " . $e->getMessage());
}

// Récupérer les détails de la réservation
$reservation = getReservationDetails($jour, $heure, $email, $dbh);

if (!$reservation) {
    die("Aucune réservation trouvée pour ces paramètres.");
}

// Générer le PDF
$pdf = new PDF();
$pdf->AddPage();
$pdf->ReservationTable($reservation);
$pdf->Output('D', 'reservation_' . $reservation['email'] . '_' . $reservation['jour'] . '.pdf');
?>
