<form action="enter_issue.php">
<p align="left" style="margin-left: 20;">

Project: <input type="text" name="Project">
</p>
<p align="left" style="margin-left: 20;">

Submitted by: <input type="select" name="SubmitBy">
<?php
    $result = mysql_query("select name from user");
    while ($names = mysql_fetch_result($result)) {
        echo "<option>".$names."</option>\n";
    }
?>
</p>
<p align="left" style="margin-left: 20;">

Assigned to: <input type="select" name="AssignedTo">
<?php
    $result = mysql_query("select name from user");
    while ($names = mysql_fetch_result($result)) {
        echo "<option>".$names."</option>\n";
    }
?>
</p>

<p align="left" style="margin-left: 20;">

Description: <textarea name="Description"></textarea>
</p>

<p align="left" style="margin-left: 20;">

Error message: <textarea name="Message"></textarea>
</p>

<p align="left" style="margin-left: 20;">

Due on: <input type="text" name="DueOn">
</p>

</form>
