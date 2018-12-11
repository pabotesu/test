<?php  
ini_set("display_errors", "On");  
error_reporting(E_ALL);  
session_start();
if( isset($_SESSION['user']) != "") {
	// ログイン済みの場合はリダイレクト
	header("Location: home.php");
}

// DBとの接続
include_once 'dbconnect.php';

?>
<!DOCTYPE HTML>
<html lang="ja">
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>会員登録</title>
<!-- Bootstrap読み込み（スタイリングのため） -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css">
<link rel="stylesheet" href="cssfile/style.css">
</head>
<body class="all">
<div class="col-xs-6 col-xs-offset-3 my-form-col">

<?php
// 登録がPOSTされたときに下記を実行
if(isset($_POST['signup'])) {
	
	$userid2 = $mysqli->real_escape_string($_POST['userid2']);
	$username = $mysqli->real_escape_string($_POST['username']);
	$email = $mysqli->real_escape_string($_POST['email']);
	$password = $mysqli->real_escape_string($_POST['password']);
	$password2 = $mysqli->real_escape_string($_POST['password2']);
	
	//パスワードを確認
		if($password !== $password2){?>
		<div class="alert alert-danger" role="alert">入力したパスワードが一致しません。</div>
		<?php

	}
	
	$password = password_hash($password, PASSWORD_BCRYPT);
	// POSTされた情報をDBに格納する 
	$sql ="SELECT userid2 FROM users WHERE userid2='$userid2'";
	$query = "INSERT INTO users(userid2,username,email,password) VALUES('$userid2','$username','$email','$password')";

    $result = $mysqli->query($sql);
    $row = $result->fetch_assoc();
   
	if($row["userid2"] == $userid2){ ?>
	<?php
		$i = 0;
	}else{
		$i = 1;
	} ?>
	<?php
		
	if($mysqli->query($query)) { ?>
		<div class="alert alert-success" role="alert">登録しました</div>
		<?php }
		
		elseif($i == 0){ ?>
			<div class="alert alert-danger" role="alert">入力されたユーザーIDは<br>既にご利用されています。<br>再度、新規のユーザーIDを入力してください。</div>
		<?php
		}else{ ?>	
			<div class="alert alert-danger" role="alert">入力されたメールアドレスは<br>既に使用されています。</div>
		<?php
		}
} ?>

<div class="my-form-col">
<form class='login' method="post">
	<h1>会員登録フォーム</h1>
	<div class="form-group">
		<input type="text" class="form-control" name="userid2" placeholder="ユーザーID" required />
	</div>
	<div class="form-group">
		<input type="text" class="form-control" name="username" placeholder="ユーザー名" required />
	</div>
	<div class="form-group">
		<input type="email"  class="form-control" name="email" placeholder="メールアドレス" required />
	</div>
	<div class="form-group">
		<input type="password" class="form-control" name="password" placeholder="パスワード" required />
	</div>
	<div class="form-group">
		<input type="password" class="form-control" name="password2" placeholder="パスワード(確認用)" required />
	</div>
	<a class="btn btn-default"href="index.php">ログインはこちら</a>
	<button type="submit" class="btn btn-success"btn btn-default" name="signup">会員登録する</button><br>
	<a href="https://allheartit.azurewebsites.net" class="top-page">トップページ</a>
	
</form>

</div>
</div>
</body>
</html>
