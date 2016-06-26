<?php
//saveimg.php
$a['ret'] = '';
if(isset($_GET['files'])||isset($_POST['n'])||isset($_POST['p'])||isset($_POST['dir'])){
	$name = $_POST['n'];
	$pass = $_POST['p'];
	$d = $_POST['dir'];
	switch($d){
		case 'a':$dir = '../img/a/';break;
		case 'b':$dir = '../img/b/';break;
	}
	require("../db.php");
	$con = mysqli_connect($servername,$username,$db_password,$dbname);
	$query1 = "SELECT * FROM `users` WHERE `num` = '$name'";
	$result1 = $con->query($query1) or die($con->error.__LINE__);
	while ($row = $result1->fetch_assoc()) {
		$pass1 = $row["pass"];
	}
	if(password_verify($pass, $pass1)){
		
		//set session for auto search of user
		session_start();
		$_SESSION['num'] = $name;
		
		//saving image
		foreach($_FILES as $file){
			if(intval($file['size'] ) < 2097152){//size
				if($file['type'] == 'image/png'||$file['type'] == 'image/jpeg'||$file['type'] == 'image/gif'){//ext
				$ext = substr($file['type'],6);
					if(move_uploaded_file($file['tmp_name'], $dir.$name.".".$ext)){
						//changing ext in DB
						if($d == "a"){
							$query2 = "UPDATE `users` SET `img`='img/a/".$name.".".$ext."' WHERE `num` = '".$name."'";
							$result2 = $con->query($query2) or die($con->error.__LINE__);
						}elseif($d == "b"){
							$query2 = "UPDATE `users` SET `bg`='img/b/".$name.".".$ext."' WHERE `num` = '".$name."'";
							$result2 = $con->query($query2) or die($con->error.__LINE__);
						}
						//dliting other ext
						if($ext != 'png'){
							if(file_exists($dir.$name.'.png')){
								unlink($dir.$name.'.png');
							}
						}
						if($ext != 'jpeg'){
							if(file_exists($dir.$name.'.jpeg')){
								unlink($dir.$name.'.jpeg');
							}
						}
						if($ext != 'gif'){
							if(file_exists($dir.$name.'.gif')){
								unlink($dir.$name.'.gif');
							}
						}
						$a["ext"] = $ext;
						$a["d"] = $d;
						$a["ret"] = "files are here";
					}else{
						$a["ret"] = "error on uploading img";
					}
				}else{
					$a["ret"] = "wrong extention";
				}
			}else{
				$a["ret"] = "to large";					
			}
		}
		
	}else{
		$a["ret"] = "wrong password";
	}
}else{
	$a["ret"] = "lack of data";
}

echo json_encode($a);
