<?php
//**** Home directory ****
$homeDir = "/xgt/";

// graphics directory
$graphDir = $homeDir."Live";

// get run info
$RunInfoFile = $homeDir."Live/RunInfo.log";
$fh = fopen($RunInfoFile , 'r');
$RunInfo = fread($fh, filesize($RunInfoFile));
fclose($fh);

list ($filename, $runStatus, $evtID, $duration, $chargeX, $chargeY, $chargeGrid) = split(';', $RunInfo);

if ($runStatus == "0") {$status = "running";}
else {$status = "stopped";}

if ($duration >= 60) {
   if ($duration >= 3600) {
      if ($duration >= 86400) {
         $dMTP = $duration / 86400;
         $d = floor($duration / 86400); $diff = $duration - $d*86400;
         $h = floor($diff / 3600); $diff = $diff - $h*3600;
         $m = floor($diff / 60);
         $s = $diff - $m*60;
         $durationTMP = $d."d ".$h."h ".$m."m ".$s."s";
      }
      else {
         $h = floor($duration / 3600); $diff = $duration - $h*3600;
         $m = floor($diff / 60);
         $s = $diff - $m*60;
         $durationTMP = $h."h ".$m."m ".$s."s";
      }
   }
   else {
      $m = floor($duration / 60);
      $s = $duration - $m*60;
      $durationTMP = $m."m ".$s."s";
   }
}
else {
   $durationTMP = $duration."s";
}

$trigRate = sprintf("%.3f",$evtID/$duration);

echo "<table align='center' border='0' bordercolor='#808080' cellpadding='0' cellspacing='0' style='border-collapse: collapse;' width='760'>\n";
echo "   <tr>\n";
echo "      <td valign='bottom' align='right' style='border-color: #808080; border-left-style: none; border-left-width: 0; border-right-style: none; border-right-width: 0; border-top-style: none; border-top-width: 0; border-bottom-style: none; border-bottom-width: 0' bgcolor='#FFFFFF' width='40' height='20'>\n";
echo "      </td>\n";
echo "      <td valign='bottom' align='left' style='border-color: #808080; border-left-style: none; border-left-width: 0; border-right-style: none; border-right-width: 0; border-top-style: none; border-top-width: 0; border-bottom-style: solid; border-bottom-width: 1' bgcolor='#FFFFFF' width='680' height='20'>\n";
echo "<font size='2' color='#808080'>Run Information";
echo "      <td valign='bottom' align='right' style='border-color: #808080; border-left-style: none; border-left-width: 0; border-right-style: none; border-right-width: 0; border-top-style: none; border-top-width: 0; border-bottom-style: none; border-bottom-width: 0' bgcolor='#FFFFFF' width='40' height='20'>\n";
echo "      </td>\n";
echo "   </tr>\n";
echo "   <tr>\n";
echo "      <td valign='bottom' align='right' style='border-color: #808080; border-left-style: none; border-left-width: 0; border-right-style: none; border-right-width: 0; border-top-style: none; border-top-width: 0; border-bottom-style: none; border-bottom-width: 0' bgcolor='#FFFFFF' width='40' height='30'>\n";
echo "      </td>\n";
echo "      <td valign='middle' align='left' style='border-color: #808080; border-left-style: solid; border-left-width: 1; border-right-style: solid; border-right-width: 1; border-top-style: none; border-top-width: 0; border-bottom-style: solid; border-bottom-width: 1' bgcolor='#FFFFFF' width='680' height='30'>\n";

echo "<p align='left' style='margin-left: 20px; margin-right: 20px; margin-top: 10px; margin-bottom: 3px;'>";
echo "<font size='2'>Current File: <b>".$filename."</b>&nbsp;&nbsp;&nbsp;&nbsp;Run Status: <b>".$status."</b>&nbsp;&nbsp;&nbsp;&nbsp;Current EventID: <b>".$evtID."</b>&nbsp;&nbsp;&nbsp;&nbsp;Run Duration: <b>".$durationTMP."</b></font>";
echo "</p>";
echo "<p align='left' style='margin-left: 20px; margin-right: 20px; margin-top: 0px; margin-bottom: 10px;'>";
echo "<font size='2'>Charge X: <b>".$chargeX."&nbsp;fC</b>&nbsp;&nbsp;&nbsp;&nbsp;Charge Y: <b>".$chargeY."&nbsp;fC</b>&nbsp;&nbsp;&nbsp;&nbsp;ChargeGrid: <b>".$chargeGrid."&nbsp;fC</b>&nbsp;&nbsp;&nbsp;&nbsp;Trigger rate: <b>".$trigRate."&nbsp;Hz</b></font>";
echo "</p>";

echo "      </td>\n";
echo "      <td valign='bottom' align='right' style='border-color: #808080; border-left-style: none; border-left-width: 0; border-right-style: none; border-right-width: 0; border-top-style: none; border-top-width: 0; border-bottom-style: none; border-bottom-width: 0' bgcolor='#FFFFFF' width='40' height='30'>\n";
echo "      </td>\n";
echo "   </tr>\n";
echo "   <tr>\n";
echo "      <td valign='middle' align='left' style='border-color: #000000; border-left-style: none; border-left-width: 0; border-right-style: none; border-right-width: 0; border-top-style: none; border-top-width: 0; border-bottom-style: none; border-bottom-width: 0' bgcolor='#FFFFFF' width='40' height='10'>\n";
echo "      </td>\n";
echo "      <td valign='middle' align='left' style='border-color: #000000; border-left-style: none; border-left-width: 0; border-right-style: none; border-right-width: 0; border-top-style: none; border-top-width: 0; border-bottom-style: none; border-bottom-width: 0' bgcolor='#FFFFFF' width='680' height='10'>\n";
echo "      </td>\n";
echo "      <td valign='middle' align='left' style='border-color: #000000; border-left-style: none; border-left-width: 0; border-right-style: none; border-right-width: 0; border-top-style: none; border-top-width: 0; border-bottom-style: none; border-bottom-width: 0' bgcolor='#FFFFFF' width='40' height='10'>\n";
echo "      </td>\n";
echo "   </tr>\n";
echo "</table>\n";

copy("$graphDir/graphX.png","../LiveGraphs/graphX.png");
copy("$graphDir/graphY.png","../LiveGraphs/graphY.png");
copy("$graphDir/graphGrid.png","../LiveGraphs/graphGrid.png");

echo "<p align='center' style='margin-top: 0px; margin-bottom: 5px;'>";
echo "<img src='../LiveGraphs/graphX.png' width='500'>";
echo "</p>";
echo "<p align='center' style='margin-top: 0px; margin-bottom: 5px;'>";
echo "<img src='../LiveGraphs/graphY.png' width='500'>";
echo "</p>";
echo "<p align='center' style='margin-top: 0px; margin-bottom: 5px;'>";
echo "<img src='../LiveGraphs/graphGrid.png' width='500'>";
echo "</p>";

echo "<meta http-equiv='refresh' content='10; URL=getlivegraphs.php'>";
?>
