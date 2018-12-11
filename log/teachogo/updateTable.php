<?php 
    session_start();
    error_reporting(E_ALL);
    include_once("condb.php");


    $tableName = $_SESSION['tablename'];
/////////////////////////$_SEVER['PHP_SELF']からの$_POST['updateTable'])////////////
    if(isset($_POST['updateTable'])){
        //SQLインジェクション防止
        $mondai = mysqli_real_escape_string($connt,$_POST['mondai']);
        $mondaiID = mysqli_real_escape_string($connt,$_POST['editMondai']);
        $kai1 = mysqli_real_escape_string($connt,$_POST['kai1']);
        $kai2 = mysqli_real_escape_string($connt,$_POST['kai2']);
        $kai3 = mysqli_real_escape_string($connt,$_POST['kai3']);
        $kai4 = mysqli_real_escape_string($connt,$_POST['kai4']);
        $seikaiNum = $_POST['seikaiNum'];
        $sql = "UPDATE $tableName SET mondai = '{$mondai}', kai1 = '{$kai1}', kai2 = '{$kai2}', kai3 = '{$kai3}', kai4 = '{$kai4}', seikaiNum = {$seikaiNum} WHERE mondaiID = {$mondaiID}";
        mysqli_query($connt,$sql);
        //echo $sql;
    }

/////////////////////////////////////////////////////////////////////////////////
    if(isset($_POST['insert'])){
        unset($_POST['delete']);
        $postName = 'insertInto';
        $mondai = '';
        $mondaiID = '';
        $kai1 = '';
        $kai2 = '';
        $kai3 = '';
        $kai4 = '';
        $seikaiNum = '';
        $value = '追加';
    }
    if(isset($_POST['insertInto'])){
        $mondai = mysqli_real_escape_string($connt,$_POST['mondai']);
        $mondaiID = mysqli_real_escape_string($connt,$_POST['editMondai']);
        $kai1 = mysqli_real_escape_string($connt,$_POST['kai1']);
        $kai2 = mysqli_real_escape_string($connt,$_POST['kai2']);
        $kai3 = mysqli_real_escape_string($connt,$_POST['kai3']);
        $kai4 = mysqli_real_escape_string($connt,$_POST['kai4']);
        $seikaiNum = $_POST['seikaiNum'];
        $sql = "INSERT INTO $tableName (mondai,kai1,kai2,kai3,kai4,seikaiNum) VALUES ('{$mondai}','{$kai1}','{$kai2}','{$kai3}','{$kai4}',{$seikaiNum})";
        mysqli_query($connt,$sql);
        header("Location: mondaiTable.php");
        exit();
    }
///////////////////////mondaiTable.phpからの$_POST['editMondai']///////////////////
    if(isset($_POST['editMondai'])){
        if($_POST['editMondai'] != -1){
            //$_POST['editMondai] = -1の場合はチェックされた項目を削除
            unset($_POST['delete']);
        }
        $postName = 'updateTable';
        $value = '保存';
        //echo $_POST['editMondai'],'<br>';
        $mondaiID = $_POST['editMondai'];
        $sql = "SELECT * FROM $tableName WHERE mondaiID = $mondaiID";
        $result = mysqli_query($connt,$sql);
        if($result){
            while( $row = mysqli_fetch_assoc($result) ){
                $mondai = $row['mondai'];
                $kai1 = $row['kai1'];
                $kai2 = $row['kai2'];
                $kai3 = $row['kai3'];
                $kai4 = $row['kai4'];
                $seikaiNum = $row['seikaiNum'];
            }
        mysqli_free_result($result);
        }
    }
/////////////////////////mondaiTable.phpからの$_POST['delete']/////////////////////
    if(isset($_POST['delete'])){
        /////////////////////////////////////////////////////////////////
        $delIndex = $_POST['delete'];
        for($i=0;$i<count($delIndex);$i++){
            $delQuery = "DELETE FROM $tableName WHERE mondaiID = {$delIndex[$i]}";
            mysqli_query($connt,$delQuery);
        }
        $dropMondaiID = "ALTER TABLE $tableName DROP mondaiID";
        mysqli_query($connt,$dropMondaiID);
        //mondaiIDの順番を並びなおす
        $reArrange = "ALTER TABLE $tableName ADD mondaiID INT(10) NOT NULL AUTO_INCREMENT PRIMARY KEY FIRST";
        mysqli_query($connt,$reArrange);
        /////////////////////////////////////////////////////////////////
        header("Location: mondaiTable.php");
        mysqli_close($connt);
        exit();
    }
    mysqli_close($connt);
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>updateTable</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="script.js"></script>
</head>
<body>
    <div class="wrapper">
      <form action="<?php $_SERVER['PHP_SELF'] ?>" method='post'>
          <div class="form-group">
              <label for="mondai">問題<?php echo $mondaiID ?></label>
              <textarea class='form-control' rows='5' id='mondai' name='mondai'><?php echo $mondai?></textarea><br>
              <label for='kai1'>回答1</label>
              <textarea class='form-control' rows='5' id='kai1' name='kai1'><?php echo $kai1?></textarea><br>
              <label for='kai2'>回答2</label>
              <textarea class='form-control' rows='5' id='kai2' name='kai2'><?php echo $kai2?></textarea><br>
              <label for='kai3'>回答3</label>
              <textarea class='form-control' rows='5' id='kai3' name='kai3'><?php echo $kai3?></textarea><br>
              <label for='kai4'>回答4</label>
              <textarea class='form-control' rows='5' id='kai4' name='kai4'><?php echo $kai4?></textarea><br>
              <label class='monBan'>正解番号</label><br>
              <input type='number' name='seikaiNum' value='<?php echo $seikaiNum?>' min= '1' max = '4'>
              <input type='hidden' name='editMondai' value='<?php echo $mondaiID ?>'>
              <input class='btn btn-success' type='submit' name='<?php echo $postName?>' value='<?php echo $value?>' style='float: right' disabled>
          </div>
      </form> 
        <form id="modoru" action="mondaiTable.php" method="post">
           <input class="btn btn-default" type="submit" value="戻る">
        </form>
    </div>
</body>
</html>
