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

<p align="right" style="margin-top: 5; margin-bottom: 5; margin-right: 20;"><img src="../image/add_issue.png"></p>

<table align="center" border="0" bordercolor="#000000" cellpadding="0" cellspacing="0" style="border-collapse: collapse; " width="720">
<tr>
<td>
<table align="center" border="0" bordercolor="#000000" cellpadding="0" cellspacing="0" style="border-collapse: collapse; " width="720">
<tr>
<td valign="middle" align="center" style="border-color: #000000; border-left-style: none; border-left-width: 0; border-right-style: none; border-right-width: 0; border-top-style: solid; border-top-width: 1; border-bottom-style: solid; border-bottom-width: 1" width="50" height="30" bgcolor="#FFFFFF"><font size="2">Issue#</font>
</td>
<td valign="middle" align="left" style="border-color: #000000; border-left-style: none; border-left-width: 0; border-right-style: none; border-right-width: 0; border-top-style: solid; border-top-width: 1; border-bottom-style: solid; border-bottom-width: 1" width="100" height="30" bgcolor="#FFFFFF"><font size="2">Project</font>
</td>
<td valign="middle" align="left" style="border-color: #000000; border-left-style: none; border-left-width: 0; border-right-style: none; border-right-width: 0; border-top-style: solid; border-top-width: 1; border-bottom-style: solid; border-bottom-width: 1" width="100" height="30" bgcolor="#FFFFFF"><font size="2">Submit by</font>
</td>
<td valign="middle" align="left" style="border-color: #000000; border-left-style: none; border-left-width: 0; border-right-style: none; border-right-width: 0; border-top-style: solid; border-top-width: 1; border-bottom-style: solid; border-bottom-width: 1" width="100" height="30" bgcolor="#FFFFFF"><font size="2">Assigned to</font>
</td>
<td valign="middle" align="left" style="border-color: #000000; border-left-style: none; border-left-width: 0; border-right-style: none; border-right-width: 0; border-top-style: solid; border-top-width: 1; border-bottom-style: solid; border-bottom-width: 1" width="260" height="30" bgcolor="#FFFFFF"><font size="2">Description</font>
</td>
<td valign="middle" align="left" style="border-color: #000000; border-left-style: none; border-left-width: 0; border-right-style: none; border-right-width: 0; border-top-style: solid; border-top-width: 1; border-bottom-style: solid; border-bottom-width: 1" width="80" height="30" bgcolor="#FFFFFF"><font size="2">Due on</font>
</td>
<td valign="middle" align="center" style="border-color: #000000; border-left-style: none; border-left-width: 0; border-right-style: none; border-right-width: 0; border-top-style: solid; border-top-width: 1; border-bottom-style: solid; border-bottom-width: 1" width="30" height="30" bgcolor="#FFFFFF">
</td>
</tr>
</table>
</td>
</tr>

<?php

// connect with database
$db=mysql_connect("lheppc90.unibe.ch","exodaq","EXOsql");
mysql_select_db("exo");

$result = mysql_query("select * from issuetracker where CommentID='0' order by category, date");

