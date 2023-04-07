<?php
require 'php/config.php';

$projectId = $_GET['id'] ? $_GET['id'] : null;
if (!isset($projectId)) {
    header("Location: index.php");
}

$stmt = $pdo->prepare("SELECT * FROM projects WHERE id = ?");
$stmt->bindValue($projectId, PDO::PARAM_INT);

try {
    $stmt->execute();
    $project = $stmt->fetch(PDO::FETCH_ASSOC);
    header("Location: index.php?successDelete=true");
} catch (Exception $e) {
    header("Location: index.php?successDelete=false");
}
