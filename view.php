<?php 
require 'php/config.php';

$projectId = $_GET['id'] ?? null;
if (!isset($projectId)) {
    header("Location: index.php");
}

$query = "SELECT * FROM projects WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param('i', $projectId);
$stmt->execute();
$result = $stmt->get_result();
$project = mysqli_fetch_assoc($result);

$editResponseMessage= "";
if (isset($_GET['success'])) {
    if ($_GET['success'] == true) {
        $ediResponseMessage = "Project changed successfully";
    } else {
        $ediResponseMessage = 'An error has occurred';
    }
}

include "php/header.php"; ?>

<h1><?= $project['title'] ?></h1>
<a href="index.php">Back to Home page</a>

<?= $editResponseMessage ?>

<div>ADDRESS : <?= $project['address'] ?> </div>
<div>ABOUT : <?= $project['description'] ?> </div>
<div>TARGET : <?= $project['target'] ?> ETH </div>
<div>DEADLINE : <?= $project['deadline'] ?> </div>
<div>AMOUNT COLLECTED : <?= $project['amount_collected'] ?> ETH </div>
<div>TITLE : <?= $project['title'] ?> </div>
<img src="<?= $project['image'] ?>" class="img-responsive">