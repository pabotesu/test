<?php
    session_start();
	include_once('condb.php');
    include 'operator.php';
    if(!isset($_SESSION['user'])){
        header("Location: ../index.php");
        exit();
    }
    /////////////////////////////変数/////////////////////////////////
    $tnum = NULL;
    if(isset($_POST['number'])){
        $tnum = $_POST['number'];//ボタンの内容を受け取る
    }
    //$testID = $_POST['testID']; //ボタンの内容を受け取る
    if(isset($newArr[$tnum])){
        $userid2 = $newArr[$tnum];
    }
    $teacherID = '';
    $shikenID = '';
    if(isset($_SESSION['teacherID'])){
        $teacherID = $_SESSION['teacherID'];
    }
    if(isset($_SESSION['shikenID'])){
        $shikenID = $_SESSION['shikenID'];
    }
    $testName = "test{$teacherID}_{$shikenID}";
    $message = '';
    //////////////////////////////////////////////////////////////////
    if(!isset($_SESSION['countdown'])){
        //カウントダウンタイムを3600sに設定する
        $_SESSION['countdown'] = 3600;
        $_SESSION['timeStart'] = time();
    }
    //現時点の時間を取得する(timestamp)
    $now = time();
    //経つ時間をはかる
    $timeSince = $now - $_SESSION['timeStart'];
    //残る時間をはかる
    $remainingTime = $_SESSION['countdown'] - $timeSince;
    
    if($remainingTime < 1){
        header("Location: sekaihanntei.php");
        exit();
    }
    /////////////////////////////////////////////////////////////////
    $sikenID = "";
	$title = "{$sikenID}試験";
    $ansnum = array();
    //アイウエの文字
	$aiue = array("ア","イ","ウ","エ");
    $Qnum = $_SESSION['qnum'];
    $randArr = $_SESSION['randArr'];
    if(!isset($_SESSION['user'])){
        header("location: ../index.php");
        exit();
    }
    if(!isset($_SESSION['qnum'])||!isset($_SESSION['num_rows'])
    ||!isset($_SESSION['randArr'])||!isset($_SESSION['tAnsArr'])||!isset($_SESSION['mypoint'])){
        header("location: ../index.php");
        exit();
    }
//////////////////////////////////////////////////////////////////////////
    if(isset($_POST['answer'])){
        if($_POST['answer'] == 0){}
        else{
            $_SESSION['mypoint'][$_SESSION['qnum']] = $_POST['answer'];
        }
    }
    if(isset($_POST['selected'])){
        $Qnum = $_POST['selected'];
        $_SESSION['qnum'] = $Qnum;
    }
//////////////////////////////////////////////////////////////////////////   
	$q = "SELECT mondai FROM {$testName} WHERE mondaiID =".($randArr[$Qnum]);
	$qNum = $Qnum+1;

    $questions = $mysql_test->query($q);

	$tNum = "select seikaiNum FROM {$testName} WHERE mondaiID =".($randArr[$Qnum]);
    foreach ($mysql_test->query($tNum) as $trueAns) {
	   //$trueAnsに答えの番号をDatabaseから取得する
	}
    $kai = "SELECT kai1,kai2,kai3,kai4 FROM {$testName} Where mondaiID =".($randArr[$Qnum]);
    $ans = $mysql_test->query($kai);
    if ($ans->num_rows > 0) {
    // output data of each row
        while($row = $ans->fetch_assoc()) {
            $somnu = array($row['kai1'],$row['kai2'],$row['kai3'],$row['kai4']);
        }
    } else {
        $message = "<div class='alert alert-info' style='text-align: center;'>まだ問題がないようです.
        <button class='btn btn-default'><a href='teachermon.php'>戻る</a></button></div>";
    }
?>
<!DOCTYPE html>
<html lang="ja">
    
    
<head>
<meta charset="utf-8">
<title><?php echo $title?></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<!-- Bootstrap読み込み（スタイリングのため） -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="../../css/1style.css">
<link rel="stylesheet" type="text/css" href="css/testmode.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="js/script.js"></script>
    <script>
        $(document).ready(function(){
            var remainingTime = <?php echo $remainingTime?>;
            var x = setInterval(function(){
                var hours = Math.floor(remainingTime/3600);
                var minutes = Math.floor((remainingTime-hours*3600)/60);
                var seconds = remainingTime%60;
                var str = hours;
                 if(remainingTime < 1){
                     $('#saiten').trigger("submit");
                     return false;
                 }
                remainingTime--;
                $("h3.rTime").text("残り時間："+hours+"時間"+minutes+"分"+seconds+"秒");
            },1000);
        })
    </script>
</head>

<body>
<?php 
    if($message != ''){
        echo $message;
        exit();
    }
?>
<!--***************************メーン画面***********************-->
<div class="wrapper">
        <h2><?php echo $title ?></h2>
        <div><h3 class='rTime'></h3></div>
        <!--問題-->
        <?php
            //問題を表示する
            echo "<p class='mondai'>";
            foreach ($questions as $que) {
               echo "(問".$qNum.") ".$que['mondai']."<br>"; //queに問題の文字列を取得する
            }
            echo "</p>";
        ?>
        <!--*********************** 答えの部分**************************-->
        <div class="kotae">   
        <?php
            //選択を表示する
            if(isset($somnu)){
                for ($i=0;$i<count($somnu);$i++){
                    echo "<p>".$aiue[$i].". ".$somnu[$i]."</p>";
                }
                $qNo = array(1,2,3,4);
            }
        ?>
        </div>
        
        <!--***************************ボタンボックス**********************-->
        <form action="<? echo $_SERVER['PHP_SELF']?>" method='post'>
            <div class="openBobox">問題番号</div>
            <div class="boBox" style="display: none;">
                <?php
                    $mypoint = $_SESSION['mypoint'];
                    $selected = '';
                        for($i=0;$i<count($mypoint);$i++){
                            if($mypoint[$i] != 0){
                                $selected = "selected";
                            }
                            else{
                                $selected = '';
                            }
                            echo "<button type='submit' name='selected' class='boBox-b $selected' value= $i>",$i+1,"</button>";
                        }
                    $flag = $mypoint[$Qnum];
                ?>
                <div class='closeBobox'>x</div>
            </div>
        </form>
        <!--****************************************************************-->
        <div class="kotae-button">
            <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" id="button-submit">
                <?php foreach($qNo as $value){ 
                    if($value == $flag){
                        $class = "class='selected'";
                    }
                    else{
                        $class = "";
                    }
                ?>
                <button <? echo $class ?> type="submit" name="answer" value="<?php echo $value; ?>"><?php echo $aiue[$value-1]; ?></button>
                <?php }?>
            </form>
        </div>

        <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST" class="operation-button">
            <button type="submit" name="back">＜前の問題</button>
            <button type="submit" name="next">次の問題＞</button>
        </form>
        <form id="saiten" action="sekaihanntei.php" method='post' style="text-align: center; margin: 10px;">
            <input type= "submit" name= "seikai" value="採点">
        </form>
    </div>
</body>
</html>
<?
    mysqli_close($mysql_test);
?>