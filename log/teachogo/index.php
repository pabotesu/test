<?php 
    session_start();
    include_once("condb.php");
    if($_SESSION['testNot'] == 0){
        header("Location: ../index.php");
        exit();
    }
    //SESSION[TEACHERID]定義
    $_SESSION['teacherID'] = $_SESSION['userid2'] ;
    $message = "";
    $idError = "";
    $kadaiError = "";
    //いらない文字を削除する
    function cleanString($string)
    {
        $res = preg_replace("/[^a-zA-Z0-9]/", "", $string);//削除処理
        $res = strtolower($res);// 小文字に変換する
        return $res;// return
    }
//////////////////////////////////////////////////////////////////////////////////////////////////////////////

    $teacherID = $_SESSION['teacherID'];
    $teacherID = mysqli_real_escape_string($connt,$teacherID);
    $kadaiName = "kadai{$teacherID}";//echo $kadaiName;
    $_SESSION['kadaiName'] = $kadaiName;
    $query_kadai = "SELECT * FROM $kadaiName";//QUERY ELEMENTS FROM KADAINAME TABLE
    if(isset($_POST['createTable'])){
        if($_POST['kadaiID'] == ''){
            $idError = "<div class='alert alert-danger' style='text-align: center;'>課題IDが必要です。</div>";
        }else{
            $testID = cleanString($_POST['kadaiID']);
        }
        if($_POST['kadaiName'] == ''){
            $kadaiError = "<div class='alert alert-danger' style='text-align: center;'>課題名が必要です。</div>";
        }else{
            $kadaiName = $_POST['kadaiName'];//例：ip
        }
        
        if( $_POST['kadaiID'] != '' && $_POST['kadaiName'] != ''){
            $teacherID = $_SESSION['teacherID'];//例：k018
            $testTable = "test".$teacherID."_".$testID;//例：testk018_ip
            $tableName = "kadai$teacherID";//例：kadaik018

            $sql = "SELECT testID FROM $tableName WHERE testID = '$testID'";
            $result = mysqli_query($connt,$sql);
            $num_row = mysqli_num_rows($result);
            //echo $num_row;

            if($num_row == 0){
                $sql = "INSERT INTO $tableName VALUES('$testID','$kadaiName')";
                $result = mysqli_query($connt,$sql);
                //$query_f = "CREATE TABLE IF NOT EXISTS $testTable AS SELECT * FROM mondaitb";
                $query_f = "CREATE TABLE IF NOT EXISTS $testTable LIKE mondaitb";
                $query_s = "ALTER TABLE $testTable CHANGE mondaiID mondaiID INT(10) AUTO_INCREMENT PRIMARY KEY";
                mysqli_query($connt,$query_f);
                mysqli_query($connt,$query_s);
            }
            if(file_exists($_FILES['csvfile']['tmp_name'])){ 
                //CSVファイル追加
                if(mysqli_query($connt,"SELECT 1 FROM $testTable")){
                    $handle = fopen($_FILES['csvfile']['tmp_name'],'r');
                    //var_dump($handle);
                    while($csv[] = fgetcsv($handle,"1024")){};
                    mb_convert_variables("UTF-8", "SJIS-win", $csv);
                    for($i=0;$i<count($csv)-1;$i++){
                        $row = $csv[$i];
                        $string = implode("\",\"",$row);
                        $sql = "INSERT INTO $testTable (mondai,kai1,kai2,kai3,kai4,seikaiNum) VALUES(\"{$string}\")";
                        mysqli_query($connt,$sql);
                    }
                    fclose($handle);
                }  
            }
        }
        else{
            $message = "<div class='alert alert-danger' style='text-align: center;'>正しく入力されていません。もう一度入力してください</div>";
        }
    }
    if($result_of_kadai = mysqli_query($connt, $query_kadai)){
        $num_row = mysqli_num_rows($result_of_kadai);
    }//$RESULT_OF_KADAI に格納
    mysqli_close($connt);
?>

<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>TeachogoSample</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="script.js"></script>
    <style>
        .newTable{
            margin: 0 30%;
            border: 1px solid #ff1111;
            border-radius: 5px;
            color: #ff1111;
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <div class="logo"><img src="images/teacherLogo.png" alt="teacherLogo" style='height: 40px;'></div><br>
        <h2 class='tableTitle'>テスト表</h2><br>
        <form class='submitForm' action="mondaiTable.php" id="zenkadai" method="post">
            <div class="contrainer">
                <table class='table-bodered'>
                    <?php
                if($num_row>0){
                    $flag = false;
                    echo "
                            <thread>
                                <tr>
                                <th><input type='checkbox' id='allChecked'></th>
                                <th>テストID</th>
                                <th>テスト名</th>
                                <th>操作ボタン</th>
                                </tr>
                            </thread>";
                    while($row = mysqli_fetch_assoc($result_of_kadai)){
                        echo "
                            <tbody>
                            <tr>
                                <td><input class='check' type='checkbox' name='majors[]' value='{$row['testID']}'></td>
                                <td class='id'>{$row['testID']}</td>
                                <td class='testName'>{$row['testName']}</td>
                                <td><button class='btn btn-success' type='submit' name='select_kadai' value='{$row['testID']}'>更新 <i class='fa fa-file-code-o'></i></button>
                                <button class='btn btn-default' type='submit' name='select_kadai' value='seiseki_{$row['testID']}'>成績 <i class='fa fa-file-excel-o'></i></button></td>
                            </tr>
                            </tbody>
                        ";
                    }
                    mysqli_free_result($result_of_kadai);
                }else {
                    echo "<p class='newTable'>新しいテーブルを作りますか。<br>*****************************</p>";
                    $flag = true;
                }
                ?>
                </table>
                <div class='downButton'><p>+</p></div>
            </div>
            <button class="btn btn-danger" id="deleteHandler" type='submit' name="select_kadai" style="display: none" value="-1">削除</button>
        </form>
        <div id="alertBox">
            <?php
                    if($idError != ''){
                        echo $idError;
                    }
                    if($kadaiError!= ''){
                        echo $kadaiError;
                    }
                    if($message != ''){
                        echo $message;
                    }
                ?>
        </div>
        <form action='<?php $_SERVER['PHP_SELF']?>' method='post' enctype="multipart/form-data" id='fill'>
            <div class='form-group form-toko'>
                <input class='form-control' type='text' name='kadaiID' placeholder='テストID'  autocomplete="off"><br>
                <input class='form-control text' type='text' name='kadaiName' placeholder='テスト名' autocomplete="off"><br>
                <div class="input-group">
                    <label class="input-group-btn">
                        <span class="btn btn-primary">
                            ファイル選択&hellip;<input type="file" name="csvfile" accept=".csv" style="display: none;">
                        </span>
                    </label>
                    <input id="auto-box" type="text" name='readOnly' class="form-control readOnly" readonly>
                </div><br>
                <input class='btn btn-success' type='submit' name='createTable' value="新規作成">
            </div>
        </form>
        <div><a href='../index.php'><button class='btn btn-default'>戻る</button></a></div>
    </div>
</body>

</html>
