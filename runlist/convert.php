<?php

$runNb = $_GET["id"];

$homeDir = "/xgt/";
$LibExport = "export LD_LIBRARY_PATH=$LD_LIBRARY_PATH:/home/exodaq/ReadMidas/lib";
$PathExport = "export PATH=$PATH:/home/exodaq/ReadMidas/bin";
$file = $runNb.".mid";

$cmd = "$LibExport; $PathExport; mid2root $homeDir$file";
$outp = shell_exec($cmd);

echo "<meta http-equiv='refresh' content='0; URL=../index.php?page=runlist/runlist.php'>";

?>
