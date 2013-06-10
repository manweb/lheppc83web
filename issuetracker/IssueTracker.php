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

<?php

// connect with database
$db=mysql_connect("lheppc90.unibe.ch","exodaq","EXOsql");
mysql_select_db("exo");

$result = mysql_query("select * from issuetracker order by category, date");

while ($issues = mysql_fetch_assoc($result)) {
  echo "<tr>\n";
  echo "<td valign='middle' align='left' style='border-color: #000000; border-left-style: none; border-left-width: 0; border-right-style: none; border-right-width: 0; border-top-style: none; border-top-width: 0; border-bottom-style: solid; border-bottom-width: 1' width='80' height='30' bgcolor='#FFFFFF'><font size='2'><a href='javascript:changeVis(\"div".$issue['ID']."\")'>".$issue['ID']."</a></font>\n";
  echo "</td>\n";
  echo "<td valign='middle' align='center' style='border-color: #000000; border-left-style: none; border-left-width: 0; border-right-style: none; border-right-width: 0; border-top-style: none; border-top-width: 0; border-bottom-style: solid; border-bottom-width: 1' width='80' height='30' bgcolor='#FFFFFF'><font size='2'>".$issue['Project']."</font>\n";
  echo "</td>\n";
  echo "<td valign='middle' align='center' style='border-color: #000000; border-left-style: none; border-left-width: 0; border-right-style: none; border-right-width: 0; border-top-style: none; border-top-width: 0; border-bottom-style: solid; border-bottom-width: 1' width='80' height='30' bgcolor='#FFFFFF'><font size='2'>".$issue['SubmitBy']."</font>\n";
  echo "</td>\n";
  echo "<td valign='middle' align='center' style='border-color: #000000; border-left-style: none; border-left-width: 0; border-right-style: none; border-right-width: 0; border-top-style: none; border-top-width: 0; border-bottom-style: solid; border-bottom-width: 1' width='85' height='30' bgcolor='#FFFFFF'><font size='2'>".$issue['AssignedTo']."</font>\n";
  echo "</td>\n";
  echo "<td valign='middle' align='center' style='border-color: #000000; border-left-style: none; border-left-width: 0; border-right-style: none; border-right-width: 0; border-top-style: none; border-top-width: 0; border-bottom-style: solid; border-bottom-width: 1' width='75' height='30' bgcolor='#FFFFFF'><font size='2'>".$issue['Description']."</font>\n";
  echo "</td>\n";
  echo "<td valign='middle' align='center' style='border-color: #000000; border-left-style: none; border-left-width: 0; border-right-style: none; border-right-width: 0; border-top-style: none; border-top-width: 0; border-bottom-style: solid; border-bottom-width: 1' width='80' height='30' bgcolor='#FFFFFF'><font size='2'>".$issue['DueOn']."</font>\n";
  echo "</td>\n";
  echo "</tr>\n";
  echo "<div id='div".$issues['ID']."' style='display:none'>More content</div>\n";
}

?>

</table>
