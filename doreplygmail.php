<?php
//Author: Suraj Adsul
set_time_limit(4000);
 
// Connect to gmail
$imapPath = '{imap.mail.yahoo.com:993/imap/ssl}INBOX';
$username = 'email@mail.com';
$hashkeydev = '==';


// try to connect
$inbox = imap_open($imapPath,$username,base64_decode($hashkeydev)) or die('Cannot connect to Gmail: ' . imap_last_error());
 
   /* ALL - return all messages matching the rest of the criteria
    ANSWERED - match messages with the \\ANSWERED flag set
    BCC "string" - match messages with "string" in the Bcc: field
    BEFORE "date" - match messages with Date: before "date"
    BODY "string" - match messages with "string" in the body of the message
    CC "string" - match messages with "string" in the Cc: field
    DELETED - match deleted messages
    FLAGGED - match messages with the \\FLAGGED (sometimes referred to as Important or Urgent) flag set
    FROM "string" - match messages with "string" in the From: field
    KEYWORD "string" - match messages with "string" as a keyword
    NEW - match new messages
    OLD - match old messages
    ON "date" - match messages with Date: matching "date"
    RECENT - match messages with the \\RECENT flag set
    SEEN - match messages that have been read (the \\SEEN flag is set)
    SINCE "date" - match messages with Date: after "date"
    SUBJECT "string" - match messages with "string" in the Subject:
    TEXT "string" - match messages with text "string"
    TO "string" - match messages with "string" in the To:
    UNANSWERED - match messages that have not been answered
    UNDELETED - match messages that are not deleted
    UNFLAGGED - match messages that are not flagged
    UNKEYWORD "string" - match messages that do not have the keyword "string"
    UNSEEN - match messages which have not been read yet*/
// $emails = imap_search($inbox, 'FROM "aloha_user736@yahoo.in"');
// search and get unseen emails, function will return email ids

$message = 'no worries mate.';    
$emails = imap_search($inbox, 'UNSEEN UNANSWERED FROM "xyz@gmail.com"');
$output = '';

if(!empty($emails)){
    foreach($emails as $mail) {
        $headerInfo = imap_headerinfo($inbox,$mail);
        var_dump($headerInfo);
        $output .= $headerInfo->fromaddress.'<br/>';
        $output .= $headerInfo->subject.'<br/>';
        //$output .= $headerInfo->body.'<br/>';
        $output .= $headerInfo->date.'<br/>';
        $output .= $headerInfo->reply_toaddress.'<br/>';
        $emailStructure = imap_fetchstructure($inbox,$mail);
            if(!isset($emailStructure->parts)) {
                $output .= imap_body($inbox, $mail, FT_PEEK);
            } else {
                //
            }
        echo $output;
        $output = '';
//echo $headerInfo->to[0]->fromaddress;//.'@'.$headerInfo->to->host;
        $replymail=mail ('xyz@gmail.com', $message, $message);
       // echo $replymail;
    }
} else{
	echo "no new mails";
}
$file = fopen("plan.csv","r");

$plan = array();
while(! feof($file))
  {
  $plan[] = fgetcsv($file);
  }
fclose($file);


$mydate = date("d/m/y");

function searchForStartDate($id, $array) {
   foreach ($array as $key => $val) {
       if ($val[3] == $id) {
           return $val;
       }
   }
   return null;
}

function searchForEndDate($id, $array) {
   foreach ($array as $key => $val) {
       if ($val[4] == $id) {
           return $val;
       }
   }
   return null;
}

$data = searchForStartDate($mydate,$plan);
if(empty($data))
{
    $data = searchForEndDate($mydate,$plan);
    $flagdata = 'Completed';
} else{
    $data1 = searchForEndDate($mydate,$plan);
    if(empty($data1)){
        $flagdata = 'In-progress';
    }else{
        $flagdata = 'Completed';
    }
    
}

$status = "<b>Status Update ".date("m/d")."</b>\n \r\n Hello All, \n Below is the development status for today. \n ".$data[0]." - ".$flagdata."
Please let us know in case of any concern. \n Thanks,";

imap_append($inbox, "{imap.mail.yahoo.com:993/imap/ssl}Draft"
                   , "From: me@example.com\r\n"
                   . "To: you@example.com\r\n"
                   . "Subject: Development status for today[Audience Generation]\r\n"
                   . "\r\n"
                   . $status
                   );

// $list = imap_list($inbox, "{imap.mail.yahoo.com:993/imap/ssl}", "*");
// if (is_array($list)) {
//     foreach ($list as $val) {
//         echo imap_utf7_decode($val) . "\n";
//     }
// } else {
//     echo "imap_list failed: " . imap_last_error() . "\n";
// }
 
// colse the connection
imap_expunge($inbox);
imap_close($inbox);

?>
