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

$question = array(); //この変数は配列ですよという宣言
$question = array('1','2','3','4',); //選択肢を設定 本来はアイウエ

$dsn = 'mysql:dbname=localdb;host=127.0.0.1:53105;charset=utf8';
$user = 'azure';
$password = '6#vWHD_$';

try{
    $dbh = new PDO($dsn, $user, $password);
    mysqli_set_charset($dbh,"utf8");
    $q = "SELECT mondai,sikenID FROM mondaitb Where mondaiID =" .($_SESSION['number']);
    $que = $dbh->query($q);
    foreach ($dbh->query($q) as $que) {
            echo $que['mondai'];
            echo $que['sikenID'];     
    }
    
   /* $ID = "SELECT sikenID FROM mondaitb Where mondaiID =" .($_SESSION['number']);
    $siken = $dbh->query($ID);
    foreach ($dbh->query($ID) as $siken) {
            echo $siken['sikenID'];     
    }*/
    
    $sql = "select seikaiNum FROM mondaitb Where mondaiID =" .($_SESSION['number']);
    foreach ($dbh->query($sql) as $row) {
    }
    
    $kai = "SELECT kai1,kai2,kai3,kai4 FROM kaitoutb Where kaitouNO =" .($_SESSION['number']);
    $tou = $dbh->query($kai);
    foreach ($dbh->query($kai) as $tou) {
            br();
            echo "ア：";
            echo $tou['kai1'];
            br();
            echo "イ：";
            echo $tou['kai2'];
            br();
            echo "ウ：";
            echo $tou['kai3'];
            br();
            echo "エ：";
            echo $tou['kai4'];
            
    }
    
}catch (PDOException $e){
    print('Error:'.$e->getMessage());
    die();
}

$dbh = null;

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
//  sleep(3000);
//  if($question == $answer){
//       $_SESSION['number']++;
//  header('Location: http://allheartit.azurewebsites.net/mondai.php');
//  exit();
//  }

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