<?php
require 'php/config.php';
include "php/header.php";

$projectId = $_GET['id'] ?? null;
if (!isset($projectId)) {
    header("Location: index.php");
    exit();
}

$stmt = $pdo->prepare("SELECT * FROM projects WHERE id = ?");
$stmt->bindParam(1, $projectId, PDO::PARAM_INT);
$stmt->execute();
$project = $stmt->fetch(PDO::FETCH_ASSOC);

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$userId = $_SESSION['user_id'];
$isCreator = $userId == $project['user_id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_POST['comment']) || empty($_POST['comment'])) {
        $error = "The comment cannot be empty.";
    } else {
        $comment = $_POST['comment'];
        $stmt = $pdo->prepare("INSERT INTO comments (User_id, Project_id, Description) VALUES (?, ?, ?)");
        $stmt->execute([$userId, $projectId, $comment]);
        header("Location: view.php?id=$projectId");
        exit();
    }
}

$stmt = $pdo->prepare("SELECT comments.*, users.name FROM comments INNER JOIN users ON comments.User_id = users.id WHERE Project_id = ? ORDER BY comments.Id DESC");
$stmt->bindParam(1, $projectId, PDO::PARAM_INT);
$stmt->execute();
$comments = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>


<div id="threejs-container"></div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js"></script>
<script src="js/project.js"></script>

<div id="project-info">
    <h1 class="pt-2rem" id="title"><?= $project['title'] ?></h1>


    <div class="pt-2rem">ADDRESS :</div>
    <div class="pt-02rem"> <?= $project['address'] ?> </div>
    <div class="pt-2rem">ABOUT : </div>
    <div class="pt-02rem"> <?= $project['description'] ?> </div>
    <div class="pt-2rem">TARGET : <?= $project['target'] ?> ETH </div>
    <div class="pt-2rem">DEADLINE : <?= $project['deadline'] ?> Days</div>
    <div class="pt-2rem">AMOUNT COLLECTED : <?= $project['amount_collected'] ?> ETH </div>

    <?php if ($isCreator) : ?>
        <div class="pt-2rem">
            <a href="home.php " class="btn-blue">
                <<< </a>
                    <a class="btn-blue" href="/earthwise/edit.php?id=<?= $project['id'] ?>">edit</a>
                    <a class="btn-blue" href="/earthwise/delete.php?id=<?= $project['id'] ?>">delete</a>
                    <button id="submitToBlockchain" class="btn btn-primary">Submit to Blockchain</button>
        </div>
    <?php else : ?>
        <div class="pt-2rem">
            <a href="home.php" class="btn-blue">
                <<< </a>
        </div>
    <?php endif; ?>
</div>

<div id="comments-section">
    <h2 class="pt-2rem">Comments:</h2>

    <?php foreach ($comments as $comment) { ?>
        <div class="comment">
            <p><?= $comment['Comment'] ?></p>
        </div>
    <?php }; ?>

    <?php if ($userId) { ?>
        <h3 class="pt-2rem">Add a comment:</h3>
        <form method="POST" action="/earthwise/create-comment.php">
            <input type="hidden" name="project_id" value="<?= $project['id'] ?>">
            <div>
                <label for="comment">Comment:
                    <textarea class="comment-div" id="comment" name="comment" rows=3></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    <?php }; ?>
</div>

<script src="js/sendToBlock.js"></script>