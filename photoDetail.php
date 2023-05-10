<?php
session_start();
if ($_SESSION["email"] == '')
    header('Location:/index.php#inp');
include 'db_connection.php';
$photoId = $_GET['photo'];

$photo = $mysql->query("SELECT * FROM photos WHERE id = '$photoId'");
$photo = $photo->fetch();

$id_user = $photo['user'];
$owner = $mysql->query("SELECT name, email FROM users WHERE id = '$id_user'");
$owner = $owner->fetch();
$selfFoto = false;
if ($_SESSION["email"] == $owner['email']){
    $selfFoto = true;
}

$stmt = $mysql->prepare("SELECT avg(rate) as `avg_rate`, count(rate) AS `rate_num` FROM `user_photo_rate` WHERE user_photo_rate.id_photo = :id_photo");

$stmt->bindParam(':id_photo', $photo['id']);

$stmt->execute();

$result2 = $stmt->fetch();
$average_rate = substr($result2['avg_rate'], 0, 3);
$rate_num = $result2['rate_num'];

$stmt = $mysql->prepare("SELECT rate FROM `user_photo_rate` WHERE user_photo_rate.id_photo = :id_photo AND user_photo_rate.id_user = :id_user");

$stmt->bindParam(':id_photo', $photo['id']);
$stmt->bindParam(':id_user', $_SESSION['id_user']);

$stmt->execute();

//$fotos = $mysql->query("SELECT * FROM photos ORDER BY id DESC");
require_once 'header.php'
?>

