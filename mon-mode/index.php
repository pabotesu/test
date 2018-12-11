<?php
	session_start();
	include_once('condb.php');
	if(!isset($_SESSION['qnum'])){
        $_SESSION['qnum']=0;
    }
    //next,backとresetとの操作設定
    $allq = "SELECT mondai FROM mondaitb";
    $result_of_allq = $mysql_test->query($allq);
    $num_rows = $result_of_allq->num_rows;
    if(isset($_POST['next'])){
        $_SESSION['qnum']++;
        if($_SESSION['qnum']>$num_rows-1){
            $_SESSION['qnum']= 0;
        }
    }
    if(isset($_POST['back'])){
        $_SESSION['qnum']--;
        if($_SESSION['qnum']<0){
            $_SESSION['qnum']= $num_rows-1;
        }
    }
    if(isset($_POST['reset'])){
	   session_destroy();
       $_SESSION['qnum']=0;
    }
	$title = "問題モード";
    //アイウエの文字
	$aiue = array("ア","イ","ウ","エ");
    
	$q = "SELECT mondai FROM mondaitb WHERE mondaiID =" .($_SESSION['qnum']+1);
	$qNum = $_SESSION['qnum']+1;
    $questions = $mysql_test->query($q);
	$tNum = "select seikaiNum FROM mondaitb WHERE mondaiID =".($_SESSION['qnum']+1);
    foreach ($mysql_test->query($tNum) as $trueAns) {
	   //$trueAnsに答えの番号をDatabaseから取得する
	}
    $kai = "SELECT kai1,kai2,kai3,kai4 FROM mondaitb WHERE mondaiID =" .($_SESSION['qnum']+1);
    $ans = $mysql_test->query($kai);
    if ($ans->num_rows > 0) {
    // output data of each row
        while($row = $ans->fetch_assoc()) {
            $somnu = array($row['kai1'],$row['kai2'],$row['kai3'],$row['kai4']);
        }
    } else {
         echo "0 results";
    }
    $ans -> close();
?>
<!doctype html>
<html>
    
    
<head>
<meta charset="utf-8">
<title><?php echo $title?></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" type="text/css" href="../css/1style.css">
<link rel="stylesheet" type="text/css" href="css/testmode.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>

<body><!--コーナー背景-->
<div class="welcome-demo">
    <p><img src="../images/logo.png" alt=""><span><?php echo $title?></span></p>
</div>
<div><img src='marubatu/maru.png' alt='' id='maru' style='display:none;'></div>
<div><img src='marubatu/batu.png' alt='' id='batu' style='display:none;'></div>

<!--***************************メーン画面***********************-->
<div class="wrapper">
    <h2><?php echo $title ?></h2>
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
    for ($i=0;$i<count($somnu);$i++){
        echo "<p>".$aiue[$i].". ".$somnu[$i]."</p>";
    }
    $qNo = array(1,2,3,4);
?>
</div>
<div class="kotae-button">
    <?php foreach($qNo as $value){ ?>
          <button name="answers" value="<?php echo $value; ?>" onclick="checkAns($(this).val())"><?php echo $aiue[$value-1]; ?></button>
    <?php }?>
</div>

<form action="" method="POST" class="operation-button">
   <button type="submit" name="back">＜前の問題</button>
   <input  type="submit" name="reset" value="リセット">
   <button type="submit" name="next">次の問題＞</button>
</form>
<form action="" method="POST">
    <input type="submit" name="next" value="次の問題" style="display:none;">
</form>


<?php 
    $x = $trueAns['seikaiNum'];
    echo "<p id='ansChar' style='display:none;'>".$x."</p>";
?>
<script>
     var jval = parseInt($("#ansChar").text());
     function checkAns(value){
         if(value == jval){
             $("#maru").fadeIn("slow").fadeOut("slow");
         }
         else{
             $("#batu").fadeIn("slow").fadeOut("slow");
         }
         $('html, body').animate({scrollTop: 0});
     }
    $loading = $("button[type='submit']");
    
</script>
</div>
<p style='text-align: center;' class="topmodoru"><a href="https://allheartit.azurewebsites.net">トップページに戻る</a></p>



<!--WikideGO接続部分-->
<div id="Mon">
    <button><img src="marubatu/wikidego.png"></button>
</div>
<button id="hideShow" style="display:none;">検索</button>
<iframe id="Wikidego" src="../Wikidego/wikidego.php"></iframe>
<script> 
<!--送信する内容-->
$(function() {
     function selStr(){       
          var SelStr = document.getSelection();
          var Msg =String(SelStr);
          <!-- Webストレージに選択文字列を保存 -->
          window.sessionStorage.Msg_key = Msg;
          <!-- WikideGOに送信 -->
          document.getElementById('Wikidego').contentWindow.Wikidego();
     }
    $("#hideShow").click(function(){
        selStr();
    })
    $(document).on('click', '#Mon button', function() {
        
        $('iframe').toggle(function(){
            $(this).removeClass("hideShow");
        },function(){
            $(this).addClass("hideShow");
        });
        
        $('#hideShow').toggle(function(){
            $(this).removeClass("hideShow");
        },function(){
            $(this).addClass("hideShow");
        });
        
        selStr();
    });
});


</script>


</body>
</html>