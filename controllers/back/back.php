<?php
include 'Database.php';
if ($stmt->rowCount() > 0) {

    while ($row = $stmt->fetch()) {
        echo "<tr>
            <td>" . htmlspecialchars($row["id"]) . "</td>
            <td>" . htmlspecialchars($row["q"]) . "</td>
            <td>" . htmlspecialchars($row["r"]) . "</td>
        </tr>";
    }
} else {

    echo "<tr><td colspan='4'>0 résultats</td></tr>";
}



require 'views/back/back.view.php';
?>