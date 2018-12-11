<?php
    session_start();
    include_once("condb.php");
    $message = "";
    $userid2 = $_SESSION['userid2'];
    //echo $userid2;
    if(isset($_SESSION['username'])){
        $username = $_SESSION['username'];
    }

    $kadaiTable = "kadai{$userid2}";
    $sqlpass = "SELECT pass FROM himitu";
    $passResult = mysqli_query($student,$sqlpass);
    if($passResult){
        while($row = mysqli_fetch_assoc($passResult)){
            $ninshouPass = $row['pass'];
        }
        mysqli_free_result($passResult);
    }
    
    $sqlnewtable = "CREATE TABLE IF NOT EXISTS {$kadaiTable} LIKE kadai";
    $sqlInsert = "INSERT INTO teacherlist (teacherID,teacherName) VALUES ('{$userid2}','{$username}')";
    $sqlUpdate = "UPDATE users SET testNoT = 1 WHERE userid2 = '{$userid2}'";
    //echo $sqlUpdate;
    //echo $ninshouPass;
    if(isset($_POST['ninshou'])){
        if($_POST['psw'] == $ninshouPass){
            mysqli_query($teachgo,$sqlnewtable);//Teacherdbに新しいテーブルを作成する
            mysqli_query($teachgo,$sqlInsert);//Teacherdbのteacherlistにuserid2を追加する
            mysqli_query($student,$sqlUpdate);//localdbのフラグを立てる
        }
        else{
            $message = "パスワードは違います。正しいパスワードを入力してください!";
        }
    }
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>license</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <style>
        /***************************************************/
        ::-webkit-input-placeholder {
            text-align: center;
        }
        
        :-moz-placeholder { /* Firefox 18- */
           text-align: center;  
        }
        
        ::-moz-placeholder {  /* Firefox 19+ */
           text-align: center;  
        }
        
        :-ms-input-placeholder {  
           text-align: center; 
        }
        /**************************************************/
        body{
            background-color: #f9f1e6;
        }
        .wrapper{
            margin: 10% 20%;
            font-size: 20px;
        }
        header{
            text-align: center;
        }
        img{
            height: 50px;
        }
        img.middle{
            height: 100px;
        }
    </style>
</head>
<body>
    <div class='wrapper'>
        <header>
            <div><img src='../../images/logo.png'><img class='middle' src='https://marketplace.canva.com/MAB5nccL-pw/1/thumbnail/canva-arrow-MAB5nccL-pw.png'>
            <img src='../teachogo/images/teacherLogo.png'></div><hr>
        </header>
        <?php 
            if($message != ""){
                echo "<div style='text-align:center;' class='alert alert-warning'>$message</div>";
            }
        ?>
            <div class="form-group">
              <form action="<? echo $_SERVER['PHP_SELF']?>" method='post'>
                  <div class="col-sm-10">          
                    <input type="password" name ='psw' class="form-control" id="pwd" placeholder="ライセンスキーを入力" name="pwd">
                  </div>
                  <div class="col-sm-1"><input class='btn btn-success' type = 'submit' name='ninshou' value='送信'></div>
              </form>
              <form action='../home.php' method='post'>
                   <div class="col-sm-1"><input class='btn btn-default' type='submit' value='戻る'></div>
              </form>
            </div>
    </div>
    <div class='wrapper'>
            <div class="panel panel-warning">
                <div class="panel-heading" style='text-align: center'>~注意~</div>
                <div class="panel-body">
                    <ol>
                        <li>一度教師になったアカウントは学生には戻れません。</li>
                        <li>問題投稿はCSVファイル形式と手入力のみになります。</li>
                        <li>問題投稿時による著作権の違反等に関しましては、当サイトは一切の責任を負いかねます。</li>
                        <li>間違いのない問題の投稿をお願いします。</li>
                        <li>テストの採点は、(正解数　/　問題数) ×100になります。</li>
                    </ol>
                </div>
            </div>
    </div>
</body>
</html>