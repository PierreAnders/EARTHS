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
    if (empty($addressError) && empty($titleError) && empty($descriptionError) 
        && empty($targetError) && empty($deadlineError) 
        && empty($imageError)) {
        $query = "INSERT INTO projects (address, title, description, target, deadline, amount_collected,
        image) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('sssiiis', $address, $title, $description, $target, $deadline, $amount_collected, $image);
        $stmt->execute();
        $result = $stmt->get_result();
        header("Location: index.php");
    }
}
?>

<!-- CODE HTML -->

<?php include 'php/header.php' ?>

<h1>Create a Web3 Crowfunding Projet</h1>

<a href="index.php">Back to Home page</a>

<form action="create.php" method="POST">

    <div class="form-group">
        <label for="address">Address</label>
        <input id="address" name="address" type="text">
        <span class="error">
            <?= $addressError ?>
        </span>
    </div>

    <div class="form-group">
        <label for="title">Title</label>
        <input id="title" name="title" type="text">
        <span class="error">
            <?= $titleError ?>
        </span>
    </div>

    <div class="form-group">
        <label for="description">Descrition</label>
        <input id="description" name="description" type="text">
        <span class="error">
            <?= $descriptionError ?>
        </span>
    </div>

    <div class="form-group">
        <label for="target">Target</label>
        <input id="target" name="target" type="text">
        <span class="error">
            <?= $targetError ?>
        </span>
    </div>

    <div class="form-group">
        <label for="deadline">Deadline</label>
        <input id="deadline" name="deadline" type="text">
        <span class="error">
            <?= $deadlineError ?>
        </span>
    </div>

    <div class="form-group">
        <label for="image">Image URL</label>
        <input id="image" name="image" type="text">
        <span class="error">
            <?= $imageError ?>
        </span>
    </div>

    <button type="submit">Create</button>
</form>