<?php
    
    // connect with database
    $db=mysql_connect("lheppc90.unibe.ch","exodaq","EXOsql");
    mysql_select_db("exo");
?>

<form action="enter_issue.php">
<p align="left" style="margin-left: 20;">

Project: <input type="text" name="Project">
</p>
<p align="left" style="margin-left: 20;">

Submitted by: <select name="SubmitBy">
<?php
    $result = mysql_query("select name from users");
    while ($names = mysql_fetch_assoc($result)) {
        echo "<option>".$names['name']."</option>\n";
    }
?>
</select>
</p>
<p align="left" style="margin-left: 20;">

Assigned to: <select name="AssignedTo">
<?php
    $result = mysql_query("select name from users");
    while ($names = mysql_fetch_assoc($result)) {
        echo "<option>".$names['name']."</option>\n";
    }
?>
</select>
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
