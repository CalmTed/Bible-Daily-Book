
<?php 
$ar;
if(isset($_POST['e']) && isset($_POST['t']) && isset($_POST['m'])){
	$e = $_POST['e'];
	$t = $_POST['t'];
	$m = $_POST['m'];
	$to = 'r2d2f9@gmail.com';
	$subject = "Кто-то с BibleDiary написал на тему '".$t."'";
	$message = "".
	"<html>
		<head>
			<title>Кто-то с BibleDiary написал на тему '".$t."'</title>
		</head>
		<body>
			Hi, dear Admin.<br>
			Сообщение от ".$e.".<br>На тему '".$t."'.<br>Сообщение: ".$m."
		</body>
	</html>".
	"";
	$headers = "MIME-Version: 1.0" . "\r\n";
	$headers .= "Content-type : text/html; charset=iso-8859-1" . "\r\n";
	$headers .= "From: no-reply@dbible.ted9.xyz" . "\r\n";
	mail($to, $subject, $message, $headers);
	$ar['return'] = 'message sent';
}else{
	$ar['return'] = 'vars leak';
}
echo json_encode($ar);