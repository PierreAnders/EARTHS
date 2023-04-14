<?php
require 'php/config.php';
session_start();
$commentError = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $comment = $_POST['comment'] ??  '';
    $project_id = $_POST['project_id'] ??  '';
    $user_id = $_SESSION['user_id'] ?? '';

    if (empty($comment)) {
        $commentError = "Text is required";
    }
    if (
        empty($commentError)
    ) {
        $stmt = $pdo->prepare('INSERT INTO comments (Comment, User_id, Project_id) VALUES (?, ?, ?)');
        $stmt->execute([$comment, $user_id, $project_id]);
        header("Location: view.php?id=" . $project_id);
        exit();
    }
}
