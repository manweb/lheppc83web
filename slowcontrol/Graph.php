<?php

// difference between LabView time and Unix time in seconds
$dt = 2082848400;

$tStart = $_GET["start"];
$tStartLV = $tStart + $dt;

$tEnd = $_GET["end"];
$tEndLV = $tEnd + $dt;

$var = $_GET["variable"];

// number of datapoints
$maxSamples = ($tEndLV - $tStartLV) / 10;
if ($maxSamples > 500) {$nrSample = 500;}
else {$nrSample = floor($maxSamples);}

// connect with database
$db=mysql_connect("lheppc90.unibe.ch","exodaq","EXOsql");
mysql_select_db("exo");

$dataTMP = array();
$timeTMP = array();
$k = 0;
/*for ($startTime = $tStartLV; $startTime <= $tEndLV; $startTime = $startTime + 10) {
   $endTime = $startTime + 10;
   $SC = mysql_query("select * from slowcontrol where Time >= $startTime and Time < $endTime");
   if ($SCValue = mysql_fetch_assoc($SC)) {
      $dataTMP[$k] = $SCValue[$var];
      $timeTMP[$k] = $SCValue["Time"];
   }
   else {
      $dataTMP[$k] = -100;
      $timeTMP[$k] = $startTime + 5;
   }
   $k++;
}*/

$SC = mysql_query("select * from slowcontrol where Time >= $tStartLV and Time < $tEndLV");
while ($SCValue = mysql_fetch_assoc($SC)) {
   $dataTMP[$k] = $SCValue[$var];
   $timeTMP[$k] = $SCValue["Time"];
   $k++;
}

if (sizeof($dataTMP) > 500) {$stepSize = sizeof($dataTMP) / $nrSample;}
else {$stepSize = 1;}

$data = array();
$time = array();
$k = 0;
for ($i = 0; $i < sizeof($dataTMP); $i++) {
   if (round($k*$stepSize) == $i) {
      if ($var == "TC1" || $var == "TC2" || $var == "TC3") {$data[$k] = $dataTMP[$i] - 273.16;}
      else {$data[$k] = $dataTMP[$i];}
      $time[$k] = $timeTMP[$i];
      $k++;
   }
}

// Define .PNG image
header("Content-type: image/png");

// Image dimensions
$imgWidth = 600;
$imgHeight = 330;
$MarginLeft = 50;
$MarginRight = 50;
$MarginTop = 10;
$MarginBottom = 80;
$topOffset = 10;

$GraphWidth = $imgWidth - $MarginLeft - $MarginRight;
$GraphHeight = $imgHeight - $MarginTop - $MarginBottom - $topOffset;

// Y axis plot range
$rangeYmax = GetMax($data);
$rangeYmin = GetMin($data);

if ($rangeYmax == $rangeYmin) {$rangeYmin = 0.5 * $rangeYmin;}
else {$rangeYmin = $rangeYmin - ($rangeYmax - $rangeYmin) / 5;}

// X axis plot range
$rangeXmax = max($time);
$rangeXmin = min($time);

// Data scaling factor
$scData = $GraphHeight / ($rangeYmax - $rangeYmin);
$offsetData = $scData * $rangeYmin;

$scTime = $GraphWidth / ($rangeXmax - $rangeXmin);
$offsetTime = $scTime * $rangeXmin;

// Create image and define colors
$image=imagecreate($imgWidth, $imgHeight);

$colorWhite=imagecolorallocate($image, 255, 255, 255);
$colorGrey=imagecolorallocate($image, 192, 192, 192);
$colorBlue=imagecolorallocate($image, 0, 0, 255);
$colorBlack= imagecolorallocate($image, 0, 0, 0);
$colorLightBlue=imagecolorallocate($image, 160, 160, 255);
$colorLightRed=imagecolorallocate($image, 255, 160, 160);
$colorLightGreen=imagecolorallocate($image, 160, 255, 160);

