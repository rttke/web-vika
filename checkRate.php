<?php
session_start();
include 'db_connection.php';

$user_id = $_SESSION['id_user'];
$element_id = $_POST['photoId'];

$stmt = $mysql->prepare("SELECT `rate` FROM `user_photo_rate` WHERE `id_user` = :user_id AND
	`id_photo` = :element_id");

$stmt->bindParam(':user_id', $user_id);
$stmt->bindParam(':element_id', $element_id);


$stmt->execute();


$result = $stmt->fetch();

if (empty($result['rate']))
    echo "";
else
    echo $result['rate'];


//echo $html_get;











