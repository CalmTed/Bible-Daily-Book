<?php
//savesettings.php
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
	if(isset($_POST['p'])){
		$pass = $_POST['p'];
	}else{
		$pass = '';
	}
	//checking password
	$query1 = "SELECT * FROM `users` WHERE `num` = '$name'";
	$result1 = $con->query($query1) or die($con->error.__LINE__);
	while ($row = $result1->fetch_assoc()) {
		$ar["name"] = $row["name"];
		$ar["pass"]  = $row["pass"];
		$ar["mail"]  = $row["mail"];
	}
	if(!$ar["pass"]){
		$ar["return"] = "user not finded";
	}else{
		if(password_verify($pass, $ar["pass"])){
			//checking inputs validnes
			if(isset($_POST['n'])&&isset($_POST['e'])&&isset($_POST['p1'])&&isset($_POST['p2'])){
					$n = $_POST['n'];
					$e = $_POST['e'];
					$p1 = $_POST['p1'];
					$p2 = $_POST['p2'];
					if(strlen($n)>6 && strlen($n)<100 && $p1 == $p2){
						if(strlen($p1)>6&&strlen($p1)<30&&strlen($p2)>6&&strlen($p2)<30){
							$length = 255;
							$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
							$charactersLength = strlen($characters);
							$salt = '';
							for ($i = 0; $i < $length; $i++) {
								$salt .= $characters[rand(0, $charactersLength - 1)];
							}
							$newpass = crypt($p1, $salt);
							$query2 = "UPDATE `users` SET `mail`= '".$e."',`pass`= '".$newpass."',`name`= '".$n."' WHERE `num` = '".$name."'";
						}else{
							//as same but without password changing
							$query2 = "UPDATE `users` SET `mail`= '".$e."',`name`= '".$n."' WHERE `num` = '".$name."'";
						}
						$result2 = $con->query($query2) or die($con->error.__LINE__);
						if($e != $ar['mail']){
							//change verif state
							$query3 = "UPDATE `users` SET `verif`='old' WHERE `num` = '".$name."'";
							$result3 = $con->query($query3) or die($con->error.__LINE__);
							
							//sending verification  message
							//$hosting = "http://dbible.ted9.xyz";
							$hosting = "http://193.107.226.245:2410/1/pr/10/";
							$verlink = $hosting . "/v?k=" . base64_encode($name . "-" . $e);
							$to = $e;
							$subject = "Verification on DiaryBible";
							$message = "".
							"<html>
								<head>
									<title>Verification link</title>
								</head>
								<body>
									Новый адресс уже изменен.<br>
									Перейдите по этой ссылке для его подтверждения:\r\n<br><a href='". $verlink ."'>". $verlink ."</a>
								</body>
							</html>".
							"";
							$headers = "MIME-Version: 1.0" . "\r\n";
							$headers .= "Content-type : text/html; charset=iso-8859-1" . "\r\n";
							$headers .= "From: no-reply@dbible.ted9.xyz" . "\r\n";
							mail($to, $subject, $message, $headers);
							
							
							$ar['verif'] = "new";// ----- to inform user
						}else{
							$ar['verif'] = "old";
						}
						session_start();
						$_SESSION['num'] = $name;
						$ar["return"] = "done";
					}else{
						$ar["return"] = "invalid value";
					}
			}else{
				$ar["return"] = "vars missing";
			}		
		}else{
			$ar["return"] = "wrong password";
		}
	}
}
$ar["name"] = '';
$ar["pass"]  = '';
$ar["mail"]  = '';
echo json_encode($ar);
