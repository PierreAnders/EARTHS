<?php
require_once 'php/config.php';
include "php/header.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

$stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$user_id]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    session_unset();
    session_destroy();
    header("Location: login.php");
    exit();
}

$addressError = "";
$titleError = "";
$descriptionError = "";
$targetError = "";
$deadlineError = "";
$imageError = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $address = $_POST['address'] ?? '';
    $title = $_POST['title'] ?? '';
    $description = $_POST['description'] ?? '';
    $target = $_POST['target'] ?? '';
    $deadline = $_POST['deadline'] ?? '';
    $image = $_POST['image'] ?? '';


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
        $stmt = $pdo->prepare('INSERT INTO projects (user_id, address, title, description, target, deadline, amount_collected,
        image) VALUES (?, ?, ?, ?, ?, ?, ?, ?)');
        $stmt->execute([$user_id, $address, $title, $description, $target, $deadline, $amount_collected, $image]);
        $project_id = $pdo->lastInsertId();
        header("Location: view.php?id=" . $project_id);
        exit();
    }
}
?>

<!-- CODE HTML -->

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
        <a href="home.php" class="btn-blue mr-1">
            <<< </a>
                <button class="btn-blue ml-1" type="submit">Create</button>
    </div>
</form>