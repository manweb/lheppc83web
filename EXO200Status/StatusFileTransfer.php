<?php

$LogDir = "../rsynclogs";

$LogFiles = array();

if ($handle = opendir('../rsynclogs')) {
   while (false !== ($file = readdir($handle))) {
      if ($file != "." && $file != "..") {array_push($LogFiles, $file);}
   }

   closedir($handle);
}
else {echo "Could not open directory.";}

echo "<table align='center' border='0' bordercolor='#000000' cellpadding='0' cellspacing='0' style='border-collapse: collapse; ' width='720'>\n";
echo "<tr>\n";
      echo "<td valign='middle' align='left' style='border-color: #A4A4A4; border-left-style: none; border-left-width: 0; border-right-style: none; border-right-width: 0; border-top-style: none; border-top-width: 0; border-bottom-style: solid; border-bottom-width: 1' width='720' height='10' bgcolor='#FFFFFF'><font size='3'>EXO Data Transfer</font>\n";
      echo "</td>\n";
   echo "</tr>\n";
echo "</table>\n";

echo "<table align='center' border='0' bordercolor='#000000' cellpadding='0' cellspacing='0' style='border-collapse: collapse; ' width='720'>\n";
   echo "<tr>\n";
      echo "<td valign='middle' align='left' style='border-color: #A4A4A4; border-left-style: none; border-left-width: 0; border-right-style: none; border-right-width: 0; border-top-style: none; border-top-width: 0; border-bottom-style: solid; border-bottom-width: 1' width='50' height='25' bgcolor='#FFFFFF'><font size='2'><b>Run#</b></font>\n";
      echo "</td>\n";
      echo "<td valign='middle' align='left' style='border-color: #A4A4A4; border-left-style: none; border-left-width: 0; border-right-style: none; border-right-width: 0; border-top-style: none; border-top-width: 0; border-bottom-style: solid; border-bottom-width: 1' width='140' height='25' bgcolor='#FFFFFF'><font size='2'><b>File</b></font>\n";
      echo "</td>\n";
      echo "<td valign='middle' align='left' style='border-color: #A4A4A4; border-left-style: none; border-left-width: 0; border-right-style: none; border-right-width: 0; border-top-style: none; border-top-width: 0; border-bottom-style: solid; border-bottom-width: 1' width='140' height='25' bgcolor='#FFFFFF'><font size='2'><b>Speed</b></font>\n";
      echo "</td>\n";
      echo "<td valign='middle' align='left' style='border-color: #A4A4A4; border-left-style: none; border-left-width: 0; border-right-style: none; border-right-width: 0; border-top-style: none; border-top-width: 0; border-bottom-style: solid; border-bottom-width: 1' width='140' height='25' bgcolor='#FFFFFF'><font size='2'><b>Time remaining\n";
      echo "</td>\n";
      echo "<td valign='middle' align='left' style='border-color: #A4A4A4; border-left-style: none; border-left-width: 0; border-right-style: none; border-right-width: 0; border-top-style: none; border-top-width: 0; border-bottom-style: solid; border-bottom-width: 1' width='140' height='25' bgcolor='#FFFFFF'><font size='2'><b>Data transferred</b></font>\n";
      echo "</td>\n";
      echo "</td>\n";
      echo "<td valign='middle' align='center' style='border-color: #A4A4A4; border-left-style: none; border-left-width: 0; border-right-style: none; border-right-width: 0; border-top-style: none; border-top-width: 0; border-bottom-style: solid; border-bottom-width: 1' width='110' height='25' bgcolor='#FFFFFF'><font size='2'><b>Progress</b></font>\n";
      echo "</td>\n";
   echo "</tr>\n";

