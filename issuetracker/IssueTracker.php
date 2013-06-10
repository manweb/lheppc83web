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

<table align="center" border="0" bordercolor="#000000" cellpadding="0" cellspacing="0" style="border-collapse: collapse; " width="760">
<tr>
<td>
<table align="center" border="0" bordercolor="#000000" cellpadding="0" cellspacing="0" style="border-collapse: collapse; " width="760">
<tr>
<td valign="middle" align="left" style="border-color: #000000; border-left-style: none; border-left-width: 0; border-right-style: none; border-right-width: 0; border-top-style: none; border-top-width: 0; border-bottom-style: solid; border-bottom-width: 1" width="80" height="30" bgcolor="#FFFFFF"><font size="2">Issue#</font>
</td>
<td valign="middle" align="center" style="border-color: #000000; border-left-style: none; border-left-width: 0; border-right-style: none; border-right-width: 0; border-top-style: none; border-top-width: 0; border-bottom-style: solid; border-bottom-width: 1" width="80" height="30" bgcolor="#FFFFFF"><font size="2">Project</font>
</td>
<td valign="middle" align="center" style="border-color: #000000; border-left-style: none; border-left-width: 0; border-right-style: none; border-right-width: 0; border-top-style: none; border-top-width: 0; border-bottom-style: solid; border-bottom-width: 1" width="80" height="30" bgcolor="#FFFFFF"><font size="2">Submit by</font>
</td>
<td valign="middle" align="center" style="border-color: #000000; border-left-style: none; border-left-width: 0; border-right-style: none; border-right-width: 0; border-top-style: none; border-top-width: 0; border-bottom-style: solid; border-bottom-width: 1" width="85" height="30" bgcolor="#FFFFFF"><font size="2">Assigned to</font>
</td>
<td valign="middle" align="center" style="border-color: #000000; border-left-style: none; border-left-width: 0; border-right-style: none; border-right-width: 0; border-top-style: none; border-top-width: 0; border-bottom-style: solid; border-bottom-width: 1" width="75" height="30" bgcolor="#FFFFFF"><font size="2">Description</font>
</td>
<td valign="middle" align="center" style="border-color: #000000; border-left-style: none; border-left-width: 0; border-right-style: none; border-right-width: 0; border-top-style: none; border-top-width: 0; border-bottom-style: solid; border-bottom-width: 1" width="80" height="30" bgcolor="#FFFFFF"><font size="2">Due on</font>
</td>
</tr>
</table>
</td>

<?php

// connect with database
$db=mysql_connect("lheppc90.unibe.ch","exodaq","EXOsql");
mysql_select_db("exo");

$result = mysql_query("select * from issuetracker order by category, date");

while ($issues = mysql_fetch_assoc($result)) {
  echo "<td>\n";
  echo "<table align='center' border='0' bordercolor='#000000' cellpadding='0' cellspacing='0' style='border-collapse: collapse; ' width='760'>\n";
  echo "<tr>\n";
  echo "<td valign='middle' align='left' style='border-color: #000000; border-left-style: none; border-left-width: 0; border-right-style: none; border-right-width: 0; border-top-style: none; border-top-width: 0; border-bottom-style: solid; border-bottom-width: 1' width='80' height='30' bgcolor='#FFFFFF'><font size='2'><a href='javascript:changeVis(\"div".$issues['ID']."\")'>".$issues['ID']."</a></font>\n";
  echo "</td>\n";
  echo "<td valign='middle' align='center' style='border-color: #000000; border-left-style: none; border-left-width: 0; border-right-style: none; border-right-width: 0; border-top-style: none; border-top-width: 0; border-bottom-style: solid; border-bottom-width: 1' width='80' height='30' bgcolor='#FFFFFF'><font size='2'>".$issues['Project']."</font>\n";
  echo "</td>\n";
  echo "<td valign='middle' align='center' style='border-color: #000000; border-left-style: none; border-left-width: 0; border-right-style: none; border-right-width: 0; border-top-style: none; border-top-width: 0; border-bottom-style: solid; border-bottom-width: 1' width='80' height='30' bgcolor='#FFFFFF'><font size='2'>".$issues['SubmitBy']."</font>\n";
  echo "</td>\n";
  echo "<td valign='middle' align='center' style='border-color: #000000; border-left-style: none; border-left-width: 0; border-right-style: none; border-right-width: 0; border-top-style: none; border-top-width: 0; border-bottom-style: solid; border-bottom-width: 1' width='85' height='30' bgcolor='#FFFFFF'><font size='2'>".$issues['AssignedTo']."</font>\n";
  echo "</td>\n";
  echo "<td valign='middle' align='center' style='border-color: #000000; border-left-style: none; border-left-width: 0; border-right-style: none; border-right-width: 0; border-top-style: none; border-top-width: 0; border-bottom-style: solid; border-bottom-width: 1' width='75' height='30' bgcolor='#FFFFFF'><font size='2'>".$issues['Description']."</font>\n";
  echo "</td>\n";
  echo "<td valign='middle' align='center' style='border-color: #000000; border-left-style: none; border-left-width: 0; border-right-style: none; border-right-width: 0; border-top-style: none; border-top-width: 0; border-bottom-style: solid; border-bottom-width: 1' width='80' height='30' bgcolor='#FFFFFF'><font size='2'>".$issues['DueOn']."</font>\n";
  echo "</td>\n";
  echo "</tr>\n";
  echo "</table>\n";
  echo "</td>\n";
  echo "<td>\n";
  echo "<div id='div".$issues['ID']."' style='display:none'>More content</div>\n";
  echo "</td>\n";
}

?>

</tr>

</table>

</html>
