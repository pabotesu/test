<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" >
</head>
<title>CSVインポート</title>
<h1>CSVで問題登録できちゃうよ君GO</h1>
<h2>使い方</h2>
<p>１．CSVファイルは問題、答え１、答え２、答え３、答え４、正解の番号、問題の種類（FE・AP・IP・etcいずれか一つ）の順番で記載してください。</p>
<p>２．セル行の改行をすることで新たな問題を追加することができます。</p>
<p>３．作成したcsvファイルを【ファイルを選択】から選択し、【送信】を押下してください。</p>
<p>４．登録が完了するとデータベースに送られた問題数を報告します。</p><br>
<A href="download.php">CSVサンプルはこちら</A>
<form method="post" action="csvinport.php" enctype="multipart/form-data">
<input type="file" name="csvfile" accept=".csv"/><br />
<input type="submit" name="csvsub" value="登録" /><br />
</form>

<?php
//フォームから送られたデータは、$_FILES["csvfile"]["tmp_name"]で受け取ることができる。
$tmp = fopen($_FILES['csvfile']['tmp_name'], "r");

while ($csv[] = fgetcsv($tmp, "1024")) {}
//fopen()関数で、ファイルを開く。"r"というのは「読み込み専用」という指示です。
//ここで2次元配列にする。fgetcsv()関数により、csvデータを読み込む。

mb_convert_variables("UTF-8", "SJIS-win", $csv);
//文字化け防止のため、UTF-8に変換する// 配列 $csv の文字コードをSJIS-winからUTF-8に変換


$lim = count($csv);//for文で読み込むために、配列の最大行数を出す

for($i=0; $i<=$lim; $i++){
if($i < ($lim-1)){
$ar = $csv[$i];
$aaa = implode("\",\"", $ar);
//echo $aaa,"\n";

//DB接続
$host = "127.0.0.1:53105";
$mysql_user = "azure";
$mysql_password = "6#vWHD_$";
$db = "localdb";
$tb = "mondaitb";

$cn = mysql_connect($host,$mysql_user,$mysql_password);
if(!$cn){
    die("db connect Error");
}
if(!(mysql_select_db("$db"))){
    die("db select error");
}
$sqlcon += 1;
mysql_query('SET NAMES UTF8');
$sql = "INSERT INTO mondaitb(mondai,kai1,kai2,kai3,kai4,seikaiNum,sikenID) VALUES(\"$aaa\");";
print "$sqlcon 問目を登録しました。<br />";

$query = mysql_query($sql);
mysql_close($cn);
}
}

?>