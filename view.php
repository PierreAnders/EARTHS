<?php 
require 'php/config.php';

$projectId = $_GET['id'] ?? null;
if (!isset($projectId)) {
    header("Location: index.php");
    exit();
}

$stmt = $pdo->prepare("SELECT * FROM projects WHERE id = ?");
$stmt->bindParam(1, $projectId, PDO::PARAM_INT);
$stmt->execute();
$project = $stmt->fetch(PDO::FETCH_ASSOC);



include "php/header.php"; ?>

<div id="threejs-container"></div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js"></script>
<script src="js/project.js"></script>

<div id="project-info">
    <h1 class="pt-2rem" id="title"><?= $project['title'] ?></h1>
    <h1 class="pt-2rem" id="title"><?= $project['id'] ?></h1>

    
    <div class="pt-2rem">ADDRESS :</div> 
    <div class="pt-02rem"> <?= $project['address'] ?> </div>
    <div class="pt-2rem">ABOUT : </div> 
    <div class="pt-02rem"> <?= $project['description'] ?> </div>
    <div class="pt-2rem">TARGET : <?= $project['target'] ?> ETH </div>
    <div class="pt-2rem">DEADLINE : <?= $project['deadline'] ?> Days</div>
    <div class="pt-2rem">AMOUNT COLLECTED : <?= $project['amount_collected'] ?> ETH </div>
    <!-- <img src="<?= $project['image'] ?>" class="img-responsive"> -->
    <div class="pt-2rem">
        <a href="home.php " class="btn-blue"><<<</a>
        <a class="btn-blue" href="/earthwise/edit.php?id=<?= $project['id'] ?>">edit</a>
        <a class="btn-blue" href="/earthwise/delete.php?id=<?= $project['id'] ?>">delete</a>
    </div>
</div>
