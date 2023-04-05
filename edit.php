<?php
require 'php/config.php';

$projectId = $_GET['id'] ? $_GET['id'] : null;
if (!isset($projectId)) {
    header("Location: index.php");
}
$query = "SELECT * FROM projects WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param('i', $projectId);
$stmt->execute();
$result = $stmt->get_result();
$project = mysqli_fetch_assoc($result);

$addressError = "";
$titleError = "";
$descriptionError = "";
$targetError = "";
$deadlineError = "";
$imageError = "";
$amount_collectedError = "" ;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $address = $_POST['address'] ?? '';
    $title = $_POST['title'] ?? '';
    $description = $_POST['description'] ?? '';
    $target = $_POST['target'] ?? '';
    $deadline = $_POST['deadline'] ?? '';
    $amount_collected = $_POST['amount_collected'] ?? '';
    $image = $_POST['image'] ?? '';

    // (Vérifications et erreurs de validation...)

    if (empty($addressError) && empty($titleError) && empty($descriptionError) 
        && empty($targetError) && empty($deadlineError) 
        && empty($imageError) && empty($amount_collectedError)
        ) {
        $query = "UPDATE projects SET address = ?, title = ?, description = ?, target = ?, deadline = ?, amount_collected = ?, image = ? WHERE id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('sssiiisi', $address, $title, $description, $target, $deadline, $amount_collected, $image, $projectId);
        $stmt->execute();
        header("Location: view.php?id=" . $projectId . "&success=true");
    } else {
        header("Location: view.php?id=" . $projectId . "&success=false");
    }
}

include 'php/header.php'
    ?>
<h1>Update Project</h1>
<a href="index.php">Back to Home</a>

<form action="edit.php?id=<?= $project['id'] ?>" method="POST">
    <div class="form-group">
        <label for="address">Address</label>
        <input value="<?= $project['address'] ?>" id="address" name="address" type="text">
        <span class="error">
            <?= $addressError ?>
        </span>
    </div>
    <div class="form-group">
        <label for="title">Title</label>
        <input value="<?= $project['title'] ?>" id="title" name="title" type="text">
        <span class="error">
            <?= $titleError ?>
        </span>
    </div>
    <div class="form-group">
        <label for="description">Description</label>
        <input value="<?= $project['description'] ?>" id="description" name="description" type="text">
        <span class="error">
            <?= $descriptionError ?>
        </span>
    </div>
    <div class="form-group">
        <label for="target">Target</label>
        <input value="<?= $project['target'] ?>" id="target" name="target" type="number">
        <span class="error">
            <?= $targetError ?>
        </span>
    </div>
    <div class="form-group">
        <label for="deadline">Deadline</label>
        <input value="<?= $project['deadline'] ?>" id="deadline" name="deadline" type="number">
        <span class="error">
            <?= $deadlineError ?>
        </span>
    </div>
    <div class="form-group">
        <label for="image">Image</label>
        <input value="<?= $project['image'] ?>" id="image" name="image" type="text">
        <span class="error">
            <?= $imageError ?>
        </span>
    </div>
    <button type="submit">Update</button>
</form>