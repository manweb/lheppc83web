<?php
// connect with database
$db=mysql_connect("lheppc90.unibe.ch","exodaq","EXOsql");
mysql_select_db("exo");

if ($_POST['id']) {
   $id = $_POST['id'];
   $result = mysql_query("select max(CommentID) from issuetracker where ID='$id'");
   $comID = mysql_result($result,0) + 1;
}
else {
    $result = mysql_query("select max(ID) from issuetracker");
    $id = mysql_result($result,0) + 1;
    $comID = 0;
}

$current_date = date("Y-m-d");
$current_time = date("H:i:s");
if ($_POST['Project']) {$project = $_POST['Project'];}
else {$project = 0;}
if ($_POST['SubmitBy']) {$name = $_POST['SubmitBy'];}
else {$name = 0;}
if ($_POST['AssignedTo']) {$assigned = $_POST['AssignedTo'];}
else {$assigned = 0;}
if ($_POST['Description']) {$description = $_POST['Description'];}
else {$description = 0;}
$description = str_replace("'", "''", $description);
$message = $_POST['Message'];
$message = str_replace("'", "''", $message);
if ($_POST['DueOn']) {$dueOn = $_POST['DueOn'];}
else {$dueOn = "0000-00-00";}
if ($_POST['Category']) {
   switch ($_POST['Category']) {
      case "Urgent":
         $category = 0;
         break;
      case "Moderate":
         $category = 1;
         break;
    }
}
else {$category = 0;}

$insert = mysql_query("insert into issuetracker (ID, date, time, Project, SubmitBy, AssignedTo, Description, Message, DueOn, category, CommentID) values ('$id', '$current_date', '$current_time', '$project', '$name', '$assigned', '$description', '$message', '$dueOn', '$category', '$comID')");

if ($name != $assigned && $assigned) {
   if ($_POST['SendAll']) {$mail = mysql_query("select email from users");}
   else {$mail = mysql_query("select email from users where name='$assigned'");}

   if (!$name) {$name = "Someone";}
}
elseif (!$name && !$assigned && $_POST['SendAll']) {
   $mail = mysql_query("select email from users");
   $name = "Someone";
}
else {$mail = 0;}

$result = mysql_query("select AssignedTo from issuetracker where ID='$id'");
$ass = mysql_result($result,0);

require("class.phpmailer.php");
if ($mail && !$_POST['id']) {
   $body = $name." has submitted a new issue and you have been assigned. Please review the issue number ".$id.".\n";
   $m=0;
   while ($row = mysql_fetch_row($mail)) {
//      $mail_var = "mail$m";
      $mail_var = new PHPMailer();
      $mail_var->IsSMTP();
      $mail_var->CharSet = 'UTF-8';
      
      $mail_var->Host       = "smtp.gmail.com"; // SMTP server example
      $mail_var->SMTPDebug  = 0;                     // enables SMTP debug information (for testing)
      $mail_var->SMTPSecure = 'ssl';
      $mail_var->SMTPAuth   = true;                  // enable SMTP authentication
      $mail_var->Port       = 465;                    // set the SMTP port for the GMAIL server
      $mail_var->Username   = "exo.bern"; // SMTP account username example
      $mail_var->Password   = "L1qu1dTPC";        // SMTP account password example

      $mail_var->From = "issuetracker@lheppc83.unibe.ch";
      $mail_var->FromName = "Issue Tracker";
      $mail_var->AddAddress($row[0]);

      $mail_var->Subject = "New issue";
      $mail_var->Body    = $body;

      $mail_var->Send();

      $m++;

   }
}
elseif ($_POST['id']) {
   $u = mysql_query("select SubmitBy from issuetracker where ID='$id' and SubmitBy!='$name'");

   if (!$name) {$name = "Someone";}

   $body = $name." has added a comment to the issue number ".$id.".\n";

   $sendAss = true;

   $m=0;
   while ($n = mysql_fetch_row($u)) {
      $mail = mysql_query("select email from users where name='$n[0]'");
      $mailAddress = mysql_result($mail,0);

      //$mail_var = "mail$m";
      $mail_var = new PHPMailer();
      $mail_var->IsSMTP();
      $mail_var->CharSet = 'UTF-8';
      
      $mail_var->Host       = "smtp.gmail.com"; // SMTP server example
      $mail_var->SMTPDebug  = 0;                     // enables SMTP debug information (for testing)
      $mail_var->SMTPSecure = 'ssl';
      $mail_var->SMTPAuth   = true;                  // enable SMTP authentication
      $mail_var->Port       = 465;                    // set the SMTP port for the GMAIL server
      $mail_var->Username   = "exo.bern"; // SMTP account username example
      $mail_var->Password   = "L1qu1dTPC";        // SMTP account password example

      $mail_var->From = "issuetracker@lheppc83.unibe.ch";
      $mail_var->FromName = "Issue Tracker";
      $mail_var->AddAddress($mailAddress);

      $mail_var->Subject = "New comment";
      $mail_var->Body    = $body;

      $mail_var->Send();

      if ($ass == $n[0]) {$sendAss = false;}

      $m++;
   }

   if ($ass && $sendAss) {

      $mail = mysql_query("select email from users where name='$ass'");
      $mailAddress = mysql_result($mail,0);

      //$mail_var = "mail$m";
      $mail_var = new PHPMailer();
      $mail_var->IsSMTP();
      $mail_var->CharSet = 'UTF-8';
      
      $mail_var->Host       = "smtp.gmail.com"; // SMTP server example
      $mail_var->SMTPDebug  = 0;                     // enables SMTP debug information (for testing)
      $mail_var->SMTPSecure = 'ssl';
      $mail_var->SMTPAuth   = true;                  // enable SMTP authentication
      $mail_var->Port       = 465;                    // set the SMTP port for the GMAIL server
      $mail_var->Username   = "exo.bern"; // SMTP account username example
      $mail_var->Password   = "L1qu1dTPC";        // SMTP account password example

      $mail_var->From = "issuetracker@lheppc83.unibe.ch";
      $mail_var->FromName = "Issue Tracker";
      $mail_var->AddAddress($mailAddress);

      $mail_var->Subject = "New comment";
      $mail_var->Body    = $body;

      $mail_var->Send();
   }
}

echo "<meta http-equiv='refresh' content='0; URL=../index.php?page=issuetracker/IssueTracker.php'>";

?>