// Create Grid
$stepSizeX = $GraphWidth / 10;
for ($i = 0; $i < 11; $i++) {
   $xLabelUnix = $i * $stepSizeX / $scTime + $rangeXmin - $dt + 3600; // add 1 hour to convert UTC into MESZ
   $xlabelDate = date("m/d/Y",$xLabelUnix);
   $xlabelTime = date("H:i:s",$xLabelUnix);
   if ($i != 0 && $i != 10) {imageline($image, $i * $stepSizeX + $MarginLeft, $imgHeight - $MarginBottom, $i * $stepSizeX + $MarginLeft, $MarginTop, $colorGrey);}
   imagestringup($image, 2, $i * $stepSizeX + $MarginLeft - 12, $imgHeight - 5, "$xlabelDate", $colorBlack);
   imagestringup($image, 2, $i * $stepSizeX + $MarginLeft, $imgHeight - 5, "$xlabelTime", $colorBlack);
}

$stepSizeY = ($GraphHeight + $topOffset) / 5;
for ($i = 0; $i < 6; $i++) {
   $yLabel = round($i * $stepSizeY / $scData + $rangeYmin,2);
   if ($i != 0 && $i != 5) {imageline($image, $MarginLeft, $i * $stepSizeY + $MarginTop, $imgWidth - $MarginRight, $i * $stepSizeY + $MarginTop, $colorGrey);}
   imagestring($image, 2, 2, $imgHeight - $MarginBottom - $i * $stepSizeY - 8, "$yLabel", $colorBlack);
}

// Draw the data
for ($i = 0; $i < sizeof($data) - 1; $i++) {
   if ($data[$i] != -100) {
       if ($data[$i+1] == -100) {
          imageline($image, $scTime * $time[$i] - $offsetTime + $MarginLeft, $imgHeight - $MarginBottom - ($scData * $data[$i] - $offsetData), $scTime * $time[$i + 1] - $offsetTime + $MarginLeft, $imgHeight - $MarginBottom - ($scData * $data[$i] - $offsetData), $colorBlue);
      }
      else {
         imageline($image, $scTime * $time[$i] - $offsetTime + $MarginLeft, $imgHeight - $MarginBottom - ($scData * $data[$i] - $offsetData), $scTime * $time[$i + 1] - $offsetTime + $MarginLeft, $imgHeight - $MarginBottom - ($scData * $data[$i + 1] - $offsetData), $colorBlue);
      }
   }
   else {
      imagefilledpolygon($image, array($scTime * $time[$i] - $offsetTime + $MarginLeft, $imgHeight - $MarginBottom, $scTime * $time[$i] - $offsetTime + $MarginLeft, $MarginTop, $scTime * $time[$i + 1] - $offsetTime + $MarginLeft, $MarginTop, $scTime * $time[$i + 1] - $offsetTime + $MarginLeft, $imgHeight - $MarginBottom), 4, $colorLightGreen);
   }
}

// Create border around image
imageline($image, $MarginLeft, $MarginTop, $MarginLeft, $imgHeight - $MarginBottom, $colorBlack);
imageline($image, $MarginLeft, $MarginTop, $imgWidth - $MarginRight, $MarginTop, $colorGrey);
imageline($image, $imgWidth - $MarginRight, $MarginTop, $imgWidth - $MarginRight, $imgHeight - $MarginBottom, $colorGrey);
imageline($image, $MarginRight, $imgHeight - $MarginBottom, $imgWidth - $MarginRight, $imgHeight - $MarginBottom, $colorBlack);

// Output graph and clear image from memory
imagepng($image);
imagedestroy($image);

function GetMax($data) {
   $siz = sizeof($data);
   $max = -1000000;
   for ($i = 0; $i < $siz; $i++) {
      if ($data[$i] > $max && $data[$i] != -100) {$max = $data[$i];}
   }

   if ($siz == 0) {$max = 0;}
   return($max);
}

function GetMin($data) {
   $siz = sizeof($data);
   $min = 1000000;
   for ($i = 0; $i < $siz; $i++) {
      if ($data[$i] < $min && $data[$i] != -100) {$min = $data[$i];}
   }

   if ($siz == 0) {$min = 0;}
   return($min);
}

?>
