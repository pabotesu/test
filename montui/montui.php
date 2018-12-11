<?php  
ini_set("display_errors", "On");  
error_reporting(E_ALL);  
session_start();

// DBとの接続
include_once 'dbconnect.php';

?>
<!DOCTYPE HTML>
<html lang="ja">
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>もんつい！</title>
<!-- Bootstrap読み込み（スタイリングのため） -->
</head>
<body class="all">
<div class="col-xs-6 col-xs-offset-3 my-form-col">

<?php
// 登録がPOSTされたときに下記を実行
if(isset($_POST['signup'])) {
	
	$mondai = $mysqli->real_escape_string($_POST['mondai']);
	$kai1 = $mysqli->real_escape_string($_POST['kai1']);
	$kai2 = $mysqli->real_escape_string($_POST['kai2']);
	$kai3 = $mysqli->real_escape_string($_POST['kai3']);
	$kai4 = $mysqli->real_escape_string($_POST['kai4']);
	$seikaiNum = $mysqli->real_escape_string($_POST['seikaiNum']);
	$sikenID = $mysqli->real_escape_string($_POST['sikenID']);
	
	
	// POSTされた情報をDBに格納する 
	$query = "INSERT INTO mondaitb(mondai,kai1,kai2,kai3,kai4,seikaiNum,sikenID) VALUES('$mondai','$kai1','$kai2','$kai3','$kai4','$seikaiNum','$sikenID')";
		
	if($mysqli->query($query)) { ?>
		<div class="alert alert-success" role="alert">登録しました</div>
		<?php
			
		 }else{ ?>	
			<div class="alert alert-danger" role="alert">失敗しました。</div>
		<?php
		}
} ?>



<div class="my-form-col">
<form method="post">
	<h1>もんつい！</h1>
	<div class="form-group">
		<input type="text" class="form-control" name="mondai" placeholder="問題文" required />
	</div>
	<div class="form-group">
		<input type="text" class="form-control" name="kai1" placeholder="回答１" required />
	</div>
	<div class="form-group">
		<input type="text"  class="form-control" name="kai2" placeholder="回答２" required />
	</div>
	<div class="form-group">
		<input type="text" class="form-control" name="kai3" placeholder="回答３" required />
	</div>
	<div class="form-group">
		<input type="text" class="form-control" name="kai4" placeholder="回答４" required />
	</div>
	<div class="form-group">
		<input type="text" class="form-control" name="seikaiNum" placeholder="正解の番号" required />
	</div>
	<div class="form-group">
		<input type="text" class="form-control" name="sikenID" placeholder="試験ID" required />
	</div>
	<button type="submit" class="btn btn-success"btn btn-default" name="signup">登録する</button><br>

	<a href="https://allheartit.azurewebsites.net" class="top-page">トップページ</a>
	
</form>

</div>
</div>
</body>
</html>
