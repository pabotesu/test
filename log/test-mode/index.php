<? session_start();
    if(!isset($_SESSION['user'])){
        header("Location: ../index.php");
        exit();
    }
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
        <link rel="stylesheet" href='css/matching.css'>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
<div class='wrapper'>
     <!-- Search form -->
     <form action='<?php echo $_SERVER['PHP_SELF']; ?>' method='get'>
      <div class="input-group search active-cyan">
            <input type="text" name='search' class="form-control" placeholder="Search">
            <div class="input-group-btn">
              <button class="btn btn-default" type="submit">
                <i class="glyphicon glyphicon-search"></i>
              </button>
            </div>
      </div>
    </form>
    <form method="POST" action="teachermon.php">
     <div class="container">
          <h2>教師とマッチング</h2>       
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>No</th>
                <th>教師名</th>
                <th>ボタン</th>
              </tr>
            </thead>
            <tbody>
              <?php 
                    $newArr = array();
                    $string = '';
                    $sql = 'SELECT * FROM `teacherlist` WHERE 1';
                    if(isset($_GET['search'])){
                        $query = $_GET['search'];
                        $query = htmlspecialchars($query);//無駄なHTMLタッグを削除
                        $query = mysqli_real_escape_string($conn,$query);//SQLインジェクションの防止
                        $string = " AND teacherName LIKE '%{$query}%' OR teacherID LIKE '%{$query}%'";
                    }
                    $sql .= $string;
                    $sql .= " ORDER BY `teacherName`";
                    if($result_of_query = mysqli_query($conn,$sql)){
                        $i=1;
                        while ($row = mysqli_fetch_assoc($result_of_query))
                            {
                                array_push($newArr,$row['teacherID']);
                                echo "
                                    <tr>
                                        <td>{$i}</td>
                                        <td>{$row['teacherName']}</td>
                                        <td class='middle'><button class='btn btn-success' type='submit' name= 'number' value=".($i-1)."><i class='fa fa-binoculars'></i></button></td>
                                    </tr>
                                ";
                                $i++;
                            }
                        // Free result set
                        mysqli_free_result($result_of_query);
                    }
                   $_SESSION['tid'] = $newArr;
                   $count = count($newArr);
              ?>
            </tbody>
          </table>
        </form>
        <button class='btn btn-default'><a href='../index.php'>戻る</a></button> 
        </div>  
</div>



</body>
</html>