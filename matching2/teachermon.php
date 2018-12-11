<? 
	session_start();
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
    $num = $_POST['number'];
    $newArr = $_SESSION['tid'];
    $userid2 = $newArr[$num];
	//echo $newArr[0];

$tArr = array();

 $query = "SELECT * FROM kadai{$userid2}";
 echo $query;

	
    
   if($result_of_query = mysqli_query($conn,$query)){
        while ($row = mysqli_fetch_assoc($result_of_query))
            {
                array_push($tArr,$row['testID']);
                array_push($tArr,$row['testName']);
               
            }
        // Free result set
        mysqli_free_result($result_of_query); 
   }
    //  for($i=0;$i<count($tArr);$i++){
    //     echo $tArr[$i]," ";
    // }
$cou = count($tArr);
$count = $cou/2;
//echo $count;

?>


<!doctype html>
<html>
<head>
<meta charset="utf-8">
</head>
<body>


<form method="POST" action="test.php">
    <?PHP
        for($i=0;$i<$count;$i++){
            echo "<input type= 'submit' name= 'number' value=$i>";
        }
     ?>   
</form>

</body>
</html>






