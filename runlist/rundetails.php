<?php

if (!$_COOKIE['experiment']) {setcookie("experiment", "xgt", time()+86400);}

//**** Database ****
$database = "runlist_".$_COOKIE['experiment'];

//**** Home directory ****
switch ($_COOKIE['experiment']) {
    case "xgt":
        $homeDir = "/xgt/";
        break;
    case "xlr":
        $homeDir = "/xlr/";
        break;
    default:
        $homeDir = "/xgt";
}

//**** Initialize ****
$LibExport = "export LD_LIBRARY_PATH=$LD_LIBRARY_PATH:/home/exodaq/ReadMidas/lib";
$PathExport = "export PATH=$PATH:/home/exodaq/ReadMidas/bin";

// get run number
$runNb = $_GET["id"];

// set current directory to homeDir
$d = $homeDir;

echo "<table align='center' border='0' bordercolor='#000000' cellpadding='0' cellspacing='0' style='border-collapse: collapse;' width='760' height='30'>\n";
echo "   <tr>\n";
echo "      <td valign='middle' align='left' style='border-color: #000000; border-left-style: none; border-left-width: 0; border-right-style: none; border-right-width: 0; border-top-style: none; border-top-width: 0; border-bottom-style: none; border-bottom-width: 0' bgcolor='#FFFFFF' width='20' height='30'>\n";
echo "      </td>\n";
echo "      <td valign='middle' align='left' style='border-color: #000000; border-left-style: none; border-left-width: 0; border-right-style: none; border-right-width: 0; border-top-style: none; border-top-width: 0; border-bottom-style: solid; border-bottom-width: 1' bgcolor='#FFFFFF' width='360' height='30'>\n";
echo "<font size='2'>Displaying details of run# $runNb</font>";
echo "      </td>\n";
echo "      <td valign='middle' align='right' style='border-color: #000000; border-left-style: none; border-left-width: 0; border-right-style: none; border-right-width: 0; border-top-style: none; border-top-width: 0; border-bottom-style: solid; border-bottom-width: 1' bgcolor='#FFFFFF' width='360' height='30'>\n";
echo "<a href='index.php?page=runlist/editrundetails.php&id=$runNb' title='Edit run details'><img src='image/edit.png' border='0' align='absmiddle'></a>&nbsp;&nbsp;";
$filename = $homeDir.$runNb.".root";
if (!file_exists($filename)) {$dfile = $runNb.".mid";}
else {$dfile = $runNb.".root";}
echo "<a href='runlist/download.php?id=$dfile' title='Download run'><img src='image/download.png' border='0' align='absmiddle'></a>&nbsp;&nbsp;";
echo "<a href='index.php?page=runlist/fileupload.php&runID=$runNb' title='Upload file'><img src='image/upload.png' border='0' align='absmiddle'></a>";
echo "      </td>\n";
echo "      <td valign='middle' align='left' style='border-color: #000000; border-left-style: none; border-left-width: 0; border-right-style: none; border-right-width: 0; border-top-style: none; border-top-width: 0; border-bottom-style: none; border-bottom-width: 0' bgcolor='#FFFFFF' width='20' height='30'>\n";
echo "      </td>\n";
echo "   </tr>\n";
echo "   <tr>\n";
echo "      <td valign='middle' align='left' style='border-color: #000000; border-left-style: none; border-left-width: 0; border-right-style: none; border-right-width: 0; border-top-style: none; border-top-width: 0; border-bottom-style: none; border-bottom-width: 0' bgcolor='#FFFFFF' width='20' height='2'>\n";
echo "      </td>\n";
echo "      <td valign='middle' align='left' style='border-color: #000000; border-left-style: none; border-left-width: 0; border-right-style: none; border-right-width: 0; border-top-style: none; border-top-width: 0; border-bottom-style: none; border-bottom-width: 0' bgcolor='#FFFFFF' width='360' height='2'>\n";
echo "      </td>\n";
echo "      <td valign='middle' align='left' style='border-color: #000000; border-left-style: none; border-left-width: 0; border-right-style: none; border-right-width: 0; border-top-style: none; border-top-width: 0; border-bottom-style: none; border-bottom-width: 0' bgcolor='#FFFFFF' width='360' height='2'>\n";
echo "      </td>\n";
echo "      <td valign='middle' align='left' style='border-color: #000000; border-left-style: none; border-left-width: 0; border-right-style: none; border-right-width: 0; border-top-style: none; border-top-width: 0; border-bottom-style: none; border-bottom-width: 0' bgcolor='#FFFFFF' width='20' height='2'>\n";
echo "      </td>\n";
echo "   </tr>\n";
echo "</table>\n";

?>

