<?php
session_start();

session_destroy();

exit();

require 'views/registration/logout.view.php';
?>