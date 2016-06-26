<?php
//regbk.php
	if(isset($_POST['name']) && isset($_POST['email']) && isset($_POST['pass1']) && isset($_POST['pass2']) && isset($_POST['agree'])){
		$n = $_POST['name'];
		$e = $_POST['email'];
		$p1 = $_POST['pass1'];
		$p2 = $_POST['pass2'];
		$a = $_POST['agree'];
		if((strlen($n)>5 && strlen($n)<30) && (strlen($p1)>5 && strlen($p2)>5) && (strlen($p1)<30 && strlen($p2)<30) && ($p1 == $p2)){
			require("db.php");
			$con = mysqli_connect($servername,$username,$db_password,$dbname);
			//check is this email already exists
			$query4 = "SELECT * FROM `users`  WHERE `mail` =  '$e'";
			$result4 = $con->query($query4) or die($con->error.__LINE__);
			if($res4 = $result4->fetch_array()<1){
				//get number of all users
				//best thing when this number will be over thousand
				$query1 = "SELECT * FROM `users`";
				$result1 = $con->query($query1) or die($con->error.__LINE__);
				$res1n = $result1 -> num_rows;
				
				$num = 'u'.(11111 + $res1n);
				$pass = $p1;
				$name = $n;
				$img = 'img/a/'.$num.'.png';
				$bg = 'img/b/'.$num.'.png';
				//get user ip
					if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
						$ip = $_SERVER['HTTP_CLIENT_IP'];
					} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
						$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
					} else {
						$ip = $_SERVER['REMOTE_ADDR'];
					}
				
				//hashing password
				$length = 255;
				$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
				$charactersLength = strlen($characters);
				$randomString = '';
				for ($i = 0; $i < $length; $i++) {
					$randomString .= $characters[rand(0, $charactersLength - 1)];
				}
				$hash = crypt($pass, $randomString);
				
				// add line in users table
				
				$query2 = "INSERT INTO `users` (`num`, `reg`,`mail`,`pass`, `name`, `img`, `bg`, `ip`) VALUES ('" .$num. "', CURRENT_TIMESTAMP,'" .$e. "','" .$hash. "', '".$name."', '".$img."', '".$bg."', '".$ip."')";
				$result2 = $con->query($query2) or die($con->error.__LINE__);
				
				//creating [user] table
				
				$query3 = "CREATE TABLE `dbible`.`".$num."` (`id` INT(16) NOT NULL AUTO_INCREMENT COMMENT 'уникальный номер' ,
									`d` VARCHAR(56) NOT NULL DEFAULT '00.00.00' COMMENT 'дата записи' ,
									`tags` VARCHAR(500) NOT NULL DEFAULT ' ' COMMENT 'теги' ,
									`c` VARCHAR(300) NOT NULL DEFAULT '0' COMMENT 'прочитаные главы' ,
									`n` VARCHAR(16) NOT NULL DEFAULT '0' COMMENT 'кол-во глав' ,
									`s` VARCHAR(10000) NOT NULL DEFAULT 'oh its empty! Ok then.' COMMENT 'коментарий',
									`reald` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'real date',
									`uip` VARCHAR(15) NOT NULL DEFAULT '0.0.0.0' COMMENT 'user ip',
									UNIQUE (`id`)) ENGINE = InnoDB";
				$result3 = $con->query($query3) or die($con->error.__LINE__);
				
				//create img/a/[user].png
				
				$aimg = imagecreatefrompng("img/a.png");
				$backgroundColor = imagecolorallocate($aimg,255,255,255);
				imagecolortransparent($aimg, $backgroundColor);
				imagepng($aimg ,'img/a/'.$num.'.png');
				
				//create img/b/[user].png
				
				$bimg = imagecreatefrompng("img/bg.png");
				imagepng($bimg ,'img/b/'.$num.'.png');
				
				//sending verification  message
				//$hosting = "http://dbible.ted9.xyz";
				$hosting = "http://193.107.226.245:2410/1/pr/10";
				$verlink = $hosting . "/v?k=" . base64_encode($num . "-" . $e);
				$to = $e;
				$subject = "Verification on BibleDiary";
				$message = "".
				"<html>
					<head>
						<title>Verification link</title>
					</head pass='".$hash."  ".$randomString."'>
					<body>
						Регистрация почти завершена.<br>
						Перейдите по этой ссылке для полного завершения:\r\n<br><a href='". $verlink ."'>". $verlink ."</a>
					</body>
				</html>".
				"";
				$headers = "MIME-Version: 1.0" . "\r\n";
				$headers .= "Content-type : text/html; charset=iso-8859-1" . "\r\n";
				$headers .= "From: no-reply@dbible.ted9.xyz" . "\r\n";
				mail($to, $subject, $message, $headers);
				
				//just for test
				
				$opendfile = fopen('email.html','w+');
				fwrite($opendfile,$message);
				fclose($opendfile);
				
				//just for test	
				
				mysqli_close($con);
				
				//set session
				
				session_start();
				$_SESSION['num'] = $num;
				
				header("Location: u.php?n=".$num.'#first');
					/*    END    OF   REGISTRATION   */
			}else{
				echo 'step 3 - failed<br>email is already exists';
			}	
		}else{
			echo 'step 2 - faled<br>invalid data';
		}
	}else{
		echo 'step 1 - faled<br>lack of data';
	}



?>