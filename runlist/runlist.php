<?php

//**** Database ****
if ($_POST['exp']) {$database = "runlist_".$_POST['exp']; $exp = $_POST['exp'];}
else {$database = "runlist_xgt"; $exp = "xgt";}

//**** Home directory ****
switch ($_POST['exp']) {
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

// test connection to daq
$fp = fsockopen("lhepdaq5.unibe.ch", 22, $errno, $errstr, 3);
if (!$fp) {
    echo "<meta http-equiv='refresh' content='0; URL=error.php?err=$errstr'>";
}

// set current directory to homeDir
$d = $homeDir;

// connect with database
$db=mysql_connect("lheppc90.unibe.ch","exodaq","EXOsql");
mysql_select_db("exo");

// open run directory and get .mid and .root files
$dh  = opendir($d);
while (false !== ($filename = readdir($dh))) {
   $fileExt = substr($filename, strrpos($filename, '.'));
   if ($fileExt == ".mid" || $fileExt == ".root") {$files[] = $filename;}
}

// sort files in descending order
rsort($files);

// preselect files to display
$m = 0;
for ($i=0; $i<sizeof($files); $i++) {
   $file = $files[$i];

   $ext = substr($file, strrpos($file, '.') + 1);
   $runNb = substr($file, 0, strrpos($file, '.'));

   $run = mysql_query("select * from $database where runNumber = '$runNb'");
   $currentRun = mysql_fetch_assoc($run);

   if ($runNormal == 1 && $currentRun["category"] == 0) {$dislpayRun = true;}
   elseif ($runCalib == 1 && $currentRun["category"] == 1) {$dislpayRun = true;}
   elseif ($runIgnore == 1 && $currentRun["category"] == 2) {$dislpayRun = true;}
   elseif ($runTest == 1 && $currentRun["category"] == 3) {$dislpayRun = true;}
   elseif ($runHalted == 1 && $currentRun["category"] == 4) {$dislpayRun = true;}
   else {$dislpayRun = false;}

   if ($ext == "mid") {
      $midExist = true;
      $runNb = substr($file, 0, strrpos($file, '.'));
      if ($i == 0) {$rootExist = false;}
      else {
         if ($runNb.".root" == $files[$i - 1]) {$rootExist = true;}
         else {$rootExist = false;}
      }
   }
   else {$midExist = false;}
   
   if ($strnotfound == 0 && $midExist && $m < $nrFilesPerPage && $dislpayRun) {
      if ($rootExist) {$filesToDisplay[] = $files[$i - 1];}
      else {$filesToDisplay[] = $file;}
      $m++;
   }
}

$nrFilesPerPage = sizeof($filesToDisplay);

echo "<table align='center' border='0' bordercolor='#808080' cellpadding='0' cellspacing='0' style='border-collapse: collapse;' width='760'>\n";
echo "   <tr>\n";
echo "      <td valign='bottom' align='right' style='border-color: #808080; border-left-style: none; border-left-width: 0; border-right-style: none; border-right-width: 0; border-top-style: none; border-top-width: 0; border-bottom-style: none; border-bottom-width: 0' bgcolor='#FFFFFF' width='40' height='20'>\n";
echo "      </td>\n";
echo "      <td valign='bottom' align='left' style='border-color: #808080; border-left-style: none; border-left-width: 0; border-right-style: none; border-right-width: 0; border-top-style: none; border-top-width: 0; border-bottom-style: solid; border-bottom-width: 1' bgcolor='#FFFFFF' width='680' height='20'>\n";
echo "<font size='2' color='#808080'>Display options";
echo "      <td valign='bottom' align='right' style='border-color: #808080; border-left-style: none; border-left-width: 0; border-right-style: none; border-right-width: 0; border-top-style: none; border-top-width: 0; border-bottom-style: none; border-bottom-width: 0' bgcolor='#FFFFFF' width='40' height='20'>\n";
echo "      </td>\n";
echo "   </tr>\n";
echo "   <tr>\n";
echo "      <td valign='bottom' align='right' style='border-color: #808080; border-left-style: none; border-left-width: 0; border-right-style: none; border-right-width: 0; border-top-style: none; border-top-width: 0; border-bottom-style: none; border-bottom-width: 0' bgcolor='#FFFFFF' width='40' height='30'>\n";
echo "      </td>\n";
echo "      <td valign='middle' align='left' style='border-color: #808080; border-left-style: solid; border-left-width: 1; border-right-style: solid; border-right-width: 1; border-top-style: none; border-top-width: 0; border-bottom-style: solid; border-bottom-width: 1' bgcolor='#FFFFFF' width='680' height='30'>\n";
echo "<form action='index.php?page=runlist/runlist.php' id='options' class='fileform' method='post' enctype='multipart/form-data'>";
echo "<p style='margin-top: 5px; margin-bottom: 0px; margin-left: 5px; margin-right: 0px;'>";

echo "<input type='checkbox' name='DisplayOptions[]' value='all' onClick='CheckAllOptions(this)'>&nbsp;<font size='2'>All runs</font>&nbsp;&nbsp;";

if ($runNormal == 1) {echo "<input type='checkbox' name='DisplayOptions[]' value='normal' checked>";}
else {echo "<input type='checkbox' name='DisplayOptions[]' value='normal'>";}
echo "&nbsp;<font size='2'>Normal runs</font>&nbsp;";
echo "<img src='image/white.png' border='0' align='absmiddle'>&nbsp;&nbsp;&nbsp;&nbsp;";

if ($runCalib == 1) {echo "<input type='checkbox' name='DisplayOptions[]' value='calib' checked>";}
else {echo "<input type='checkbox' name='DisplayOptions[]' value='calib'>";}
echo "&nbsp;<font size='2'>Calibration runs</font>&nbsp;";
echo "<img src='image/green.png' border='0' align='absmiddle'>&nbsp;&nbsp;&nbsp;&nbsp;";

if ($runIgnore == 1) {echo "<input type='checkbox' name='DisplayOptions[]' value='ignore' checked>";}
else {echo "<input type='checkbox' name='DisplayOptions[]' value='ignore'>";}
echo "&nbsp;<font size='2'>Ignored runs</font>&nbsp;";
echo "<img src='image/red.png' border='0' align='absmiddle'>&nbsp;&nbsp;&nbsp;&nbsp;";

if ($runTest == 1) {echo "<input type='checkbox' name='DisplayOptions[]' value='test' checked>";}
else {echo "<input type='checkbox' name='DisplayOptions[]' value='test'>";}
echo "&nbsp;<font size='2'>Test runs</font>&nbsp;";
echo "<img src='image/blue.png' border='0' align='absmiddle'>&nbsp;&nbsp;&nbsp;&nbsp;";

if ($runHalted == 1) {echo "<input type='checkbox' name='DisplayOptions[]' value='halted' checked>";}
else {echo "<input type='checkbox' name='DisplayOptions[]' value='halted'>";}
echo "&nbsp;<font size='2'>Halted runs</font>&nbsp;";
echo "<img src='image/grey.png' border='0' align='absmiddle'></font></p>";
echo "<p style='margin-top: 10px; margin-bottom: 0px; margin-left: 5px; margin-right: 0px;'><font size='2'>";
echo "Max&nbsp;<input type='text' style='width:25px; height:20px;' name='nbFiles' maxlength='5' value='$nrFilesPerPage'>&nbsp;files (".sizeof($files)."&nbsp;total)</font></p>";
echo "<p align='right' style='margin-top: 0px; margin-bottom: 10px; margin-left: 0px; margin-right: 10px;'>";
echo "<input type='submit' class='btn' style='width:50px; height:20px;' value='Update'></form>";
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
echo "   <tr>\n";
echo "      <td valign='middle' align='left' style='border-color: #000000; border-left-style: none; border-left-width: 0; border-right-style: none; border-right-width: 0; border-top-style: none; border-top-width: 0; border-bottom-style: none; border-bottom-width: 0' bgcolor='#FFFFFF' width='40' height='2'>\n";
echo "      </td>\n";
echo "      <td valign='middle' align='left' style='border-color: #000000; border-left-style: none; border-left-width: 0; border-right-style: none; border-right-width: 0; border-top-style: solid; border-top-width: 1; border-bottom-style: none; border-bottom-width: 0' bgcolor='#FFFFFF' width='680' height='2'>\n";
echo "      </td>\n";
echo "      <td valign='middle' align='left' style='border-color: #000000; border-left-style: none; border-left-width: 0; border-right-style: none; border-right-width: 0; border-top-style: none; border-top-width: 0; border-bottom-style: none; border-bottom-width: 0' bgcolor='#FFFFFF' width='40' height='2'>\n";
echo "      </td>\n";
echo "   </tr>\n";
echo "</table>\n";

echo "<form action='enterruncategory.php' id='ckRun' class='fileform' method='post' enctype='multipart/form-data'>";

?>
<table align="center" border="0" bordercolor="#000000" cellpadding="0" cellspacing="0" style="border-collapse: collapse; " width="760">
   <tr>
      <td valign="middle" align="right" style="border-color: #000000; border-left-style: none; border-left-width: 0; border-right-style: none; border-right-width: 0; border-top-style: none; border-top-width: 0; border-bottom-style: none; border-bottom-width: 0" width="10" height="30" bgcolor="#FFFFFF">
      </td>
      <td valign="middle" align="left" style="border-color: #000000; border-left-style: none; border-left-width: 0; border-right-style: none; border-right-width: 0; border-top-style: none; border-top-width: 0; border-bottom-style: none; border-bottom-width: 0" width="30" height="30" bgcolor="#FFFFFF">
<?php
      echo "<input type='checkbox' name='checkAll' onClick='CheckAllRun(this)'>";
?>
      </td>
      <td valign="middle" align="left" style="border-color: #000000; border-left-style: none; border-left-width: 0; border-right-style: none; border-right-width: 0; border-top-style: none; border-top-width: 0; border-bottom-style: solid; border-bottom-width: 1" width="80" height="30" bgcolor="#FFFFFF"><font size="2">Run#</font>
      </td>
      <td valign="middle" align="center" style="border-color: #000000; border-left-style: none; border-left-width: 0; border-right-style: none; border-right-width: 0; border-top-style: none; border-top-width: 0; border-bottom-style: solid; border-bottom-width: 1" width="80" height="30" bgcolor="#FFFFFF"><font size="2">Nb events</font>
      </td>
      <td valign="middle" align="center" style="border-color: #000000; border-left-style: none; border-left-width: 0; border-right-style: none; border-right-width: 0; border-top-style: none; border-top-width: 0; border-bottom-style: solid; border-bottom-width: 1" width="80" height="30" bgcolor="#FFFFFF"><font size="2">Duration [s]</font>
      </td>
      <td valign="middle" align="center" style="border-color: #000000; border-left-style: none; border-left-width: 0; border-right-style: none; border-right-width: 0; border-top-style: none; border-top-width: 0; border-bottom-style: solid; border-bottom-width: 1" width="85" height="30" bgcolor="#FFFFFF"><font size="2">Pressure [bar]</font>
      </td>
      <td valign="middle" align="center" style="border-color: #000000; border-left-style: none; border-left-width: 0; border-right-style: none; border-right-width: 0; border-top-style: none; border-top-width: 0; border-bottom-style: solid; border-bottom-width: 1" width="75" height="30" bgcolor="#FFFFFF"><font size="2">Grid [V]</font>
      </td>
      <td valign="middle" align="center" style="border-color: #000000; border-left-style: none; border-left-width: 0; border-right-style: none; border-right-width: 0; border-top-style: none; border-top-width: 0; border-bottom-style: solid; border-bottom-width: 1" width="80" height="30" bgcolor="#FFFFFF"><font size="2">Leakage [nA]</font>
      </td>
      <td valign="middle" align="center" style="border-color: #000000; border-left-style: none; border-left-width: 0; border-right-style: none; border-right-width: 0; border-top-style: none; border-top-width: 0; border-bottom-style: solid; border-bottom-width: 1" width="200" height="30" bgcolor="#FFFFFF"><font size="2">Notes</font>
      </td>
      <td valign="middle" align="center" style="border-color: #000000; border-left-style: none; border-left-width: 0; border-right-style: none; border-right-width: 0; border-top-style: none; border-top-width: 0; border-bottom-style: none; border-bottom-width: 0" width="40" height="30" bgcolor="#FFFFFF">
      </td>
   </tr>
      
   <?php
// **** Start of files display ********************************************************************

   for ($i=0; $i<sizeof($filesToDisplay); $i++) {
      $file = $filesToDisplay[$i];
      $file_s = "$d/$file";
      $ext = substr($file, strrpos($file, '.'));
      $runNb = substr($file, 0, strrpos($file, '.'));
      
      // get size of file
      $siz = filesize($file_s);
      
      // check if run exists in database
      $run = mysql_query("select * from $database where runNumber = '$runNb'");
      
      // update run info if run already in database ...
      if ($currentRun = mysql_fetch_assoc($run)) {
         if ($ext == ".root" && ($currentRun['runDate'] == "0" || $currentRun['runDate'] == NULL || ($currentRun['runDuration'] == NULL || $currentRun['runDuration'] == "0") && ($currentRun['nbEvents'] == NULL || $currentRun['nbEvents'] == "0"))) {
            $cmd = "$LibExport; $PathExport; getRunInfo $homeDir$file";
            $outp = shell_exec($cmd);
            $runInfo = split(';', $outp);
            
            $upd = mysql_query("update $database set nbEvents='$runInfo[0]', runDuration='$runInfo[1]', trigThreshold='$runInfo[2]', extTrigStatus='$runInfo[3]', localTrigStatus='$runInfo[4]', grpMultiplicity='$runInfo[5]', runDate='$runInfo[6]', fileSize='$siz' where runNumber = '$runNb'");

            switch($currentRun['category']) {
               case 0:
                  $bc = "#FFFFFF";
                  break;
               case 1:
                  $bc = "#BAFFA2";
                  break;
               case 2:
                  $bc = "#FFA2A2";
                  break;
               case 3:
                  $bc = "#A2C1FF";
                  break;
               case 4:
                  $bc = "#D8D8D8";
                  break;
            }
         }
         elseif ($ext == ".mid") {
            switch($currentRun['category']) {
               case 0:
                  $bc = "#FDFEB9";
                  break;
               case 1:
                  $bc = "#BAFFA2";
                  break;
               case 2:
                  $bc = "#FFA2A2";
                  break;
               case 3:
                  $bc = "#A2C1FF";
                  break;
               case 4:
                  $bc = "#FDFEB9";
                  break;
            }
         }
         else {
            switch($currentRun['category']) {
               case 0:
                  $bc = "#FFFFFF";
                  break;
               case 1:
                  $bc = "#BAFFA2";
                  break;
               case 2:
                  $bc = "#FFA2A2";
                  break;
               case 3:
                  $bc = "#A2C1FF";
                  break;
               case 4:
                  $bc = "#D8D8D8";
                  break;
            }
         }
      }
      // ... else insert run into database
      else {
         if ($ext == ".root") {
            $cmd = "$LibExport; $PathExport; getRunInfo $homeDir$file";
            $outp = shell_exec($cmd);
            $runInfo = split(';', $outp);
            
            $input=mysql_query("insert into $database (runNumber, runDate, runDuration, nbEvents, trigThreshold, grpMultiplicity, extTrigStatus, localTrigStatus, fileSize) values ('$runNb', '$runInfo[6]', '$runInfo[1]', '$runInfo[0]','$runInfo[2]', '$runInfo[5]', '$runInfo[3]', '$runInfo[4]', '$siz')") or die (mysql_error());
            $bc = "#FFFFFF";
         }
         else {
            $input=mysql_query("insert into $database (runNumber, fileSize) values ('$runNb', '$siz')") or die (mysql_error());
            $bc = "#FDFEB9";
         }
      }
      
      // reload run
      $runR = mysql_query("select * from $database where runNumber = '$runNb'");
      $currentRunR = mysql_fetch_assoc($runR);
      $dateOfRunR = date("m/d/Y",$currentRunR['runDate']);

      // get number of attached files
      $attachment = mysql_query("select * from attachments where run = '$runNb' && experiment = '$exp'");
      $nAtt = mysql_num_rows($attachment);

      echo "<tr>";
         echo "<td valign='middle' align='right' style='border-color: #C0C0C0; border-left-style: none; border-left-width: 0; border-right-style: none; border-right-width: 0; border-top-style: none; border-top-width: 0; border-bottom-style: none; border-bottom-width: 0' width='10' height='20' bgcolor='#FFFFFF'>";
         echo "</td>";
         echo "<td valign='middle' align='left' style='border-color: #C0C0C0; border-left-style: none; border-left-width: 0; border-right-style: none; border-right-width: 0; border-top-style: none; border-top-width: 0; border-bottom-style: none; border-bottom-width: 0' width='30' height='20' bgcolor='#FFFFFF'>";
         echo "<input type='checkbox' name='SelectedRun[]' value='$runNb'>";
         echo "</td>";
         echo "<td valign='middle' align='left' style='border-color: #C0C0C0; border-left-style: none; border-left-width: 0; border-right-style: none; border-right-width: 0; border-top-style: none; border-top-width: 0; border-bottom-style: solid; border-bottom-width: 1' width='80' height='20' bgcolor='$bc'><font size='2'>";
         echo "<a href='index.php?page=runlist/rundetails.php&id=$runNb' title='$dateOfRunR'>$file</a>";
         if ($nAtt > 0) {echo "&nbsp;&nbsp;&nbsp;&nbsp;<img src='image/attachment.png' align='absmiddle'>$nAtt";}
         echo "</font></td>";
         echo "<td valign='middle' align='center' style='border-color: #C0C0C0; border-left-style: none; border-left-width: 0; border-right-style: none; border-right-width: 0; border-top-style: none; border-top-width: 0; border-bottom-style: solid; border-bottom-width: 1' width='80' height='30' bgcolor='$bc'><font size='2'>";
         echo $currentRunR['nbEvents'];
         echo "</font></td>";
         echo "<td valign='middle' align='center' style='border-color: #C0C0C0; border-left-style: none; border-left-width: 0; border-right-style: none; border-right-width: 0; border-top-style: none; border-top-width: 0; border-bottom-style: solid; border-bottom-width: 1' width='80' height='30' bgcolor='$bc'><font size='2'>";
         echo $currentRunR['runDuration'];
         echo "</font></td>";
         echo "<td valign='middle' align='center' style='border-color: #C0C0C0; border-left-style: none; border-left-width: 0; border-right-style: none; border-right-width: 0; border-top-style: none; border-top-width: 0; border-bottom-style: solid; border-bottom-width: 1' width='85' height='30' bgcolor='$bc'><font size='2'>";
         if ($currentRunR['pressure']) {echo $currentRunR['pressure'];}
         echo "</font></td>";
         echo "<td valign='middle' align='center' style='border-color: #C0C0C0; border-left-style: none; border-left-width: 0; border-right-style: none; border-right-width: 0; border-top-style: none; border-top-width: 0; border-bottom-style: solid; border-bottom-width: 1' width='75' height='30' bgcolor='$bc'><font size='2'>";
         if ( $currentRunR['gridVolt']) {echo $currentRunR['gridVolt'];}
         echo "</font></td>";
         echo "<td valign='middle' align='center' style='border-color: #C0C0C0; border-left-style: none; border-left-width: 0; border-right-style: none; border-right-width: 0; border-top-style: none; border-top-width: 0; border-bottom-style: solid; border-bottom-width: 1' width='80' height='30' bgcolor='$bc'><font size='2'>";
         if ($currentRunR['leakageCurrent']) {echo $currentRunR['leakageCurrent'];}
         echo "</font></td>";
         echo "<td valign='middle' align='center' style='border-color: #C0C0C0; border-left-style: none; border-left-width: 0; border-right-style: none; border-right-width: 0; border-top-style: none; border-top-width: 0; border-bottom-style: solid; border-bottom-width: 1' width='200' height='30' bgcolor='$bc'><font size='2'>";
         if (strlen($currentRunR['notes']) > 28) {echo substr($currentRunR['notes'], 0,28)."...";}
         elseif ($currentRunR['notes']) {echo $currentRunR['notes'];}
         echo "</font></td>";
         echo "<td valign='middle' align='left' style='border-color: #C0C0C0; border-left-style: none; border-left-width: 0; border-right-style: none; border-right-width: 0; border-top-style: none; border-top-width: 0; border-bottom-style: none; border-bottom-width: 0' width='40' height='30' bgcolor='#FFFFFF'>";
         if ($ext == ".mid") {echo "&nbsp;<a href='runlist/convert.php?id=$runNb' title='Convert midas file to root file'><img src='image/convert.png' border='0' align='absmiddle' id='$i' alt='' onmousedown='change($i)'></a>";}
         echo "</td>";
      echo "</tr>";
   }

// **** End of files display **********************************************************************
   ?>
   <tr>
      <td valign="middle" align="right" style="border-color: #000000; border-left-style: none; border-left-width: 0; border-right-style: none; border-right-width: 0; border-top-style: none; border-top-width: 0; border-bottom-style: none; border-bottom-width: 0" width="10" height="2" bgcolor="#FFFFFF">
      </td>
      <td valign="middle" align="right" style="border-color: #000000; border-left-style: none; border-left-width: 0; border-right-style: none; border-right-width: 0; border-top-style: none; border-top-width: 0; border-bottom-style: none; border-bottom-width: 0" width="30" height="2" bgcolor="#FFFFFF">
      </td>
      <td valign="middle" align="right" style="border-color: #000000; border-left-style: none; border-left-width: 0; border-right-style: none; border-right-width: 0; border-top-style: none; border-top-width: 0; border-bottom-style: none; border-bottom-width: 0" width="80" height="2" bgcolor="#FFFFFF">
      </td>
      <td valign="middle" align="right" style="border-color: #000000; border-left-style: none; border-left-width: 0; border-right-style: none; border-right-width: 0; border-top-style: none; border-top-width: 0; border-bottom-style: none; border-bottom-width: 0" width="80" height="2" bgcolor="#FFFFFF">
      </td>
      <td valign="middle" align="right" style="border-color: #000000; border-left-style: none; border-left-width: 0; border-right-style: none; border-right-width: 0; border-top-style: none; border-top-width: 0; border-bottom-style: none; border-bottom-width: 0" width="80" height="2" bgcolor="#FFFFFF">
      </td>
      <td valign="middle" align="right" style="border-color: #000000; border-left-style: none; border-left-width: 0; border-right-style: none; border-right-width: 0; border-top-style: none; border-top-width: 0; border-bottom-style: none; border-bottom-width: 0" width="85" height="2" bgcolor="#FFFFFF">
      </td>
      <td valign="middle" align="right" style="border-color: #000000; border-left-style: none; border-left-width: 0; border-right-style: none; border-right-width: 0; border-top-style: none; border-top-width: 0; border-bottom-style: none; border-bottom-width: 0" width="75" height="2" bgcolor="#FFFFFF">
      </td>
      <td valign="middle" align="right" style="border-color: #000000; border-left-style: none; border-left-width: 0; border-right-style: none; border-right-width: 0; border-top-style: none; border-top-width: 0; border-bottom-style: none; border-bottom-width: 0" width="80" height="2" bgcolor="#FFFFFF">
      </td>
      <td valign="middle" align="right" style="border-color: #000000; border-left-style: none; border-left-width: 0; border-right-style: none; border-right-width: 0; border-top-style: none; border-top-width: 0; border-bottom-style: none; border-bottom-width: 0" width="200" height="2" bgcolor="#FFFFFF">
      </td>
      <td valign="middle" align="right" style="border-color: #000000; border-left-style: none; border-left-width: 0; border-right-style: none; border-right-width: 0; border-top-style: none; border-top-width: 0; border-bottom-style: none; border-bottom-width: 0" width="40" height="2" bgcolor="#FFFFFF">
      </td
   </tr>
   <tr>
      <td valign="middle" align="right" style="border-color: #000000; border-left-style: none; border-left-width: 0; border-right-style: none; border-right-width: 0; border-top-style: none; border-top-width: 0; border-bottom-style: none; border-bottom-width: 0" width="10" height="60" bgcolor="#FFFFFF">
      </td>
      <td valign="top" align="left" style="border-color: #000000; border-left-style: none; border-left-width: 0; border-right-style: none; border-right-width: 0; border-top-style: none; border-top-width: 0; border-bottom-style: none; border-bottom-width: 0" width="30" height="60" bgcolor="#FFFFFF">
<p style="margin-top: 5px; margin-bottom: 0px; margin-left: 7px; margin-right: 0px;">
<img src="image/arrow.gif" border="0">
<p>
      </td>
      <td valign="top" align="left" style="border-color: #000000; border-left-style: none; border-left-width: 0; border-right-style: none; border-right-width: 0; border-top-style: none; border-top-width: 0; border-bottom-style: none; border-bottom-width: 0" width="80" height="60" bgcolor="#FFFFFF">
<?php

echo "<p style='margin-top: 5px; margin-bottom: 0px; margin-left: 0px; margin-right: 0px;'>";
echo "<select name='selectOption'>";
echo "<option>Mark as:</option>";
echo "<option>Normal run</option>";
echo "<option>Ignore run</option>";
echo "<option>Calibration run</option>";
echo "<option>Test run</option>";
echo "<option>Halted run</option>";
echo "</select>";
echo "</p>";

?>
      </td>
      <td valign="top" align="center" style="border-color: #000000; border-left-style: none; border-left-width: 0; border-right-style: none; border-right-width: 0; border-top-style: none; border-top-width: 0; border-bottom-style: none; border-bottom-width: 0" width="80" height="60" bgcolor="#FFFFFF">
<?php

echo "<p style='margin-top: 5px; margin-bottom: 0px; margin-left: 0px; margin-right: 0px;'>";
echo "<input type='submit' class='btn' style='width:35px; height:20px;' value='OK' onclick='markRuns()'>";
echo "</p>";

?>
      </td>
      <td valign="middle" align="right" style="border-color: #000000; border-left-style: none; border-left-width: 0; border-right-style: none; border-right-width: 0; border-top-style: none; border-top-width: 0; border-bottom-style: none; border-bottom-width: 0" width="80" height="60" bgcolor="#FFFFFF">
      </td>
      <td valign="middle" align="right" style="border-color: #000000; border-left-style: none; border-left-width: 0; border-right-style: none; border-right-width: 0; border-top-style: none; border-top-width: 0; border-bottom-style: none; border-bottom-width: 0" width="85" height="60" bgcolor="#FFFFFF">
      </td>
      <td valign="middle" align="right" style="border-color: #000000; border-left-style: none; border-left-width: 0; border-right-style: none; border-right-width: 0; border-top-style: none; border-top-width: 0; border-bottom-style: none; border-bottom-width: 0" width="75" height="60" bgcolor="#FFFFFF">
      </td>
      <td valign="middle" align="right" style="border-color: #000000; border-left-style: none; border-left-width: 0; border-right-style: none; border-right-width: 0; border-top-style: none; border-top-width: 0; border-bottom-style: none; border-bottom-width: 0" width="80" height="60" bgcolor="#FFFFFF">
      </td>
      <td valign="middle" align="right" style="border-color: #000000; border-left-style: none; border-left-width: 0; border-right-style: none; border-right-width: 0; border-top-style: none; border-top-width: 0; border-bottom-style: none; border-bottom-width: 0" width="200" height="60" bgcolor="#FFFFFF">
      </td>
      <td valign="middle" align="right" style="border-color: #000000; border-left-style: none; border-left-width: 0; border-right-style: none; border-right-width: 0; border-top-style: none; border-top-width: 0; border-bottom-style: none; border-bottom-width: 0" width="40" height="60" bgcolor="#FFFFFF">
      </td
   </tr>
</table>
</form>
