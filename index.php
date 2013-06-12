<?php

//**** Images ****
$iconImg = "image/server.png";
$titleImg = "image/title2.png";
$homeImg = "image/home.png";

?>

<html>
<head>
<title>EXO Bern</title>

<?php
echo "<link rel='shortcut icon' href='$iconImg' type='image/png' />\n";
echo "<link rel='icon' href='$iconImg' type='image/png' />\n";
?>

<style type="text/css">
<!--
a:link {text-decoration: none; color: #000000;}
a:visited {text-decoration: none; color: #000000;}
a:active {text-decoration: none; color: #000000;}
a:hover {text-decoration: underline; color: #9A2B2B;}
-->
</style>

<style type="text/css">
<!--
form{
   margin-bottom: 0px;
}

form.fileform input.btn{
   background-color:#BAC7FF;
   border-top-color:#E0E6FF;
   border-left-color:#E0E6FF;
   border-right-color:#98A3D2;
   border-bottom-color:#98A3D2;
   color:#000000;
   font-size:60%;
   margin: 0px 0px 0px 0px;

}

form.fileform input {
   background-color:#FFFFFF;
   border:1px solid;
   border-top-color:#000000;
   border-left-color:#000000;
   border-right-color:#000000;
   border-bottom-color:#000000;
   font-size:80%;
   text-align:center;
}

form.fileform select {
   background-color:#FFFFFF;
   border:1px solid;
   border-top-color:#000000;
   border-left-color:#000000;
   border-right-color:#000000;
   border-bottom-color:#000000;
   font-size:80%;
   margin: 0px 0px 0px 0px;
}
-->
</style>

<script type="text/javascript">

function change(id) {
   document.getElementById(id).src="image/loading.gif";
}
</script>

<script type="text/javascript">

function CheckAllRun(el) {
   var checked = el.checked;
   var elements = document.getElementById('ckRun').elements;
   for (var i = 0; i < elements.length; i++) {
      if (elements[i].type.toLowerCase() == 'checkbox') {elements[i].checked = checked;}
   }
}

</script>

<script type="text/javascript">

function CheckAllOptions(el) {
   var checked = el.checked;
   var elements = document.getElementById('options').elements;
   for (var i = 0; i < elements.length; i++) {
      if (elements[i].type.toLowerCase() == 'checkbox') {elements[i].checked = checked;}
   }
}

</script>

<script type="text/javascript">

function windowName() {
   var id = document.getElementById('selectVariable').selectedIndex;
   var selection = document.getElementById('selectVariable').options[id].value;
   if (selection != "Variable") {
      var url = "slowcontrol/SlowControlGraph.php?title=" + selection;
      document.getElementById('plot').target=selection;
      document.getElementById('plot').action=url;
      var el = document.getElementById('plotGraph');
      el.onClick=showPopup(selection);
   }
}

function showPopup(selection) {
  var url = "slowcontrol/SlowControlGraph.php?title=" + selection;
  var popup = window.open(url, selection, 'height=350, width=620');
  popup.focus();
  return false;
}
</script>

<script type="text/javascript">

function ckFormular() {
   var id = document.getElementById('selectVariable').selectedIndex;
   var selection = document.getElementById('selectVariable').options[id].value;
   if (selection == "Variable") {
      alert("Choose variable to plot!");
      return false;
   }

   return true;
}
</script>

<script type="text/javascript">
function changeVis(id) {
   if (document.getElementById(id).style.display == 'none') {document.getElementById(id).style.display = 'block';}
   else {document.getElementById(id).style.display = 'none';}
}
</script>

<script type="text/javascript">

function changeLink(id) {
    var ckID = "ck"+id;
    if (document.getElementById(ckID).checked) {
        document.getElementById("LinkSolved").href="issuetracker/issue_solved.php?id="+id;
        document.getElementById("LinkArchive").href="issuetracker/archive_issue.php?id="+id;
        document.getElementById("LinkDelete").href="issuetracker/delete_issue.php?id="+id;
    }
    else {
        document.getElementById("LinkSolved").href="#";
        document.getElementById("LinkArchive").href="#";
        document.getElementById("LinkDelete").href="#";
    }
    
    var inputElems = document.getElementsByTagName("input");
    for (var i=0; i<inputElems.length; i++) {
        if (inputElems[i].type === "checkbox" && inputElems[i].checked === true && inputElems[i].id != ckID) {
            inputElems[i].checked = false;
        }
    }
}
</script>

<script src="jquery-1.3.2.min.js"></script>

<script>
 $(document).ready(function() {
 	 $("#EXOAnalyisJobs").load("/EXO200Status/StatusEXOAnalysis.php");
   var refreshId = setInterval(function() {
      $("#EXOAnalysisJobs").load('EXO200Status/StatusEXOAnalysis.php');
   }, 5000);
   $.ajaxSetup({ cache: false });
});
</script>

<script>
 $(document).ready(function() {
 	 $("#EXOFileTransfer").load("EXO200Status/StatusFileTransfer.php");
   var refreshId = setInterval(function() {
      $("#EXOFileTransfer").load('EXO200Status/StatusFileTransfer.php');
   }, 5000);
   $.ajaxSetup({ cache: false });
});
</script>

<script>
 $(document).ready(function() {
 	 $("#EXODataDisks").load("EXO200Status/StatusDataDisk.php");
   var refreshId = setInterval(function() {
      $("#EXODataDisks").load('EXO200Status/StatusDataDisk.php');
   }, 5000);
   $.ajaxSetup({ cache: false });
});
</script>

</head>

<body bgcolor="#000000">

<p style="margin-top: 50px;"></p>

<?php

if ($_GET["page"] == "slowcontrol/slowcontrol.php") {
   $tab1 = "image/tab2.png";
   $tab2 = "image/tab3.png";
   $tab3 = "image/tab2.png";
   $tab4 = "image/tab2.png";
   $tab5 = "image/tab2.png";
}
elseif ($_GET["page"] == "liveview/liveview.php") {
   $tab1 = "image/tab2.png";
   $tab2 = "image/tab2.png";
   $tab3 = "image/tab3.png";
   $tab4 = "image/tab2.png";
   $tab5 = "image/tab2.png";
}
elseif ($_GET["page"] == "EXO200Status/status.php") {
   $tab1 = "image/tab2.png";
   $tab2 = "image/tab2.png";
   $tab3 = "image/tab2.png";
   $tab4 = "image/tab3.png";
   $tab5 = "image/tab2.png";
}
elseif ($_GET["page"] == "issuetracker/IssueTracker.php") {
   $tab1 = "image/tab2.png";
   $tab2 = "image/tab2.png";
   $tab3 = "image/tab2.png";
   $tab4 = "image/tab2.png";
   $tab5 = "image/tab3.png";
}
else {
   $tab1 = "image/tab3.png";
   $tab2 = "image/tab2.png";
   $tab3 = "image/tab2.png";
   $tab4 = "image/tab2.png";
   $tab5 = "image/tab2.png";
}

$runNormal = 0;
$runCalib = 0;
$runIgnore = 0;
$runTest = 0;
$runHalted = 0;

// get number of files to display
if ($_POST["nbFiles"]) {$nrFilesPerPage = $_POST["nbFiles"]; setcookie("nFiles", $_POST["nbFiles"], time()+86400);}
elseif ($_COOKIE["nFiles"]) {$nrFilesPerPage = $_COOKIE["nFiles"];}
else {$nrFilesPerPage = 20;}

// get display options
if ($_POST["DisplayOptions"]) {
   for ($i = 0; $i < count($_POST["DisplayOptions"]); $i++) {
      switch($_POST["DisplayOptions"][$i]) {
         case "normal":
            $runNormal = 1;
            break;
         case "calib":
            $runCalib = 1;
            break;
         case "ignore":
            $runIgnore = 1;
            break;
         case "test":
            $runTest = 1;
            break;
         case "halted":
            $runHalted = 1;
            break;
      }
   }
   setcookie("runN", $runNormal, time()+86400);
   setcookie("runC", $runCalib, time()+86400);
   setcookie("runI", $runIgnore, time()+86400);
   setcookie("runT", $runTest, time()+86400);
   setcookie("runH", $runHalted, time()+86400);
}
elseif ($_COOKIE["runN"] || $_COOKIE["runC"] || $_COOKIE["runI"] || $_COOKIE["runT"] || $_COOKIE["runH"]) {
   $runNormal = $_COOKIE["runN"];
   $runCalib = $_COOKIE["runC"];
   $runIgnore = $_COOKIE["runI"];
   $runTest = $_COOKIE["runT"];
   $runHalted = $_COOKIE["runH"];
}
else {
   $runNormal = 1;
   $runCalib = 1;
   $runIgnore = 1;
   $runTest = 1;
   $runHalted = 1;
}

//**** Database ****
if ($_POST["exp"]) {$database = "runlist_".$_POST["exp"]; $exp = $_POST["exp"]; setcookie("experiment", $_POST["exp"], time()+86400);}
elseif ($_COOKIE["experiment"]) {$database = "runlist_".$_COOKIE["experiment"]; $exp = $_COOKIE["experiment"];}
else {$database = "runlist_xgt"; $exp = "xgt";}

if (!$_COOKIE["experiment"]) {setcookie("experiment", $exp, time()+86400);}

//**** Home directory ****
switch ($exp) {
    case "xgt":
        $homeDir = "/xgt/";
        break;
    case "xlr":
        $homeDir = "/xlr/";
        break;
    default:
        $homeDir = "/xgt/";
}

// **** TOP ***************************************************************************************
echo "<table align='center' border='0' bordercolor='#000000' cellpadding='0' cellspacing='0' style='border-collapse: collapse;' width='800' height='100'>\n";
echo "   <tr>\n";
echo "      <td valign='bottom' align='right' style='border-color: #000000; border-left-style: none; border-left-width: 0; border-right-style: none; border-right-width: 0; border-top-style: none; border-top-width: 0; border-bottom-style: none; border-bottom-width: 0' width='800' height='100' background='$titleImg'>\n";
echo "      </td>\n";
echo "   </tr>\n";
// ************************************************************************************************

echo "   <tr>\n";
echo "      <td valign='top' align='center' style='border-color: #000000; border-left-style: none; border-left-width: 0; border-right-style: none; border-right-width: 0; border-top-style: none; border-top-width: 0; border-bottom-style: none; border-bottom-width: 0' width='800' bgcolor='#FFFFFF'>\n";

// **** MIDDLE ************************************************************************************
echo "<table align='center' border='0' bordercolor='#000000' cellpadding='0' cellspacing='0' style='border-collapse: collapse;' width='770' height='20'>\n";
echo "   <tr>\n";
echo "      <td valign='bottom' align='left' style='border-color: #000000; border-left-style: none; border-left-width: 0; border-right-style: none; border-right-width: 0; border-top-style: none; border-top-width: 0; border-bottom-style: none; border-bottom-width: 0' width='5' height='20'>\n";
echo "      </td>\n";
echo "      <td valign='bottom' align='center' style='border-color: #000000; border-left-style: none; border-left-width: 0; border-right-style: none; border-right-width: 0; border-top-style: none; border-top-width: 0; border-bottom-style: none; border-bottom-width: 0; background: url($tab1) no-repeat bottom left;' width='100' height='20'>\n";
echo "<font size='2' color='#FFFFFF'><a href='index.php?page=runlist/runlist.php' style='color:White; text-decoration:none'>Runlist</a></font>";
echo "      </td>\n";
echo "      <td valign='bottom' align='center' style='border-color: #000000; border-left-style: none; border-left-width: 0; border-right-style: none; border-right-width: 0; border-top-style: none; border-top-width: 0; border-bottom-style: none; border-bottom-width: 0; background: url($tab2) no-repeat bottom left;' width='100' height='20'>\n";
echo "<font size='2' color='#FFFFFF'><a href='index.php?page=slowcontrol/slowcontrol.php' style='color:White; text-decoration:none'>Slowcontrol</a></font>";
echo "      </td>\n";
echo "      <td valign='bottom' align='center' style='border-color: #000000; border-left-style: none; border-left-width: 0; border-right-style: none; border-right-width: 0; border-top-style: none; border-top-width: 0; border-bottom-style: none; border-bottom-width: 0; background: url($tab3) no-repeat bottom left;' width='100' height='20'>\n";
echo "<font size='2' color='#FFFFFF'><a href='index.php?page=liveview/liveview.php' style='color:White; text-decoration:none'>Live view</a></font>";
echo "      </td>\n";
echo "      <td valign='bottom' align='center' style='border-color: #000000; border-left-style: none; border-left-width: 0; border-right-style: none; border-right-width: 0; border-top-style: none; border-top-width: 0; border-bottom-style: none; border-bottom-width: 0; background: url($tab4) no-repeat bottom left;' width='100' height='20'>\n";
echo "<font size='2' color='#FFFFFF'><a href='index.php?page=EXO200Status/status.php' style='color:White; text-decoration:none'>EXO200</a></font>";
echo "      </td>\n";
// connect with database
$db=mysql_connect("lheppc90.unibe.ch","exodaq","EXOsql");
mysql_select_db("exo");

    $result = mysql_query("select * from issuetracker where CommentID='0' and category < 2");
    $nIssues = mysql_num_rows($result);
    if ($nIssues > 0) {$nI = "(".$nIssues.")";}
    else {$nI = "";}
echo "      <td valign='bottom' align='center' style='border-color: #000000; border-left-style: none; border-left-width: 0; border-right-style: none; border-right-width: 0; border-top-style: none; border-top-width: 0; border-bottom-style: none; border-bottom-width: 0; background: url($tab5) no-repeat bottom left;' width='100' height='20'>\n";
echo "<font size='2' color='#FFFFFF'><a href='index.php?page=issuetracker/IssueTracker.php' style='color:White; text-decoration:none'>Issue Tracker ".$nI."</a></font>";
echo "      </td>\n";
echo "      <td valign='bottom' align='left' style='border-color: #000000; border-left-style: none; border-left-width: 0; border-right-style: none; border-right-width: 0; border-top-style: none; border-top-width: 0; border-bottom-style: none; border-bottom-width: 0' width='265' height='20'>\n";
echo "      </td>\n";
echo "   </tr>\n";
echo "</table>\n";

echo "<table align='center' border='0' bordercolor='#5181D9' cellpadding='0' cellspacing='0' style='border-collapse: collapse;' width='770'>\n";
echo "   <tr>\n";
echo "      <td valign='top' align='center' style='border-color: #5181D9; border-left-style: solid; border-left-width: 1; border-right-style: solid; border-right-width: 1; border-top-style: solid; border-top-width: 1; border-bottom-style: none; border-bottom-width: 0' width='770' height='10'>\n";
echo "      </td>\n";
echo "   </tr>\n";
echo "   <tr>\n";
echo "      <td valign='top' align='center' style='border-color: #5181D9; border-left-style: solid; border-left-width: 1; border-right-style: solid; border-right-width: 1; border-top-style: none; border-top-width: 0; border-bottom-style: solid; border-bottom-width: 1' width='770'>\n";

// *** CONTENT ************************************************************************************

if ($_GET["page"]) {$currentPage = $_GET["page"];}
else {$currentPage = "runlist/runlist.php";}

$path = $currentPage;
include($path);

// ************************************************************************************************


echo "      </td>\n";
echo "   </tr>\n";
echo "</table>\n";

echo "      </td>\n";
echo "   </tr>\n";
// ************************************************************************************************

// **** BOTTOM ************************************************************************************
echo "   <tr>\n";
echo "      <td valign='bottom' align='right' style='border-color: #000000; border-left-style: none; border-left-width: 0; border-right-style: none; border-right-width: 0; border-top-style: none; border-top-width: 0; border-bottom-style: none; border-bottom-width: 0' width='800' height='20' bgcolor='#FFFFFF'>\n";
echo "      </td>\n";
echo "   </tr>\n";
echo "</table>\n";
// ************************************************************************************************

?>

</body>

</html>
