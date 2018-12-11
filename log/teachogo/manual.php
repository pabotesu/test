<?php
//////////////////////////////////zipファイルをダウンロード/////////////////////////////////////////////////////
    $yourfile = "teachergoManual.zip";

    $file_name = basename($yourfile);

    header("Content-Type: application/zip");
    header("Content-Disposition: attachment; filename=$file_name");
    header("Content-Length: " . filesize($yourfile));

    readfile($yourfile);
    header("Location: index.php");
?>