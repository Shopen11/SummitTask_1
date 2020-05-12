<?php
require "db.php";
$data = $_POST;

// изменение данных
$id = $_SESSION['logged_user']->id;
$id = (int)$id;

if ( isset($_POST['change'])) {
      $findUser = R::findOne('users', 'id = ?', [$id]);
      
      $findUser->user_name = $data['user_name'];
      $findUser->user_surname = $data['user_surname'];
      $findUser->user_thirdname = $data['user_otchestvo'];
      $findUser->user_age = $data['user_age'];	
      R::store($findUser);
      unset($_SESSION['logged_user']);
	header("Location:/index.php");
}



// выход из аккаунта
if ( isset($_POST['out']) ) { 
	unset($_SESSION['logged_user']);
	header("Location:/index.php");
}



// смена фотографии
$conn = mysqli_connect("localhost", "root", "", "mybase");

if (isset($_POST['upload'])) {
      if (isset($_FILES['uploadfile'])) {
            $foto_name = time()."_".basename($_FILES['uploadfile']['name']);
            $error_flag = $_FILES['uploadfile']['errors'];

            if ($error_flag == 0) {
                  $upfile = getcwd()."/img/profiles_photos/".time()."_".basename(iconv('utf-8', 'windows-1251', $_FILES['uploadfile']['name']));
                  
                  if ($_FILES['uploadfile']['tmp_name']) {
                        
                        if (move_uploaded_file($_FILES['uploadfile']['tmp_name'], $upfile)) {
                              mysqli_query($conn, "UPDATE users SET photo = '$foto_name' WHERE id = ".$_SESSION['logged_user']->id);
                              unset($_SESSION['logged_user']);
	                        header("Location:/index.php");
                        }

                  } else {
                        $errors[] = "ошибка!";
                  }
            }
      }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta http-equiv="X-UA-Compatible" content="ie=edge">
      <link rel="stylesheet" href="css/main__profile.css">
      <link rel="icon" type="ico" sizes="16x16" href="img/favicon.ico">
      <title>Summit Group</title>
</head>

<body>
      <div class="container head">
            <header class="wrap">
                  <div class="logo">
                        <img src="/img/logo.png" alt="">                        
                  </div>
                  <div class="text">
                        <p>личный кабинет</p>
                  </div>
            </header>
      </div>
      <div class="container center">
            <section class="wrap main">
                  <form action="/index2.php" method="POST">
                        <p>Изменить личные данные</p>
                        <input type="text" onkeyup="let text=/['0-9',':']/; if(text.test(this.value)) this.value = '', alert('Введены запрещенные символы')" placeholder="имя" name="user_name" required minlength="2" >
                        <input type="text" onkeyup="let text=/['0-9',':']/; if(text.test(this.value)) this.value = '', alert('Введены запрещенные символы')" placeholder="фамилия" name="user_surname" required minlength="2" >
                        <input type="text" onkeyup="let text=/['0-9',':']/; if(text.test(this.value)) this.value = '', alert('Введены запрещенные символы')" placeholder="отчество" name="user_otchestvo" required minlength="2" >
                        <input type="text" onkeyup="let text=/['A-Z, a-z, А-Я, а-я',':']/; if(text.test(this.value)) this.value = '', alert('Введены запрещенные символы')" placeholder="возраст(лет)" name="user_age" required >
                        <button type="submit" name="change">Изменить</button>
                  </form>
            </section>
      </div>

      <section class="container profile">
            <div class="wrap prof__wrap">
                  <h2>Ваши текущие данные:</h2>
                  <div class="profile__block">
                        <div class="head__text">
                              <p class="option">Ваше имя:</p>
                              <p class="option">Ваша фамилия:</p>
                              <p class="option">Ваше отчество:</p>
                              <p class="option">Ваш возраст:</p>
                        </div>
                        <div class="user__data">
                              <p><?php echo $_SESSION['logged_user']->user_name; ?></p>
                              <p><?php echo $_SESSION['logged_user']->user_surname; ?></p>
                              <p><?php echo $_SESSION['logged_user']->user_thirdname; ?></p>
                              <p><?php echo $_SESSION['logged_user']->user_age; ?></p>
                        </div>
                  </div>
                  <div class="photo__block">
                        <img src="/img/profiles_photos/<?php echo $_SESSION['logged_user']->photo;  ?>" alt="Вы не добавляли фотографии">
                  </div>
                  <form id="img_change" action="index2.php" method="POST" enctype="multipart/form-data">
                        <input onchange="displayImage(this)" type="file" id="profileImage" name="uploadfile" value="Foto..." accept="image/*,image/jpeg"><br>
                        <button id="changebutton" name="upload"><a>Сменить фотографию</a></button><br>
                  </form>

                  <form action="/index2.php" method="POST" class="out__button"><button id="out_from" type="submit" name="out">Выйти</button></form>
            </div>
            
      </section>
<script src="js/script.js"></script>
</body>