<table align="center" border="0" bordercolor="#000000" cellpadding="0" cellspacing="0" style="border-collapse: collapse; " width="760">
   <tr>
      <td valign="middle" align="right" style="border-color: #000000; border-left-style: none; border-left-width: 0; border-right-style: none; border-right-width: 0; border-top-style: none; border-top-width: 0; border-bottom-style: none; border-bottom-width: 0" width="20" height="10" bgcolor="#FFFFFF">
      </td>
      <td valign="middle" align="left" style="border-color: #000000; border-left-style: none; border-left-width: 0; border-right-style: none; border-right-width: 0; border-top-style: none; border-top-width: 0; border-bottom-style: none; border-bottom-width: 0" width="720" height="10" bgcolor="#FFFFFF">
      </td>
      <td valign="middle" align="center" style="border-color: #000000; border-left-style: none; border-left-width: 0; border-right-style: none; border-right-width: 0; border-top-style: none; border-top-width: 0; border-bottom-style: none; border-bottom-width: 0" width="20" height="10" bgcolor="#FFFFFF">
      </td>
   </tr>
   <tr>
      <td valign="middle" align="right" style="border-color: #000000; border-left-style: none; border-left-width: 0; border-right-style: none; border-right-width: 0; border-top-style: none; border-top-width: 0; border-bottom-style: none; border-bottom-width: 0" width="20" bgcolor="#FFFFFF">
      </td>
      <td valign="middle" align="left" style="border-color: #000000; border-left-style: none; border-left-width: 0; border-right-style: none; border-right-width: 0; border-top-style: none; border-top-width: 0; border-bottom-style: none; border-bottom-width: 0" width="720" bgcolor="#FFFFFF">
      
   <?php
// **** Run info **********************************************************************************

// connect with database
$db=mysql_connect("lheppc90.unibe.ch","exodaq","EXOsql");
mysql_select_db("exo");

$run = mysql_query("select * from $database where runNumber = '$runNb'");
$currentRun = mysql_fetch_assoc($run);

if ($currentRun['runDate'] != 0) {
   $startDate = date("d.m.Y H:i:s", $currentRun['runDate']);
   $endDate = date("d.m.Y H:i:s", $currentRun['runDate'] + $currentRun['runDuration']);
}
else {
   $startDate = "-";
   $endDate = "-";
}

echo "<table align='center' border='0' bordercolor='#000000' cellpadding='0' cellspacing='0' style='border-collapse: collapse; ' width='720'\n";
echo "   <tr>\n";
echo "      <td valign='middle' align='left' style='border-left-color: #FFFFFF; border-left-width: 0; border-right-color: #FFFFFF; border-right-width: 0; border-top-color: #FFFFFF; border-top-width: 0; border-bottom-color: #000000; border-bottom-width: 0' width='250' bgcolor='#FFFFFF'>\n";
echo "<font size='2'>Start of run:</font>";
echo "      </td>\n";
echo "      <td valign='middle' align='left' style='border-left-color: #FFFFFF; border-left-width: 0; border-right-color: #FFFFFF; border-right-width: 0; border-top-color: #FFFFFF; border-top-width: 0; border-bottom-color: #000000; border-bottom-width: 0' width='470' bgcolor='#FFFFFF'>\n";
echo "<font size='2'>".$startDate."</font>";
echo "      </td>\n";
echo "   </tr>\n";

echo "   <tr>\n";
echo "      <td valign='middle' align='left' style='border-left-color: #FFFFFF; border-left-width: 0; border-right-color: #FFFFFF; border-right-width: 0; border-top-color: #FFFFFF; border-top-width: 0; border-bottom-color: #000000; border-bottom-width: 0' width='250' height='10' bgcolor='#FFFFFF'></td>\n";
echo "      <td valign='middle' align='left' style='border-left-color: #FFFFFF; border-left-width: 0; border-right-color: #FFFFFF; border-right-width: 0; border-top-color: #FFFFFF; border-top-width: 0; border-bottom-color: #000000; border-bottom-width: 0' width='470' height='10' bgcolor='#FFFFFF'></td>\n";
echo "   </tr>\n";

echo "   <tr>\n";
echo "      <td valign='middle' align='left' style='border-left-color: #FFFFFF; border-left-width: 0; border-right-color: #FFFFFF; border-right-width: 0; border-top-color: #FFFFFF; border-top-width: 0; border-bottom-color: #000000; border-bottom-width: 0' width='250' bgcolor='#FFFFFF'>\n";
echo "<font size='2'>End of run:</font>";
echo "      </td>\n";
echo "      <td valign='middle' align='left' style='border-left-color: #FFFFFF; border-left-width: 0; border-right-color: #FFFFFF; border-right-width: 0; border-top-color: #FFFFFF; border-top-width: 0; border-bottom-color: #000000; border-bottom-width: 0' width='470' bgcolor='#FFFFFF'>\n";
echo "<font size='2'>".$endDate."</font>";
echo "      </td>\n";
echo "   </tr>\n";

