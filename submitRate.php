<?php
header('Content-Type: application/json');
session_start();
include 'db_connection.php';

$user_id = $_SESSION['id_user'];
$photo_id = $_POST['photoId'];
$rate_get = $_POST['rate'];
$stmt = $mysql->prepare("INSERT INTO `user_photo_rate` VALUES(:user_id, :element_id, :rate_get)");

$stmt->bindParam(':user_id', $user_id);
$stmt->bindParam(':element_id', $photo_id);
$stmt->bindParam(':rate_get', $rate_get);

$stmt->execute();


//echo $rate_get;


$stmt = $mysql->prepare("SELECT avg(rate) as `avg_rate`, count(rate) AS `rate_num` FROM `user_photo_rate` WHERE user_photo_rate.id_photo = :id_element");

$stmt->bindParam(':id_element', $photo_id);

$stmt->execute();

$result2 = $stmt->fetch();
$average_rate = substr($result2['avg_rate'], 0, 3);
$rate_num = $result2['rate_num'];

$arr['rate'] = $rate_get;
$arr['average_rate'] = $average_rate;
$arr['rate_num'] = $rate_num;
echo json_encode($arr);
