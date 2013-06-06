<?php

$cmd = "df -H | grep '/EXO200Data/'";
$outp = shell_exec($cmd);

preg_match_all('/\/dev\/.+/', $outp, $DiskInfoALL);

echo "<table align='center' border='0' bordercolor='#000000' cellpadding='0' cellspacing='0' style='border-collapse: collapse; ' width='720'>\n";
echo "<tr>\n";
      echo "<td valign='middle' align='left' style='border-color: #A4A4A4; border-left-style: none; border-left-width: 0; border-right-style: none; border-right-width: 0; border-top-style: none; border-top-width: 0; border-bottom-style: solid; border-bottom-width: 1' width='720' height='10' bgcolor='#FFFFFF'><font size='3'>EXO Data Disks</font>\n";
      echo "</td>\n";
   echo "</tr>\n";
echo "</table>\n";

echo "<table align='center' border='0' bordercolor='#000000' cellpadding='0' cellspacing='0' style='border-collapse: collapse; ' width='720'>\n";
   echo "<tr>\n";
      echo "<td valign='middle' align='left' style='border-color: #A4A4A4; border-left-style: none; border-left-width: 0; border-right-style: none; border-right-width: 0; border-top-style: none; border-top-width: 0; border-bottom-style: solid; border-bottom-width: 1' width='160' height='25' bgcolor='#FFFFFF'><font size='2'><b>Disk</b></font>\n";
      echo "</td>\n";
      echo "<td valign='middle' align='left' style='border-color: #A4A4A4; border-left-style: none; border-left-width: 0; border-right-style: none; border-right-width: 0; border-top-style: none; border-top-width: 0; border-bottom-style: solid; border-bottom-width: 1' width='80' height='25' bgcolor='#FFFFFF'><font size='2'><b>Size</b></font>\n";
      echo "</td>\n";
      echo "<td valign='middle' align='left' style='border-color: #A4A4A4; border-left-style: none; border-left-width: 0; border-right-style: none; border-right-width: 0; border-top-style: none; border-top-width: 0; border-bottom-style: solid; border-bottom-width: 1' width='80' height='25' bgcolor='#FFFFFF'><font size='2'><b>Available</b></font>\n";
      echo "</td>\n";
      echo "<td valign='middle' align='left' style='border-color: #A4A4A4; border-left-style: none; border-left-width: 0; border-right-style: none; border-right-width: 0; border-top-style: none; border-top-width: 0; border-bottom-style: solid; border-bottom-width: 1' width='80' height='25' bgcolor='#FFFFFF'><font size='2'><b>Used</b></font>\n";
      echo "</td>\n";
      echo "<td valign='middle' align='left' style='border-color: #A4A4A4; border-left-style: none; border-left-width: 0; border-right-style: none; border-right-width: 0; border-top-style: none; border-top-width: 0; border-bottom-style: solid; border-bottom-width: 1' width='190' height='25' bgcolor='#FFFFFF'><font size='2'><b>Notes</b></font>\n";
      echo "</td>\n";
      echo "</td>\n";
      echo "<td valign='middle' align='right' style='border-color: #A4A4A4; border-left-style: none; border-left-width: 0; border-right-style: none; border-right-width: 0; border-top-style: none; border-top-width: 0; border-bottom-style: solid; border-bottom-width: 1' width='110' height='25' bgcolor='#FFFFFF'><font size='2'><b></b></font>\n";
      echo "</td>\n";
      echo "<td valign='middle' align='center' style='border-color: #A4A4A4; border-left-style: none; border-left-width: 0; border-right-style: none; border-right-width: 0; border-top-style: none; border-top-width: 0; border-bottom-style: none; border-bottom-width: 0' width='20' height='25' bgcolor='#FFFFFF'><font size='2'><b></b></font>\n";
      echo "</td>\n";
   echo "</tr>\n";

