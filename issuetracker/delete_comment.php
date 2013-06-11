<?php

// connect with database
$db=mysql_connect("lheppc90.unibe.ch","exodaq","EXOsql");
mysql_select_db("exo");

$id = $_GET['id'];
$comID = $_GET['comID'];

$delete = mysql_query("delete from issuetracker where ID='$id' and CommentID='$comID'");

echo "<meta http-equiv='refresh' content='0; URL=../index.php?page=issuetracker/IssueTracker.php'>";

?>
