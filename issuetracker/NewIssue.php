<?php
    
    // connect with database
    $db=mysql_connect("lheppc90.unibe.ch","exodaq","EXOsql");
    mysql_select_db("exo");
?>

<p style="margin-left: 20; margin-top: 5; margin-bottom: 10;"><font size="4">Submit new issue</font></p>

<form action="issuetracker/enter_issue.php" class="fileform" method="post" enctype="multipart/form-data">

<table align="center" border="0">
<tr>
<td style="margin-top: 5; margin-bottom: 5; margin-right: 5;" width="200">Project:</td>
<td style="margin-top: 5; margin-bottom: 5;" width="500"><input type="text" name="Project"></td>
</tr>

<tr>
<td style="margin-top: 5; margin-bottom: 5; margin-right: 5;" width="200">Submitted by:</td>
<td style="margin-top: 5; margin-bottom: 5;" width="500"><select name="SubmitBy">
<?php
    $result = mysql_query("select name from users");
    while ($names = mysql_fetch_assoc($result)) {
        echo "<option>".$names['name']."</option>\n";
    }
?>
</select>
</td>
</tr>

<tr>
<td style="margin-top: 5; margin-bottom: 5; margin-right: 5;" width="200">Assigned to:</td>
<td style="margin-top: 5; margin-bottom: 5;" width="500"><select name="AssignedTo">
<?php
    $result = mysql_query("select name from users");
    while ($names = mysql_fetch_assoc($result)) {
        echo "<option>".$names['name']."</option>\n";
    }
?>
</select>
</td>
</tr>

<tr>
<td style="margin-top: 5; margin-bottom: 5; margin-right: 5;" width="200">Description:</td>
<td style="margin-top: 5; margin-bottom: 5;" width="500"><textarea name="Description"></textarea></td>
</tr>

<tr>
<td style="margin-top: 5; margin-bottom: 5; margin-right: 5;" width="200">Error message:</td>
<td style="margin-top: 5; margin-bottom: 5;" width="500"><textarea name="Message"></textarea></td>
</tr>

<tr>
<td style="margin-top: 5; margin-bottom: 5; margin-right: 5;" width="200">Due on:</td>
<td style="margin-top: 5; margin-bottom: 5;" width="500"><input type="text" name="DueOn"></td>
</tr>

</table>

</form>
