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
        $query = "UPDATE project SET address = ?, titre = ?, description = ?, target = ?,
        deadline = ?, image = ? WHERE id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('sssiiis', $address, $title, $description, $target, $deadline, $amount_collected, $image);
        $stmt->execute();
        $result = $stmt->get_result();
        header("Location: view.php?id=" . $projectId . "&success=true");
    } else {
        header("Location: view.php?id=" . $projectId . "&success=false");
    }
}


include 'php/header.php'
    ?>
<h1>Update Project</h1>
<a href="index.php">Back to Home</a>

<form action="/phpCrud/edit.php?id=<?= $student['id'] ?>" method="POST">
    <div class="form-group">
        <label for="name">Nom</label>
        <input value="<?= $student['name'] ?>" id="name" name="name" type="text">
        <span class="error">
            <?= $nameError ?>
        </span>
    </div>
    <div class="form-group">
        <label for="age">Age</label>
        <input value="<?= $student['age'] ?>" id="age" name="age" type="text">
        <span class="error">
            <?= $ageError ?>
        </span>
    </div>
    <div class="form-group">
        <label for="school">Ecole</label>
        <input value="<?= $student['school'] ?>" id="school" name="school" type="text">
        <span class="error">
            <?= $schoolError ?>
        </span>
    </div>
    <button type="submit">Modifier</button>
</form>


<?php include('inc/footer.php'); ?>