echo "   <tr>\n";
echo "      <td valign='middle' align='left' style='border-left-color: #FFFFFF; border-left-width: 0; border-right-color: #FFFFFF; border-right-width: 0; border-top-color: #FFFFFF; border-top-width: 0; border-bottom-color: #000000; border-bottom-width: 0' width='250' height='10' bgcolor='#FFFFFF'></td>\n";
echo "      <td valign='middle' align='left' style='border-left-color: #FFFFFF; border-left-width: 0; border-right-color: #FFFFFF; border-right-width: 0; border-top-color: #FFFFFF; border-top-width: 0; border-bottom-color: #000000; border-bottom-width: 0' width='470' height='10' bgcolor='#FFFFFF'></td>\n";
echo "   </tr>\n";

echo "   <tr>\n";
echo "      <td valign='middle' align='left' style='border-left-color: #FFFFFF; border-left-width: 0; border-right-color: #FFFFFF; border-right-width: 0; border-top-color: #FFFFFF; border-top-width: 0; border-bottom-color: #000000; border-bottom-width: 0' width='250' bgcolor='#FFFFFF'>\n";
echo "<font size='2'>Numer of events:</font>";
echo "      </td>\n";
echo "      <td valign='middle' align='left' style='border-left-color: #FFFFFF; border-left-width: 0; border-right-color: #FFFFFF; border-right-width: 0; border-top-color: #FFFFFF; border-top-width: 0; border-bottom-color: #000000; border-bottom-width: 0' width='470' bgcolor='#FFFFFF'>\n";
if ($currentRun['nbEvents']) {echo "<font size='2'>".$currentRun['nbEvents']."</font>";}
echo "      </td>\n";
echo "   </tr>\n";

echo "   <tr>\n";
echo "      <td valign='middle' align='left' style='border-left-color: #FFFFFF; border-left-width: 0; border-right-color: #FFFFFF; border-right-width: 0; border-top-color: #FFFFFF; border-top-width: 0; border-bottom-color: #000000; border-bottom-width: 0' width='250' height='10' bgcolor='#FFFFFF'></td>\n";
echo "      <td valign='middle' align='left' style='border-left-color: #FFFFFF; border-left-width: 0; border-right-color: #FFFFFF; border-right-width: 0; border-top-color: #FFFFFF; border-top-width: 0; border-bottom-color: #000000; border-bottom-width: 0' width='470' height='10' bgcolor='#FFFFFF'></td>\n";
echo "   </tr>\n";

echo "   <tr>\n";
echo "      <td valign='middle' align='left' style='border-left-color: #FFFFFF; border-left-width: 0; border-right-color: #FFFFFF; border-right-width: 0; border-top-color: #FFFFFF; border-top-width: 0; border-bottom-color: #000000; border-bottom-width: 0' width='250' bgcolor='#FFFFFF'>\n";
echo "<font size='2'>Duration:</font>";
echo "      </td>\n";
echo "      <td valign='middle' align='left' style='border-left-color: #FFFFFF; border-left-width: 0; border-right-color: #FFFFFF; border-right-width: 0; border-top-color: #FFFFFF; border-top-width: 0; border-bottom-color: #000000; border-bottom-width: 0' width='470' bgcolor='#FFFFFF'>\n";
if ($currentRun['runDuration']) {echo "<font size='2'>".$currentRun['runDuration']." s</font>";}
echo "      </td>\n";
echo "   </tr>\n";

echo "   <tr>\n";
echo "      <td valign='middle' align='left' style='border-left-color: #FFFFFF; border-left-width: 0; border-right-color: #FFFFFF; border-right-width: 0; border-top-color: #FFFFFF; border-top-width: 0; border-bottom-color: #000000; border-bottom-width: 0' width='250' height='10' bgcolor='#FFFFFF'></td>\n";
echo "      <td valign='middle' align='left' style='border-left-color: #FFFFFF; border-left-width: 0; border-right-color: #FFFFFF; border-right-width: 0; border-top-color: #FFFFFF; border-top-width: 0; border-bottom-color: #000000; border-bottom-width: 0' width='470' height='10' bgcolor='#FFFFFF'></td>\n";
echo "   </tr>\n";

echo "   <tr>\n";
echo "      <td valign='middle' align='left' style='border-left-color: #FFFFFF; border-left-width: 0; border-right-color: #FFFFFF; border-right-width: 0; border-top-color: #FFFFFF; border-top-width: 0; border-bottom-color: #000000; border-bottom-width: 0' width='250' bgcolor='#FFFFFF'>\n";
echo "<font size='2'>Pressure:</font>";
echo "      </td>\n";
echo "      <td valign='middle' align='left' style='border-left-color: #FFFFFF; border-left-width: 0; border-right-color: #FFFFFF; border-right-width: 0; border-top-color: #FFFFFF; border-top-width: 0; border-bottom-color: #000000; border-bottom-width: 0' width='470' bgcolor='#FFFFFF'>\n";
if ($currentRun['pressure']) {echo "<font size='2'>".$currentRun['pressure']." bar</font>";}
echo "      </td>\n";
echo "   </tr>\n";

