<?php

$disk = $_GET['disk'];
$diskinfo = $_POST['diskinfo'];

$FileName = "DiskInfo/".$disk.".txt";
$fh = fopen($FileName,'w');
fwrite($fh,$diskinfo);
fclose($fh);

echo "<meta http-equiv='refresh' content='0; URL=StatusDataDisk.php'>";

?>
