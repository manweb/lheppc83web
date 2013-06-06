<?php

// connect with database
$db=mysql_connect("lheppc90.unibe.ch","exodaq","EXOsql");
mysql_select_db("exo");
$SC = mysql_query("select * from slowcontrol order by Time desc limit 1");
$SCValues = mysql_fetch_assoc($SC);

echo "<table align='center' border='0' bordercolor='#000000' cellpadding='0' cellspacing='0' style='border-collapse: collapse;' width='760' height='570'>\n";
echo "   <tr>\n";
echo "      <td valign='top' align='center' style='border-color: #000000; border-left-style: none; border-left-width: 0; border-right-style: none; border-right-width: 0; border-top-style: none; border-top-width: 0; border-bottom-style: none; border-bottom-width: 0' width='760' height='15'>\n";
if ($SCValues["Alarm"] == "1") {echo "<img src='../image/alarm.gif'>";}
echo "      </td>\n";
echo "   </tr>\n";
echo "   <tr>\n";
echo "      <td valign='top' align='left' style='border-color: #000000; border-left-style: none; border-left-width: 0; border-right-style: none; border-right-width: 0; border-top-style: none; border-top-width: 0; border-bottom-style: none; border-bottom-width: 0' width='760' height='570' background='../image/SlowControlBG2.jpg'>\n";

echo "<p style='margin-top: 95px; margin-bottom: 0px; margin-left: 610px; margin-right: 0px;'>".$SCValues["Pressure"]."&nbsp;bar</p>";
echo "<p style='margin-top: 52px; margin-bottom: 0px; margin-left: 500px; margin-right: 0px;'>".($SCValues["TC2"] - 273.16)."&nbsp;°C</p>";
echo "<p style='margin-top: 20px; margin-bottom: 0px; margin-left: 415px; margin-right: 0px;'>".($SCValues["TC1"] - 273.16)."&nbsp;°C</p>";
echo "<p style='margin-top: 12px; margin-bottom: 0px; margin-left: 500px; margin-right: 0px;'>".$SCValues["Cathode"]."&nbsp;kV</p>";

echo "<table align='center' border='0' bordercolor='#000000' cellpadding='0' cellspacing='0' style='border-collapse: collapse;' width='760'>\n";
echo "   <tr>\n";
echo "      <td valign='top' align='left' style='border-color: #000000; border-left-style: none; border-left-width: 0; border-right-style: none; border-right-width: 0; border-top-style: none; border-top-width: 0; border-bottom-style: none; border-bottom-width: 0' width='380'>\n";

echo "<p style='margin-top: 225px; margin-bottom: 0px; margin-left: 210px; margin-right: 0px;'>".$SCValues["Grid"]."&nbsp;V</p>";
echo "<p style='margin-top: 0px; margin-bottom: 0px; margin-left: 210px; margin-right: 0px;'>".$SCValues["Leakage"]."&nbsp;nA</p>";

echo "      </td>";
echo "      <td valign='top' align='left' style='border-color: #000000; border-left-style: none; border-left-width: 0; border-right-style: none; border-right-width: 0; border-top-style: none; border-top-width: 0; border-bottom-style: none; border-bottom-width: 0' width='190'>\n";

echo "<p style='margin-top: 220px; margin-bottom: 0px; margin-left: 120px; margin-right: 0px;'>".$SCValues["First"]."&nbsp;V</p>";
echo "      </td>";
echo "      <td valign='top' align='left' style='border-color: #000000; border-left-style: none; border-left-width: 0; border-right-style: none; border-right-width: 0; border-top-style: none; border-top-width: 0; border-bottom-style: none; border-bottom-width: 0' width='190'>\n";
echo "<p style='margin-top: 220px; margin-bottom: 0px; margin-left: 90px; margin-right: 0px;'>".($SCValues["TC3"] - 273.16)."&nbsp;°C</p>";

echo "      </td>";
echo "   <tr>\n";
echo "</table>";

echo "      </td>";
echo "   </tr>";
echo "</table>";

echo "<meta http-equiv='refresh' content='10; URL=slowcontrol2.php'>";
?>
