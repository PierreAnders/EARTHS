<?php
require 'php/config.php';

$projectId = $_GET['id'] ?? null;
if (!isset($projectId)) {
    header("Location: index.php");
}

$stmt = $pdo->prepare("DELETE FROM projects WHERE id = :id");
$stmt->bindValue(':id', $projectId, PDO::PARAM_INT);

try {
    $stmt->execute();
    header("Location: index.php?successDelete=true");
} catch (Exception $e) {
    header("Location: index.php?successDelete=false");
}
