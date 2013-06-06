<?php

$cmd = "COLUMNS=200 top -b -n1 -c | grep 'EXOAnalysis[[:space:]].*\.exo'";
$outp = shell_exec($cmd);
preg_match_all('/.+\n/', $outp, $procInfoALL);

echo "<table align='center' border='0' bordercolor='#000000' cellpadding='0' cellspacing='0' style='border-collapse: collapse; ' width='720'>\n";
echo "<tr>\n";
      echo "<td valign='middle' align='left' style='border-color: #A4A4A4; border-left-style: none; border-left-width: 0; border-right-style: none; border-right-width: 0; border-top-style: none; border-top-width: 0; border-bottom-style: solid; border-bottom-width: 1' width='720' height='10' bgcolor='#FFFFFF'><font size='3'>EXOAnalysis jobs</font>\n";
      echo "</td>\n";
   echo "</tr>\n";
echo "</table>\n";

echo "<table align='center' border='0' bordercolor='#000000' cellpadding='0' cellspacing='0' style='border-collapse: collapse; ' width='720'>\n";
   echo "<tr>\n";
      echo "<td valign='middle' align='left' style='border-color: #A4A4A4; border-left-style: none; border-left-width: 0; border-right-style: none; border-right-width: 0; border-top-style: none; border-top-width: 0; border-bottom-style: solid; border-bottom-width: 1' width='50' height='25' bgcolor='#FFFFFF'><font size='2'><b>PID</b></font>\n";
      echo "</td>\n";
      echo "<td valign='middle' align='left' style='border-color: #A4A4A4; border-left-style: none; border-left-width: 0; border-right-style: none; border-right-width: 0; border-top-style: none; border-top-width: 0; border-bottom-style: solid; border-bottom-width: 1' width='100' height='25' bgcolor='#FFFFFF'><font size='2'><b>User</b></font>\n";
      echo "</td>\n";
      echo "<td valign='middle' align='left' style='border-color: #A4A4A4; border-left-style: none; border-left-width: 0; border-right-style: none; border-right-width: 0; border-top-style: none; border-top-width: 0; border-bottom-style: solid; border-bottom-width: 1' width='270' height='25' bgcolor='#FFFFFF'><font size='2'><b>Job name</b></font>\n";
      echo "</td>\n";
      echo "<td valign='middle' align='left' style='border-color: #A4A4A4; border-left-style: none; border-left-width: 0; border-right-style: none; border-right-width: 0; border-top-style: none; border-top-width: 0; border-bottom-style: solid; border-bottom-width: 1' width='80' height='25' bgcolor='#FFFFFF'><font size='2'><b>Runtime</b></font>\n";
      echo "</td>\n";
      echo "<td valign='middle' align='center' style='border-color: #A4A4A4; border-left-style: none; border-left-width: 0; border-right-style: none; border-right-width: 0; border-top-style: none; border-top-width: 0; border-bottom-style: solid; border-bottom-width: 1' width='110' height='25' bgcolor='#FFFFFF'><font size='2'><b>CPU usage</b></font>\n";
      echo "</td>\n";
      echo "</td>\n";
      echo "<td valign='middle' align='center' style='border-color: #A4A4A4; border-left-style: none; border-left-width: 0; border-right-style: none; border-right-width: 0; border-top-style: none; border-top-width: 0; border-bottom-style: solid; border-bottom-width: 1' width='110' height='25' bgcolor='#FFFFFF'><font size='2'><b>Memory usage</b></font>\n";
      echo "</td>\n";
   echo "</tr>\n";

$nrProc = 0;
for ($i = 0; $i < sizeof($procInfoALL[0]); $i++) {
   preg_match_all('/[a-zA-Z0-9\.:_]+\s+/', $procInfoALL[0][$i], $procInfo);

   if (strcmp(str_replace(' ','',$procInfo[0][1]),"apache") != 0) {

   echo "<tr>\n";
      echo "<td valign='middle' align='left' style='border-color: #A4A4A4; border-left-style: none; border-left-width: 0; border-right-style: none; border-right-width: 0; border-top-style: none; border-top-width: 0; border-bottom-style: solid; border-bottom-width: 1' width='50' height='25' bgcolor='#FFFFFF'><font size='2'>".str_replace(' ','',$procInfo[0][0])."</font>\n";
      echo "</td>\n";
      echo "<td valign='middle' align='left' style='border-color: #A4A4A4; border-left-style: none; border-left-width: 0; border-right-style: none; border-right-width: 0; border-top-style: none; border-top-width: 0; border-bottom-style: solid; border-bottom-width: 1' width='100' height='25' bgcolor='#FFFFFF'><font size='2'>".str_replace(' ','',$procInfo[0][1])."</font>\n";
      echo "</td>\n";
      echo "<td valign='middle' align='left' style='border-color: #A4A4A4; border-left-style: none; border-left-width: 0; border-right-style: none; border-right-width: 0; border-top-style: none; border-top-width: 0; border-bottom-style: solid; border-bottom-width: 1' width='270' height='25' bgcolor='#FFFFFF'><font size='2'>".str_replace(' ','',$procInfo[0][11])." ".str_replace(' ','',$procInfo[0][12])."</font>\n";
      echo "</td>\n";
      echo "<td valign='middle' align='left' style='border-color: #A4A4A4; border-left-style: none; border-left-width: 0; border-right-style: none; border-right-width: 0; border-top-style: none; border-top-width: 0; border-bottom-style: solid; border-bottom-width: 1' width='80' height='25' bgcolor='#FFFFFF'><font size='2'>".str_replace(' ','',$procInfo[0][10])."</font>\n";
      echo "</td>\n";
      echo "<td valign='middle' align='right' style='border-color: #A4A4A4; border-left-style: none; border-left-width: 0; border-right-style: none; border-right-width: 0; border-top-style: none; border-top-width: 0; border-bottom-style: solid; border-bottom-width: 1' width='110' height='25' bgcolor='#FFFFFF'><img src='ProgressBar.php?p=".str_replace(' ','',$procInfo[0][8])."&label=".str_replace(' ','',$procInfo[0][8])."%&color=ffa0a0' border='0' align='absmiddle'>\n";
      echo "</td>\n";
      echo "</td>\n";
      echo "<td valign='middle' align='right' style='border-color: #A4A4A4; border-left-style: none; border-left-width: 0; border-right-style: none; border-right-width: 0; border-top-style: none; border-top-width: 0; border-bottom-style: solid; border-bottom-width: 1' width='110' height='25' bgcolor='#FFFFFF'><img src='ProgressBar.php?p=".str_replace(' ','',$procInfo[0][9])."&label=".str_replace(' ','',$procInfo[0][9])."%&color=a0ffa0' border='0' align='absmidle'>\n";
      echo "</td>\n";
   echo "</tr>\n";

   $nrProc++;
   }
}
echo "</table\n";

if ($nrProc == 0) {
echo "<table align='center' border='0' bordercolor='#000000' cellpadding='0' cellspacing='0' style='border-collapse: collapse; ' width='720'>\n";
echo "<tr>\n";
      echo "<td valign='middle' align='center' style='border-color: #A4A4A4; border-left-style: none; border-left-width: 0; border-right-style: none; border-right-width: 0; border-top-style: none; border-top-width: 0; border-bottom-style: none; border-bottom-width: 0' width='720' height='20' bgcolor='#FFFFFF'><font size='2'>No running jobs</font>\n";
      echo "</td>\n";
   echo "</tr>\n";
echo "</table>\n";
}

echo "<meta http-equiv='refresh' content='5; URL=StatusEXOAnalysis.php'>";

?>

