<?php
// connect with database
$db=mysql_connect("lheppc90.unibe.ch","exodaq","EXOsql");
mysql_select_db("exo");

$result = mysql_query("select max(ID) from issuetracker");
$id = mysql_result($result,0) + 1;

if (!$_POST['DueOn']) {
   $result = mysql_query("select max(CommentID) from issuetracker where ID='$id'");
   $comID = mysql_result($result,0) + 1;
}
else {$comID = 0;}

$current_date = date("Y-m-d");
$current_time = date("H:i:s");
if ($_POST['Project']) {$project = $_POST['Project'];}
else {$project = 0;}
if ($_POST['SubmitBy']) {$name = $_POST['SubmitBy'];}
else {$name = 0;}
if ($_POST['AssignedTo']) {$assigned = $_POST['AssignedTo'];}
else {$assigned = 0;}
if ($_POST['Description']) {$description = $_POST['Description'];}
else {$description = 0;}
$message = $_POST['Message'];
if ($_POST['DueOn']) {$dueOn = $_POST['DueOn'];}
else {$dueOn = 0;}
if ($_POST['Category']) {
   switch ($_POST['Category']) {
      case "Urgent":
         $category = 0;
         break;
      case "Moderate":
         $category = 1;
         break;
    }
}
else {$category = 0;}

$insert = mysql_query("insert into issuetracker (ID, date, time, Project, SubmitBy, AssignedTo, Description, Message, DueOn, category, CommentID) values ('$id', '$current_date', '$current_time', '$project', '$name', '$assigned', '$description', '$message', '$dueOn', '$category', '$comID')");

echo "<meta http-equiv='refresh' content='0; URL=../index.php?page=issuetracker/IssueTracker.php'>";

?>