while ($issues = mysql_fetch_assoc($result)) {
    switch ($issues['category']) {
        case 0:
            $bgcolor = "#F8E0F7";
            break;
        case 1:
            $bgcolor = "#E0E0F8";
            break;
        case 2:
            $bgcolor = "#E0F8E0";
            break;
        case 3:
            $bgcolor = "#F7F8E0";
            break;
    }
    
    $id = $issues['ID'];
    
    $nComments = mysql_query("select max(CommentID) from issuetracker where ID='$id'");
    $nCom = mysql_result($nComments,0);
    
  echo "<tr>\n";
  echo "<td bgcolor='$bgcolor'>\n";
  echo "<table align='center' border='0' bordercolor='#000000' cellpadding='0' cellspacing='0' style='border-collapse: collapse; ' width='720'>\n";
  echo "<tr>\n";
  echo "<td valign='middle' align='center' style='border-color: #000000; border-left-style: none; border-left-width: 0; border-right-style: none; border-right-width: 0; border-top-style: none; border-top-width: 0; border-bottom-style: none; border-bottom-width: 0' width='50' height='30' bgcolor='$bgcolor'><font size='2'><a href='javascript:changeVis(\"div".$issues['ID']."\")'>".$issues['ID']."</a></font>\n";
  echo "</td>\n";
  echo "<td valign='middle' align='left' style='border-color: #000000; border-left-style: none; border-left-width: 0; border-right-style: none; border-right-width: 0; border-top-style: none; border-top-width: 0; border-bottom-style: none; border-bottom-width: 0' width='100' height='30' bgcolor='$bgcolor'><font size='2'>".$issues['Project']."</font>\n";
  echo "</td>\n";
  echo "<td valign='middle' align='left' style='border-color: #000000; border-left-style: none; border-left-width: 0; border-right-style: none; border-right-width: 0; border-top-style: none; border-top-width: 0; border-bottom-style: none; border-bottom-width: 0' width='100' height='30' bgcolor='$bgcolor'><font size='2'>".$issues['SubmitBy']."</font>\n";
  echo "</td>\n";
  echo "<td valign='middle' align='left' style='border-color: #000000; border-left-style: none; border-left-width: 0; border-right-style: none; border-right-width: 0; border-top-style: none; border-top-width: 0; border-bottom-style: none; border-bottom-width: 0' width='100' height='30' bgcolor='$bgcolor'><font size='2'>".$issues['AssignedTo']."</font>\n";
  echo "</td>\n";
  echo "<td valign='middle' align='left' style='border-color: #000000; border-left-style: none; border-left-width: 0; border-right-style: none; border-right-width: 0; border-top-style: none; border-top-width: 0; border-bottom-style: none; border-bottom-width: 0' width='260' height='30' bgcolor='$bgcolor'><font size='2'>".$issues['Description']."</font>\n";
  echo "</td>\n";
  echo "<td valign='middle' align='left' style='border-color: #000000; border-left-style: none; border-left-width: 0; border-right-style: none; border-right-width: 0; border-top-style: none; border-top-width: 0; border-bottom-style: none; border-bottom-width: 0' width='80' height='30' bgcolor='$bgcolor'><font size='2'>".$issues['DueOn']."</font>\n";
  echo "</td>\n";
    echo "<td valign='middle' align='center' style='border-color: #000000; border-left-style: none; border-left-width: 0; border-right-style: none; border-right-width: 0; border-top-style: none; border-top-width: 0; border-bottom-style: none; border-bottom-width: 0' width='30' height='30' bgcolor='$bgcolor'>";
    if ($nCom > 0) {echo "<img src='../image/comment.png' align='middle'><font size='2'> ".$nCom."</font>";}
    echo "\n";
    echo "</td>\n";
  echo "</tr>\n";
  echo "</table>\n";
  echo "</td>\n";
  echo "</tr>\n";
  echo "<tr>\n";
  echo "<td style='border-color: #000000; border-left-style: none; border-left-width: 0; border-right-style: none; border-right-width: 0; border-top-style: none; border-top-width: 0; border-bottom-style: solid; border-bottom-width: 1' bgcolor='$bgcolor'>\n";
  echo "<div id='div".$issues['ID']."' style='display:none; margin-bottom: 10'>\n";
  echo "<font size='2'>&nbsp;&nbsp;Error output:</font><br>\n";
  echo "<table align='right' border='0' bordercolor='#000000' cellpadding='10' cellspacing='0' style='border-collapse: collapse; margin-bottom: 10' width='720'>\n";
  echo "<tr>\n";
  echo "<td valign='middle' align='left' style='border-color: #000000; border-left-style: dashed; border-left-width: 0; border-right-style: none; border-right-width: 0; border-top-style: none; border-top-width: 0; border-bottom-style: none; border-bottom-width: 0' width='40' bgcolor='$bgcolor'>\n";
  echo "</td>\n";
  echo "<td valign='top' align='left' style='border-color: #0000FF; border-left-style: dashed; border-left-width: 1; border-right-style: dashed; border-right-width: 1; border-top-style: dashed; border-top-width: 1; border-bottom-style: dashed; border-bottom-width: 1' width='660' bgcolor='#E2E2E2'><font size='2'>".nl2br($issues['Message'])."</font>\n";
  echo "<br>\n";
  echo "</td>\n";
  echo "<td valign='middle' align='left' style='border-color: #000000; border-left-style: dashed; border-left-width: 0; border-right-style: none; border-right-width: 0; border-top-style: none; border-top-width: 0; border-bottom-style: none; border-bottom-width: 0' width='20' bgcolor='$bgcolor'>\n";
  echo "</td>\n";
  echo "</tr>\n";
  echo "</table>\n";
  
    $comments = mysql_query("select * from issuetracker where ID='$id' and CommentID > 0 order by date");
    if (mysql_num_rows($comments) > 0) {
        echo "<font size='2'>&nbsp;&nbsp;Comments:</font>\n";
        while ($com = mysql_fetch_assoc($comments)) {
            echo "<table align='right' border='0' bordercolor='#000000' cellpadding='10' cellspacing='0' style='border-collapse: collapse; margin-bottom: 5' width='720'>\n";
            echo "<tr>\n";
            echo "<td valign='middle' align='left' style='border-color: #000000; border-left-style: dashed; border-left-width: 0; border-right-style: none; border-right-width: 0; border-top-style: none; border-top-width: 0; border-bottom-style: none; border-bottom-width: 0;' width='40' bgcolor='$bgcolor'>\n";
            echo "</td>\n";
            echo "<td valign='top' align='left' style='border-color: #0000FF; border-left-style: dashed; border-left-width: 1; border-right-style: dashed; border-right-width: 1; border-top-style: dashed; border-top-width: 1; border-bottom-style: dashed; border-bottom-width: 1' width='660' bgcolor='#E2E2E2'><font size='2'>".$com['SubmitBy']." on ".$com['date']." ".$com['time'].":<br><br>".nl2br($com['Message'])."</font>\n";
            echo "<br>\n";
            echo "</td>\n";
            echo "<td valign='top' align='left' style='border-color: #000000; border-left-style: dashed; border-left-width: 0; border-right-style: none; border-right-width: 0; border-top-style: none; border-top-width: 0; border-bottom-style: none; border-bottom-width: 0' width='20' bgcolor='$bgcolor'><a href=issuetracker/delete_comment.php?id=".$issues['ID']."&comID=".$com['CommentID']."'<img src='../image/delete_comment.png'></a>\n";
            echo "</td>\n";
            echo "</tr>\n";
            echo "</table>\n";
        }
    }
    echo "<a href='javascript:changeVis(\"div".$issues['ID']."_2\")'><img src='../image/add_comment.png' align='middle'></a>\n";
  echo "</div>\n";
  echo "<div id='div".$issues['ID']."_2' style='display:none'>\n";
  echo "<form action='issuetracker/enter_issue.php' class='fileform' method='post' enctype='multipart/form-data'>\n";
  echo "<table align='right' border='0' bordercolor='#000000' cellpadding='10' cellspacing='0' style='border-collapse: collapse; margin-bottom: 5' width='720'>\n";
  echo "<tr>\n";
  echo "<td valign='middle' align='left' style='border-color: #000000; border-left-style: dashed; border-left-width: 0; border-right-style: none; border-right-width: 0; border-top-style: none; border-top-width: 0; border-bottom-style: none; border-bottom-width: 0;' width='40' bgcolor='$bgcolor'>\n";
  echo "</td>\n";
  echo "<td valign='top' align='left' style='border-color: #0000FF; border-left-style: dashed; border-left-width: 1; border-right-style: dashed; border-right-width: 1; border-top-style: dashed; border-top-width: 1; border-bottom-style: dashed; border-bottom-width: 1' width='660' bgcolor='#E2E2E2'>\n";
  echo "<select name='SubmitBy'>\n";

    $result = mysql_query("select name from users");
    while ($names = mysql_fetch_assoc($result)) {
        echo "<option>".$names['name']."</option>\n";
    }

  echo "</select><br>\n";
  echo "<textarea name='Message' rows='5' cols='50' class='field'></textarea><br><br>\n";
  echo "<br><input type='submit' value='Submit' class='btn'>\n";
  echo "</td>\n";
  echo "<td valign='top' align='left' style='border-color: #000000; border-left-style: dashed; border-left-width: 0; border-right-style: none; border-right-width: 0; border-top-style: none; border-top-width: 0; border-bottom-style: none; border-bottom-width: 0' width='20' bgcolor='$bgcolor'><img src='../image/delete_comment.png'>\n";
  echo "</td>\n";
  echo "</tr>\n";
  echo "</table>\n";
  echo "</form>\n";
  echo "</div>\n";
  echo "</td>\n";
  echo "</tr>\n";
}

?>

</tr>

</table>

<br>

</html>
