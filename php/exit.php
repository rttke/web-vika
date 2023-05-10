<?php
	session_start();
	$_SESSION["name"] = null;
	$_SESSION["email"] = null;
	$_SESSION["id_user"] = null;
	//setcookie('user', $user['login'], time() - 7200, "/");
	header('Location: /');