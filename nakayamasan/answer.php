<?php
 
$question = $_POST['question']; //ボタンの内容を受け取る
$answer = $_POST['answer'];   //hiddenで送られた正解を受け取る
 
//結果の判定
if($question == $answer){
	$result = "正解！";
	
}else{
	$result = "不正解･･･";
}
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>簡易クイズプログラム - 結果</title>
</head>
<body>

<h2>クイズの結果</h2>
<?php echo $result ?>
<form action="" method="POST">
   <button type="submit" name="back" value="Back">戻る</button>
   <button type="submit" name="next" value="Next">次へ</button>
</form>
 
</body>
</html>