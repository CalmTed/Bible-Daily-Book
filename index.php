<!DOCTYPE html >
<html lang="en-ru">
<head>
	<meta charset="utf-8">
	<title>Bible db</title>
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
				$result->fetch_assoc();
				$a = 0;
				$n = 0;
				/*while ($line = $result->fetch_assoc()) {
					echo "<link>";
					$n += $line['n'];
					$a++;
				}*/
			}
		?>
</head>
<body>
<header></header>
<div id="background">
	<img src="img/bg.jpg">
</div>
<div id="content">
	<div id="profile">
		<div id="image"><img src="img/image.png"></div>
		<div id="name">Федя Мороз</div>
	</div>
	<div id="progress">
		<div id="times">1</div>
		<div id="progbar" val="<?php echo (100/1189) * $n; ?>"></div>
		<div id="addprogr">+</div>
	</div>
	<div id="table">
	<table  border="0">
		<tr class="th">
			<th style="width:10%;">Date</th>
			<th>Chapters</th>
			<th style="width:10%;">Number</th>
			<th style="width:40%;">Description</th>
	   </tr>
				<?php
				$i = 0;
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
					if(strlen($row['s']) >= 50){
						echo '<td class="s" full="'.$row['s'].'">'.substr($row['s'], 0, 40).'...</td>';
					}else{
						echo '<td class="s" full="'.$row['s'].'">'.substr($row['s'], 0, 40).'</td>';
					}
					echo '</tr>';
					$n += $row['n'];
					$i++;
				}
				echo '&nbsp Прочитано глав: '.$n;
				echo '&nbsp Осталось глав: '. (1189 - $n);
				echo '&nbsp В процентах: '.round((100/1189) * $n);
	   ?>
	</table></div> 
</div>
<div id="info" percent="<?php echo round((100/1189) * $n); ?>"></div>
<div id="toppanel">
</div>
<div id="win">
	<input id="wdate" value="" readonly>
	<input id="wnumber" value="" readonly>
	<input id="wchapters" value="" readonly>
	<textarea id="wdescription" readonly></textarea>
</div>
<footer>
	<div style="color:#777;font-size:17px;">&copy;&nbsp;Bible db 2016</div><br>
	<div style="color:#777;font-size:10px;">Made by TedFrost 2016</div>
</footer>
</body>
<script src="js/jquery.js"></script>
<script src="js/script.js"></script>
</html>