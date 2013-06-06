<?php

$runID = $_GET['runID'];

echo "<p align='center'>Choose file to upload</p>";

echo "<form name='Formular' action='runlist/upload.php?runID=$runID' method='post' enctype='multipart/form-data'>";
echo "<table align='center' border='0' bordercolor='#000000' cellpadding='0' cellspacing='0' style='border-collapse: collapse; ' width='350'>\n";
   echo "<tr>\n";
      echo "<td valign='middle' align='left' style='border-color: #000000; border-left-style: none; border-left-width: 0; border-right-style: none; border-right-width: 0; border-top-style: none; border-top-width: 0; border-bottom-style: none; border-bottom-width: 0' width='150' bgcolor='#FFFFFF'>File:</td>\n";
      echo "<td valign='middle' align='left' style='border-color: #000000; border-left-style: none; border-left-width: 0; border-right-style: none; border-right-width: 0; border-top-style: none; border-top-width: 0; border-bottom-style: none; border-bottom-width: 0' width='200' bgcolor='#FFFFFF'>";
      echo "<input type='file' name='file'><br>";
      echo "</td>\n";
   echo "</tr>";
   echo "<tr>\n";
      echo "<td valign='middle' align='left' style='border-color: #000000; border-left-style: none; border-left-width: 0; border-right-style: none; border-right-width: 0; border-top-style: none; border-top-width: 0; border-bottom-style: none; border-bottom-width: 0' width='150' bgcolor='#FFFFFF'>Description:</td>\n";
      echo "<td valign='middle' align='left' style='border-color: #000000; border-left-style: none; border-left-width: 0; border-right-style: none; border-right-width: 0; border-top-style: none; border-top-width: 0; border-bottom-style: none; border-bottom-width: 0' width='200' bgcolor='#FFFFFF'>";
      echo "<input type='text' name='comment'><br>";
      echo "</td>\n";
   echo "</tr>";
echo "</table>";

echo "<p align='center'><input type='submit' value='Upload'></p>";
echo "</form>";
echo "<br>";

?>
