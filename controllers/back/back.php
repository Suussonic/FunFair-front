<?php
if (isset($_SESSION['firstname'])) {
    if ($_SESSION['role'] === 'admin') echo header("Location: /");
} 


require 'views/back/back.view.php';
?>