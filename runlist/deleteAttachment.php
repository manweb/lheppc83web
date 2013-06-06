<?php

// connect with database
$db=mysql_connect("lheppc90.unibe.ch","exodaq","EXOsql");
mysql_select_db("exo");

$ID = $_GET['id'];
$page = $_GET['page'];
$runID = $_GET['runID'];

$result = mysql_query("select filename from attachments where id = '$ID'");
$FileName = mysql_result($result,0);

unlink("../attachments/".$FileName);

$delete = mysql_query("delete from attachments where id = '$ID'");

echo "<meta http-equiv='refresh' content='0; URL=../index.php?page=$page&id=$runID'>";

?>
