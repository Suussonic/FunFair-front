<?php
include 'models/Database.php';
include 'views/back/captcha.view.php';

$sql = "SELECT id, q, r FROM captcha";
$stmt = $dbh->query($sql);

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

require 'views/back/captcha.view.php';
?>