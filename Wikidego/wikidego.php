<?php

// 初期化処理 ================================================================
define('INTERNAL_ENCODING', 'UTF-8');
mb_internal_encoding(INTERNAL_ENCODING);
mb_regex_encoding(INTERNAL_ENCODING);
define('MYSELF', basename($_SERVER['SCRIPT_NAME']));
define('REFERENCE', 'http://www.pahoo.org/e-soul/webtech/php06/php06-03-01.shtm');

//プログラム・タイトル


/**
 * リリース・フラグ
 * @global bool $Flag_release TRUE/FALSE（公開時にはTRUEにすること）
 */
$Flag_release = FALSE;

/**
 * 共通HTMLヘッダ
 * @global string $HtmlHeader
 */
$encode     = INTERNAL_ENCODING;
$title      = "Wiki de GO";
$HtmlHeader = <<< EOD
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="{$encode}">
<title>{$title}</title>
<link rel="stylesheet" href="kaiwa.css" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="author" content="studio pahoo" />
<meta name="copyright" content="studio pahoo" />
<meta name="ROBOTS" content="NOINDEX,NOFOLLOW" />
<meta http-equiv="pragma" content="no-cache">
<meta http-equiv="cache-control" content="no-cache">
<script src="../javascript/jquery.min.js"></script>


<!--問題モードから選択検索したい時専用-->
<script>
function Wikidego() {
	var Msg = window.sessionStorage["Msg_key"];	
	document.myform.query.value= Msg;
	document.myform.submit();
}
</script>

<!--WikideGO内で選択検索したい時専用-->
<script>
function SelectedMoji(){
	var SelStr = document.getSelection();
	var Msg =String(SelStr);
	document.myform.query.value= Msg;
	if(Msg != ""){
		$('.hideShow').show();
	}
	else{
		$('.hideShow').hide();
	}
}
	document.addEventListener("selectionchange", SelectedMoji);
</script>
</head>



		
		
		
		
		
EOD;

/**
 * 共通HTMLフッタ
 * @global string $HtmlFooter
 */
$HtmlFooter = <<< EOD
</html>

EOD;

// サブルーチン ==============================================================
/**
 * エラー処理ハンドラ
 */
function myErrorHandler($errno, $errmsg, $filename, $linenum, $vars)
{
				echo "Sory, system error occured !";
				exit(1);
}
error_reporting(E_ALL);
if ($Flag_release)
				$old_error_handler = set_error_handler("myErrorHandler");

/**
 * PHP5以上かどうか検査する
 * @return	bool TRUE：PHP5以上／FALSE:PHP5未満
 */
function isphp5over()
{
				$version = explode('.', phpversion());
				
				return $version[0] >= 5 ? TRUE : FALSE;
}

/**
 * 指定したパラメータを取り出す
 * @param	string $key  パラメータ名（省略不可）
 * @param	bool   $auto TRUE＝自動コード変換あり／FALSE＝なし（省略時：TRUE）
 * @param	mixed  $def  初期値（省略時：空文字）
 * @return	string パラメータ／NULL＝パラメータ無し
 */
function getParam($key, $auto = TRUE, $def = '')
{
				if (isset($_GET[$key]))
								$param = $_GET[$key];
				else if (isset($_POST[$key]))
								$param = $_POST[$key];
				else
								$param = $def;
				if ($auto)
								$param = mb_convert_encoding($param, INTERNAL_ENCODING, 'auto');
				return $param;
}

/**
 * Wikipedia API のURLを取得する
 * @param	string $query   検索語
 * @return	string URL
 */
function getURL_wikipediaAPI($query)
{
				$query = urlencode($query); //検索語
				$res   = "http://wikipedia.simpleapi.net/api?keyword=$query&output=xml";
				return $res;
}

/**
 * 指定XMLファイルを読み込んでDOMを返す
 * @param	string $xml XMLファイル名
 * @return	object DOMオブジェクト／NULL 失敗
 */
function read_xml($xml)
{
				if (isphp5over())
								return NULL;
				if (($fp = fopen($xml, "r")) == FALSE)
								return NULL;
				
				//いったん変数に読み込む
				$str = fgets($fp);
				$str = preg_replace("/UTF-8/", "utf-8", $str); //コーディング文字の置換
				
				while (!feof($fp)) {
								$str = $str . fgets($fp);
				}
				fclose($fp);
				//DOMを返す
				$dom = domxml_open_mem($str);
				if ($dom == NULL) {
								echo "\n>Error while parsing the document - " . $xml . "\n";
								exit(1);
				}
				return $dom;
}

