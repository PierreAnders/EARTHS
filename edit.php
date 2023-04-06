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
?>

<?php include 'php/header.php' ?>

<form action="edit.php?id=<?= $project['id'] ?>" method="POST" class="create-form">
        <label for="address">Address</label>
        <input value="<?= $project['address'] ?>" id="address" name="address" type="text">
        <span class="error">
            <?= $addressError ?>
        </span>
    <div class="pt-1rem"></div>
        <label for="title">Title</label>
        <input value="<?= $project['title'] ?>" id="title" name="title" type="text">
        <span class="error">
            <?= $titleError ?>
        </span>
    <div class="pt-1rem"></div>
    <textarea id="description" name="description" rows="6" cols="60"><?= $project['description'] ?></textarea>
        <span class="error">
            <?= $descriptionError ?>
        </span>
    <div class="pt-1rem"></div>
        <label for="target">Target</label>
        <input value="<?= $project['target'] ?>" id="target" name="target" type="number">
        <span class="error">
            <?= $targetError ?>
        </span>
    <div class="pt-1rem"></div>
        <label for="deadline">Deadline</label>
        <input value="<?= $project['deadline'] ?>" id="deadline" name="deadline" type="number">
        <span class="error">
            <?= $deadlineError ?>
        </span>
    <div class="pt-1rem"></div>
        <label for="image">Image</label>
        <input value="<?= $project['image'] ?>" id="image" name="image" type="text">
        <span class="error">
            <?= $imageError ?>
        </span>
    <div class="flex pt-1rem">
        <a href="home.php" class="btn-blue mr-1"> <<< </a>
        <a class="btn-blue ml-1" type="submit">Update</a>
    </div>
</form>