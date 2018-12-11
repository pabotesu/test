<?php
    if(isset($_POST['add'])) {
       echo "user2のinfoIDに登録されました。";
       echo nl2br("\n");
       echo uniqid(rand());
    }
    else if(isset($_POST['remove'])) {
       echo "削除ボタンが押下されました";
    }   
?>
<form action="userset.php" method="post">
    <input type="submit" name="add" value="登録" />
    <input type="submit" name="remove" value="削除" />
</form>


