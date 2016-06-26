<?php
	// relinking from /index.php
	//$adr = "dbible.ted9.xyz/";// DO NOT FORGOT!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!thanks)
	$adr = "193.107.226.245:2410/1/pr/10/";
	if($_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"] == $adr."index.php"){
		header("Location: http://".$adr);
	}
?>
<!-- To the glory of God -->
<!DOCTYPE html >
<html lang="en-ru">
<head>
	<meta charset="utf-8">
	<title>BibleDiary</title>
	<meta name="copyright" Content="TeddyFrost2016">
	<meta name=viewport content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="css/gen.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<link rel="stylesheet" href="css/font-awesome.css">
	<link rel="shortcut icon" href="img/logo.png">
</head>
<body>
<header>
	<span id="ilang"><a>ru</a><a>en</a></span>
	<?php
	session_start();
	if(isset($_SESSION['num'])){
		 echo '<a href="u.php?n=';
		 echo $_SESSION['num'];
		echo '"><div id="iuser"><i class="fa fa-user fa-fv"></i> К себе</div></a>';
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
			echo '"><div id="iuser"><i class="fa fa-user fa-fv"></i> К себе</div></a>';
		}
	}
	?>
</header>
<div id="infow">
	<p class="infotext"></p>
	<div class="infobuttons">
		<div class="info-b-1">ОК</div>
	</div>
</div>
<div id="background">
	<img src="img/bg.jpg">
</div>
<div  id="sitename">
	<div id="logo"><img src="img/cross.png"></div>
	<span>BibleDiary</span>
</div>
<div id="content">
	<p>BibleDiary - это онлайн дневник чтения Библии. Предназначеный организовать процесс чтения текстов Писания. При этом ожидается, что чтение Библии будет из бумажной книги и пометки так-же будут и в самой книге. Тут только результат: выводы и размышления.</p>
	<div id="threeelefant"><h2 class="lite">Функции</h2>
		<ul>
			<li>
				<img src="img/cloud.svg">
				<b>Мобильность</b>
				<small>Все записи хранятся на сервере. Для доступа к ним нужен только доступ к интернету</small>
			</li>
			<li>
				<img src="img/pie-chart.svg">
				<b>Статистика</b>
				<small>При правильном отмечании количества глав, система рассчитывает прогресс прочитанного</small>
			</li>
			<li>
				<img src="img/search.svg">
				<b>Поиск</b>
				<small>При написании записи можно указать тему, которая в последствии поможет быстро найти нужную запись</small>
			</li>
		</ul>
	</div>
	<div id="reg-area">
		<a href="reg.php"><div id="reg-button">Присоединиться</div></a>
	</div>
	<div id="donation"><!--<a href="donation.php" ><img src="img/heart.svg"></a>--></div>
</div>
<footer>
	<?php require('php/links.php'); ?>
	<div style="color:#777;font-size:17px;">&copy;&nbsp;BibleDiary 2016</div><br>
	<!--<div>Icons made by <a href="http://www.flaticon.com/authors/iconnice" title="Iconnice">Iconnice</a> from <a href="http://www.flaticon.com" title="Flaticon">www.flaticon.com</a> is licensed by <a href="http://creativecommons.org/licenses/by/3.0/" title="Creative Commons BY 3.0" target="_blank">CC 3.0 BY</a></div>-->
</footer>
</body>
<script src="js/jquery.js"></script>
<script src="js/index.js"></script>
<script src="js/gen.js"></script>
</html>