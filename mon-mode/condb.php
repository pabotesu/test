<?php
	//データベースの接続と選択
	require_once('config.php');

	$mysql_test = new mysqli($host, $username, $password, $dbname);
	if ($mysql_test->connect_error) {
		error_log($mysql_test->connect_error);
		exit;
	}
	mysqli_set_charset($mysql_test,"utf8");