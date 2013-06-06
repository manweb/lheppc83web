<?php

$disk = $_GET['disk'];

echo "<p align='center'>Enter disk info</p>";

echo "<form name='Formular' action='enterdiskinfo.php?disk=$disk' method='post' enctype='multipart/form-data'>";
echo "<p align='center'><textarea name='diskinfo' rows='10' cols='50'></textarea></p>";
echo "<p align='center'><input type='submit' value='Submit'></p>";
echo "</form>";
echo "<br>";

?>
