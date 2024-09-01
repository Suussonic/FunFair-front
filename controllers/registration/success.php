<?php
require('../../fpdf186/fpdf.php');

// Connexion à la base de données
$user = 'root';
$password = 'root';

try {
    $dbh = new PDO('mysql:host=localhost;dbname=pa;charset=utf8mb4', $user, $password);
} catch (PDOException $e) {
    die("Erreur de connexion à la base de données : " . $e->getMessage());
}

// Vérification si les paramètres nécessaires sont passés dans l'URL
if (!isset($_GET['q'], $_GET['i'], $_GET['p'], $_GET['email'], $_GET['date'], $_GET['heure'])) {
    die("Les paramètres 'q', 'i', 'p', 'email', 'date', et 'heure' sont requis.");
}

// Récupération des paramètres
$quantity = (int)$_GET['q'];
$idstripe = $_GET['i'];
$unitprice = (float)$_GET['p'];
$email = $_GET['email'];
$date = $_GET['date'];
$heure = $_GET['heure'];

// Fonction pour créer une nouvelle réservation
function nouvelleReservation($quantity, $idstripe, $unitprice, $email, $date, $heure, $dbh): int
{
    // Récupération du prochain ID pour la nouvelle réservation
    $query = $dbh->prepare("SELECT count(id) as total FROM reservations");
    $query->execute();
    $result = $query->fetch(PDO::FETCH_ASSOC);
    $rowid = $result["total"] + 1;

    // Récupération de l'ID de l'attraction à partir de l'ID Stripe
    $attraction = getAttractionIdByStripeId($idstripe, $dbh);
    $total = ($unitprice * $quantity) / 100;

    // Insertion de la nouvelle réservation dans la base de données
    $query = $dbh->prepare("INSERT INTO reservations (id, attractionid, montant, quantity, jour, heure, email) 
                            VALUES (:id, :attraction, :montant, :quantity, :jour, :heure, :email)");
    $query->bindParam(':id', $rowid);
    $query->bindParam(':attraction', $attraction);
    $query->bindParam(':montant', $total);
    $query->bindParam(':quantity', $quantity);
    $query->bindParam(':jour', $date);
    $query->bindParam(':heure', $heure);
    $query->bindParam(':email', $email);
    $query->execute();

    return $rowid;
}

// Fonction pour récupérer l'ID de l'attraction via l'ID Stripe
function getAttractionIdByStripeId($stripeid, $dbh): int
{
    $query = $dbh->prepare("SELECT id FROM attractions WHERE idstripe = :idstripe");
    $query->bindParam(':idstripe', $stripeid);
    $query->execute();
    $result = $query->fetch(PDO::FETCH_ASSOC);
    return $result['id'];
}

// Fonction pour récupérer les détails de la réservation
function getReservationDetails($reservationId, $dbh) {
    $query = $dbh->prepare("SELECT r.id, r.attractionid, r.montant, r.quantity, r.jour, r.heure, r.email, a.nom AS attraction_name 
                            FROM reservations r 
                            JOIN attractions a ON r.attractionid = a.id 
                            WHERE r.id = :id");
    $query->bindParam(':id', $reservationId, PDO::PARAM_INT);
    $query->execute();
    return $query->fetch(PDO::FETCH_ASSOC);
}

// Création de la réservation et récupération de l'ID
$reservationId = nouvelleReservation($quantity, $idstripe, $unitprice, $email, $date, $heure, $dbh);

// Récupérer les détails de la réservation pour générer le PDF
$reservation = getReservationDetails($reservationId, $dbh);

if (!$reservation) {
    die("Aucune réservation trouvée pour cet ID.");
}

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

// Génération du PDF
$pdf = new PDF();
$pdf->AddPage();
$pdf->ReservationTable($reservation);
$pdf->Output('D', 'reservation_' . $reservation['email'] . '_' . $reservation['jour'] . '.pdf');
?>
