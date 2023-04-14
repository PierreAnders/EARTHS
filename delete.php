<?php
require 'php/config.php';

$projectId = $_GET['id'] ?? null;
if (!isset($projectId)) {
    header("Location: index.php");
}

$deleteCommentsStmt = $pdo->prepare("DELETE FROM comments WHERE project_id = :project_id");
$deleteCommentsStmt->bindValue(':project_id', $projectId, PDO::PARAM_INT);

$deleteProjectStmt = $pdo->prepare("DELETE FROM projects WHERE id = :id");
$deleteProjectStmt->bindValue(':id', $projectId, PDO::PARAM_INT);

try {
    $pdo->beginTransaction();
    $deleteCommentsStmt->execute();
    $deleteProjectStmt->execute();
    $pdo->commit();
    
    header("Location: index.php?successDelete=true");
} catch (Exception $e) {
    $pdo->rollBack();
    header("Location: index.php?successDelete=false");
}
