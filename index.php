<body>
    <?php
    require 'php/config.php';
    include 'php/header.php';

    $deleteResponseMessage = "";
    if (isset($_GET['successDelete'])) {
        if ($_GET['successDelete'] == true) {
            $deleteResponseMessage = "The project has been successfully deleted";
        } else {
            $deleteResponseMessage = "An error has occurred";
        }
    }

    $projects = $pdo->prepare('SELECT * FROM projects');
    $projects->execute();
    ?>

    <div class="container">
        <div id="all-projects-info">

            <?= $deleteResponseMessage ?>

            <?php foreach ($projects as $project) { ?>
                <div class="pt-3rem index-title"> <?= strtoupper($project['title']) ?> </div>
                <div class="pt-02rem">
                    <a href="/earthwise/view.php?id=<?= $project['id'] ?>"> <img src="<?= $project['image'] ?>" class="img-responsive"> </a>
                </div>
                <div class="pt-08rem"> ADDRESS : </div>
                <div class="pt-02rem"> <?= $project['address'] ?> </div>
                <div class="pt-08rem"> ABOUT : </div>
                <div class="pt-02rem"> <?= $project['description'] ?> </div>
                <div class="pt-08rem"> TARGET : <?= $project['target'] ?> ETH </div>
                <div class="pt-08rem"> DEADLINE : <?= $project['deadline'] ?> days left </div>
                <div class="pt-08rem flex">
                    AMOUNT COLLECTED : <?= $project['amount_collected'] ?> ETH
                    <a class="btn-blue flex-end w-60-px" href="/earthwise/donate.php?id=<?= $project['id'] ?>">donate</a>
                </div>
                <div>. . . . . . . . . . . . . . . . . . . . . . . . . . . . . . .</div>

            <?php
            }
            ?>
        </div>
    </div>
</body>