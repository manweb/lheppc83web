<?php

$runID = $_GET['runID'];

// connect with database
$db=mysql_connect("lheppc90.unibe.ch","exodaq","EXOsql");
mysql_select_db("exo");

$result = mysql_query("select max(id) from attachments");
$maxID = mysql_result($result,0);
$ID = $maxID + 1;

$date = date("m.d.Y");
$name = $ID."_".$_FILES["file"]["name"];
$type = $_FILES["file"]["type"];
$size = round($_FILES["file"]["size"] / 1024, 2);
$comment = $_POST['comment'];

echo $name;

if ($_FILES["file"]["error"] > 0) {echo "Return Code: " . $_FILES["file"]["error"] . "<br />";}
else {
   move_uploaded_file($_FILES["file"]["tmp_name"],"../attachments/" . $name);

   $insert = mysql_query("insert into attachments (date, filename, run, type, size, comment, id) values ('$date ', '$name', '$runID', '$type', '$size', '$comment', '$ID')");
}

echo "<meta http-equiv='refresh' content='0; URL=../index.php?page=runlist/rundetails.php&id=$runID'>";

?>
