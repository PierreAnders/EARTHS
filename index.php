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
    ?>

    <?php include 'php/header.php' ?>

    <div class="container">
        <div id="all-projects-info">

            <?= $deleteResponseMessage ?>

            <?php while ($row = mysqli_fetch_array($result)) { ?>
                <div class="pt-3rem index-title"> <?= strtoupper($row['title']) ?> </div>
                <div class="pt-02rem">
                    <a href="/earthwise/view.php?id=<?= $row['id'] ?>"> <img src="<?= $row['image'] ?>" class="img-responsive"> </a>
                </div>
                <div class="pt-08rem"> ADDRESS : </div> 
                <div class="pt-02rem"> <?= $row['address'] ?> </div>
                <div class="pt-08rem"> ABOUT : </div> 
                <div class="pt-02rem"> <?= $row['description'] ?> </div>
                <div class="pt-08rem"> TARGET : <?= $row['target'] ?> ETH </div>
                <div class="pt-08rem"> DEADLINE : <?= $row['deadline'] ?> days left </div>
                <div class="pt-08rem"> AMOUNT COLLECTED : <?= $row['amount_collected'] ?> ETH </div>
            <?php
            }
            ?>
        </div>
    </div>
</body>

