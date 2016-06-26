<?php
//verification.php
if(isset($_GET["k"])){
	$key = $_GET["k"];
	$key = base64_decode($key);
	$num = substr($key,0,6);
	$mail = substr($key,7);
	//echo $key."<br>num:".$num."<br>mail:".$mail;
	/* dTExMTE0LXIyZDJmOUBnbWFpbC5jb20=     ----->       u11114-r2d2f9@gmail.com */
	
	require("../db.php");
	$con = mysqli_connect($servername,$username,$db_password,$dbname);
	$query1 = "SELECT * FROM `users` WHERE `num` = '" . $num . "'";
	$result1 = $con->query($query1) or die($con->error.__LINE__);
	//$res1 = $result1->fetch_array();
	$res1 = $result1 -> num_rows;
	if($res1 = 1 ){
		
		$query2 = "UPDATE `users` SET `verif`= 'yes' WHERE `num` = '".$num."'";
		$result2 = $con->query($query2) or die($con->error.__LINE__);
		header("Location: ../u.php?n=".$num);
		
	}else{
		header("Location: ../");
	}
}else{
	header("Location: ../");
}


?>