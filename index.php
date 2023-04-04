<body>
    <?php
    require 'php/config.php';

    $deleteResponseMessage = "";
    if (isset($_GET['successDelete'])) {
        if ($_GET['successDelete'] == true) {
            $deleteResponseMessage = "The project has been successfully deleted";
        } else {
            $deleteResponseMessage = "An error has occurred";
        }
    }

    $statement = "SELECT * FROM projects";
    $result = mysqli_query($conn, $statement);

    include 'php/header.php'
    ?>

    <h1>EARTH'S</h1>

    <?= $deleteResponseMessage ?>

    <?php while ($row = mysqli_fetch_array($result)) { ?>
        <strong> Title : </strong> <?= $row['title'] ?> <br>
        <strong> Address: </strong> <?= $row['address'] ?> <br>
        <strong> Description: </strong> <?= $row['description'] ?> <br>
        <strong> Target: </strong> <?= $row['target'] ?> ETH <br>
        <strong> Deadline: </strong> <?= $row['deadline'] ?> days left <br>
        <strong> Amount Collected: </strong> <?= $row['amount_collected'] ?> ETH <br>
        <a href="/earthwise/view.php?id=<?= $row['id'] ?>"> <img src="<?= $row['image'] ?>" class="img-responsive"> </a>
    <?php
    }
    ?>
</body>