for ($i = 0; $i < sizeof($LogFiles); $i++) {
   $CurrentFile = $LogDir."/".$LogFiles[$i];
   //$fh = fopen($CurrentFile, 'r');
   //$theDataTMP = fread($fh, filesize($CurrentFile));
   //fclose($fh);

   $cmd1 = "head -c 100 $CurrentFile";
   $cmd2 = "tail -c -100 $CurrentFile";
   $outp1 = shell_exec($cmd1);
   $outp2 = shell_exec($cmd2);

   preg_match("/[0-9]+/", $LogFiles[$i], $runID);
   $runNr = $runID[0];

   $theData1 = preg_replace("!\s+!", " ", $outp1);
   $theData2 = preg_replace("!\s+!", " ", $outp2);
   $parts1 = explode(' ', $theData1);
   $parts2 = explode(' ', $theData2);

   $size = sizeof($parts2);
   $fName = $parts1[4];
   $time = $parts2[$size-2];
   $rate = $parts2[$size-3];
   $percentage = str_replace('%','',$parts2[$size-4]);
   if ($parts2[$size-5] >= 1024 && $parts2[$size-5] < 1024*1024) {$transferred = sprintf("%.2f kB", $parts2[$size-5] / 1024);}
   elseif ($parts2[$size-5] >= 1024*1024 && $parts2[$size-5] < 1024*1024*1024) {$transferred = sprintf("%.2f MB", $parts2[$size-5] / 1024 / 1024);}
   elseif ($parts2[$size-5] >= 1024*1024*1024) {$transferred = sprintf("%.2f GB", $parts2[$size-5] / 1024 / 1024 / 1024);}
   else {$transferred = sprintf("%.2f B", $parts2[$size-5]);}

   if (strcmp($percentage,"speedup")) {
   echo "<tr>\n";
      echo "<td valign='middle' align='left' style='border-color: #A4A4A4; border-left-style: none; border-left-width: 0; border-right-style: none; border-right-width: 0; border-top-style: none; border-top-width: 0; border-bottom-style: solid; border-bottom-width: 1' width='50' height='25' bgcolor='#FFFFFF'><font size='2'>".$runNr."</font>\n";
      echo "</td>\n";
      echo "<td valign='middle' align='left' style='border-color: #A4A4A4; border-left-style: none; border-left-width: 0; border-right-style: none; border-right-width: 0; border-top-style: none; border-top-width: 0; border-bottom-style: solid; border-bottom-width: 1' width='140' height='25' bgcolor='#FFFFFF'><font size='2'>".$fName."</font>\n";
      echo "</td>\n";
      echo "<td valign='middle' align='left' style='border-color: #A4A4A4; border-left-style: none; border-left-width: 0; border-right-style: none; border-right-width: 0; border-top-style: none; border-top-width: 0; border-bottom-style: solid; border-bottom-width: 1' width='140' height='25' bgcolor='#FFFFFF'><font size='2'>".$rate."</font>\n";
      echo "</td>\n";
      echo "<td valign='middle' align='left' style='border-color: #A4A4A4; border-left-style: none; border-left-width: 0; border-right-style: none; border-right-width: 0; border-top-style: none; border-top-width: 0; border-bottom-style: solid; border-bottom-width: 1' width=140' height='25' bgcolor='#FFFFFF'><font size='2'>".$time."</font>\n";
      echo "</td>\n";
      echo "<td valign='middle' align='left' style='border-color: #A4A4A4; border-left-style: none; border-left-width: 0; border-right-style: none; border-right-width: 0; border-top-style: none; border-top-width: 0; border-bottom-style: solid; border-bottom-width: 1' width='140' height='25' bgcolor='#FFFFFF'><font size='2'>".$transferred."</font>\n";
      echo "</td>\n";
      echo "</td>\n";
      echo "<td valign='middle' align='right' style='border-color: #A4A4A4; border-left-style: none; border-left-width: 0; border-right-style: none; border-right-width: 0; border-top-style: none; border-top-width: 0; border-bottom-style: solid; border-bottom-width: 1' width='110' height='25' bgcolor='#FFFFFF'><img src='ProgressBar.php?p=".$percentage."&label=".$percentage."%&color=0080ff' border='0' align='absmidle'>\n";
      echo "</td>\n";
   echo "</tr>\n";
   }
   else {unlink($CurrentFile);}
}
echo "</table\n";

if (sizeof($LogFiles) == 0) {
echo "<table align='center' border='0' bordercolor='#000000' cellpadding='0' cellspacing='0' style='border-collapse: collapse; ' width='720'>\n";
echo "<tr>\n";
      echo "<td valign='middle' align='center' style='border-color: #A4A4A4; border-left-style: none; border-left-width: 0; border-right-style: none; border-right-width: 0; border-top-style: none; border-top-width: 0; border-bottom-style: none; border-bottom-width: 0' width='720' height='20' bgcolor='#FFFFFF'><font size='2'>Currently no data transfer</font>\n";
      echo "</td>\n";
   echo "</tr>\n";
echo "</table>\n";
}

echo "<meta http-equiv='refresh' content='5; URL=StatusFileTransfer.php'>";

?>