for ($i = 0; $i < sizeof($DiskInfoALL[0]); $i++) {
   preg_match_all('/[\/a-zA-Z0-9\.:_\%]+(\s+|$)/',$DiskInfoALL[0][$i],$DiskInfo);

   $device = str_replace(' ','',$DiskInfo[0][0]);
   $size = str_replace(' ','',$DiskInfo[0][1]);
   $used = str_replace(' ','',$DiskInfo[0][2]);
   $available = str_replace(' ','',$DiskInfo[0][3]);
   $percentageTMP = str_replace(' ','',$DiskInfo[0][4]);
   $percentage = str_replace('%','',$percentageTMP);
   $disk = str_replace(' ','',$DiskInfo[0][5]);

   preg_match_all('/sd.1/',$device,$deviceName);

   $FileName = "DiskInfo/".$deviceName[0][0].".txt";
   $fh = fopen($FileName,'r');
   $DiskInfo = fread($fh,filesize($FileName));
   fclose($fh);

   echo "<tr>\n";
      echo "<td valign='middle' align='left' style='border-color: #A4A4A4; margin-top: 2; margin-bottom: 2; border-left-style: none; border-left-width: 0; border-right-style: none; border-right-width: 0; border-top-style: none; border-top-width: 0; border-bottom-style: solid; border-bottom-width: 1' width='180' height='25' bgcolor='#FFFFFF'><font size='2'>".$disk."</font>\n";
      echo "</td>\n";
      echo "<td valign='middle' align='left' style='border-color: #A4A4A4; margin-top: 2; margin-bottom: 2; border-left-style: none; border-left-width: 0; border-right-style: none; border-right-width: 0; border-top-style: none; border-top-width: 0; border-bottom-style: solid; border-bottom-width: 1' width='80' height='25' bgcolor='#FFFFFF'><font size='2'>".$size."</font>\n";
      echo "</td>\n";
      echo "<td valign='middle' align='left' style='border-color: #A4A4A4; margin-top: 2; margin-bottom: 2; border-left-style: none; border-left-width: 0; border-right-style: none; border-right-width: 0; border-top-style: none; border-top-width: 0; border-bottom-style: solid; border-bottom-width: 1' width='80' height='25' bgcolor='#FFFFFF'><font size='2'>".$available."</font>\n";
      echo "</td>\n";
      echo "<td valign='middle' align='left' style='border-color: #A4A4A4; margin-top: 2; margin-bottom: 2; border-left-style: none; border-left-width: 0; border-right-style: none; border-right-width: 0; border-top-style: none; border-top-width: 0; border-bottom-style: solid; border-bottom-width: 1' width='80' height='25' bgcolor='#FFFFFF'><font size='2'>".$used."</font>\n";
      echo "</td>\n";
      echo "<td valign='middle' align='left' style='border-color: #A4A4A4; margin-top: 2; margin-bottom: 2; border-left-style: none; border-left-width: 0; border-right-style: none; border-right-width: 0; border-top-style: none; border-top-width: 0; border-bottom-style: solid; border-bottom-width: 1' width='190' height='25' bgcolor='#FFFFFF'><font size='2'>".$DiskInfo."</font>\n";
      echo "</td>\n";
      echo "</td>\n";
      echo "<td valign='middle' align='right' style='border-color: #A4A4A4; margin-top: 2; margin-bottom: 2; border-left-style: none; border-left-width: 0; border-right-style: none; border-right-width: 0; border-top-style: none; border-top-width: 0; border-bottom-style: solid; border-bottom-width: 1' width='110' height='25' bgcolor='#FFFFFF'><img src='ProgressBar.php?p=$percentage&label=$percentage%&color=d7df01' border='0' align='absmidle'>\n";
      echo "</td>\n";
      echo "<td valign='middle' align='center' style='border-color: #A4A4A4; margin-top: 2; margin-bottom: 2; border-left-style: none; border-left-width: 0; border-right-style: none; border-right-width: 0; border-top-style: none; border-top-width: 0; border-bottom-style: none; border-bottom-width: 0' width='20' height='25' bgcolor='#FFFFFF'><a href='EXO200Status/AddDiskInfo.php?disk=".$deviceName[0][0]."'><img src='image/edit2.png' border='0'></a>\n";
      echo "</td>\n";
   echo "</tr>\n";
}
echo "</table\n";

echo "<meta http-equiv='refresh' content='5; URL=StatusDataDisk.php'>";

?>

