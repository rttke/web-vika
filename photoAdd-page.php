<?php
session_start();
if ($_SESSION["email"] == '')
    header('Location:/index.php#inp');
include 'db_connection.php';
require_once 'header.php'
?>

<section class="container section-addPhoto page">
    <form action="#" class="form-addPhoto" id="form-addPhoto">

        <div class="load-area">
            <div class="photoPreview">
                <img src="#" id="prevImage" alt="">
                <img src="img/delete.png" alt="" id="deleteImage">
            </div>
            <div class="load-info">
                <input type="file" id="photo-input" name="file" class="form-loadInput" accept=".jpg"/>
                <label class="label-plus" for="photo-input"><img src="img/+.svg" alt=""></label>
                <div class="load-description">Загрузите фотографию</div>
                <div class="load-annotation">(допустимый формат - jpg, максимальный размер - 3 Мб)</div>
            </div>
        </div>
        <div class="rest-area">
            <input type="text" placeholder="Описание" name="description" class="form-loadInput">
            <div class="rest-low">
                <div class="foto btn-publish">
                    <div class="sv">Опубликовать фотографию</div>
                </div>
                <div class="rest-info">
                    <img src="img/info.svg" alt="">
                    Все поля обязательны для заполнения
                </div>
            </div>

        </div>
    </form>
</section>
<script src="jquery/jquery.min.js"></script>
<script src="js/addPhoto.js"></script>

<?php
require_once 'footer.php'
?>
