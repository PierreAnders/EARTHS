<?php
require 'php/config.php';

$projectId = $_GET['id'] ? $_GET['id'] : null;
if (!isset($projectId)) {
    header("Location: index.php");
}

$query = "DELETE FROM projects WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param('i', $projectId);
try {
    $stmt->execute();
    $result = $stmt->get_result();
    header("Location: index.php?successDelete=true");
} catch (Exception $e) {
    header("Location: index.php?successDelete=false");
}