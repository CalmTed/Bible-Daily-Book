<?php
		require("../db.php");
		$con = mysqli_connect($servername,$username,$db_password,$dbname);
		if(mysqli_connect_errno())
		{
			echo '<h3 style="color: #f00;">AHAHAHahahAHaHHAh! Error:'.mysqli_connect_error().'</h3>';
		}else{
			if(isset($_POST['d']) && isset($_POST['c']) && isset($_POST['n']) && isset($_POST['s'])){
				$d = $_POST['d'];
				$c = $_POST['c'];
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
				$query = "INSERT INTO `u11111` (`id`, `d`, `c`, `n`, `s`) VALUES (NULL, '".$d."', '".$c."', '".$n."', '".$s."')";
				$result = $con->query($query) or die($con->error.__LINE__);
				mysqli_close($con);
				header('Location: ../savetou1.php');
			}
		}