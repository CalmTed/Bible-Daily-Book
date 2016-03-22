<?php 
//editline.php
/*
		"id" : $('#wid').val(),
		"d" : $('#wdate').val(),
		"ch" : $('#wchapters').val(),
		"n" : $('#wnumber').val(),
		"s" : $('#wdescription').html(),
		"name" : $('#nameinp').val(),
		"pass" : $('#passimp').val()
*/
	require("../db.php");
	$con = mysqli_connect($servername,$username,$db_password,$dbname);
	$ar;
	if(isset($_POST['pass']) && isset($_POST['name'])){
		$query =("SELECT * FROM users WHERE num='".$_POST['name']."'");
		$result = $con->query($query) or die($con->error.__LINE__);
		$user = $result->fetch_array();
		if (empty($user['pass'])){
			//echo 'wrong pass';
			$ar["return"] = "wrong password";
		}else{
			if ($user['pass'] == $_POST['pass']){
					$id = $_POST['id'];
					if(isset($_POST['d']) && isset($_POST['chap']) && isset($_POST['n']) && isset($_POST['s'])){
						$table = $user['num'];
						$d = $_POST['d'];
						$c = $_POST['chap'];
						$n = $_POST['n'];
						$s = $_POST['s'];
						$d = str_replace("'",'"',$d);
						$c = str_replace("'",'"',$c);
						$n = str_replace("'",'"',$n);
						$s = str_replace("'",'"',$s);
						$d = stripslashes($d);
						$d = htmlspecialchars($d);
						$c = stripslashes($c);
						$c = htmlspecialchars($c);
						$n = stripslashes($n);
						$n = htmlspecialchars($n);
						$s = stripslashes($s);
						$s = htmlspecialchars($s);
						$query =("SELECT `d` FROM `".$table."` ORDER BY `id` DESC LIMIT 1;");
						$result = $con->query($query) or die($con->error.__LINE__);
						$date = $result->fetch_array();
						$ar["query"] = $date['d'].' -DB  post-'.$_POST['d'];
						if($id == 'none' ){
							if($_POST['d'] != $date['d']){								
								$query = "INSERT INTO `".$table."` (`id`, `d`, `c`, `n`, `s`) VALUES (NULL, '".$d."', '".$c."', '".$n."', '".$s."')";
								$ar["return"] = "insert success";
							}else{
								$ar["return"] = "date is allready exists";
							}
						}else{
							$query = "UPDATE `".$table."` SET `d`='".$d."',`c`='".$c."',`n`='".$n."',`s`='".$s."' WHERE `id`=".$id;
							//$query = "UPDATE `".$table."` (`id`, `d`, `c`, `n`, `s`) VALUES (NULL, '".$d."', '".$c."', '".$n."', '".$s."')";
							//UPDATE `u11111` SET `d`='value',`c`='value',`n`='value',`s`='value' WHERE `id`=19
							$ar["return"] = "update success";
						}
						$result = $con->query($query) or die($con->error.__LINE__);
						mysqli_close($con);
					}else{
						//echo 'not all vars';
						$ar["return"] = "not all variables";
					}
						
			}else{
				//echo 'wrong pass';
				$ar["return"] = "wrong password";
			}
		}
	}else{
		$ar["return"] = "not all verification variables";
	}

echo json_encode($ar);




