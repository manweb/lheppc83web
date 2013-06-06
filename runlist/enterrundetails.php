<?php

// connect with database
$db=mysql_connect("lheppc90.unibe.ch","exodaq","EXOsql");
mysql_select_db("exo");

$inppressure = $_POST["Inputpressure"];
$inpgridVolt = $_POST["InputgridVolt"];
$inpcathodeVolt = $_POST["InputcathodeVolt"];
$inpfirstRingVolt = $_POST["InputfirstRingVolt"];
$inpleakagaCurrent = $_POST["InputleakagaCurrent"];
$inpnotes = $_POST["Inputnotes"];
$inpid = $_POST["Inputid"];

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

if ($_POST["selectOption"] != "") {
   $upd = mysql_query("update runlist set pressure='$inppressure', gridVolt='$inpgridVolt', cathodeVolt='$inpcathodeVolt', firstRingVolt='$inpfirstRingVolt', leakageCurrent='$inpleakagaCurrent', notes='$inpnotes', category='$cat' where runNumber = '$inpid'");
}
else {
   $upd = mysql_query("update runlist set pressure='$inppressure', gridVolt='$inpgridVolt', cathodeVolt='$inpcathodeVolt', firstRingVolt='$inpfirstRingVolt', leakageCurrent='$inpleakagaCurrent', notes='$inpnotes' where runNumber = '$inpid'");
}

echo "<meta http-equiv='refresh' content='0; URL=../index.php?page=runlist/runlist.php'>";

?>
