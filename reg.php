<!-- To the glory of God -->
<!DOCTYPE html >
<html lang="en-ru">
<head>
	<meta charset="utf-8">
	<title>BibleDiary</title>
	<meta name="copyright" Content="TedFrost2016">
	<meta name=viewport content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="css/gen.css">
	<link rel="stylesheet" type="text/css" href="css/reg.css">
	<link rel="stylesheet" href="css/font-awesome.css">
	<link rel="shortcut icon" href="img/logo.png">
</head>
<body>
<div id="sitename"></div>
<div id="content">
	<a href="./"><div id="regback" class="topbtn"><i class="fa fa-angle-left fa-fv"></i> Назад</div></a>
	<?php
	session_start();
	if(isset($_SESSION['num'])){
		 echo '<a href="u.php?n=';
		 echo $_SESSION['num'];
		echo '"><div id="reguser" class="topbtn"><i class="fa fa-user fa-fv"></i> К себе</div></a>';
	}else{
		if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
			$ip = $_SERVER['HTTP_CLIENT_IP'];
		}elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
			$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
		}else{
			$ip = $_SERVER['REMOTE_ADDR'];
		}
		require("db.php");
		$con = mysqli_connect($servername,$username,$db_password,$dbname);
		$query1 = "SELECT * FROM `users` WHERE `ip`= '$ip'";
		$result1 = $con->query($query1) or die($con->error.__LINE__);
		$res1n = $result1 -> num_rows;
		$query2 = "SELECT * FROM `users` WHERE `ip`= '$ip'";
		$result2 = $con->query($query2) or die($con->error.__LINE__);
		while ($user = $result2->fetch_assoc()){
			$usr['num'] = $user['num'];
		}
		if(isset($usr['num'])){
			echo '<a href="u.php?n=';
			echo $usr['num'];
			echo '"><div id="reguser" class="topbtn"><i class="fa fa-user fa-fv"></i> К себе</div></a>';
		}
	}
	?>
	<h1>Регистрация</h1>
	<form  action="regbk.php" method="post" id="reg-inps">
			<small style="">Регистрация не работает. Напишите в <a href="feedback.php">обратную связь</a></small>
			<label>Имя:										 <input type="text" id="iname" class="right" name="name" maxlength="30"></label>
			<label>Email:										 <input type="email"  id="imail" class="right" name="email"  maxlength="50"></label>
			<label>Пароль:									 <input type="password" id="ipass1" class="right" name="pass1"></label>
			<label>Пароль еще раз:						 <input type="password"  id="ipass2" class="right" name="pass2"></label>
			<label class="checkbox" for="agree"> <input id="agree" type="checkbox" name="agree">
				<span></span>Я согласен с <a href="agreement.php">условиями пользования и политикой конфиденциальности</a>
			</label>
			<input id="reg-submit" type="submit" value="Зарегистрироваться" disabled>
	</form>
</div>
<footer>
	<?php require('php/links.php'); ?>
	<div style="color:#777;font-size:17px;">&copy;&nbsp;DiaryBible 2016</div><br>
</footer>
</body>
<script src="js/jquery.js"></script>
<script src="js/reg.js"></script>
<script src="js/gen.js"></script>
</html>