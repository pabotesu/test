<?PHP
$dsn = 'mysql:dbname=localdb;host=127.0.0.1:53070;charset=utf8';
$user = 'azure';
$password = '6#vWHD_$';

try{
    $dbh = new PDO($dsn, $user, $password);
    $text = $_POST['txt']; //ユーザーIDを受け取る
    $text2 = $_POST['txt2'];   //ユーザーID2を受け取る
    $ketugou = $text.$text2;//結合
    $randam = md5(uniqid(rand(),1));
    echo $ketugou2 = $ketugou.$randam;
    
}catch (PDOException $e){
    print('Error:'.$e->getMessage());
    die();
}
    $sql = “INSERT INTO user2 (infoID) VALUES (:infoID)”;
    $stmt = $dbh->prepare($sql);
    $params = array(‘:infoID’ => '$ketugou2');
    $stmt->execute($params);
    /* $dbh = $pdo -> prepare("INSERT INTO user2 VALUES :infoID");
     $dbh->bindParam(':infoID', $ketugou2, PDO::PARAM_STR);
       $dbh->execute();*/
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<h2>登録しました。</h2>
</head>
<body>
</body>
</html>

