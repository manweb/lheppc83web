<?php

$database = "runlist_".$_COOKIE['experiment'];
if ($database == "runlist_") {$database = "runlist_xgt";}

// connect with database
$db=mysql_connect("lheppc90.unibe.ch","exodaq","EXOsql");
mysql_select_db("exo");

$cat = 10;

switch($_POST["selectOption"]) {
   case "Normal run":
      $cat = 0;
      break;
   case "Ignore run":
      $cat = 2;
      break;
   case "Calibration run":
      $cat = 1;
      break;
   case "Test run":
      $cat = 3;
      break;
   case "Halted run":
      $cat = 4;
      break;
}

if ($cat != 10 && $_POST["SelectedRun"]) {
   for ($i = 0; $i < count($_POST["SelectedRun"]); $i++) {
      $id = $_POST["SelectedRun"][$i];
      $upd = mysql_query("update $database set category='$cat' where runNumber = '$id'");
   }
}

echo "<meta http-equiv='refresh' content='0; URL=../index.php?page=runlist/runlist.php'>";

?>
