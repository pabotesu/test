<?php
//データベースの接続と選択
require_once('./core/config.php');

$mysqli = new mysqli($host, $username, $password, $dbname);
if ($mysqli->connect_error) {
	error_log($mysqli->connect_error);
	exit;
}
mysqli_set_charset($mysqli,"utf8");


// if(!mysql_connect("localhost","root","root"))
// {
//      die('oops connection problem ! --> '.mysql_error());
// }
// if(!mysql_select_db("register_func"))
// {
//      die('oops database selection problem ! --> '.mysql_error());
// }