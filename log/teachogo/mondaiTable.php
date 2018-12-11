<?php 
    session_start();
    include_once("condb.php");
    //echo $_SESSION['kadaiName'],"<br>";
    $kadaiName = $_SESSION['kadaiName'];
    $teacherID = $_SESSION['teacherID'];

/*****************************************************************************************/
    if(isset($_POST['select_kadai'])){
        $filename = $_POST['select_kadai'];
        $sikenid = str_replace("seiseki_","",$filename);
        $filename .= date("Y-m-d"); //日付をつける
        $filename .= ".csv"; //ファイルの拡張をつける
        //var_dump(strpos($filename,'seiseki'));
        if(strpos($filename,'seiseki') !== false){
            $query = "SELECT userid2,sikenID,finaly FROM seisekitb WHERE tuserID = '$teacherID' AND sikenid = '$sikenid'";
            //echo $query;
            
            $csv_header = '';
            if($result = mysqli_query($student,$query)){
                $num_column = mysqli_num_fields($result);
                /****************ヘーダを作る処理処理*************************/
                $header = array("ユーザーID２","試験ID","点数");
                for($i=0;$i<count($header);$i++){
                    $csv_header .= '"'.$header[$i].'",';
                }
                $csv_header .= "\n";
                /******************行にある項目を取得する処理*****************/
                $csv_row ='';
                while($row = mysqli_fetch_row($result)) {
                	for($i=0;$i<$num_column;$i++) {
                		$csv_row .= '"' . $row[$i] . '",';
                	}
                	$csv_row .= "\n";
                }
                $csv = $csv_header.$csv_row;
                $csv = mb_convert_encoding($csv, "SJIS");
                /********************CSVファイルとしてダウンロードする***************/
                echo $csv;
                header("Content-type: application/csv");
                header("Content-Disposition: attachment; filename=$filename");
            }
            mysqli_free_result($result);
            exit();
	   }
       
       //////////////////////////////////////////////////////////////////////////
       if($_POST['select_kadai'] != -1){
        unset($_POST['majors']);//項目の削除することを防ぐ
        $_SESSION['testID'] = $_POST['select_kadai'];
        }
        else{
            //チェックされたチェックボックスを削除
            if(isset($_POST['majors'])){
                $majors = $_POST['majors'];
                for($i=0;$i<count($majors);$i++){
                    //echo $majors[$i];
                    $testID = $majors[$i];
                    $testName = "test{$teacherID}_{$testID}";
                    //echo $testName;
                    mysqli_query($connt,"DELETE FROM $kadaiName WHERE testID = '$testID'");
                    mysqli_query($connt,"DROP TABLE IF EXISTS $testName");
                    header('Location: ../teachogo');
                }
                mysqli_close($connt);
                exit();
            }
        }
    }
    
    $table_name = "test{$teacherID}_".$_SESSION['testID'];
    //echo $table_name;
    $query_test = "SELECT * FROM $table_name";
    $result_of_test = mysqli_query($connt,$query_test);
    if($result_of_test){
        $num_row = mysqli_num_rows($result_of_test);//$result_of_test　のrowの数
    }
/*****************************************************************************************/
    mysqli_close($connt);
?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>問題表</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="script.js"></script>
</head>

<body>
    <!-- form が必要 -->
    <div class="wrapper">

        <form class="submitForm" action="updateTable.php" method="post">
            <h2 class="tableTitle"><?php echo $_SESSION['testID'];?></h2><br>
            <table class='table-bodered'>
                <?php
                    if($result_of_test){
                        echo "
                <thread>
                <tr>
                    <th class='smallCol'><input type='checkbox' id='allChecked'></th>
                    <th class='smallCol'>問題番号</th>
                    <th>質問</th>
                    <th>編集</th>
                </tr>
                </thread>";
                //$_SESSION['TABLENAME']
                $_SESSION['tablename'] = $table_name;
                while($row = mysqli_fetch_assoc($result_of_test)){
                    echo "
                    <tbody>
                        <tr>
                             <td class='smallCol'><input class='check' type='checkbox' name='delete[]' value='{$row['mondaiID']}'></td>
                             <td class='smallCol'>{$row['mondaiID']}</td>
                             <td>{$row['mondai']}</td>
                             <td class='smallCol'><button class='btn btn-success' name='editMondai' value='{$row['mondaiID']}'>編集</button></td>
                        </tr>

                    ";
                }
                echo "
                        <tr>
                            <td class='base'><button class='btn btn-danger' id='deleteHandler' type='submit' name='editMondai' style='display: none' value=-1>削除</button></td>
                            <td class='base'></td>
                            <td class='base'><input class='tuika' type='submit' name='insert' value='＋'></td>
                            <td class='base'></td>
                        </tr>   
                    </tbody>
                ";
                mysqli_free_result($result_of_test);
            }
            else{
                echo "テーブルは存在していないです。";
            }
                ?>
            </table>
        </form>
        <form action="index.php" method="post">
            <button class="btn btn-default">戻る</button>
        </form>
    </div>
</body>


</html>