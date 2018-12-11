<? 
	$servername = "127.0.0.1:53105";
	$username = "azure";
	$password = "6#vWHD_$";
	$dbname = "localdb";
	
	
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
mysqli_set_charset($conn,"utf8");
?>


	
<form name="Hai" method="POST" action="session.php">
<input type="hidden" name="answer" value="2">
<input type="submit" value="iパス">
</form>

<form name="Hai" method="POST" action="session.php">
<input type="hidden" name="answer" value="1">
<input type="submit" value="基本情報">
</form>

<form name="Hai" method="POST" action="session.php">
<input type="hidden" name="answer" value="3">
<input type="submit" value="応用情報">
</form>

<form name="Hai" method="POST" action="session.php">
<input type="hidden" name="answer" value="0">
<input type="submit" value="リセット">
</form>

<?
    
    
$answer = $_POST["answer"];

if($answer == 2){
	
	/*$query = 'SELECT userid2, email FROM `users` WHERE users.userid2 IN(SELECT userid2 FROM `seisekitb` WHERE finaly >= 90 AND sikenID = \'IP\')';
	$result = $conn -> query($query);*/
    /*↑なにこれ*/
    
    $query = 'SELECT userid2, email FROM `users` WHERE users.userid2 IN(SELECT userid2 FROM `seisekitb` WHERE finaly >= 90 AND sikenID = \'IP\')';
	$result = $conn -> query($query);
	
	echo "itパスポートが得意なユーザー";
	echo "<br />";
	if ($result->num_rows > 0) {
    // output data of each row
        while($row = $result->fetch_assoc()) {
            echo $row['userid2'];
            echo  " : ";
            echo $row['email'];
            echo "<br />";
        }
    } else {
         echo "0 results";
    }
	

}else if($answer == 1){
	
	$query = 'SELECT userid2, email FROM `users` WHERE users.userid2 IN(SELECT userid2 FROM `seisekitb` WHERE finaly >= 90 AND sikenID = \'FE\')';
	$result = $conn -> query($query);
	
	echo "基本情報技術者試験が得意なユーザー";
	echo "<br />";
	if ($result->num_rows > 0) {
    // output data of each row
        while($row = $result->fetch_assoc()) {
            echo $row['userid2'];
            echo  " : ";
            echo $row['email'];
            echo "<br />";
        }
    } else {
         echo "0 results";
    }

}else if($answer == 3){
	
    $query = 'SELECT userid2, email FROM `users` WHERE users.userid2 IN(SELECT userid2 FROM `seisekitb` WHERE finaly >= 90 AND sikenID = \'AP\')';
	$result = $conn -> query($query);
	
    //echo "<p style='display:none'>応用情報技術者試験が得意なユーザー</p><br>";
    echo "応用情報技術者試験が得意なユーザー";
	echo "<br />";
	if ($result->num_rows > 0) {
    // output data of each row
        while($row = $result->fetch_assoc()) {
            echo $row['userid2'];
            echo  " : ";
            echo $row['email'];
            echo "<br />";
        }
    } else {
         echo "0 results";
    }

}else if($answer == 0){
    echo "高い点数を獲得したユーザーを紹介します。";
}


?>