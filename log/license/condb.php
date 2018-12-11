<?php
//データベースの接続と選択
	require_once('config.php');

	$teachgo = new mysqli($host, $username, $password, $teacherdb);
	if ($teachgo->connect_error) {
		error_log($teachgo->connect_error);
		exit;
	}
	$student = new mysqli($host, $username, $password, $studentdb);
	if ($student->connect_error){
		error_log($student->connect_error);
		exit;
	}
	mysqli_set_charset($teachgo,"utf8");
	mysqli_set_charset($student,"utf8");
?>