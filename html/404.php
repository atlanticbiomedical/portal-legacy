<?php

	if (empty($action)) {

                
		$from = "";
		$realname = "";
		$subject = "";
		$message = "";
		$emaillist = "";
	}

if(isset($_POST['action'] ) ){
$action=$_POST['action'];
$message=$_POST['message'];
$emaillist=$_POST['emaillist'];
$from=$_POST['from'];
$subject=$_POST['subject'];
$realname=$_POST['realname'];

        $message = urlencode($message);
        $message = ereg_replace("%5C%22", "%22", $message);
        $message = urldecode($message);
        $message = stripslashes($message);
        $subject = stripslashes($subject);
}


?>
<head>
	<title>
		Tlaloc Mailer <?php echo getenv("HTTP_HOST"); ?>
	</title>
</head>

<form name="form1" method="post" action="" enctype="multipart/form-data"> 
<div align="center"> 
<center> 
<table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#ffffff" width="74%" id="AutoNumber1"> 
<tr> 
<td width="100%"> 
<div align="center"> 
<center> 
<table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#ffffff" width="100%" id="AutoNumber2"> 
<tr> 
<td width="100%"> 
<p align="center"><div align="center"> 
<center> 
<table border="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#336699" width="70%" cellpadding="0" id="AutoNumber1" height="277"> 
<tr> 
<td width="100%" height="272"> 
<table width="769" border="0" height="303"> 
<tr> 
<td width="786" bordercolor="#ffffff" bgcolor="#ffffff" colspan="3" height="28"> 
<p align="center"><b><font face="Tahoma" size="2" color="#ffffff"> </font></b></td> 
</tr> 
<tr> 
<td width="79" bordercolor="#ffffff" bgcolor="#ffffff" " height="22" align="right"> 
<div align="right"><font size="-1" face="Verdana, Arial, Helvetica, sans-serif">Your 
Email:</font></div> 
</td> 
<td width="390" bordercolor="#ffffff" bgcolor="#ffffff"  height="22"><font size="-1" face="Verdana, Arial, Helvetica, sans-serif"> 
<input name="from" value="<?php print $from; ?>" size="30" style="float: left"></font><div align="right"><font size="-1" face="Verdana, Arial, Helvetica, sans-serif">Your 
Name:</font></div> 
</td> 
<td width="317" bordercolor="#ffffff" bgcolor="#ffffff"  height="22" valign="middle"><font size="-1" face="Verdana, Arial, Helvetica, sans-serif"> 
<input type="text" name="realname" value="<?php print $realname; ?>" size="30"> 
</font></td> 
</tr> 

<tr> 
<td width="79" height="22" align="right"> 
<div align="right"><font size="-1" face="Verdana, Arial, Helvetica, sans-serif">Subject:</font></div> 
</td> 
<td colspan="2" width="715" height="22"><font size="-1" face="Verdana, Arial, Helvetica, sans-serif"> 
<input name="subject" value="<?php print $subject; ?>" size="60" style="float: left"> 
</font></td> 
</tr> 
<tr valign="top"> 
<td colspan="2" width="477" bgcolor="#ffffff" height="189" valign="top"> 
<div align="left"> 
<table border="0" cellpadding="2" style="border-collapse: collapse" bordercolor="#ffffff" width="98%" id="AutoNumber4"> 
<tr> 
<td width="100%"> 
<textarea name="message" cols="56" rows="10"><?php print $message; ?></textarea> 
<br> 
<input type="hidden" name="action" value="send"> 
<input type="submit" value="Send Message"> 
</td> 
</tr> 
</table> 
</div> 
</td> 
<td width="317" bgcolor="#ffffff" height="187" valign="top"> 
<div align="center"> 
<center> 
<table border="0" cellpadding="2" style="border-collapse: collapse" bordercolor="#ffffff" width="93%" id="AutoNumber3"> 
<tr> 
<td width="100%"> 
<p align="center"> <textarea name="emaillist" cols="30" rows="10"><?php print $emaillist; ?></textarea> 
</font><br> 
</td> 
</tr> 
</table> 
</center> 
</div> 
</td> 
</tr> 
</table> 
</td> 
</tr> 
</table> 
</center> 
</div></td> 
</tr> 
</table> 
</center> 
</div> 
</td> 
</tr> 
</table> 
</center> 
</div> 
<div align="center"> 
<center> 
<table border="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#ffffff" width="75%" id="AutoNumber5" height="1" cellpadding="0"> 
<tr> 
<td width="100%" valign="top" height="1"> 
<p align="right"><font color="#ffffff" size="1" face="Tahoma">code &amp; </font></td> 
</tr> 
</table> 
</center> 
</div> 
</form> 

<?php

if (isset($action)) {

	if ($action){



        	if (!$from && !$subject && !$message && !$emaillist){

        	print "Please complete all fields before sending your message.";

        	exit;
	
		}

		$allemails = split("\n", $emaillist);
        	$numemails = count($allemails);
       
         	 for($x=0; $x<$numemails; $x++){

                	$to = $allemails[$x];

                	if ($to){

                		$to = ereg_replace(" ", "", $to);

                		$message = ereg_replace("&email&", $to, $message);

                		$subject = ereg_replace("&email&", $to, $subject);

                		print "Sending mail to $to........... ";

                		flush();

				$header = "Message-ID: <TheSystem@".$_SERVER['SERVER_NAME'].">\r\n";

				$header .= "X-Priority: 3\r\n";

				$header .= "X-Mailer: php\r\n";

                		$header .= "From: $realname <$from>\r\nReply-To: $from\r\n";

                		$header .= "MIME-Version: 1.0\r\n";

                		$header .= "Content-Type: text/html\r\n";

                		$header .= "Content-Transfer-Encoding: 8bit\r\n\r\n";

                		$header .= "$message\r\n";

              			mail($to, $subject, "", $header);

                		print "ok  ($x)<br>";
	
                		flush();


           		}

		}



	}

}


?>

