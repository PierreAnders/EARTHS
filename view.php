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
    <h1 class="pt-2rem" id="title"><?= $project['title'] ?></h1>
    
    <?= $editResponseMessage ?>
    
    <div class="pt-2rem">ADDRESS :</div> 
    <div class="pt-02rem"> <?= $project['address'] ?> </div>
    <div class="pt-2rem">ABOUT : </div> 
    <div class="pt-02rem"> <?= $project['description'] ?> </div>
    <div class="pt-2rem">TARGET : <?= $project['target'] ?> ETH </div>
    <div class="pt-2rem">DEADLINE : <?= $project['deadline'] ?> Days</div>
    <div class="pt-2rem">AMOUNT COLLECTED : <?= $project['amount_collected'] ?> ETH </div>
    <!-- <img src="<?= $project['image'] ?>" class="img-responsive"> -->
    <div class="pt-2rem">
        <a href="home.php " class="btn-blue">Back to Home page</a>
    </div>
</div>