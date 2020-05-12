<?php
require "db.php";

// sign up
$data = $_POST;
if ( isset($data['do_signup'])) {
// поиск ошибок:
	$errors = array();
	
	if ( trim($data['email']) == '' ) {
		$errors[] = 'Введите email!';
	}
	if ( $data['password'] == '' ) {
		$errors[] = 'Введите пароль!';
	}
	if ( $data['password_2'] != $data['password'] ) {
		$errors[] = 'Повторный пароль введён не верно';
	}
	
	if ( R::count('users', "email = ?", array($data['email']) ) > 0){
		$errors[] = 'Пользователь с таким email уже существует!';
	}

// ошибок нет:
	if ( empty($errors) ) {
		$user = R::dispense('users');
            $user->user_name = $data['user_name'];
            $user->user_surname = $data['user_surname'];
            $user->user_thirdname = $data['user_otchestvo'];
            $user->user_age = $data['user_age'];
		$user->email = $data['email'];
		$user->password = password_hash($data['password'], PASSWORD_DEFAULT);
		R::store($user);
		
		$_SESSION['logged_user'] = $user;
		header("Location:/index2.php");
	} else {
		echo "<script>alert(\"В введённых данных возникла ошибка:  ".array_shift($errors)."\");</script>";
	}
}


// sign in


if ( isset($data['do_login'])) {

	$errors = array();	
	$user = R::findOne('users', 'email = ?', array($data['email']));

	if ( $user) {
		

		if ( password_verify($data['password'], $user->password)){
					
			$_SESSION['logged_user'] = $user;
			header("Location:/index2.php");
		}
		else {
			$errors[] = 'Пароль не верный!';
		}

	}
	else {
		$errors[] = 'Пользователь с таким логином не найден!';
	}


	if (! empty($errors) ) {		
		echo "<script>alert(\"В введённых данных возникла ошибка:  ".array_shift($errors)."\");</script>";
	}
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta http-equiv="X-UA-Compatible" content="ie=edge">
      <link rel="stylesheet" href="css/main.css">
      <link rel="icon" type="ico" sizes="16x16" href="img/favicon.ico">
      <title>Summit Group</title>
</head>

<body>
      <div class="container head">
            <header class="wrap">
                  <div class="logo">
                        <img src="/img/logo.png" alt="">
                        <p>Задание 1</p>
                  </div>
                  <div class="buttons">
                        <button id="autoriz" class="autoriz">авторизация</button>
                        <button id="registr" class="registr">регистрация</button>
                  </div>
            </header>
      </div>
      <div class="container">
            <section class="wrap main">
                  <article class="main__block">
                        <div class="img__block">
                              <img src="/img/logo.png" alt="">
                        </div>
                        <div id="reg" class="reg">
                              <form action="/index.php" method="POST" class="top sign__in">
                                    <h2>Регистрация</h2>
                                    <input type="text" onkeyup="let text=/['0-9',':']/; if(text.test(this.value)) this.value = '', alert('Введены запрещенные символы')" placeholder="имя" name="user_name" required minlength="2" autofocus>
                                    <input type="text" onkeyup="let text=/['0-9',':']/; if(text.test(this.value)) this.value = '', alert('Введены запрещенные символы')" placeholder="фамилия" name="user_surname" required minlength="2" >
                                    <input type="text" onkeyup="let text=/['0-9',':']/; if(text.test(this.value)) this.value = '', alert('Введены запрещенные символы')" placeholder="отчество" name="user_otchestvo" required minlength="2" >
                                    <input type="text" onkeyup="let text=/['A-Z, a-z, А-Я, а-я',':']/; if(text.test(this.value)) this.value = '', alert('Введены запрещенные символы')" placeholder="возраст(лет)" name="user_age" required >
                                    <input type="email" placeholder="Email" name="email" required minlength="5">
                                    <input type="password" placeholder="password" name="password" required minlength="5">
                                    <input type="password"placeholder="password again" name="password_2" minlength="8" required><br>
                                    <button type="submit" name="do_signup">Зарегистрироваться</button>
                              </form>
                        </div>
                        
                        <div id="aut" class="reg aut">
                              <form action="/index.php" method="POST" class="top sign__in">
                                    <h2>Авторизация</h2>                                   
                                    <input type="email" placeholder="Email" name="email" required minlength="5">
                                    <input type="password" placeholder="password" name="password" required
                                          minlength="5"><br>
                                    <button type="submit" name="do_login">Войти</button>
                              </form>
                        </div>
                  </article>
            </section>
      </div>

      <div class="container">
            <footer>
                  <div class="footer__block wrap">
                        <a target="_blank" href="https://vk.com/shopen101"><span>Andrew Shopinskiy </span>develop</a>
                  </div>
            </footer>
      </div>


      <script src="js/script.js"></script>
</body>