<?php
function br(){
    echo nl2br("\n");//改行処理
}

session_start();
if(isset($_SESSION['number'])==""){
    $_SESSION['number']=0;
}
if(isset($_POST['next'])||isset($_POST['question'])){
    $_SESSION['number']++;
}elseif(isset($_POST['back'])){
    if($_SESSION['number']<=0){
        $_SESSION['number']=1;
    }
    $_SESSION['number']--;
}elseif(isset($_POST['reset'])){
	session_destroy();
    $_SESSION['number']=0;
}
$title = '問題';

   $host = "127.0.0.1:53105";//データベース接続
	$username = "azure";
	$password = "6#vWHD_$";
	$dbname = "localdb";
	$mysql_test = new mysqli($host, $username, $password, $dbname);
	if ($mysql_test->connect_error) {
		error_log($mysql_test->connect_error);
		exit;
	}
	mysqli_set_charset($mysql_test,"utf8");//文字コード選択

	$hairetu = array(0);
	array_pop($hairetu);

	$monID = "SELECT mondaiID FROM MONDAITB WHERE SIKENID = 'FE'";
	$result = $mysql_test->query($monID);
	if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
        	array_push($hairetu,$row['mondaiID']);
        }
    } else {
         echo "0 results";
    }
    foreach ($hairetu as $val){
    	
    }
    
    $question = "SELECT mondai FROM MONDAITB WHERE MONDAIID=".$hairetu[$_SESSION['number']];
    $result = $mysql_test -> query($question);
    $row = $result-> fetch_assoc();
    echo $row['mondai'];
    $result -> close();
    
    
    
    $hairetu2 = array(0);
	array_pop($hairetu2);
    
    $kai = "SELECT kaitouNO FROM kaitoutb Where sikenID = 'FE' ";
	$res = $mysql_test->query($kai);
	if ($res->num_rows > 0) {
        while($row2 = $res->fetch_assoc()) {
        	array_push($hairetu2,$row2['kaitouNO']);
        }
    } else {
         echo "0 results";
    }
    foreach ($hairetu2 as $val2){
        //echo "$val2";
    	
    }

    $question2 = "SELECT kai1,kai2,kai3,kai4 FROM kaitoutb WHERE kaitouNO=".$hairetu2[$_SESSION['number']];
    $res = $mysql_test -> query($question2);
    $row2 = $res-> fetch_assoc();
    br();
    echo "ア：";
    echo $row2['kai1'];
    br();
    echo "イ：";
    echo $row2['kai2'];
    br();
    echo "ウ：";
    echo $row2['kai3'];
    br();
    echo "エ：";
    echo $row2['kai4'];
   
    
    $res -> close();

  




$question = array('1','2','3','4',); //選択肢を設定 
$aiue = array('ア','イ','ウ','エ');
 
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>簡易クイズプログラム</title>
</head>
<body>
<p>
    
</p>
<h2><?php echo $title ?></h2>
<form method="POST" action="">
   <?php foreach($question as $value){ ?>
   <button name="question" type= "submit" value="<?php echo $value; ?>"><?php echo $aiue[$value-1]; ?></button>
   <?php } ?>
   <input type="hidden" name="answer" value="<?php echo $answer ?>">
</form>
<form action="" method="POST">
   <button type="submit" name="back"  value="Back"><</button>
   <button type="submit" name="next"  value="Next">></button>
   <input  type="submit" name="reset" value="Reset" />
</form>


<?php echo $_SESSION['number'];?>
 
</body>
</html>




