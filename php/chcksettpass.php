<?php
//chcksettpass.php
require("../db.php");
$con = mysqli_connect($servername,$username,$db_password,$dbname);
$ar;
if(mysqli_connect_errno()){
   $ar["return"] = "cant connect";
}else{
	if(isset($_POST['num'])){
		$name = $_POST['num'];
	}else{
		$name = 'u';
	}
	if(isset($_POST['pass'])){
		$pass = $_POST['pass'];
	}else{
		$pass = '';
	}
	$query1 = "SELECT * FROM `users` WHERE `num` = '$name'";
	$result1 = $con->query($query1) or die($con->error.__LINE__);
	while ($row = $result1->fetch_assoc()) {
		$ar["name"] = $row["name"];
		$ar["pass"]  = $row["pass"]; //its hashed! why should we do this?
		$ar["email"]  = $row["mail"];
		$ar["img"]  = $row["img"];
		$ar["bg"]  = $row["bg"];
		$ar["verif"]  = $row["verif"];
	}
	if(!$ar["pass"]){
		$ar["return"] = "user not finded";
	}else{
		//if($pass == $ar["pass"]){
		if(password_verify($pass, $ar["pass"])){
			session_start();
			$_SESSION['num'] = $name;
			$ar["return"] = "done";
		}else{
			$ar["return"] = "wrong password";
			//clearing
			$ar["name"] = '';
			$ar["email"]  = '';
			$ar["img"]  = '';
			$ar["bg"]  = '';
		}
	}
	//$ar["pass"]  = password_verify($pass, $ar["pass"]);
}
echo json_encode($ar);


