<html>
<head>
<head>
<script type="text/javascript">
function changeVis(id) {
   if (document.getElementById(id).style.display == 'none') {document.getElementById(id).style.display = 'block';}
   else {document.getElementById(id).style.display = 'none';}
}
</script>
</head>

<table align="center" border="0" bordercolor="#000000" cellpadding="0" cellspacing="0" style="border-collapse: collapse; " width="720">
<tr>
<td>
<table align="center" border="0" bordercolor="#000000" cellpadding="0" cellspacing="0" style="border-collapse: collapse; " width="720">
<tr>
<td valign="middle" align="center" style="border-color: #000000; border-left-style: none; border-left-width: 0; border-right-style: none; border-right-width: 0; border-top-style: none; border-top-width: 0; border-bottom-style: solid; border-bottom-width: 1" width="50" height="30" bgcolor="#FFFFFF"><font size="2">Issue#</font>
</td>
<td valign="middle" align="left" style="border-color: #000000; border-left-style: none; border-left-width: 0; border-right-style: none; border-right-width: 0; border-top-style: none; border-top-width: 0; border-bottom-style: solid; border-bottom-width: 1" width="90" height="30" bgcolor="#FFFFFF"><font size="2">Project</font>
</td>
<td valign="middle" align="left" style="border-color: #000000; border-left-style: none; border-left-width: 0; border-right-style: none; border-right-width: 0; border-top-style: none; border-top-width: 0; border-bottom-style: solid; border-bottom-width: 1" width="90" height="30" bgcolor="#FFFFFF"><font size="2">Submit by</font>
</td>
<td valign="middle" align="left" style="border-color: #000000; border-left-style: none; border-left-width: 0; border-right-style: none; border-right-width: 0; border-top-style: none; border-top-width: 0; border-bottom-style: solid; border-bottom-width: 1" width="90" height="30" bgcolor="#FFFFFF"><font size="2">Assigned to</font>
</td>
<td valign="middle" align="left" style="border-color: #000000; border-left-style: none; border-left-width: 0; border-right-style: none; border-right-width: 0; border-top-style: none; border-top-width: 0; border-bottom-style: solid; border-bottom-width: 1" width="310" height="30" bgcolor="#FFFFFF"><font size="2">Description</font>
</td>
<td valign="middle" align="left" style="border-color: #000000; border-left-style: none; border-left-width: 0; border-right-style: none; border-right-width: 0; border-top-style: none; border-top-width: 0; border-bottom-style: solid; border-bottom-width: 1" width="90" height="30" bgcolor="#FFFFFF"><font size="2">Due on</font>
</td>
</tr>
</table>
</td>
</tr>

<?php

// connect with database
$db=mysql_connect("lheppc90.unibe.ch","exodaq","EXOsql");
mysql_select_db("exo");

$result = mysql_query("select * from issuetracker order by category, date");