echo "   <tr>\n";
echo "      <td valign='middle' align='left' style='border-left-color: #FFFFFF; border-left-width: 0; border-right-color: #FFFFFF; border-right-width: 0; border-top-color: #FFFFFF; border-top-width: 0; border-bottom-color: #000000; border-bottom-width: 0' width='250' height='10' bgcolor='#FFFFFF'></td>\n";
echo "      <td valign='middle' align='left' style='border-left-color: #FFFFFF; border-left-width: 0; border-right-color: #FFFFFF; border-right-width: 0; border-top-color: #FFFFFF; border-top-width: 0; border-bottom-color: #000000; border-bottom-width: 0' width='470' height='10' bgcolor='#FFFFFF'></td>\n";
echo "   </tr>\n";

echo "   <tr>\n";
echo "      <td valign='middle' align='left' style='border-left-color: #FFFFFF; border-left-width: 0; border-right-color: #FFFFFF; border-right-width: 0; border-top-color: #FFFFFF; border-top-width: 0; border-bottom-color: #000000; border-bottom-width: 0' width='250' bgcolor='#FFFFFF'>\n";
echo "<font size='2'>Grid voltage:</font>";
echo "      </td>\n";
echo "      <td valign='middle' align='left' style='border-left-color: #FFFFFF; border-left-width: 0; border-right-color: #FFFFFF; border-right-width: 0; border-top-color: #FFFFFF; border-top-width: 0; border-bottom-color: #000000; border-bottom-width: 0' width='470' bgcolor='#FFFFFF'>\n";
if ($currentRun['gridVolt']) {echo "<font size='2'>".$currentRun['gridVolt']." V</font>";}
echo "      </td>\n";
echo "   </tr>\n";

echo "   <tr>\n";
echo "      <td valign='middle' align='left' style='border-left-color: #FFFFFF; border-left-width: 0; border-right-color: #FFFFFF; border-right-width: 0; border-top-color: #FFFFFF; border-top-width: 0; border-bottom-color: #000000; border-bottom-width: 0' width='250' height='10' bgcolor='#FFFFFF'></td>\n";
echo "      <td valign='middle' align='left' style='border-left-color: #FFFFFF; border-left-width: 0; border-right-color: #FFFFFF; border-right-width: 0; border-top-color: #FFFFFF; border-top-width: 0; border-bottom-color: #000000; border-bottom-width: 0' width='470' height='10' bgcolor='#FFFFFF'></td>\n";
echo "   </tr>\n";

echo "   <tr>\n";
echo "      <td valign='middle' align='left' style='border-left-color: #FFFFFF; border-left-width: 0; border-right-color: #FFFFFF; border-right-width: 0; border-top-color: #FFFFFF; border-top-width: 0; border-bottom-color: #000000; border-bottom-width: 0' width='250' bgcolor='#FFFFFF'>\n";
echo "<font size='2'>Cathode voltage:</font>";
echo "      </td>\n";
echo "      <td valign='middle' align='left' style='border-left-color: #FFFFFF; border-left-width: 0; border-right-color: #FFFFFF; border-right-width: 0; border-top-color: #FFFFFF; border-top-width: 0; border-bottom-color: #000000; border-bottom-width: 0' width='470' bgcolor='#FFFFFF'>\n";
if ($currentRun['cathodeVolt']) {echo "<font size='2'>".$currentRun['cathodeVolt']." V</font>";}
echo "      </td>\n";
echo "   </tr>\n";

echo "   <tr>\n";
echo "      <td valign='middle' align='left' style='border-left-color: #FFFFFF; border-left-width: 0; border-right-color: #FFFFFF; border-right-width: 0; border-top-color: #FFFFFF; border-top-width: 0; border-bottom-color: #000000; border-bottom-width: 0' width='250' height='10' bgcolor='#FFFFFF'></td>\n";
echo "      <td valign='middle' align='left' style='border-left-color: #FFFFFF; border-left-width: 0; border-right-color: #FFFFFF; border-right-width: 0; border-top-color: #FFFFFF; border-top-width: 0; border-bottom-color: #000000; border-bottom-width: 0' width='470' height='10' bgcolor='#FFFFFF'></td>\n";
echo "   </tr>\n";

echo "   <tr>\n";
echo "      <td valign='middle' align='left' style='border-left-color: #FFFFFF; border-left-width: 0; border-right-color: #FFFFFF; border-right-width: 0; border-top-color: #FFFFFF; border-top-width: 0; border-bottom-color: #000000; border-bottom-width: 0' width='250' bgcolor='#FFFFFF'>\n";
echo "<font size='2'>First ring:</font>";
echo "      </td>\n";
echo "      <td valign='middle' align='left' style='border-left-color: #FFFFFF; border-left-width: 0; border-right-color: #FFFFFF; border-right-width: 0; border-top-color: #FFFFFF; border-top-width: 0; border-bottom-color: #000000; border-bottom-width: 0' width='470' bgcolor='#FFFFFF'>\n";
if ($currentRun['firstRingVolt']) {echo "<font size='2'>".$currentRun['firstRingVolt']." V</font>";}
echo "      </td>\n";
echo "   </tr>\n";

