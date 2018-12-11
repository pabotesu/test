<? session_start();
	$servername = "127.0.0.1:53105";
	$username = "azure";
	$password = "6#vWHD_$";
	$dbname = "teacherdb";
	
	
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
mysqli_set_charset($conn,"utf8");
?>
<?
    if(isset($_SESSION['tid'])){
        unset($_SESSION['tid']);
    }
    $newArr= array();
     $query = 'SELECT teacherID FROM `teacherlist`';
    //echo $query;
    if($result_of_query = mysqli_query($conn,$query)){
        while ($row = mysqli_fetch_assoc($result_of_query))
            {
                array_push($newArr,$row['teacherID']);
                //echo $row['teacherID']," ";
            }
        // Free result set
        mysqli_free_result($result_of_query);
    }
    for($i=0;$i<count($newArr);$i++){
        echo $newArr[$i]," ";
    }
    if(!isset($_SESSION['tid'])){
        $_SESSION['tid'] = $newArr;
    }
    
    /*$query = 'SELECT teacherID FROM `teacherlist`';
	$result = $conn -> query($query);
	
	echo "教師IDを出力";
	echo "<br />";
	if ($result->num_rows > 0) {
    // output data of each row
        while($row = $result->fetch_assoc()) {
            echo $row['teacherID'];
            echo "<br />";
        }
    } else {
         echo "0 results";
    }
    echo "名前を表示";
    echo "<br />";
    $tName = 'SELECT testname FROM kadai';
    $tresult = $conn -> query($tName);
    if ($tresult->num_rows > 0) {
    // output data of each row
        while($trow = $tresult->fetch_assoc()) {
            echo $trow['testname'];
            echo "<br />";
        }
    } else {
         echo "0 results";
    }
    
    
    
    $query2 = 'SELECT teacherName FROM `teacherlist`';
	$result2 = $conn -> query($query2);
	
	echo "教師を出力";
	echo "<br />";
	if ($result2->num_rows > 0) {
    // output data of each row
        while($row2 = $result2->fetch_assoc()) {
            echo $row2['teacherName'];
            echo "<br />";
        }
    } else {
         echo "0 results";
    }
    
    $query3 = 'SELECT testID,testName FROM kadaik018';
    $result3 = $conn -> query($query3);
    
    echo "テストネーム";
    echo "<br />";
    if ($result3->num_rows > 0) {
    // output data of each row
        while($row3 = $result3->fetch_assoc()) {
            echo $row3['testID'];
            echo "<br />";
            echo $row3['testName'];
            echo "<br />";
        }
    } else {
         echo "0 results";
    }*/
    
   $count = count($newArr);
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
</head>
<body>


<form method="POST" action="teachermon.php">
    <?PHP
        for($i=0;$i<$count;$i++){
            echo "<input type= 'submit' name= 'number' value=$i>";
        }
     ?>   
</form>



</body>
</html>



	


