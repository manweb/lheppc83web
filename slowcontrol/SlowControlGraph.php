<?php

$graphTitle = $_GET["title"];

echo "<html>";
echo "<head>";
echo "<title>SlowControl - ".$graphTitle."</title>";
echo "</head>";

echo "<body>";

if ($_POST["plotOption"] == "nHours" || $_GET["nHours"]) {
   if ($_POST["plotOption"] == "nHours") {$nhours = $_POST["hours"];}
   else {$nhours = $_GET["nHours"];}
   $tStart = time() - $nhours * 3600 - 3600; // subtract one hour to convert from MESZ to UTC
   $tEnd = time() - 3600; // subtract one hour to convert from MESZ to UTC
}
else {
   $tStart = mktime($_POST["startHour"] - 1,$_POST["startMinute"],$_POST["startSecond"],$_POST["startMonth"],$_POST["startDay"],$_POST["startYear"]);
   $tEnd = mktime($_POST["endHour"] - 1,$_POST["endMinute"],$_POST["endHour"],$_POST["endMonth"],$_POST["endDay"],$_POST["endYear"]);
}

if ($_POST["variable"]) {$var = $_POST["variable"];}
else {$var = $_GET["variable"];}

echo "<img src='Graph.php?start=$tStart&end=$tEnd&variable=$var'>";

if ($_POST["plotOption"] == "nHours" || $_GET["nHours"]) {echo "<meta http-equiv='refresh' content='30; URL=SlowControlGraph.php?title=$graphTitle&nHours=$nhours&variable=$var'>";}

echo "</body>";
echo "</html>";

?>
