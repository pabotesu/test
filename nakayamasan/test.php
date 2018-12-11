<?php
function br(){
    echo nl2br("\n");
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


   $host = "127.0.0.1:53105";
	$username = "azure";
	$password = "6#vWHD_$";
	$dbname = "localdb";
	$mysql_test = new mysqli($host, $username, $password, $dbname);
	if ($mysql_test->connect_error) {
		error_log($mysql_test->connect_error);
		exit;
	}
	mysqli_set_charset($mysql_test,"utf8");

	$hairetu = array(0);
	array_pop($hairetu);

	$tsNO = "SELECT tsNO FROM testtb ";
	$result = $mysql_test->query($tsNO);
	if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
        	array_push($hairetu,$row['tsNO']);
        }
    } else {
         echo "0 results";
    }
    foreach ($hairetu as $val){
    
    }
    
    
    $question = "SELECT tsMONDAI FROM testtb WHERE tsNO=".$hairetu[$_SESSION['number']];
    $result = $mysql_test -> query($question);
    $row = $result-> fetch_assoc();
    echo $row['tsMONDAI'];
    $result -> close();
    
    
    
    $hairetu2 = array(0);
	array_pop($hairetu2);
    
    $kai = "SELECT tsNO FROM tskaitoutb  ";
	$res = $mysql_test->query($kai);
	if ($res->num_rows > 0) {
        while($row2 = $res->fetch_assoc()) {
        	array_push($hairetu2,$row2['tsNO']);
        }
    } else {
         echo "0 results";
    }
    foreach ($hairetu2 as $val2){
        //echo "$val2";
    	
    }

    $question2 = "SELECT tskai1,tskai2,tskai3,tskai4 FROM tskaitoutb WHERE tsNO=".$hairetu2[$_SESSION['number']];
    $res = $mysql_test -> query($question2);
    $row2 = $res-> fetch_assoc();
    br();
    echo "ア：";
    echo $row2['tskai1'];
    br();
    echo "イ：";
    echo $row2['tskai2'];
    br();
    echo "ウ：";
    echo $row2['tskai3'];
    br();
    echo "エ：";
    echo $row2['tskai4'];
   
    
    $res -> close();

    
    /*$tou = $mysql_test->query($kai);
    foreach ($mysql_test->query($kai) as $tou) {
            br();
            echo "ア：";
            echo $tou['tskai1'];
            br();
            echo "イ：";
            echo $tou['tskai2'];
            br();
            echo "ウ：";
            echo $tou['tskai3'];
            br();
            echo "エ：";
            echo $tou['tskai4'];
            break;
            
    }
    
/*}catch (PDOException $e){
    print('Error:'.$e->getMessage());
    die();
}*/

$mysql_test = null;

$answer =  $row['seikaiNum']; //正解の問題を設定 データベースと繋ぐ
$q = $_POST['question']; //ボタンの内容を受け取る

echo <<<EOM
<script type="text/javascript">
 if($q == $answer){
	 alert( "正解！");
 }else{
     alert( "不正解･･･");
}
</script>
EOM;

$question = array('1','2','3','4',); //選択肢を設定 本来はアイウエ
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







