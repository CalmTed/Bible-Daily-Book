<?php
	require("../db.php");
	$con = mysqli_connect($servername,$username,$db_password,$dbname);
	$ar;
	if(isset($_POST['pass'])&&isset($_POST['name'])){
		$query =("SELECT * FROM users WHERE num='".$_POST['name']."'");
		$result = $con->query($query) or die($con->error.__LINE__);
		$user = $result->fetch_array();
		if (empty($user['pass'])){
			$ar["return"] = "user verification: denied";
		}else{
			if ($user['pass'] == $_POST['pass']){
				if(isset($_POST['id'])){
					$id = $_POST['id'];
					$table = $user['num'];
					$query = "DELETE FROM `".$table."` WHERE `".$table."`.`id` = ".$id;
					$result = $con->query($query) or die($con->error.__LINE__);
					mysqli_close($con);
					$ar["return"] = "deliting: success";
				}else{
					$ar["return"] = "deliting: ERROR! post id isnt set";
				}
			}else{
				$ar["return"] = "user verification: denied - wrong password";
			}
		}
	}else{
		$ar["return"] = "user verification: not all info";
	}
echo json_encode($ar);

//log file
/*$path = strval("../edit.txt");
$opendfile = fopen($path,'w+');
$text = 	$_POST['id']. '
'.$_POST['pass']. '
'.$_POST['name'];
fwrite($opendfile, $text);
fclose($opendfile);*/