echo "   <tr>\n";
echo "      <td valign='middle' align='left' style='border-left-color: #FFFFFF; border-left-width: 0; border-right-color: #FFFFFF; border-right-width: 0; border-top-color: #FFFFFF; border-top-width: 0; border-bottom-color: #000000; border-bottom-width: 0' width='250' height='10' bgcolor='#FFFFFF'></td>\n";
echo "      <td valign='middle' align='left' style='border-left-color: #FFFFFF; border-left-width: 0; border-right-color: #FFFFFF; border-right-width: 0; border-top-color: #FFFFFF; border-top-width: 0; border-bottom-color: #000000; border-bottom-width: 0' width='470' height='10' bgcolor='#FFFFFF'></td>\n";
echo "   </tr>\n";

echo "   <tr>\n";
echo "      <td valign='middle' align='left' style='border-left-color: #FFFFFF; border-left-width: 0; border-right-color: #FFFFFF; border-right-width: 0; border-top-color: #FFFFFF; border-top-width: 0; border-bottom-color: #000000; border-bottom-width: 0' width='250' bgcolor='#FFFFFF'>\n";
echo "<font size='2'>Leakage current:</font>";
echo "      </td>\n";
echo "      <td valign='middle' align='left' style='border-left-color: #FFFFFF; border-left-width: 0; border-right-color: #FFFFFF; border-right-width: 0; border-top-color: #FFFFFF; border-top-width: 0; border-bottom-color: #000000; border-bottom-width: 0' width='470' bgcolor='#FFFFFF'>\n";
if ($currentRun['leakageCurrent']) {echo "<font size='2'>".$currentRun['leakageCurrent']." nA</font>";}
echo "      </td>\n";
echo "   </tr>\n";

echo "   <tr>\n";
echo "      <td valign='middle' align='left' style='border-left-color: #FFFFFF; border-left-width: 0; border-right-color: #FFFFFF; border-right-width: 0; border-top-color: #FFFFFF; border-top-width: 0; border-bottom-color: #000000; border-bottom-width: 0' width='250' height='10' bgcolor='#FFFFFF'></td>\n";
echo "      <td valign='middle' align='left' style='border-left-color: #FFFFFF; border-left-width: 0; border-right-color: #FFFFFF; border-right-width: 0; border-top-color: #FFFFFF; border-top-width: 0; border-bottom-color: #000000; border-bottom-width: 0' width='470' height='10' bgcolor='#FFFFFF'></td>\n";
echo "   </tr>\n";

echo "   <tr>\n";
echo "      <td valign='middle' align='left' style='border-left-color: #FFFFFF; border-left-width: 0; border-right-color: #FFFFFF; border-right-width: 0; border-top-color: #FFFFFF; border-top-width: 0; border-bottom-color: #000000; border-bottom-width: 0' width='250' bgcolor='#FFFFFF'>\n";
echo "<font size='2'>Trigger threshold:</font>";
echo "      </td>\n";
echo "      <td valign='middle' align='left' style='border-left-color: #FFFFFF; border-left-width: 0; border-right-color: #FFFFFF; border-right-width: 0; border-top-color: #FFFFFF; border-top-width: 0; border-bottom-color: #000000; border-bottom-width: 0' width='470' bgcolor='#FFFFFF'>\n";
if ($currentRun['trigThreshold']) {echo "<font size='2'>".$currentRun['trigThreshold']." mV</font>";}
echo "      </td>\n";
echo "   </tr>\n";

echo "   <tr>\n";
echo "      <td valign='middle' align='left' style='border-left-color: #FFFFFF; border-left-width: 0; border-right-color: #FFFFFF; border-right-width: 0; border-top-color: #FFFFFF; border-top-width: 0; border-bottom-color: #000000; border-bottom-width: 0' width='250' height='10' bgcolor='#FFFFFF'></td>\n";
echo "      <td valign='middle' align='left' style='border-left-color: #FFFFFF; border-left-width: 0; border-right-color: #FFFFFF; border-right-width: 0; border-top-color: #FFFFFF; border-top-width: 0; border-bottom-color: #000000; border-bottom-width: 0' width='470' height='10' bgcolor='#FFFFFF'></td>\n";
echo "   </tr>\n";

echo "   <tr>\n";
echo "      <td valign='middle' align='left' style='border-left-color: #FFFFFF; border-left-width: 0; border-right-color: #FFFFFF; border-right-width: 0; border-top-color: #FFFFFF; border-top-width: 0; border-bottom-color: #000000; border-bottom-width: 0' width='250' bgcolor='#FFFFFF'>\n";
echo "<font size='2'>Group multiplicity:</font>";
echo "      </td>\n";
echo "      <td valign='middle' align='left' style='border-left-color: #FFFFFF; border-left-width: 0; border-right-color: #FFFFFF; border-right-width: 0; border-top-color: #FFFFFF; border-top-width: 0; border-bottom-color: #000000; border-bottom-width: 0' width='470' bgcolor='#FFFFFF'>\n";
if ($currentRun['grpMultiplicity']) {echo "<font size='2'>".$currentRun['grpMultiplicity']."</font>";}
echo "      </td>\n";
echo "   </tr>\n";

