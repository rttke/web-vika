<?php
    include 'connectionDB.php';


$email = filter_var(trim($_POST['email']), FILTER_SANITIZE_STRING);
	$pass = filter_var(trim($_POST['password']), FILTER_SANITIZE_STRING);
	// if(mb_strlen($login) < 6 || mb_strlen($login) > 90)

	



		$stmt = $mysql->prepare("SELECT id, password, name, email FROM `users` WHERE `email` = :email");
		$stmt->bindParam(':email', $email);
		$stmt->execute();
		$user_auth = $stmt->fetch();

        if($user_auth){
            if(!password_verify($pass."hash", $user_auth['password']))
            {
                echo "Неверный логин или пароль!";
                exit();

            }
        }
        else{
            echo "Неверный логин или пароль!";
            exit();
        }


	session_start();
	$_SESSION["name"] = $user_auth['name'];
	$_SESSION["email"] = $email;
	$_SESSION["id_user"] = $user_auth['id'];
