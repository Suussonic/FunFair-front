<?php
include 'models/Database.php';
include 'views/capcha.view.php';
if ($stmt->rowCount() > 0) {
    // Afficher les données de chaque ligne
    while ($row = $stmt->fetch()) {
        echo "<tr>
            <td>" . htmlspecialchars($row["id"]) . "</td>
            <td>" . htmlspecialchars($row["q"]) . "</td>
            <td>" . htmlspecialchars($row["r"]) . "</td>
        </tr>";
    }
} else {
    // Si aucun enregistrement n'est trouvé, afficher un message
    echo "<tr><td colspan='4'>0 résultats</td></tr>";
}

require 'views/back/captcha.view.php';
?>