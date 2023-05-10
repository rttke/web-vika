<?php
session_start();
include 'db_connection.php';

$fotos = $mysql->query("SELECT * FROM photos ORDER BY id DESC");
require_once 'header.php'
?>


<body>

<div class="section page">
    <div class="container">
        <div class="mes">
            <a class="text1">Апрель, 2023</a>
            <a href="/photoAdd-page.php" class="foto">
                <img class="white" src="img/+2.svg" alt="">
                <div class="sv hidden-576"> Добавить фото</div>
            </a>
        </div>
    </div>
    <div class="cards">
        <div class="container">
            <div class="cards-holder">


                <?php
                foreach ($fotos as $row) { ?>
                    <a href="photoDetail.php?photo=<?= $row['id'] ?>" class="card">
                        <div class="card__info">
                            <div class="card__title"><?= $row['description'] ?></div>
                            <div class="card__date">
                                <span>Добавлено</span>
                                <img src="img/clock.svg" alt="">
                                <?= date("d", strtotime($row['date'])) ?> апреля
                            </div>
                        </div>
                        <img class="card-img" src="<?= $row['photopath'] ?>">
                    </a>
                <?php }
                ?>
            </div>
        </div>
    </div>

    <div class="container more">
        <div class="pokaz">
            <div class="qw">
                <div class="show-more">
                    <img class="imgv" src="img/Vector 1.png" alt="">
                    <a href="#" class="show_more">Показать еще</a>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="jquery/jquery.min.js"></script>
<script src="js/main.js"></script>

<?php
require_once 'footer.php'
?>
