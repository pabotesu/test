<?php
//データベースの接続と選択
	require_once('config.php');

	$connt = new mysqli($host, $username, $password, $dbname);
	if ($connt->connect_error) {
		error_log($connt->connect_error);
		exit;
	}
	mysqli_set_charset($connt,"utf8");
	$student = new mysqli($host, $username, $password, $studentdb);
	if ($student->connect_error) {
		error_log($student->connect_error);
		exit;
	}
	mysqli_set_charset($student,"utf8");
?>