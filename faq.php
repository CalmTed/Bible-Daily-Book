<!-- To the glory of God -->
<!DOCTYPE html >
<html lang="en-ru">
<head>
	<meta charset="utf-8">
	<title>BibleDiary</title>
	<meta name="copyright" Content="TeddyFrost2016">
	<meta name=viewport content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="css/gen.css">
	<link rel="stylesheet" type="text/css" href="css/faq.css">
	<link rel="stylesheet" href="css/font-awesome.css">
	<link rel="shortcut icon" href="img/logo.png">
</head>
<body>
<header></header>
<div id="infow">
	<p class="infotext"></p>
	<div class="infobuttons">
		<div class="info-b-1">ОК</div>
	</div>
</div>
<div id="content">
	<a href="./" id="backa"><div id="regback" class="topbtn"><i class="fa fa-angle-left fa-fv"></i>&nbsp;Назад</div></a>
	<h1>Часто задаваемые вопросы</h1>
	<div id="f-menu">
		<h2><b>План:</b></h2>
		<a href="#bl-1">Создание записи</a>
		<a href="#bl-2">Изменение записи</a>
		<a href="#bl-3">Удаление записи</a>
		<a href="#bl-4">Настройка пользователя</a>
	</div>
	<div id="f-answers">
		<!--<div id="search">
			<input id="search-inp">
			<button id="search-go"><i class="fa fa-search"></i></button>
		</div>
		<div id="search-result">
		</div>-->
		<div id="blocks">
			<div id="bl-1" class="bl">
				<h2>Создание записи</h2>
				<p>Чтобы создать новую запись, нужно нажать на кнопку "<i class="fa fa-plus"></i>", которая находится под картинкой пользователя или во время просмотра записи сверху справа во время просмотра записи. Если таблица пустая, то на месте записей кнопка "Добавить запись"<br>
				Откроется окно. После ввода информации в соответствующие поля, ввода пароля, нужно нажать на кнопку "<i class="fa fa-save"></i>".<br>
				<b>При создании нужно помнить</b>:
				<br>&nbsp;&nbsp;Одна запись - один день. Система не даст сохранить две записи на одну и ту же дату.
				<br>&nbsp;&nbsp;Список глав нужно вводить так: "[короткое название книги]. [номер главы], [номер следующей главы]".Например: "Иис.Н. 1, 2, 3, 4". Название книги можно указывать только один раз в начале чтения книги.
				<br>&nbsp;&nbsp;Если не ввести количество прочитанных глав, то при сохранении сервер подсчитает количество запятых и введет свое значение.
				</p>
			</div>
			<div id="bl-2" class="bl">
				<h2>Изменение записи</h2>
				<p>Чтобы изменить запись в списке записей нужно на нее нажать, чтобы откылось окно с ее полным содержанием. В окне сверху справа нужно нажать на "<i class="fa fa-edit"></i>" это позволит изменять содержимое.
				<br>После необходимого изменения данных, нужно ввести пароль и нажать "<i class=" fa fa-save"></i>".
				<br><b>Полезно знать:</b>
				<br>&nbsp;&nbsp;Вместо нажатия на "<i class="fa fa-edit"></i>", можно дважды кликнуть по любому полю.
				</p>
			</div>
			<div id="bl-3" class="bl">
				<h2>Удаление записи</h2>
				<p>Чтобы удалить запись в списке записей нужно на нее нажать, чтобы откылось окно с ее полным содержанием. В окне сверху справа нужно нажать на "<i class="fa fa-delite"></i>".Откоется плое ввода пароля. Введя его, нужно еще раз нажать на "<i class="fa fa-delite"></i>".
				<br>После первого ввода пароля, последущие удаления не будут открывать поле пароля. Просто еще раз спросит точно ли удалить.
				</p>
			</div><div id="bl-4" class="bl">
				<h2>Настройка пользователя</h2>
				<p>Чтобы изменить настройка ипользователя, нужно на странице пользователя нажать."<i class="fa fa-gear"></i>".
				<br>Введя пароль и нажав  "<i class="fa fa-angle-right"></i>", откроются настройки.
				<br>Изменив все необходимое, для сохранения, нужно нажать кнопку "Сохранить" снизу настроек.
				<br><b>Важно знать</b>
				<br>&nbsp;&nbsp;Изменеие картинок происходит без сохранеия,а сразу после выбора файла.
				<br>&nbsp;&nbsp;Чтобы изменить пароль, нужно ввести новый в соответствующее поле и еще раз для подтверждения.Потом нажать "Сохранить". 
				</p>
			</div>
			<!--<div id="bl-" class="bl">
				<h2>Блок</h2>
				<p></p>
			</div>-->
		</div>
	</div>
	<div id="donation"><a href="donation.php" ><img src="img/heart.svg"></a></div>
	</div>
</div>
<div id="fixedblocks">
	<div id="arrtop"><i class="fa fa-angle-up"></i></div>
</div>
<footer>
	<?php require('php/links.php'); ?>
	<div style="color:#777;font-size:17px;">&copy;&nbsp;BibleDiary 2016</div><br>
</footer>
</body>
<script src="js/jquery.js"></script>
<script src="js/faq.js"></script>
<script src="js/gen.js"></script>
</html>