<?php
session_start();

// logout.php?logoutにアクセスしたユーザーをログアウトする
if(isset($_GET['logout'])) {
	unset($_SESSION['qnum']);
	unset($_SESSION['userid2']);
	unset($_SESSION['user']);
	session_destroy();
}
	header("Location: index.php");
