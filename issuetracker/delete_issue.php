<?php
    
// connect with database
$db=mysql_connect("lheppc90.unibe.ch","exodaq","EXOsql");
mysql_select_db("exo");

$id = $_GET['id'];

$delete = mysql_query("delete from issuetracker where ID='$id'");

echo "<meta http-equiv='refresh' content='0; URL=../index.php?page=issuetracker/IssueTracker.php'>";

?>
