<?php

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
echo "<font size='2'>Edit details of run# $runNb</font>";
echo "      </td>\n";
echo "      <td valign='middle' align='right' style='border-color: #000000; border-left-style: none; border-left-width: 0; border-right-style: none; border-right-width: 0; border-top-style: none; border-top-width: 0; border-bottom-style: solid; border-bottom-width: 1' bgcolor='#FFFFFF' width='360' height='30'>\n";
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

// **** End of Header *****************************************************************************

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

echo "<form action='runlist/enterrundetails.php' class='fileform' method='post' enctype='multipart/form-data'>\n";

echo "<table align='center' border='0' bordercolor='#000000' cellpadding='0' cellspacing='0' style='border-collapse: collapse; ' width='720'\n";
echo "   <tr>\n";
echo "      <td valign='middle' align='left' style='border-left-color: #FFFFFF; border-left-width: 0; border-right-color: #FFFFFF; border-right-width: 0; border-top-color: #FFFFFF; border-top-width: 0; border-bottom-color: #000000; border-bottom-width: 0' width='250' bgcolor='#FFFFFF'>\n";
echo "<font size='2'>Start of run:</font>";
echo "      </td>\n";
echo "      <td valign='middle' align='left' style='border-left-color: #FFFFFF; border-left-width: 0; border-right-color: #FFFFFF; border-right-width: 0; border-top-color: #FFFFFF; border-top-width: 0; border-bottom-color: #000000; border-bottom-width: 0' width='470' bgcolor='#FFFFFF'>\n";
if ($currentRun['runDate']) {echo "<font size='2'>".$startDate."</font>";}
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
if ($currentRun['runDate']) {echo "<font size='2'>".$endDate."</font>";}
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
$val = $currentRun['pressure'];
echo "<input type='text' name='Inputpressure' maxlength='10' value='$val' style='width:60px;'>&nbsp;<font size='2'>bar</font>";
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
$val = $currentRun['gridVolt'];
echo "<input type='text' name='InputgridVolt' maxlength='10' value='$val' style='width:60px;'>&nbsp;<font size='2'>V</font>";
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
$val = $currentRun['cathodeVolt'];
echo "<input type='text' name='InputcathodeVolt' maxlength='10' value='$val' style='width:60px;'>&nbsp;<font size='2'>V</font>";
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
$val = $currentRun['firstRingVolt'];
echo "<input type='text' name='InputfirstRingVolt' maxlength='10' value='$val' style='width:60px;'>&nbsp;<font size='2'>V</font>";
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
$val = $currentRun['leakageCurrent'];
echo "<input type='text' name='InputleakagaCurrent' maxlength='10' value='$val' style='width:60px;'>&nbsp;<font size='2'>nA</font>";
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
echo "      <td valign='middle' align='left' style='border-left-color: #FFFFFF; border-left-width: 0; border-right-color: #FFFFFF; border-right-width: 0; border-top-color: #FFFFFF; border-top-width: 0; border-bottom-color: #000000; border-bottom-width: 0' width='250' bgcolor='#FFFFFF'>\n";
echo "<font size='2'>Run category:</font>";
echo "      </td>\n";
echo "      <td valign='middle' align='left' style='border-left-color: #FFFFFF; border-left-width: 0; border-right-color: #FFFFFF; border-right-width: 0; border-top-color: #FFFFFF; border-top-width: 0; border-bottom-color: #000000; border-bottom-width: 0' width='470' bgcolor='#FFFFFF'>\n";
$val = $currentRun['category'];

echo "<select name='selectOption'>";
switch ($val) {
   case 0:
      echo "<option>Normal run</option>";
      break;
   case 1:
      echo "<option>Calibration run</option>";
      break;
   case 2:
      echo "<option>Ignore run</option>";
      break;
   case 3:
      echo "<option>Test run</option>";
      break;
   case 4:
      echo "<option>Halted run</option>";
      break;
}
echo "<option></option>";
echo "<option>Normal run</option>";
echo "<option>Ignore run</option>";
echo "<option>Calibration run</option>";
echo "<option>Test run</option>";
echo "<option>Halted run</option>";
echo "</select>";
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
$val = $currentRun['notes'];
echo "<textarea name='Inputnotes' rows='10' cols='50' align='top' class='field'>$val</textarea>";
echo "      </td>\n";
echo "   </tr>\n";

echo "   <tr>\n";
echo "      <td valign='middle' align='left' style='border-left-color: #FFFFFF; border-left-width: 0; border-right-color: #FFFFFF; border-right-width: 0; border-top-color: #FFFFFF; border-top-width: 0; border-bottom-color: #000000; border-bottom-width: 0' width='250' height='10' bgcolor='#FFFFFF'></td>\n";
echo "      <td valign='middle' align='left' style='border-left-color: #FFFFFF; border-left-width: 0; border-right-color: #FFFFFF; border-right-width: 0; border-top-color: #FFFFFF; border-top-width: 0; border-bottom-color: #000000; border-bottom-width: 0' width='470' height='10' bgcolor='#FFFFFF'></td>\n";
echo "   </tr>\n";

echo "<input type='hidden' name='Inputid' value='$runNb'>";

echo "</table>\n";

echo "<p align='center' style='margin-bottom: 10px;'><input type='submit' value='Save' class='btn'>&nbsp;<input type='reset' value='Cancel' class='btn'></p>";

echo "</form>\n";


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
