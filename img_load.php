<?php
session_start();
//	include 'thumbs.php';
include 'db_connection.php';


//-----Проверка на пустоту полей ввода-----
if ($_POST['description'] != "") {
    $username = $_SESSION["email"];

    // $description = $_POST['description'];
    $stmt = $mysql->prepare("SELECT `id` FROM `users` WHERE `email` = :username ");

    $stmt->bindParam(':username', $username);
    $stmt->execute();

    $user = $stmt;
    $result = $user->fetch();
    $id_user = $result['id'];
    $img_type = substr($_FILES['img_load']['type'], 0, 5);
    $img_size = 10000 * 1024 * 1024;

    $allowed = array('gif', 'png', 'jpg');

    $ext = pathinfo($_FILES['img_load']['name'], PATHINFO_EXTENSION);

    //-----Проверка фото-----
    if (!empty($_FILES['img_load']['tmp_name']) and in_array($ext, $allowed) and $_FILES['img_load']['size'] <= $img_size) {

        $img = addslashes(file_get_contents($_FILES['img_load']['tmp_name']));

        $image = $_FILES['img_load'];

        $u = uniqid();

        copy($image['tmp_name'], 'users-foto/' . $u . $image['name']);

//			copy($image['tmp_name'], 'img/imgmin/min_' . $u .$image['name']);

//			$image_1 = new Thumbs('img/imgmin/min_' . $u . $image['name']);
//			$image_1->thumb(500, 288);
//			$image_1->save();

        $im1 = 'users-foto/' . $u . $image['name'];
//			$im2 = 'img/imgmin/min_' . $u . $image['name'];

        //$image_min = addslashes(file_get_contents('img/imgmin/min_' . $image['name']));

        // $tag = "Припрода";
        // $tags = $tag . ", ";
        // $tagss = "ttttttt ";
        // copy($image_min['tmp_name'], 'img/imgmin/' . $image['name']);

        // echo $image, $image_min;


        // $img_minn = $img_min->reduce(200, 0);

        // $img_min_ser = addslashes(file_get_contents($img_minn));


        $stmt = $mysql->prepare("INSERT INTO `photos` (`photopath`, `description`, `user`) VALUES('$im1', :description, :id_user)");


        $description = filter_var(trim($_POST['description']), FILTER_SANITIZE_STRING);

        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':id_user', $id_user);

        $stmt->execute();


//			//-----Узнаем id фото-----
//			$stmt = $mysql->prepare("SELECT `id_element` FROM `element` ORDER BY `id_element` DESC LIMIT 1");
//			$stmt->execute();
//
//			$result = $stmt->fetch();
//			$id_element = $result['id_element'];
//
//			//-----Узнаем id тега-----
//			$stmt_search_tag = $mysqll->prepare("SELECT `id_tag` FROM `tags` ORDER BY `id_tag` DESC LIMIT 1");
//
//			$stmt_search_tag->execute();
//				$result = $stmt_search_tag->fetch();
//				$id_tag = $result['id_tag'];
//
//
//
//
//			$stmt_tag = $mysql->prepare("INSERT INTO `tags` (`title`) VALUES(:tag)");
//
//			$stmt_element_tag = $mysql->prepare("INSERT INTO `element_tag` (`id_element`, `id_tag`) VALUES(:id_element, :id_tag)");
//
//
//			$tags  = explode(",", $_POST['tags']);
//
//			for($i = 0; $i < count($tags); $i++){
//				$tag = filter_var(trim($tags[$i]), FILTER_SANITIZE_STRING);
//				$stmt_tag->bindParam(':tag', $tag);
//				$stmt_tag->execute();
//
//				$stmt_search_tag->execute();
//				$result = $stmt_search_tag->fetch();
//				$id_tag = $result['id_tag'];
//
//
//				$stmt_element_tag->bindParam(':id_element', $id_element);
//				$stmt_element_tag->bindParam(':id_tag', $id_tag);
//				$stmt_element_tag->execute();
//
//			}
//
//			$stmt = $mysql->prepare("INSERT INTO `user_element_rate` VALUES(:user_id, :element_id, '6')");
//
//			$stmt->bindParam(':user_id', $id_user);
//			$stmt->bindParam(':element_id', $id_element);
//
//			$stmt->execute();
//
//			$path_to_delete = $_SESSION['path_to_delete'];
//
//			unlink($path_to_delete);


//            ------

        // $stmt->bindParam(':tags', $tags);
        // $stmt->execute();

        // $mysqll->query("INSERT INTO `test` (`e-test`, `num`, `id_t`) VALUES('ghhhhh', '3', '3')");


        // $mysqll->close();
        // header('Location: ../../me_auth.php');
    } else {

        echo "Ошибка загрузки фото(Неверный формат или превышен размер в 10 мб)";
    }
} else {
    echo "Заполните все поля корректно!";
}