while ($issues = mysql_fetch_assoc($result)) {
  echo "<tr>\n";
  echo "<td>\n";
  echo "<table align='center' border='0' bordercolor='#000000' cellpadding='0' cellspacing='0' style='border-collapse: collapse; ' width='720'>\n";
  echo "<tr>\n";
  echo "<td valign='middle' align='center' style='border-color: #000000; border-left-style: none; border-left-width: 0; border-right-style: none; border-right-width: 0; border-top-style: none; border-top-width: 0; border-bottom-style: none; border-bottom-width: 0' width='50' height='30' bgcolor='#FFFFFF'><font size='2'><a href='javascript:changeVis(\"div".$issues['ID']."\")'>".$issues['ID']."</a></font>\n";
  echo "</td>\n";
  echo "<td valign='middle' align='left' style='border-color: #000000; border-left-style: none; border-left-width: 0; border-right-style: none; border-right-width: 0; border-top-style: none; border-top-width: 0; border-bottom-style: none; border-bottom-width: 0' width='90' height='30' bgcolor='#FFFFFF'><font size='2'>".$issues['Project']."</font>\n";
  echo "</td>\n";
  echo "<td valign='middle' align='left' style='border-color: #000000; border-left-style: none; border-left-width: 0; border-right-style: none; border-right-width: 0; border-top-style: none; border-top-width: 0; border-bottom-style: none; border-bottom-width: 0' width='90' height='30' bgcolor='#FFFFFF'><font size='2'>".$issues['SubmitBy']."</font>\n";
  echo "</td>\n";
  echo "<td valign='middle' align='left' style='border-color: #000000; border-left-style: none; border-left-width: 0; border-right-style: none; border-right-width: 0; border-top-style: none; border-top-width: 0; border-bottom-style: none; border-bottom-width: 0' width='90' height='30' bgcolor='#FFFFFF'><font size='2'>".$issues['AssignedTo']."</font>\n";
  echo "</td>\n";
  echo "<td valign='middle' align='left' style='border-color: #000000; border-left-style: none; border-left-width: 0; border-right-style: none; border-right-width: 0; border-top-style: none; border-top-width: 0; border-bottom-style: none; border-bottom-width: 0' width='310' height='30' bgcolor='#FFFFFF'><font size='2'>".$issues['Description']."</font>\n";
  echo "</td>\n";
  echo "<td valign='middle' align='left' style='border-color: #000000; border-left-style: none; border-left-width: 0; border-right-style: none; border-right-width: 0; border-top-style: none; border-top-width: 0; border-bottom-style: none; border-bottom-width: 0' width='90' height='30' bgcolor='#FFFFFF'><font size='2'>".$issues['DueOn']."</font>\n";
  echo "</td>\n";
  echo "</tr>\n";
  echo "</table>\n";
  echo "</td>\n";
  echo "</tr>\n";
  echo "<tr>\n";
  echo "<td style='border-color: #000000; border-left-style: none; border-left-width: 0; border-right-style: none; border-right-width: 0; border-top-style: none; border-top-width: 0; border-bottom-style: solid; border-bottom-width: 1'>\n";
  echo "<div id='div".$issues['ID']."' style='display:none; margin-bottom: 10'>\n";
  echo "<font size='2'>Error output:</font><br>\n";
  echo "<table align='right' border='0' bordercolor='#000000' cellpadding='10' cellspacing='0' style='border-collapse: collapse; ' width='720'>\n";
  echo "<tr>\n";
  echo "<td valign='middle' align='left' style='border-color: #000000; border-left-style: dashed; border-left-width: 0; border-right-style: none; border-right-width: 0; border-top-style: none; border-top-width: 0; border-bottom-style: none; border-bottom-width: 0' width='40' bgcolor='#FFFFFF'>\n";
  echo "</td>\n";
  echo "<td valign='top' align='left' style='border-color: #0000FF; border-left-style: dashed; border-left-width: 1; border-right-style: dashed; border-right-width: 1; border-top-style: dashed; border-top-width: 1; border-bottom-style: dashed; border-bottom-width: 1; paddingtop: 5; padding-left: 5; padding-right: 5; padding-right: 5;' width='660' bgcolor='#E2E2E2'><font size='2'>".nl2br($issues['Message'])."</font>\n";
  echo "<br>\n";
  echo "</td>\n";
  echo "<td valign='middle' align='left' style='border-color: #000000; border-left-style: dashed; border-left-width: 0; border-right-style: none; border-right-width: 0; border-top-style: none; border-top-width: 0; border-bottom-style: none; border-bottom-width: 0' width='20' bgcolor='#FFFFFF'>\n";
  echo "</td>\n";
  echo "</tr>\n";
  echo "</table>\n";
  echo "&nbsp;<br>\n";
  echo "</div>\n";
  echo "</td>\n";
  echo "</tr>\n";
}

?>

</tr>

</table>

<br>

</html>
