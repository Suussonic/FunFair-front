<?php
include 'models/Database.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $content = $_POST['content'];
    $question_id = $_POST['question_id'];
    $id_author = $_SESSION['user_id'];
    $name_author = $_SESSION['username'];

    $stmt = $pdo->prepare("INSERT INTO responses (question_id, content, id_author, name_author) VALUES (?, ?, ?, ?)");
    $stmt->execute([$question_id, $content, $id_author, $name_author]);

    header("Location: question.php?id=$question_id");
    exit;
}
?>