echo "   <tr>\n";
echo "      <td valign='middle' align='left' style='border-left-color: #FFFFFF; border-left-width: 0; border-right-color: #FFFFFF; border-right-width: 0; border-top-color: #FFFFFF; border-top-width: 0; border-bottom-color: #000000; border-bottom-width: 0' width='250' height='10' bgcolor='#FFFFFF'></td>\n";
echo "      <td valign='middle' align='left' style='border-left-color: #FFFFFF; border-left-width: 0; border-right-color: #FFFFFF; border-right-width: 0; border-top-color: #FFFFFF; border-top-width: 0; border-bottom-color: #000000; border-bottom-width: 0' width='470' height='10' bgcolor='#FFFFFF'></td>\n";
echo "   </tr>\n";

echo "   <tr>\n";
echo "      <td valign='middle' align='left' style='border-left-color: #FFFFFF; border-left-width: 0; border-right-color: #FFFFFF; border-right-width: 0; border-top-color: #FFFFFF; border-top-width: 0; border-bottom-color: #000000; border-bottom-width: 0' width='250' bgcolor='#FFFFFF'>\n";
echo "<font size='2'>External trigger:</font>";
echo "      </td>\n";
echo "      <td valign='middle' align='left' style='border-left-color: #FFFFFF; border-left-width: 0; border-right-color: #FFFFFF; border-right-width: 0; border-top-color: #FFFFFF; border-top-width: 0; border-bottom-color: #000000; border-bottom-width: 0' width='470' bgcolor='#FFFFFF'>\n";
if ($currentRun['extTrigStatus'] == "1") {echo "<font size='2'>yes</font>";}
elseif ($currentRun['extTrigStatus'] == "0") {echo "<font size='2'>no</font>";}
echo "      </td>\n";
echo "   </tr>\n";

echo "   <tr>\n";
echo "      <td valign='middle' align='left' style='border-left-color: #FFFFFF; border-left-width: 0; border-right-color: #FFFFFF; border-right-width: 0; border-top-color: #FFFFFF; border-top-width: 0; border-bottom-color: #000000; border-bottom-width: 0' width='250' height='10' bgcolor='#FFFFFF'></td>\n";
echo "      <td valign='middle' align='left' style='border-left-color: #FFFFFF; border-left-width: 0; border-right-color: #FFFFFF; border-right-width: 0; border-top-color: #FFFFFF; border-top-width: 0; border-bottom-color: #000000; border-bottom-width: 0' width='470' height='10' bgcolor='#FFFFFF'></td>\n";
echo "   </tr>\n";

echo "   <tr>\n";
echo "      <td valign='middle' align='left' style='border-left-color: #FFFFFF; border-left-width: 0; border-right-color: #FFFFFF; border-right-width: 0; border-top-color: #FFFFFF; border-top-width: 0; border-bottom-color: #000000; border-bottom-width: 0' width='250' bgcolor='#FFFFFF'>\n";
echo "<font size='2'>Local trigger:</font>";
echo "      </td>\n";
echo "      <td valign='middle' align='left' style='border-left-color: #FFFFFF; border-left-width: 0; border-right-color: #FFFFFF; border-right-width: 0; border-top-color: #FFFFFF; border-top-width: 0; border-bottom-color: #000000; border-bottom-width: 0' width='470' bgcolor='#FFFFFF'>\n";
if ($currentRun['localTrigStatus'] == "1") {echo "<font size='2'>yes</font>";}
elseif ($currentRun['localTrigStatus'] == "0") {echo "<font size='2'>no</font>";}
echo "      </td>\n";
echo "   </tr>\n";

echo "   <tr>\n";
echo "      <td valign='middle' align='left' style='border-left-color: #FFFFFF; border-left-width: 0; border-right-color: #FFFFFF; border-right-width: 0; border-top-color: #FFFFFF; border-top-width: 0; border-bottom-color: #000000; border-bottom-width: 0' width='250' height='10' bgcolor='#FFFFFF'></td>\n";
echo "      <td valign='middle' align='left' style='border-left-color: #FFFFFF; border-left-width: 0; border-right-color: #FFFFFF; border-right-width: 0; border-top-color: #FFFFFF; border-top-width: 0; border-bottom-color: #000000; border-bottom-width: 0' width='470' height='10' bgcolor='#FFFFFF'></td>\n";
echo "   </tr>\n";

echo "   <tr>\n";
echo "      <td valign='middle' align='left' style='border-left-color: #FFFFFF; border-left-width: 0; border-right-color: #FFFFFF; border-right-width: 0; border-top-color: #FFFFFF; border-top-width: 0; border-bottom-color: #000000; border-bottom-width: 0' width='250' bgcolor='#FFFFFF'>\n";
echo "<font size='2'>File size:</font>";
echo "      </td>\n";
echo "      <td valign='middle' align='left' style='border-left-color: #FFFFFF; border-left-width: 0; border-right-color: #FFFFFF; border-right-width: 0; border-top-color: #FFFFFF; border-top-width: 0; border-bottom-color: #000000; border-bottom-width: 0' width='470' bgcolor='#FFFFFF'>\n";
$siz = round($currentRun['fileSize']/1024);
if ($currentRun['fileSize']) {echo "<font size='2'>".$siz." kB</font>";}
echo "      </td>\n";
echo "   </tr>\n";

