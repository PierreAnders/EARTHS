<?php
require 'php/config.php';

$addressError = "";
$titleError = "";
$descriptionError = "";
$targetError = "";
$deadlineError = "";
$imageError = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $address = $_POST['address'] ? $_POST['address'] : '';
    $title = $_POST['title'] ? $_POST['title'] : '';
    $description = $_POST['description'] ? $_POST['description'] : '';
    $target = $_POST['target'] ? $_POST['target'] : '';
    $deadline = $_POST['deadline'] ? $_POST['deadline'] : '';
    $image = $_POST['image'] ? $_POST['image'] : '';


    if (empty($address)) {
        $addressError = "Address is required";
    }
    if (empty($title)) {
        $titleError = "Title is required";
    }
    if (empty($description)) {
        $descriptionError = "Description is required";
    }
    if (empty($target)) {
        $targetError = "Target is required";
    }
    if (empty($deadline)) {
        $deadlineError = "Deadline is required";
    }
    if (empty($image)) {
        $imageError = "Image is required";
    }
    if (
        empty($addressError) && empty($tiFtleError) && empty($descriptionError)
        && empty($targetError) && empty($deadlineError)
        && empty($imageError)
    ) {
        $stmt = $pdo->prepare('INSERT INTO projects (address, title, description, target, deadline, amount_collected,
        image) VALUES (?, ?, ?, ?, ?, ?, ?)');
        $stmt->execute([$address, $title, $description, $target, $deadline, $amount_collected, $image]);
        header("Location: index.php");
        exit(); 
    }
}
?>

<!-- CODE HTML -->

<?php include 'php/header.php' ?>
<form action="create.php" method="POST" class="create-form">
    <label for="address">Address</label>
    <input id="address" name="address" type="text">
    <span class="error">
        <?= $addressError ?>
    </span>

    <div class="pt-1rem"></div>
        <label for="title">Title</label>
        <input id="title" name="title" type="text">
        <span class="error">
            <?= $titleError ?>
        </span>
    <div class="pt-1rem"></div>
        <label for="description">Description</label>
        <textarea id="description" name="description" rows="6" cols="60"></textarea>
        <span class="error">
            <?= $descriptionError ?>
        </span>
    <div class="pt-1rem"></div>
        <label for="target">Target</label>
        <input id="target" name="target" type="text">
        <span class="error">
            <?= $targetError ?>
        </span>
    <div class="pt-1rem"></div>
        <label for="deadline">Deadline</label>
        <input id="deadline" name="deadline" type="text">
        <span class="error">
            <?= $deadlineError ?>
        </span>
    <div class="pt-1rem"></div>
        <label for="image">Image URL</label>
        <input id="image" name="image" type="text">
        <span class="error">
            <?= $imageError ?>
        </span>
    <div class="flex pt-1rem">
        <a href="home.php" class="btn-blue mr-1"> <<< </a>
        <button class="btn-blue ml-1" type="submit">Create</button>
    </div>
</form>
