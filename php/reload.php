<?php

//reload.php
require("../db.php");
$con = mysqli_connect($servername,$username,$db_password,$dbname);
$ar;
if(mysqli_connect_errno()){
   $ar["return"] = "cant connect";
}else{
	if(isset($_POST['name'])){
		$name = $_POST['name'];
	}else{
		$name = '';
	}
	$query1 = "SELECT * FROM `users` WHERE `num` = '$name'";
	$result1 = $con->query($query1) or die($con->error.__LINE__);
	if(count($result1->fetch_array())<1){
		$ar["return"] = "user not exists";
	}else{
		
		$query = "SELECT * FROM `$name` ORDER BY `id` DESC LIMIT 0, 250";
		$result = $con->query($query) or die($con->error.__LINE__);
		mysqli_close($con);
		$ar['num'] = $result->num_rows;
		$i = 0;$n = 0;
		if($ar['num'] > 0 ){
				
			while ($row = $result->fetch_assoc()) {
				$ar["id_".strval($i)] = $row['id'];
				$ar["d_".strval($i)] = $row['d'];
				$ar["c_".strval($i)] = $row['c'];
				$ar["t_".strval($i)] = $row['tags'];
				$ar["n_".strval($i)] = $row['n'];
				$ar["s_".strval($i)] = $row['s'];
				$i++;
				$n += $row['n'];
			}
			$nt = $n - ( 1189 * floor($n / 1189));
			$ar['level'] = floor($n / 1189)+1;//level
			$ar['nm']  = $n;//n max
			$ar['nt'] = $nt;//n for this level (accurate)
			$ar['left'] = (1189 - $nt);//chapters left
			$ar['perc'] = round((100/1189) * $nt,1);//in percents
			$ar["return"] = "success";
		}else{
			$ar["return"] = "empty table";
		}
	}
}
	echo json_encode($ar);
//$i = 13; ???