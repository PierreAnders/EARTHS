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
    $articles = $pdo->prepare('SELECT * FROM projects');
    $articles->execute();
    ?>

    <?php include 'php/header.php' ?>

    <div class="container">
        <div id="all-projects-info">

            <?= $deleteResponseMessage ?>

            <?php foreach ($articles as $row) { ?>
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
                <div class="pt-08rem flex"> 
                    AMOUNT COLLECTED : <?= $row['amount_collected'] ?> ETH 
                    <a class="btn-blue flex-end w-60-px" href="/earthwise/donate.php?id=<?= $project['id'] ?>">donate</a>
                </div>
                <div>. . . . . . . . . . . . . . . . . . . . . . . . . . . . . . .</div>

            <?php
            }
            ?>
        </div>
    </div>
</body>

