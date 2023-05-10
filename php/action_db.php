<?php
  $title = filter_var(trim($_POST['title']), FILTER_SANITIZE_STRING); 
  $server = "localhost";
	$login = "root";
	$password = "";
	$name_db = "web";

	$mysql = new mysqli($server, $login, $password, $name_db);


try {

	$mysql->query("INSERT INTO posts (title, path) VALUES('$title', '/fgdgsdg')");

	echo "ok";
} catch (Exception $e) {
	echo 'Выброшено исключение: ',  $e->getMessage(), "\n";
}
  header('Location: /');
  exit();
?>
