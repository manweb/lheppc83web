<?php

echo "<html>";
echo "<head>";
echo "<title>SlowControl</title>";
echo "</head>";

echo "<body>";

if ($_GET['nHours']) {$nhours = $_GET['nHours'];}
else {$nhours = 1;}

$tStart = time() - $nhours*3600 - 3600;
$tEnd = time() - 3600;

echo "<table align='left' border='0' bordercolor='#808080' cellpadding='0' cellspacing='0' style='border-collapse: collapse;' width='800'>\n";
echo "   <tr>\n";
echo "      <td valign='bottom' align='center' style='border-color: #808080; border-left-style: none; border-left-width: 0; border-right-style: none; border-right-width: 0; border-top-style: none; border-top-width: 0; border-bottom-style: none; border-bottom-width: 0' bgcolor='#FFFFFF' width='133' height='20'>\n";
echo "<form action='SlowControlOverview.php?nHours=1' id='plot' class='fileForm' method='post' enctype='multipart/form-data'><input type='submit' value='1h'></form>";
echo "      </td>\n";
echo "      <td valign='bottom' align='center' style='border-color: #808080; border-left-style: none; border-left-width: 0; border-right-style: none; border-right-width: 0; border-top-style: none; border-top-width: 0; border-bottom-style: none; border-bottom-width: 0' bgcolor='#FFFFFF' width='133' height='20'>\n";
echo "<form action='SlowControlOverview.php?nHours=2' id='plot' class='fileForm' method='post' enctype='multipart/form-data'><input type='submit' value='2h'></form>";
echo "      </td>\n";
echo "      <td valign='bottom' align='center' style='border-color: #808080; border-left-style: none; border-left-width: 0; border-right-style: none; border-right-width: 0; border-top-style: none; border-top-width: 0; border-bottom-style: none; border-bottom-width: 0' bgcolor='#FFFFFF' width='133' height='20'>\n";
echo "<form action='SlowControlOverview.php?nHours=8' id='plot' class='fileForm' method='post' enctype='multipart/form-data'><input type='submit' value='8h'></form>";
echo "      </td>\n";
echo "      <td valign='bottom' align='center' style='border-color: #808080; border-left-style: none; border-left-width: 0; border-right-style: none; border-right-width: 0; border-top-style: none; border-top-width: 0; border-bottom-style: none; border-bottom-width: 0' bgcolor='#FFFFFF' width='133' height='20'>\n";
echo "<form action='SlowControlOverview.php?nHours=12' id='plot' class='fileForm' method='post' enctype='multipart/form-data'><input type='submit' value='12h'></form>";
echo "      </td>\n";
echo "      <td valign='bottom' align='center' style='border-color: #808080; border-left-style: none; border-left-width: 0; border-right-style: none; border-right-width: 0; border-top-style: none; border-top-width: 0; border-bottom-style: none; border-bottom-width: 0' bgcolor='#FFFFFF' width='133' height='20'>\n";
echo "<form action='SlowControlOverview.php?nHours=24' id='plot' class='fileForm' method='post' enctype='multipart/form-data'><input type='submit' value='24h'></form>";
echo "      </td>\n";
echo "      <td valign='bottom' align='center' style='border-color: #808080; border-left-style: none; border-left-width: 0; border-right-style: none; border-right-width: 0; border-top-style: none; border-top-width: 0; border-bottom-style: none; border-bottom-width: 0' bgcolor='#FFFFFF' width='133' height='20'>\n";
echo "<form action='SlowControlOverview.php?nHours=48' id='plot' class='fileForm' method='post' enctype='multipart/form-data'><input type='submit' value='48h'></form>";
echo "      </td>\n";
echo "   </tr>\n";
echo "</table>\n";

echo "<div id='div1' style='width:800px'>";
echo "<div id='div11' style='width:400px;float:left'>";
echo "<p align='center'>Pressure<br>";
echo "<img src='Graph.php?start=$tStart&end=$tEnd&variable=Pressure' width='400'>";
echo "</p>";
echo "</div>";
echo "<div id='div12' style='width:400px;float:right'>";
echo "<p align='center'>First ring<br>";
echo "<img src='Graph.php?start=$tStart&end=$tEnd&variable=First' width='400'>";
echo "</p>";
echo "</div>";
echo "</div>";

echo "<div id='div1' style='width:800px'>";
echo "<div id='div11' style='width:400px;float:left'>";
echo "<p align='center'>Grid voltage<br>";
echo "<img src='Graph.php?start=$tStart&end=$tEnd&variable=Grid' width='400'>";
echo "</p>";
echo "</div>";
echo "<div id='div12' style='width:400px;float:right'>";
echo "<p align='center'>Leakage current<br>";
echo "<img src='Graph.php?start=$tStart&end=$tEnd&variable=Leakage' width=400'>";
echo "</p>";
echo "</div>";
echo "</div>";

echo "<div id='div1' style='width:800px'>";
echo "<div id='div11' style='width:400px;float:left'>";
echo "<p align='center'>Cathode voltage<br>";
echo "<img src='Graph.php?start=$tStart&end=$tEnd&variable=Cathode' width='400'>";
echo "</p>";
echo "</div>";
echo "<div id='div12' style='width:400px;float:right'>";
echo "<p align='center'>Alarm<br>";
echo "<img src='Graph.php?start=$tStart&end=$tEnd&variable=Alarm' width='400'>";
echo "</p>";
echo "</div>";
echo "</div>";

echo "<div id='div1' style='width:800px'>";
echo "<div id='div11' style='width:400px;float:left'>";
echo "<p align='center'>TC1<br>";
echo "<img src='Graph.php?start=$tStart&end=$tEnd&variable=TC1' width='400'>";
echo "</p>";
echo "</div>";
echo "<div id='div12' style='width:400px;float:right'>";
echo "<p align='center'>TC2<br>";
echo "<img src='Graph.php?start=$tStart&end=$tEnd&variable=TC2' width='400'>";
echo "</p>";
echo "</div>";
echo "</div>";

echo "<div id='div1' style='width:800px'>";
echo "<div id='div11' style='width:400px;float:left'>";
echo "<p align='center'>TC3<br>";
echo "<img src='Graph.php?start=$tStart&end=$tEnd&variable=TC3' width='400'>";
echo "</p>";
echo "</div>";
echo "<div id='div12' style='width:400px;float:right'>";
echo "</p>";
echo "</div>";
echo "</div>";

echo "<meta http-equiv='refresh' content='30; URL=SlowControlOverview.php?nHours=$nhours'>";

echo "</body>";
echo "</html>";

?>
