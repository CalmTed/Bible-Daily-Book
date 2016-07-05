<!-- To the glory of God -->
<!DOCTYPE html >
<html lang="en-ru">
<head>
	<meta charset="utf-8">
	<title>BibleDiary</title>
	<link rel="shortcut icon" href="img/logo.png">
	<meta name="copyright" Content="TeddyFrost2016">
	<link rel="stylesheet" type="text/css" href="css/gen.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<meta name=viewport content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="css/font-awesome.css">
	   <?php
			if(isset($_GET["n"])){
				$name = $_GET["n"];
			}else{
				$name = 'u';
			}
			require("db.php");
			$con = mysqli_connect($servername,$username,$db_password,$dbname);
			$arr;
			if(mysqli_connect_errno())
			{}else{
				$query1 = "SELECT * FROM `users` WHERE `num`= '$name'";
				$result1 = $con->query($query1) or die($con->error.__LINE__);
				$res1 = $result1->fetch_array();
				//echo count($res1);
				//echo $name;
				if (count($res1)>0){
						$query3 = "SELECT * FROM `users` WHERE `num`= '$name'";
						$result3 = $con->query($query3) or die($con->error.__LINE__);
					$us;
					while ($user = $result3->fetch_assoc()){
						$us['name'] = $user['name'];
						$us['img'] = $user['img'];
						$us['bg'] = $user['bg'];
						//$us['link'] = $user['link'];
					}
					$query = "SELECT * FROM `notes` WHERE `user` = '".$name."' ORDER BY `id` DESC LIMIT 0, 150";
					$result = $con->query($query) or die($con->error.__LINE__);
					mysqli_close($con);
				}else{
					$query2 = "SELECT * FROM `users` WHERE `num`= 'u'";
					$result2 = $con->query($query2) or die($con->error.__LINE__);
					//echo count($result2->fetch_array());
					$us;
					while ($user2 = $result2->fetch_assoc()){
						$us['name'] = $user2['name'];
						$us['img'] = $user2['img'];
						$us['bg'] = $user2['bg'];
						$name = 'u';
						//$us['link'] = $user2['link'];
					}
					
					
					$query = "SELECT * FROM `notes` WHERE `user` = '".$name."' ORDER BY `id` DESC LIMIT 0, 150";
					$result = $con->query($query) or die($con->error.__LINE__);
					mysqli_close($con);
				}

			}
		echo "
</head>
<body>
<header></header>
<div id='infow'>
	<p class='infotext'>Здесь есть информация</p>
	<div class='infobuttons'>
		<div class='info-b-1'>ОК</div>
	</div>
</div>
<div id='background'>
	<img src='".$us['bg']."'>
</div>
<div id='content'>
	<div id='profile'>
		<div id='image'><img src='".$us['img']."'></div>
		<div id='name'>". $us['name']. "</div>
		<input type='hidden' id='nameinp' value='".$name."'>"; ?>
	</div>
	<div id="progress">
		<div id="times">1</div>
		<div id="progbar"></div>
	</div>
	<div id="btbuttons" tab="list">
		<div class="btbutton tablnew"><i class="fa  fa-plus"></i></div>
		<div class="btbutton tablreload"><i class="fa fa-repeat"></i></div>
		<div class="btbutton tablsett"><i class="fa  fa-gear"></i></div>
		<div class="btbutton tablsearch"><i class="fa  fa-search"></i></div>
	</div>
	<div id="table">
	<h1>Список прочитанного:</h1>
	<div class="div-table"  border="0">
		<div class="th">
			<div>Дата</div>
			<div>Главы</div>
			<div>Кол-во</div>
			<div>Описание</div>
	   </div>
				<?php
				$i = 13;
				$n = 0;
				while ($row = $result->fetch_assoc()) {
					echo '<div class="tr" num="'.$row['id'].'" id="r'.$row['id'].'">';
					echo '<div style="display:none" class="t">'.$row['tags'].'</div>';
					echo '<div class="d">'.$row['d'].'</div>';
					echo '<div class="c">'.$row['c'].'</div>';
					echo '<div class="n">'.$row['n'].'</div>';
					echo '<div class="s">'.$row['s'].'</div>';
					echo '</div>';
					$n += $row['n'];
					$i++;
				}
				if($i == 13){
					echo '<div class="tr tradd" num="1">';
					echo '<div style="display:none" class="t"></div>';
					echo '<div class="d"></div>';
					echo '<div class="c">Добавить запись</div>';
					echo '<div class="n"></div>';
					echo '<div class="s"></div>';
					echo '</div>';
				}
				if($n > 1189){
					$nt = $n - ( 1189 * floor($n / 1189));
					//echo '&nbsp Уровень: <span id="tlevel">'. (floor($n / 1189)+1).'</span>';
					//echo '&nbsp Прочитано глав всего : <span id="tallchap">'.$n.'</span>';
					//echo '&nbsp Прочитано глав за этот раз: <span id="tthischap">'.$nt.'</span>';
				}else{
					//echo '&nbsp Прочитано глав: <span id="tallchap">'.$n.'</span>';
					$nt = $n;
				}
				//echo '&nbsp Осталось глав: <span id="tleftchap">'. (1189 - $nt).'</span>';
				//echo '&nbsp В процентах: <span id="tpercent">'.round((100/1189) * $nt,1).'</span>';
				//echo '&nbsp В процентах: <span id="tpercent">'.round((100/1189) * $nt,1).'</span>';
	   ?>
	</table></div> 
</div>
<div id="info" percent="<?php
	echo round((100/1189) * $nt,1); ?>" times="<?php
	echo floor($n / 1189)+1; ?>" date="<?php
	if(date('G')>4){$d = date('d');}else{ if(date('j')<10){$d = '0'.(date('j')-1);}else{$d = (date('j')-1);}}  echo $d.'.'.date('m').'.'.date('y'); ?>"></div>
<div id="toppanel">
	<div id="topback" title="Назад к списку"><i class="fa  fa-angle-left fa-fw"></i>Назад</div>
	<div id="topdelite" title="Удалить"><i class="fa  fa-trash fa-fw"></i></div>
	<div id="topadd" title="Добавить"><i class="fa  fa-plus fa-fw"></i></div>
	<div id="topedit"  title="Изменить (Двойной клик)"><i class="fa  fa-edit fa-fw"></i></div>
	<div id="topsave" style="display:none"  title="Сохранить"><i class="fa  fa-save fa-fw"></i></div>
</div>
<div id="win">
	<input type="hidden" id="wid">
	<label id="wpass"  style="display:none">Пароль:
		<input type="password" id="passinp">
	</label><br>
	<label id="wdatel">Дата:
		<input id="wdate" value="" readonly>
	</label>
	<label id="wnuml">Количество:
	<input type="number" min="0"  max="60" id="wnumber" value="" readonly>
	</label>
	<label id="wtagsl">Темы:
		<input id="wtags" value="" readonly>
	</label>
	<label id="wchl">Главы:
	<input id="wchapters" value="" readonly>
	</label>
	<label id="wdescl">Описание:<br >
	<textarea id="wdescription" readonly></textarea>
	</label>
	<div id="wspan"></div>
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
<script src="js/gen.js"></script>
<script src="js/script.js"></script>
</html>