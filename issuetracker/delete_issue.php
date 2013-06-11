<?php

$id = $_GET['id'];

$delete = mysql_query("delete from issuetracker where ID='$id'");

echo "<meta http-equiv='refresh' content='0; URL=../index.php?page=issuetracker/IssueTracker.php'>";

?>
