<?php
    session_start();
    
    if(!isset($_SESSION['user'])){
        header("Location: ../index.php");
        exit();
    }
    $eranda = '';
    $num = '';
    if(isset($_POST['submittestid'])){
        $num = $_POST['submittestid'];//0,1,2,3...
    }
    $eranda = $_SESSION['erandatestID']; //ip ap fe...
	include_once('condb.php');
    $_SESSION['mypoint'] = array();
    //空っぽの配列宣言
    $newArr = array();
    //乱数の配列
    $randArr = array();
    //$teacherID = $_SESSION['tid'];//teacherのuserid2
    ///////////////////////////////////////////////////////////////
    // if(!isset($_SESSION['teacherID'])){
    //     $_SESSION['teacherID'] = ;
    // }
    $_SESSION['shikenID'] = "{$eranda[$num]}";
    $teacherID = "{$_SESSION['teacherID']}";
    $shikenID = "{$_SESSION['shikenID']}";
    $testName = "test{$teacherID}_".$shikenID;
    
    //echo $testName;
    
    $allQ = "SELECT * FROM {$testName};";
    //echo $allQ;
    if($result_of_allq = mysqli_query($mysql_test,$allQ)){
        while ($row = mysqli_fetch_assoc($result_of_allq))
            {
                array_push($newArr,$row['mondaiID']);
            }
        // Free result set
        mysqli_free_result($result_of_allq);
    }
    // foreach の LOOP　を実行後 $elem をNULLに設定
    unset($elem);

    //出したい問題の数
    //define("MONNUM",20);
    
    //shuffle関数を実行して $randArr にランダムの問題を入れる
    shuffle($newArr);
    //DEBUG--> print_r($newArr);
    
    for($i=0;$i<count($newArr);$i++){
        $randArr[$i] = $newArr[$i];
        array_push($_SESSION['mypoint'],0);
    }
    

    //正解の答えを格納するための配列宣言
    $tAnsArr= array();

    //$randArrの要素に対し　$tAnsArrに　正解の答えを入れていく
    foreach($randArr as &$elem){
        //echo $elem,"<br>";
        $tAnswer = "SELECT seikaiNum FROM {$testName} WHERE mondaiID = ".$elem;
        //echo $tAnswer,"<br>";
        $result = mysqli_query($mysql_test,$tAnswer);
        foreach($result as $value){
           array_push($tAnsArr,$value['seikaiNum']);
        }
    }
    unset($result);
    unset($value);
    
    $_SESSION['randArr'] = $randArr;

    $_SESSION['tAnsArr'] = $tAnsArr;
    
    //ページ移動
    header('location: test.php');
?>