/**
 * Wikipedia APIから必要な情報を配列に格納する
 * @param	array  $items   情報を格納する配列
 * @param	array  $query   検索語
 * @return	int ヒット数
 */
function getResults(&$items, $query)
{
				//受信データの要素名
				$tbl = array(
								'language', //言語；現在は'ja'固定
								'id', //Wikipediaの管理ID
								'url', //Wikipedia本文のURL
								'title', //見出し語
								'body', //ダイジェスト文の長さ
								'length', //ダイジェスト文の長さ
								'redirect', //別のキーワードへのリダイレクトがあるか
								'strict', //1：見出し語と完全一致，0：部分一致
								'datetime' //更新日時
				);
				
				$url = getURL_wikipediaAPI($query); //リクエストURL
				
				//PHP4用; DOM XML利用
				if (isphp5over() == FALSE) {
								if (($dom = read_xml($url)) == NULL)
												return FALSE;
								$resultset = $dom->get_elements_by_tagname("results");
								$results   = $resultset[0]->get_elements_by_tagname("result");
								//検索結果取りだし
								$cnt       = 1;
								foreach ($results as $element) {
												foreach ($tbl as $name) {
																$node = $element->get_elements_by_tagname($name);
																if ($node != NULL) {
																				$items[$cnt][$name] = $node[0]->get_content();
																}
												}
												$cnt++;
								}
								
								//PHP5用; SimpleXML利用
				} else {
								$results = simplexml_load_file($url);
								//レスポンス・チェック
								if (isset($results->result) == FALSE)
												return FALSE;
								//検索結果取りだし
								$cnt = 1;
								foreach ($results->result as $element) {
												foreach ($tbl as $name) {
																if (isset($element->$name)) {
																				$items[$cnt][$name] = $element->$name;
																}
												}
												$cnt++;
								}
				}
				
				return ($cnt - 1);
}

/**
 * HTML BODYを作成する
 * @param	string $query 検索キーワード
 * @param	array  $items 検索結果
 * @return	string HTML BODY
 */
function makeCommonBody($query, $items)
{
				global $Flag_release;
				$myself = MYSELF;
				$refere = REFERENCE;
				
				// $p_title = $TITLE;
				
				if (!$Flag_release) {
								$phpver = phpversion();
								if (!isphp5over()) {
												$enable = 'DOM XML : ';
												$enable .= function_exists('domxml_open_mem') ? 'enabled' : 'disable';
								} else {
												$enable = 'SimpleXML : ';
												$enable .= function_exists('simplexml_load_file') ? 'enabled' : 'disable';
								}
								$url = getURL_wikipediaAPI($query);
								$msg = <<< EOT
		
		
<!--自分が送信した内容-->	
<div class="kaiwa">
 <div class="kaiwa-text-left">
  <p class="kaiwa-text">
   キーワード：<b>$query</b>
  </p>
 </div>
</div>
			

<dl>

EOT;
				} else {
								$msg = '';
				}
				
				$i   = 1;
				$res = '';
				foreach ($items as $item) {
								$res .= <<< EOT
	
<!--Wiki de Go側の返信-->			
<div class="kaiwa">
	<div class="kaiwa-text-right">
		<p class="kaiwa-text">
		<dt>{$i} : <a href="{$item['url']}"><b>{$item['title']}</b></a>
			<dd>{$item['body']}</dd>
		</p>
	</div>
</div>


EOT;
								$i++;
								
				}
				
				$body = <<< EOT
				
				    <script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
    <script src="fakeLoader.min.js"></script>
<body>
<div id="fakeLoader"></div>

<form name="myform" method="post" action="{$myself}" enctype="multipart/form-data">
<input style="display:none" type="text" name="query" id="query" value="{$query}" />
<input class="hideShow" type="submit" name="execute" value="検索"/>




</form>
<p>{$msg}</p>
</div>
{$res}
</body>

EOT;
				return $body;
}

// メイン・プログラム =======================================================
$query = getParam('query', TRUE, '');
$items = array();
if ($query != '') {
				$n = getResults($items, $query); //検索実行
} else {
				$n = 0;
}
$HtmlBody = makeCommonBody($query, $items);

// 表示処理
echo $HtmlHeader;
echo $HtmlBody;
echo $HtmlFooter;


?>
