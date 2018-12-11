<?php 
	if(!isset($_SESSION['qnum'])){
        $_SESSION['qnum']=0;
    }
    //next,backとresetとの操作設定
    $_SESSION['num_rows'] = count($_SESSION['randArr']);

    if(isset($_POST['next'])){
        $_SESSION['qnum']++;
        $_SESSION['qnum'] %= $_SESSION['num_rows'];
    }
    if(isset($_POST['back'])){
        $_SESSION['qnum']--;
        if($_SESSION['qnum']<1){
            $_SESSION['qnum'] = $_SESSION['num_rows']-1;
        }
    }
?>