echo "   <tr>\n";
echo "      <td valign='middle' align='left' style='border-left-color: #FFFFFF; border-left-width: 0; border-right-color: #FFFFFF; border-right-width: 0; border-top-color: #FFFFFF; border-top-width: 0; border-bottom-color: #000000; border-bottom-width: 0' width='250' height='10' bgcolor='#FFFFFF'></td>\n";
echo "      <td valign='middle' align='left' style='border-left-color: #FFFFFF; border-left-width: 0; border-right-color: #FFFFFF; border-right-width: 0; border-top-color: #FFFFFF; border-top-width: 0; border-bottom-color: #000000; border-bottom-width: 0' width='470' height='10' bgcolor='#FFFFFF'></td>\n";
echo "   </tr>\n";

echo "   <tr>\n";
echo "      <td valign='top' align='left' style='border-left-color: #FFFFFF; border-left-width: 0; border-right-color: #FFFFFF; border-right-width: 0; border-top-color: #FFFFFF; border-top-width: 0; border-bottom-color: #000000; border-bottom-width: 0' width='250' bgcolor='#FFFFFF'>\n";
echo "<font size='2'>Notes:</font>";
echo "      </td>\n";
echo "      <td valign='top' align='left' style='border-left-color: #FFFFFF; border-left-width: 0; border-right-color: #FFFFFF; border-right-width: 0; border-top-color: #FFFFFF; border-top-width: 0; border-bottom-color: #000000; border-bottom-width: 0' width='470' bgcolor='#FFFFFF'>\n";
if ($currentRun['notes']) {echo "<font size='2'>".$currentRun['notes']."</font>";}
echo "      </td>\n";
echo "   </tr>\n";

echo "   <tr>\n";
echo "      <td valign='middle' align='left' style='border-left-color: #FFFFFF; border-left-width: 0; border-right-color: #FFFFFF; border-right-width: 0; border-top-color: #FFFFFF; border-top-width: 0; border-bottom-color: #000000; border-bottom-width: 0' width='250' height='10' bgcolor='#FFFFFF'></td>\n";
echo "      <td valign='middle' align='left' style='border-left-color: #FFFFFF; border-left-width: 0; border-right-color: #FFFFFF; border-right-width: 0; border-top-color: #FFFFFF; border-top-width: 0; border-bottom-color: #000000; border-bottom-width: 0' width='470' height='10' bgcolor='#FFFFFF'></td>\n";
echo "   </tr>\n";

echo "</table>\n";


// **** End of run info ***************************************************************************
   ?>
      </td>
      <td valign="middle" align="center" style="border-color: #000000; border-left-style: none; border-left-width: 0; border-right-style: none; border-right-width: 0; border-top-style: none; border-top-width: 0; border-bottom-style: none; border-bottom-width: 0" width="20" bgcolor="#FFFFFF">
      </td>
   </tr>
   <tr>
      <td valign="middle" align="right" style="border-color: #000000; border-left-style: none; border-left-width: 0; border-right-style: none; border-right-width: 0; border-top-style: none; border-top-width: 0; border-bottom-style: none; border-bottom-width: 0" width="20" height="30" bgcolor="#FFFFFF">
      </td>
      <td valign="middle" align="right" style="border-color: #000000; border-left-style: none; border-left-width: 0; border-right-style: none; border-right-width: 0; border-top-style: solid; border-top-width: 1; border-bottom-style: none; border-bottom-width: 0" width="720" height="30" bgcolor="#FFFFFF">
      </td>
      <td valign="middle" align="right" style="border-color: #000000; border-left-style: none; border-left-width: 0; border-right-style: none; border-right-width: 0; border-top-style: none; border-top-width: 0; border-bottom-style: none; border-bottom-width: 0" width="20" height="30" bgcolor="#FFFFFF">
      </td
   </tr>
</table>

<?php

$attachments = mysql_query("select * from attachments where run = '$runNb' order by id desc");
$nAtt = mysql_num_rows($attachments);

