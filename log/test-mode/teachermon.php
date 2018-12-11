<? 
	session_start();
	$servername = "127.0.0.1:53105";
	$username = "azure";
	$password = "6#vWHD_$";
	$dbname = "teacherdb";
    if(!isset($_SESSION['user'])){
        header("Location: ../index.php");
        exit();
    }
	
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
mysqli_set_charset($conn,"utf8");
?>

<?
    $tid = array();
    $teacherid = '';
    $num = NULL;
    if(isset($_POST['number'])){
        $num = $_POST['number'];
    }
    $tid = $_SESSION['tid'];//session2.phpからもらった
    if($num != NULL){
        $_SESSION['teacherID'] = $tid[$num]; //index.phpで使う必要がある
        $teacherid = $tid[$num];
    }

$tArr = array();
$iArr = array();

 $query = "SELECT * FROM kadai{$teacherid}";
// echo $query;

	
    
   if($result_of_query = mysqli_query($conn,$query)){
        while ($row = mysqli_fetch_assoc($result_of_query))
            {
                array_push($tArr,$row['testID']);
               
            }
        // Free result set
        mysqli_free_result($result_of_query); 
   }
$cou = count($tArr);
$count = $cou;
//echo $count;
$_SESSION['erandatestID'] = $tArr;
?>


<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0"><!--デバイス判定-->
        <!-- Bootstrap読み込み（スタイリングのため） -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href='css/matching.css'>
        <style>
            .wrapper{
                margin: 0 10%;
            }
        </style>
</head>
<body>

<div class='wrapper'>
<form method="POST" action="start.php">
    <table class='table table-bordered'>
        <thead>
            <tr>
                <th>No</th>
                <th>テストID</th>
                <th>ボタン</th>
            </tr>
        </thead>
        <tbody>
            <?PHP
                for($i=0;$i<$count;$i++){
                    echo "<tr>";
                    echo "<td>".($i+1)."</td>";
                    echo "<td>{$tArr[$i]}</td>";
                    echo "<td class='middle'><button class='btn btn-primary' type= 'submit' name= 'submittestid' value=$i>受験する</button></td>";
                    echo "</tr>";
                }
             ?>
        </tbody>
     </table> 
</form>
<button class='btn btn-default'><a href='index.php'>戻る</a></button>
</div>

</body>
</html>







    
    
    
    
    
    
    
    








