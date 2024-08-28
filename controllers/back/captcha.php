<?php
include 'models/Database.php';
include 'views/back/captcha.view.php';

if (isset($_POST['delete_id'])) {
    $delete_id = $_POST['delete_id'];
    $delete_sql = "DELETE FROM captcha WHERE id = :id";
    $stmt = $dbh->prepare($delete_sql);
    $stmt->execute([':id' => $delete_id]);

header("Location: " . $_SERVER['PHP_SELF']);
exit;
}

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