if ($nAtt > 0) {
echo "<table align='center' border='0' bordercolor='#000000' cellpadding='0' cellspacing='0' style='border-collapse: collapse; ' width='720'>\n";
   echo "<tr>\n";
      echo "<td valign='middle' align='left' style='border-color: #A4A4A4; border-left-style: none; border-left-width: 0; border-right-style: none; border-right-width: 0; border-top-style: none; border-top-width: 0; border-bottom-style: solid; border-bottom-width: 1' width='220' height='10' bgcolor='#FFFFFF'><font color=#A4A4A4 size=2>Attachments</font>\n";
      echo "</td>\n";
      echo "<td valign='middle' align='left' style='border-color: #A4A4A4; border-left-style: none; border-left-width: 0; border-right-style: none; border-right-width: 0; border-top-style: none; border-top-width: 0; border-bottom-style: solid; border-bottom-width: 1' width='320' height='10' bgcolor='#FFFFFF'>\n";
      echo "</td>\n";
      echo "<td valign='middle' align='left' style='border-color: #A4A4A4; border-left-style: none; border-left-width: 0; border-right-style: none; border-right-width: 0; border-top-style: none; border-top-width: 0; border-bottom-style: solid; border-bottom-width: 1' width='80' height='10' bgcolor='#FFFFFF'>\n";
      echo "</td>\n";
      echo "<td valign='middle' align='left' style='border-color: #A4A4A4; border-left-style: none; border-left-width: 0; border-right-style: none; border-right-width: 0; border-top-style: none; border-top-width: 0; border-bottom-style: solid; border-bottom-width: 1' width='80' height='10' bgcolor='#FFFFFF'>\n";
      echo "</td>\n";
      echo "<td valign='middle' align='left' style='border-color: #A4A4A4; border-left-style: none; border-left-width: 0; border-right-style: none; border-right-width: 0; border-top-style: none; border-top-width: 0; border-bottom-style: none; border-bottom-width: 0' width='20' height='10' bgcolor='#FFFFFF'>\n";
      echo "</td>\n";
   echo "</tr>\n";

while ($att = mysql_fetch_assoc($attachments)) {
   $fileTypeSplit = split('/',$att['type']);
   if ($fileTypeSplit[0] == 'image') {$typeIMG = 'image/image.png';}
   elseif ($fileTypeSplit[0] == 'text') {
      if ($fileTypeSplit[1] == 'html') {$typeIMG = 'image/html.png';}
      else {$typeIMG = 'image/text.png';}
   }
   elseif ($fileTypeSplit[1] == 'pdf') {$typeIMG = 'image/pdf.png';}
   elseif ($fileTypeSplit[1] == 'zip') {$typeIMG = 'image/zip.png';}
   elseif ($fileTypeSplit[1] == 'msword') {$typeIMG = 'image/doc.png';}
   elseif ($fileTypeSplit[1] == 'vnd.ms-excel') {$typeIMG = 'image/xls.png';}
   elseif ($fileTypeSplit[1] == 'vnd.ms-powerpoint') {$typeIMG = 'image/doc.png';}
   else {$typeIMG = 'image/undef.png';}

   $date = $att['date'];
   $name = $att['filename'];
   $size = $att['size'];
   $comment = $att['comment'];
   $delete = "<a href='runlist/deleteAttachment.php?id=".$att['id']."&page=runlist/rundetails.php&runID=".$runNb."' onclick=\"return confirm('Are you sure you want to delete the file?')\"><img src='image/delete.png' border='0' align='absmiddle'></a>";
   
   echo "<tr>\n";
      echo "<td valign='middle' align='left' style='border-color: #A4A4A4; border-left-style: none; border-left-width: 0; border-right-style: none; border-right-width: 0; border-top-style: none; border-top-width: 0; border-bottom-style: solid; border-bottom-width: 1' width='220' height='30' bgcolor='#FFFFFF'><img src='".$typeIMG."' border='0' align='absmiddle'><font color='#A4A4A4' size='2'>&nbsp;<a href='attachments/".$name."' style='color:#A4A4A4'>".$name."</a></font></td>\n";
      echo "<td valign='middle' align='left' style='border-color: #A4A4A4; border-left-style: none; border-left-width: 0; border-right-style: none; border-right-width: 0; border-top-style: none; border-top-width: 0; border-bottom-style: solid; border-bottom-width: 1' width='320' height='30' bgcolor='#FFFFFF'><font color='#A4A4A4' size='2'>".$comment."</font></td>\n";
      echo "<td valign='middle' align='center' style='border-color: #A4A4A4; border-left-style: none; border-left-width: 0; border-right-style: none; border-right-width: 0; border-top-style: none; border-top-width: 0; border-bottom-style: solid; border-bottom-width: 1' width='80' height='30' bgcolor='#FFFFFF'><font color='#A4A4A4' size='2'>".$date."</font></td>\n";
      echo "<td valign='middle' align='center' style='border-color: #A4A4A4; border-left-style: none; border-left-width: 0; border-right-style: none; border-right-width: 0; border-top-style: none; border-top-width: 0; border-bottom-style: solid; border-bottom-width: 1' width='80' height='30' bgcolor='#FFFFFF'><font color='#A4A4A4' size='2'>".$size."&nbsp;kB</font></td>\n";
      echo "<td valign='middle' align='right' style='border-color: #A4A4A4; border-left-style: none; border-left-width: 0; border-right-style: none; border-right-width: 0; border-top-style: none; border-top-width: 0; border-bottom-style: none; border-bottom-width: 0' width='20' height='30' bgcolor='#FFFFFF'>$delete</td>\n";
   echo "</tr>\n";
}

echo "</table>\n";
echo "<br>";
}
?>