<section class="container section-photoDetail page">
    <div class="photo">
        <img src="<?= $photo['photopath'] ?>" alt="">
    </div>
    <div class="photo-info">
        <div class="photo-firstrow">
            <h1 class="photo-title"><?= $photo['description'] ?></h1>
            <a href="/" class="btn-return"><img src="img/return.svg" alt="">
                <span class="hidden-576">Назад</span>
            </a>
        </div>
        <div class="photo-secondrow">
            <p class="post-date">Добавлено <?= date("d.m.y", strtotime($photo['date'])) ?>
                в <?= date("H:i:s", strtotime($photo['date'])) ?></p>
            <img src="img/dot.png" alt="">
            <p class="post-owner"><?= $owner['name'] ?>, <?= $owner['email'] ?></p>
        </div>
        <div class="rating">
            <div class="rating-info">
                <div class="rating-title">Рейтинг</div>
                <div class="rating-average" id="average-rate"><?php
                    if (!$average_rate) {
                        echo '-';
                    } else {
                        echo $average_rate;
                    }

                    ?></div>
                <div class="rating-num" id="num-rate"><?= $rate_num ?> оценок</div>
            </div>

            <div class="rating-form" id="ratingForm">
            <?php
            if ($selfFoto) {?>
                <div class="rating-title denied-foto" id="nonrated-title">Вы не можете оценить свое фото!</div>
            <?php } else {?>

                    <div class="rating-title" id="nonrated-title">Оцените фотографию</div>
                    <div class="rating-title2" id="rated-title">Вы оценили фотографию</div>
                    <div class="rating-stars">
                        <svg class="rate-star" data-value="5" width="32" height="32" viewBox="0 0 32 32" fill="none"
                             xmlns="http://www.w3.org/2000/svg">
                            <path d="M14.2311 3.35268C14.9815 1.93038 17.0185 1.93039 17.7689 3.35268L20.4315 8.39921C20.7209 8.9477 21.2483 9.33091 21.8594 9.43664L27.4817 10.4094C29.0663 10.6836 29.6957 12.6209 28.5749 13.7741L24.5982 17.8658C24.166 18.3105 23.9645 18.9306 24.0528 19.5444L24.865 25.1922C25.0939 26.7839 23.4459 27.9812 22.0028 27.2716L16.8825 24.7539C16.326 24.4803 15.674 24.4803 15.1175 24.7539L9.99715 27.2716C8.55406 27.9812 6.90612 26.7839 7.13503 25.1922L7.94723 19.5444C8.0355 18.9306 7.83403 18.3105 7.40181 17.8658L3.42506 13.7741C2.30427 12.6209 2.93373 10.6836 4.5183 10.4094L10.1406 9.43664C10.7517 9.33091 11.2791 8.94769 11.5685 8.3992L14.2311 3.35268Z"
                                  fill="#463F5D"/>
                        </svg>

                        <svg class="rate-star" data-value="4" width="32" height="32" viewBox="0 0 32 32" fill="none"
                             xmlns="http://www.w3.org/2000/svg">
                            <path d="M14.2311 3.35268C14.9815 1.93038 17.0185 1.93039 17.7689 3.35268L20.4315 8.39921C20.7209 8.9477 21.2483 9.33091 21.8594 9.43664L27.4817 10.4094C29.0663 10.6836 29.6957 12.6209 28.5749 13.7741L24.5982 17.8658C24.166 18.3105 23.9645 18.9306 24.0528 19.5444L24.865 25.1922C25.0939 26.7839 23.4459 27.9812 22.0028 27.2716L16.8825 24.7539C16.326 24.4803 15.674 24.4803 15.1175 24.7539L9.99715 27.2716C8.55406 27.9812 6.90612 26.7839 7.13503 25.1922L7.94723 19.5444C8.0355 18.9306 7.83403 18.3105 7.40181 17.8658L3.42506 13.7741C2.30427 12.6209 2.93373 10.6836 4.5183 10.4094L10.1406 9.43664C10.7517 9.33091 11.2791 8.94769 11.5685 8.3992L14.2311 3.35268Z"
                                  fill="#463F5D"/>
                        </svg>

                        <svg class="rate-star" data-value="3" width="32" height="32" viewBox="0 0 32 32" fill="none"
                             xmlns="http://www.w3.org/2000/svg">
                            <path d="M14.2311 3.35268C14.9815 1.93038 17.0185 1.93039 17.7689 3.35268L20.4315 8.39921C20.7209 8.9477 21.2483 9.33091 21.8594 9.43664L27.4817 10.4094C29.0663 10.6836 29.6957 12.6209 28.5749 13.7741L24.5982 17.8658C24.166 18.3105 23.9645 18.9306 24.0528 19.5444L24.865 25.1922C25.0939 26.7839 23.4459 27.9812 22.0028 27.2716L16.8825 24.7539C16.326 24.4803 15.674 24.4803 15.1175 24.7539L9.99715 27.2716C8.55406 27.9812 6.90612 26.7839 7.13503 25.1922L7.94723 19.5444C8.0355 18.9306 7.83403 18.3105 7.40181 17.8658L3.42506 13.7741C2.30427 12.6209 2.93373 10.6836 4.5183 10.4094L10.1406 9.43664C10.7517 9.33091 11.2791 8.94769 11.5685 8.3992L14.2311 3.35268Z"
                                  fill="#463F5D"/>
                        </svg>

                        <svg class="rate-star" data-value="2" width="32" height="32" viewBox="0 0 32 32" fill="none"
                             xmlns="http://www.w3.org/2000/svg">
                            <path d="M14.2311 3.35268C14.9815 1.93038 17.0185 1.93039 17.7689 3.35268L20.4315 8.39921C20.7209 8.9477 21.2483 9.33091 21.8594 9.43664L27.4817 10.4094C29.0663 10.6836 29.6957 12.6209 28.5749 13.7741L24.5982 17.8658C24.166 18.3105 23.9645 18.9306 24.0528 19.5444L24.865 25.1922C25.0939 26.7839 23.4459 27.9812 22.0028 27.2716L16.8825 24.7539C16.326 24.4803 15.674 24.4803 15.1175 24.7539L9.99715 27.2716C8.55406 27.9812 6.90612 26.7839 7.13503 25.1922L7.94723 19.5444C8.0355 18.9306 7.83403 18.3105 7.40181 17.8658L3.42506 13.7741C2.30427 12.6209 2.93373 10.6836 4.5183 10.4094L10.1406 9.43664C10.7517 9.33091 11.2791 8.94769 11.5685 8.3992L14.2311 3.35268Z"
                                  fill="#463F5D"/>
                        </svg>

                        <svg class="rate-star" data-value="1" width="32" height="32" viewBox="0 0 32 32" fill="none"
                             xmlns="http://www.w3.org/2000/svg">
                            <path d="M14.2311 3.35268C14.9815 1.93038 17.0185 1.93039 17.7689 3.35268L20.4315 8.39921C20.7209 8.9477 21.2483 9.33091 21.8594 9.43664L27.4817 10.4094C29.0663 10.6836 29.6957 12.6209 28.5749 13.7741L24.5982 17.8658C24.166 18.3105 23.9645 18.9306 24.0528 19.5444L24.865 25.1922C25.0939 26.7839 23.4459 27.9812 22.0028 27.2716L16.8825 24.7539C16.326 24.4803 15.674 24.4803 15.1175 24.7539L9.99715 27.2716C8.55406 27.9812 6.90612 26.7839 7.13503 25.1922L7.94723 19.5444C8.0355 18.9306 7.83403 18.3105 7.40181 17.8658L3.42506 13.7741C2.30427 12.6209 2.93373 10.6836 4.5183 10.4094L10.1406 9.43664C10.7517 9.33091 11.2791 8.94769 11.5685 8.3992L14.2311 3.35268Z"
                                  fill="#463F5D"/>
                        </svg>

                    </div>
                    <div class="foto btn-rate" id="btn-rate">Оценить</div>

            <?php }

            ?>
            </div>

        </div>
    </div>
</section>


<script src="jquery/jquery.min.js"></script>
<script src="js/photoDetail2.js"></script>
<?php
require_once 'footer.php'
?>
