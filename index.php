<!DOCTYPE html >
<html lang="en-ru">
<head>
	<meta charset="utf-8">
	<title>DiaryBible</title>
	<meta name="copyright" Content="TeddyFrost2016">
	<meta name=viewport content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
	<link rel="shortcut icon" href="img/logo.png">
	   <?php   
			require("db.php");
			$con = mysqli_connect($servername,$username,$db_password,$dbname);
			$arr;
			if(mysqli_connect_errno())
			{}else{
				$query = "SELECT * FROM `u11111` ORDER BY `id` DESC LIMIT 0, 150";
				$result = $con->query($query) or die($con->error.__LINE__);
				mysqli_close($con);
				/*
				$result->fetch_assoc();
				$a = 0;
				$n = 0;
				while ($line = $result->fetch_assoc()) {
					echo "<link>";
					$n += $line['n'];
					$a++;
				}*/
			}
		?>
</head>
<body>
<header></header>
<div id="infow">
	<p class="infotext">Здесь есть информация</p>
	<div class="infobuttons">
		<div class="info-b-1">ОК</div>
	</div>
</div>
<div id="background">
	<img src="img/bg.jpg">
</div>
<div id="content">
	<div id="profile">
		<div id="image"><img src="img/image.png"></div>
		<div id="name">Федя Мороз</div>
		<input type="hidden" id="nameinp" value="u11111">
	</div>
	<div id="progress">
		<div id="times">1</div>
		<div id="progbar"></div>
	</div>
	<div id="table">
	<table  border="0">
		<tr class="th">
			<th style="width:10%;">Дата</th>
			<th>Главы</th>
			<th style="width:10%;">Кол-во</th>
			<th style="width:40%;">Описание</th>
	   </tr>
				<?php
				$i = 13;
				$n = 0;
				while ($row = $result->fetch_assoc()) {
					echo '<tr num="'.$row['id'].'">';
					echo '<td class="d">'.$row['d'].'</td>';
					if(strlen($row['c']) >= 50){
						echo '<td class="c" full="'.$row['c'].'">'.substr($row['c'], 0, 40).'...</td>';
					}else{
						echo '<td class="c" full="'.$row['c'].'">'.substr($row['c'], 0, 40).'</td>';
					}
					echo '<td class="n">'.$row['n'].'</td>';
					if(strlen($row['s']) >= 40){
						echo '<td class="s" full="'.$row['s'].'">'.substr($row['s'], 0, 39).'...</td>';
					}else{
						echo '<td class="s" full="'.$row['s'].'">'.substr($row['s'], 0, 39).'</td>';
					}
					echo '</tr>';
					$n += $row['n'];
					$i++;
				}
				if($n > 1189){
					$nt = $n - ( 1189 * floor($n / 1189));
					//$NT = ceil($n)
				echo '&nbsp Уровень: <span id="tlevel">'. (floor($n / 1189)+1).'</span>';
				echo '&nbsp Прочитано глав всего : <span id="tallchap">'.$n.'</span>';
				echo '&nbsp Прочитано глав за этот раз: <span id="tthischap">'.$nt.'</span>';
				}else{
					echo '&nbsp Прочитано глав: <span id="tallchap">'.$n.'</span>';
					$nt = $n;
				}
				echo '&nbsp Осталось глав: <span id="tleftchap">'. (1189 - $nt).'</span>';
				echo '&nbsp В процентах: <span id="tpercent">'.round((100/1189) * $nt,1).'</span>';
	   ?>
	</table></div> 
</div>
<div id="info" percent="
<?php echo round((100/1189) * $nt,1); ?>" times="
<?php echo floor($n / 1189)+1; ?>" date="
<?php if(date('G')>4){$d = date('d');}else{ if(date('j')<10){$d = '0'.(date('j')-1);}else{$d = (date('j')-1);}}  echo $d.'.'.date('m').'.'.date('y'); ?>"></div>
<div id="toppanel">
	<div id="topback"><i class="fa  fa-angle-left fa-fw"></i>Назад</div>
	<div id="topdelite"><i class="fa  fa-trash fa-fw"></i></div>
	<div id="topadd"><i class="fa  fa-plus fa-fw"></i></div>
	<div id="topedit"><i class="fa  fa-edit fa-fw"></i></div>
	<div id="topsave" style="display:none"><i class="fa  fa-save fa-fw"></i></div>
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
	<label id="wchl">Главы:
	<input id="wchapters" value="" readonly>
	</label>
	<label id="wdescl">Описание:<br >
	<textarea id="wdescription" readonly></textarea>
	</label>
	<div id="wspan"></div>
</div>
<footer>
	<div style="color:#777;font-size:17px;">&copy;&nbsp;DiaryBible 2016</div><br>
	<div style="color:#777;font-size:10px;">Made by TedFrost 2016</div>
</footer>
</body>
<script src="js/jquery.js"></script>
<script src="js/script.js"></script>
</html>
