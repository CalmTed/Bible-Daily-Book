<div id="footer-links">
<?php 
	$rur =$_SERVER['REQUEST_URI'];
	if(substr($rur,-11) != 'mission.php'){ echo '<a href="mission.php">Цель сайта</a>';}
	if(substr($rur,-7) != 'faq.php'){ echo '<a href="faq.php">Помощь</a>';}
	if(substr($rur,-12) != 'feedback.php'){ echo '<a href="feedback.php">Обратная связь</a>';}
?>
</div>