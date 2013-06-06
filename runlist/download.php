<?php

if (!$_COOKIE['experiment']) {setcookie("experiment", "xgt", time()+86400);}

//**** Home directory ****
switch ($_COOKIE['experiment']) {
    case "xgt":
        $homeDir = "/xgt/";
        break;
    case "xlr":
        $homeDir = "/xlr/";
        break;
    default:
        $homeDir = "/xgt";
}

$downloadfile = $homeDir.$_GET["id"];
$filename = $_GET["id"];
$filesize = filesize($downloadfile);

header("Content-Disposition: attachment; filename=$filename");
header("Content-Length: $filesize");

readfile($downloadfile);
exit;
?>
