<?php
//パス
$fpath = 'CSVSample.csv';
//ファイル名
$fname = 'CSVSample.csv';

header('Content-Type: application/force-download');
header('Content-Length: '.filesize($fpath));
header('Content-disposition: attachment; filename="'.$fname.'"');
readfile($fpath);
?>