<?php
$downloadfile = "/xgt/".$_GET["id"];
$filename = $_GET["id"];
$filesize = filesize($downloadfile);

header("Content-Disposition: attachment; filename=$filename");
header("Content-Length: $filesize");

readfile($downloadfile);
exit;
?>
