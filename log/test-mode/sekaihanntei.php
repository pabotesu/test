<?PHP
session_start();
/////////////////////////////変数/////////////////////////////////
    //$_SESSION['teacherID'] = 'k018';
    $teacherID = $_SESSION['teacherID'];
    $shikenID = $_SESSION['shikenID'];
    $testName = "test{$teacherID}_{$shikenID}";
    $userid2 = $_SESSION['userid2'];
    $hanntei = array();
    $kekka = array();
    $message = '';
    $t = '';
//////////////////////////////////////////////////////////////////
    if(!isset($_SESSION['user'])){
        header("Location: ../index.php");
        exit();
    }
    include_once('condb.php');
    include_once('../license/condb.php');
    //カウント関数
    $count = count($_SESSION['mypoint']);

    for($i=0;$i<$count;$i++){
            if($_SESSION['mypoint'][$i] == $_SESSION['tAnsArr'][$i]){
                   array_push($hanntei,1); 
                   $kekka[$i] = "正解";
            }
            else{
                   array_push($hanntei,0);
                   $kekka[$i] = "不正解";
            }
    }
    $total = 0;
    foreach($hanntei as &$value){
           $total += $value;
    }
    if($count != 0){
        $t = floor(($total/$count)*100);
    }
    unset($value);

    if(isset($_POST['message'])){
         //echo $message."<br>";
         $sql = "SELECT * FROM seisekitb WHERE sikenID = '$shikenID' AND userid2 = '$userid2' AND tuserID = '$teacherID'";
         //echo $sql;
         $result_of_mes = mysqli_query($student,$sql);
         if(mysqli_num_rows($result_of_mes)==0){
             //データがない場合
             $insert = "INSERT INTO seisekitb (sikenID,userid2,finaly,tuserID) VALUES ('$shikenID','$userid2',$t,'$teacherID')";
             //echo $insert;
             mysqli_query($student,$insert);
             $message = "レコードを登録しました。";
         }
         else{
             //でーたがある場合
             $update = "UPDATE seisekitb SET finaly = $t WHERE userid2 = '$userid2' AND sikenID = '$shikenID' AND tuserID = '$teacherID'";
             $message = "レコードを更新しました。";
             mysqli_query($student,$update);
         }
         //USERが戻れないように保存した値をすべて消します
        if(isset($_SESSION['qnum'])){
            unset($_SESSION['qnum']);
        }
        if(isset($_SESSION['num_rows'])){
            unset($_SESSION['num_rows']);
        }
        if(isset($_SESSION['randArr'])){
            unset($_SESSION['randArr']);
        }
        if(isset($_SESSION['tAnsArr'])){
            unset($_SESSION['tAnsArr']);
        }
        if(isset($_SESSION['mypoint'])){
            unset($_SESSION['mypoint']);
        }
        if(isset($_SESSION['countdown'])){
            unset($_SESSION['countdown']);
        }
    	if(isset($_SESSION['timeStart'])){
            unset($_SESSION['timeStart']);
        }
    }
if(isset($_SESSION['randArr'])){
    $randArr = $_SESSION['randArr'];
}
mysqli_close($student);
?>
<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <title>正解判定</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"><!--デバイス判定-->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" href="../cssfile/monuser.css">
        <link rel="stylesheet" href="../../css/common.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <style>
            body{
                background-repeat: no-repeat;
                background-attachment: absolute;
                background-position: right top;
                background-image: url(../../images/top-rightbg.png);
            }
            .wrapper{
                padding: 50px;
            }
            th{
                color: white;
                background-color: darkcyan;
            }
            #tensuuTitle{
                margin: 0 20%;
                text-align: center;
                color: darkcyan;
                font-size: 61px;
                font-style: oblique;
            }
            #tensuu{
                color: red;
                text-decoration: underline;
            }
        </style>
    </head>
    <body>
        <div class="wrapper">
            <div><?php 
                if($message != ''){
                    echo $message;
                }
            ?></div>
            <div id='tensuuTitle'>点数<span id="tensuu"><?php echo $t."%";?></span></div>
            <table class='table table-bordered'>
                <thead>
                    <tr>
                         <th>No</th>
                         <th>問題</th>
                         <th>正誤</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    if(isset($randArr)){
                        for($i=0;$i<count($randArr);$i++){
                                $mon = "SELECT mondai FROM {$testName} WHERE mondaiID = ".$randArr[$i];
                                $result_of_mon = mysqli_query($mysql_test,$mon);
                                $mondai = '';
                                foreach($result_of_mon as $value){
                                    $mondai = $value['mondai'];
                                }
                                $value = 0;
                                echo '<tr>';
                                echo "<td>".($i+1)."</td>";
                                echo "<td>$mondai</td>";
                                echo '<td>'.$kekka[$i].'</td>';
                                echo '</tr>';
                                mysqli_free_result($result_of_mon);
                        }
                    }
                ?>
                </tbody>
            </table>
            <form action="<?php $_SERVER['PHP_SELF']?>" method="POST">
                <input class='btn btn-success' type="submit" name='message' value="先生に送りますか">
            </form>
            <button><a href='../home.php'>戻る</a></button>
        </div>   
    </body>
</html>