<!-- To the glory of God -->
<!DOCTYPE html >
<html lang="en-ru">
<head>
	<meta charset="utf-8">
	<title>Обратная связь - BibleDiary</title>
	<link rel="shortcut icon" href="img/logo.png">
	<meta name="copyright" Content="TeddyFrost2016">
	<link rel="stylesheet" type="text/css" href="css/gen.css">
	<link rel="stylesheet" type="text/css" href="css/feedback.css">
	<meta name=viewport content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="css/font-awesome.css">
</head>
<body>
<header></header>
<div id='infow'>
	<p class='infotext'></p>
	<div class='infobuttons'>
		<div class='info-b-1'>ОК</div>
	</div>
</div>
<div id="content">
	<a href="./"><div id="regback" class="topbtn"><i class="fa fa-angle-left fa-fv"></i>&nbsp;Назад</div></a>
	<div id="back-btn"></div>
	<h1>Обратная связь</h1>
	<div class="p">
		<label><span>Эл. почта:</span><input type="email" id="f-email"></label><br>
		<label><span>Тема:</span>
			<select id="f-topic">
				<option value="feedback">Отзыв</option>
				<option value="error">Ошибка</option>
				<option value="question">Вопрос</option>
				<option value="other">Другое</option>
			</select>
		</label><br>
		<label id="topic-other-label" class="hidden"><span>Своя тема:</span><input type="text" id="topic-other"></label><br>
		<label>
		<span>Сообщение:</span>
		<textarea id="f-message"></textarea>
		</label><br>
		<button id="f-submit">Отправить</button>
	</div>
<div id="donation"><a href="donation.php" ><img src="img/heart.svg"></a></div>
</div>
<footer>
	<?php require('php/links.php'); ?>
	<div style="color:#777;font-size:17px;">&copy;&nbsp;BibleDiary 2016</div><br>
</footer>
</body>
<script src="js/jquery.js"></script>
<script src="js/gen.js"></script>
<script src="js/feedback.js"></script>
</html>