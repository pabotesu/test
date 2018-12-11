<?php
session_start();
include_once 'dbconnect.php';
if(!isset($_SESSION['user'])) {
	header("Location: index.php");
    exit();
}

// ユーザーIDからユーザー名を取り出す
$query = isset($_SESSION['user'])?"SELECT * FROM users WHERE user_id=".$_SESSION['user']:"";
$result = mysqli_query($mysqli, $query);
if (!$result) {
	print('クエリーが失敗しました。'.$mysqli->error);
	$mysqli->close();
	exit();
}

// ユーザー情報の取り出し
while ($row = $result->fetch_assoc()) {
	$userid2 = $row['userid2'];
	$username = $row['username'];
	$email = $row['email'];
    $testnot = $row['testNoT'];//教師学生判定
}
if(!isset($_SESSION['userid2'])){
    $_SESSION['userid2'] = $userid2;
    $_SESSION['username'] = $username;
    $_SESSION['testNot'] = $testnot;
}
if($testnot == 0){
    $hanteiKekka = "学生";
    $teachLicense = "
        <a href='/log/license'><button class='btn btn-primary' style='background-color: darkcyan;'>教師になる？</button></a>
    ";
}
else{
    $hanteiKekka = "教師";
    $teachLicense = "
        <a href='/log/teachogo'><button class='btn btn-primary' style='background-color: darkcyan;'>TeachGO</button></a>
    ";
}
// データベースの切断
$result->close();
?>
    <!DOCTYPE HTML>
    <html lang="ja">

    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>
            <?php echo $username; ?>のプロフィル</title>
        <!-- Bootstrap読み込み（スタイリングのため） -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <!-- Style -->
        <link rel="stylesheet" href="../css/1style.css">
        <link rel="stylesheet" href="cssfile/style.css">
        <link rel="stylesheet" href="cssfile/grago.css">
        <link rel="stylesheet" href="cssfile/monuser.css">
        <script src="../javascript/jquery.min.js"></script>
        <script src="../javascript/jquery-ui-1.10.3.custom.min.js"></script>
        <script src="../javascript/modernizr.custom.min.js"></script>
        <script src="javascript/grago.js"></script>
    </head>

    <body>
        <!--johoGOにようこそ-->
        <div class="welcome-demo">
            <p><img src="../images/logo.png" alt=""><span>Profile</span></p>
        </div>
        <!--*******************************************-->
        <div class="user-title">ユーザーの情報</div>
        <div class="userInfo">
            <div class="userName">
                <h1>ユーザー ID:
                    <u><?php echo $userid2;?></u>
                </h1>
                <div>ユーザー名：
                    <u><?php echo $username; ?></u>
                </div>
                <div>メールアドレス：<span class="joho"><u><?php echo $email;?></u></span></div>
                <div>ライセンス: <?php echo $hanteiKekka ?></div>
                <div><?php echo $teachLicense?><a href='./test-mode'><button class='btn btn-primary' style='background-color: darkcyan;'>テスト</button></a></div>
            </div>
        </div>
        <div class="user-title">結果表
            <?php 
                     $conditions = '';
                     $select = '';
                     if(isset($_POST['selectTuser'])){
                         //ドロップダウンで選択した先生別の点数を出す
                         $choice = $_POST['selectTuser'];
                         $select = $choice;
                         $conditions= "AND `tuserID` = '{$choice}'"; 
                     }
                ?>
                <form id ='selectTeacher' action='<?php $_SERVER['PHP_SELF']?>' method='POST'>
                    <select name='selectTuser' onchange=this.form.submit()>
                        <?php
                            if($select == ''){
                                echo "<option id='selected'>先生のID</option>";
                            }
                            else{
                                echo "<option id='selected'>先生：{$select}</option>";
                            }
                            $sql = "SELECT MIN(seisekiID) as id, tuserID FROM seisekitb WHERE userid2='{$userid2}' GROUP BY tuserID";
                            if($result = mysqli_query($mysqli,$sql)){
                                while($row = mysqli_fetch_assoc($result)){
                                    echo "<option>{$row['tuserID']}</option>";
                                }
                            }
                        ?>
                    </select>
            </div>
        </div>
        <div id="graph-content">
            <div class="charts">
                <?php
                 $sql  = "SELECT sikenid, finaly FROM seisekitb WHERE userid2='{$userid2}'".$conditions;
                 if ($result = $mysqli->query($sql)) {
                  // 連想配列を取得
                while ($row = $result->fetch_assoc()) {
                    echo '<div class="chart">';
                    echo '<div class="circlogo-mask-outer left">';
                    echo '<div class="circlogo-mask-inner">';
                    echo '<div class="circlogo-body"></div></div></div>';
                    echo '<div class="circlogo-mask-outer right">';
                    echo '<div class="circlogo-mask-inner">';
                    echo '<div class="circlogo-body"></div></div></div>';
                    echo '<div class="chart-content">';
                    echo '<p>',$row["sikenid"],'</p>';
                    echo '<p class="text">';
                    echo '<span class="percent-number">',$row["finaly"],'%</span>';
                    echo '</p></div></div>';
                 }
                    // 結果セットを閉じる
                  $result->close();
                 }
             ?>
        </div>
     </div>
        <!--<div class="user-title">選択科目</div>
        <div class="sentaku">
            <div class="image-collection">
                <img src="../images/buttons/IPsel.png">
                <a href='./test-mode'><img src="../images/buttons/FEsel.png"></a>
                <img src="../images/buttons/APsel.png">
            </div>
        </div>-->
        <div style='text-align: center;'><a class="btn btn-primary" href="logout.php?logout">ログアウト</a></div>
    </body>

    </html>
