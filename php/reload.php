<?php

//reload.php
require("../db.php");
$con = mysqli_connect($servername,$username,$db_password,$dbname);
$ar;
if(mysqli_connect_errno()){
   $ar["return"] = "cant connect";
}else{
	$query = "SELECT * FROM `u11111` ORDER BY `id` DESC LIMIT 0, 150";
	$result = $con->query($query) or die($con->error.__LINE__);
	mysqli_close($con);
	$ar['num'] = $result->num_rows;
	$i = 0;$n = 0;
	if($ar['num'] > 0 ){
			
		while ($row = $result->fetch_assoc()) {
			$ar["id_".strval($i)] = $row['id'];
			$ar["d_".strval($i)] = $row['d'];
			$ar["c_".strval($i)] = $row['c'];
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
	echo json_encode($ar);
//$i = 13; ???