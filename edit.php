<?php
require 'php/config.php';


    

$addressError = "";
$titleError = "";
$descriptionError = "";
$targetError = "";
$deadlineError = "";
$imageError = "";
$amount_collectedError = "" ;

if (isset($_GET['id'])) {
    if (!empty($_POST)) {
    $id = $_POST['id'] ?? '';
    $address = $_POST['address'] ?? '';
    $title = $_POST['title'] ?? '';
    $description = $_POST['description'] ?? '';
    $target = $_POST['target'] ?? '';
    $deadline = $_POST['deadline'] ?? '';
    $amount_collected = $_POST['amount_collected'] ?? '';
    $image = $_POST['image'] ?? '';

    // (Vérifications et erreurs de validation...)

    $stmt = $pdo->prepare("UPDATE projects SET id = ?, address = ?, title = ?, description = ?, target = ?, deadline = ?, amount_collected = ?, image = ? WHERE id = ?");
$values = [$id, $address, $title, $description, $target, $deadline, $amount_collected, $image, $id];
$stmt->execute($values);
    } if ($stmt->execute($values)) {
        echo "Les modifications ont été enregistrées avec succès.";
    } else {
        echo "Erreur lors de l'enregistrement des modifications.";
    }

    $stmt = $pdo->prepare("SELECT * FROM projects WHERE id = ?");
        $stmt->execute([$_GET['id']]);
        $project = $stmt->fetch(PDO::FETCH_ASSOC);
    
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
        <button class="btn-blue ml-1" type="submit">Mis à jour</button>
    </div>
</form>