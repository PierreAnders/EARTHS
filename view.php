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

<div id="threejs-container"></div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js"></script>
<script src="js/project.js"></script>

<div id="project-info">
    <h1 id="title"><?= $project['title'] ?></h1>
    <a href="index.php">Back to Home page</a>

    <?= $editResponseMessage ?>

    <div class="small-padding">ADDRESS : <?= $project['address'] ?> </div>
    <div class="small-padding">ABOUT : <?= $project['description'] ?> </div>
    <div class="small-padding">TARGET : <?= $project['target'] ?> ETH </div>
    <div class="small-padding">DEADLINE : <?= $project['deadline'] ?> </div>
    <div class="small-padding">AMOUNT COLLECTED : <?= $project['amount_collected'] ?> ETH </div>
    <div class="small-padding">TITLE : <?= $project['title'] ?> </div>
    <!-- <img src="<?= $project['image'] ?>" class="img-responsive"> -->
</div>