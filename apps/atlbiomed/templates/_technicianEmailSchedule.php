<?php 
/*
 * Accepts the following parameters
 *  	$schedule: a TechnicianSchedule object
 *		$workorderCallbackFunction: a string representing a javascript function accepting 1 parameter
 */

$date = explode('-',$date);
$date = $date[1].'/'.$date[2].'/'.$date[0];

$tech_name = $schedule->getTechnician()->getFirstName().' '.$schedule->getTechnician()->getLastName();
$tech_email = $schedule->getTechnician()->getEmail();
//var_dump(get_class_methods('Workorder'));
//exit;
$workorders = $schedule->getWorkorders();
$tech = $schedule->getTechnician();
$workorders = $schedule->sortWorkorder($workorders);

    $output = "";
for($i=0; $i < count($workorders); $i++){
    if($workorders[$i]->getExactTime())
            $output .= "<span style='color:red'>This job starts exactly at</span>: ".$workorders[$i]->convertTime($workorders[$i]->getJobStart())."<br/>";
    else
	    $output .= $workorders[$i]->convertTime($workorders[$i]->getJobStart())."<br/>";
	$output .= "<b>".$workorders[$i]->getClient()->getClientName()."</b><br/>";
	$output .= "(".$workorders[$i]->getClient()->getClientIdentification().")<br/>";
	$output .=  $workorders[$i]->getClient()->getAddress() . ' ' . $workorders[$i]->getClient()->getAddress2() . ' '.
						$workorders[$i]->getClient()->getCity() .
						', '. $workorders[$i]->getClient()->getState() . ' ' .  $workorders[$i]->getClient()->getZip()."<br/>";
    $output .= $workorders[$i]->getClient()->getAttn().' '.$workorders[$i]->getClient()->getPhone()."<br/>";
    $output .= "Main Contact: ".$workorders[$i]->getClient()->getAttn().' '.$workorders[$i]->getClient()->getPhone()."<br/>";
    $output .= "Requested By: ".$workorders[$i]->getCaller()."<br/>";
    $output .= "Reason: ".$job_reason[$workorders[$i]->getReason()]."<br/>Remarks:<br/>";
    $output .= $workorders[$i]->getRemarks()."<br/>";
	$output .= "<br/>";
}





$style="<style type='text/css'>
ul,ol,li,h1,h2,h3,h4,h5,h6,pre,form,body,html,p,blockquote,fieldset,input
{ margin: 0; padding: 0; }
a img,:link img,:visited img { border: none; }

a
{
  text-decoration: none;
}

a:hover
{
  text-decoration: underline;
}

body, td
{
  margin: 0;
  padding: 0;
  font-family: Arial, Verdana, sans-serif;
  font-size: 11px;
  background-color: #fff;
}

body
{
  padding: 20px;
}

.form_error, .red{
	color: #f00;
	font-weight: bold;
}

/* logo, header */

.header
{
	width: 93%;
}

.content
{
	width: 93%;
}

.header .logo_wrapper
{
	margin: 5px;
}

.secureModuleMain
{
	text-align: center; 
	padding-top: 25px;
}

.secureModuleMessage
{
	width: 600px; 
	border: 1px solid black; 
	text-align: left; 
	background-color: #cccccc; 
	color: #ffffff;
	font-size: x-large;
	padding: 10px 0px 10px 0px;
}

.secureModuleMessage img
{
	display: inline;
	border: 0px;
	float: left;
}

.secureModuleMessage div
{
	display: inline;
}

.secureModuleMessage a:visited, .secureModuleMessage a:active, .secureModuleMessage a
{
	color: #ffffff;
}

.header .logo
{
	padding: 5px;
	background: url(../images/logo_bg.png) #FFFFFF repeat-y;
	background-position: 100%;
}

.header .menu, .header .menu a, .header .menu a:visited
{
	margin: 0px 5px 5px 5px;
	padding: 2px 10px 2px 10px;
	color: #FFFFFF;
	font-weight: bold;
	font-size: 1em;
	background: #08c46e;	
}

.menuCommands
{
	display: inline;
}

.loginForm
{
	text-align: center;
	margin-top: 100px;
}

.loginFormInner
{
	display: inline;
}

.loginFormInner fieldset
{
	text-align: left; 
	display: inline; 
	position: relative; 
	padding: 0 10px 10px 10px;
}

.loginFormInner fieldset label
{
	font-weight: bold;
}
.loginFormInnerRow
{
	width: 100%;
}

.header .menu a:active
{
	font-size: .9em;
	color: #f2080c;
}

/* content */

/* footer */
.footer
{
	width: 90%;
	text-align: center;
	border-top: 2px solid #08c46e;
	margin: 20px 5px 20px 5px;
	padding: 20px;
	clear: both;
}

.footer a:visited
{
	color: #000000;
}

.footer a:active
{
	color: #f2080c;
}

/* ########## User Manager ########## */

.userForm, .currentUsers
{
	margin-left: 5px;
	margin-bottom: 5px;
	border: 1px solid #666666;
	padding: 10px;
	float: left;
}

.userForm
{
	width: 255px;
}

.currentUsers
{

}
/* ########## Client Manager ########## */
.newClient
{
	border: 1px solid #666666;
	width: 331px;
	margin: 0 5px 5px 5px;
	float: left;
}

.clientSelect
{
	padding: 3px;
	background: #ccc;
	border-bottom: 1px solid #666666;
}

.clientSelect td
{
	background: #DDDDDD;
}
.clientHeader
{
	clear: both;
	width: 100%;
	padding: 3px 0px;
	background: #ccc;
	border-top: 1px solid #666666;
	border-bottom: 1px solid #666666;
}
.clientHeader h2
{
	margin-left: 10px;
}
.oldWorkorders td, .upWorkorders td{
	padding: 3px 10px;
}

.clientSelect td
{
	background: #ccc;
}

.clientInfo
{
	margin: 5px;
}

.clientDevice
{
	width: 776px;
	border: 1px solid #666666;
	padding: 10px;
	float: left;
}

#clientOptions input
{
	float: right;
	margin: 5px;
}

/* ########## Workorders ########## */

#workorder_report
{
	border: 1px solid #888888;
}

#workorder_report td
{
	background: #6292c4;
	padding: 3px;
	margin: 1px;
}
#workorder_report td.order_label
{
	font-weight: bold;
}

/* ########## Scheduler ########## */
#main
{
	width: 90%;

	margin: 0 5px 0 5px;
	float: left;
}

#availableTechWrapper
{
}
#availableTechnicians
{
	border: 1px solid #000;
	width: 200px;
	float: left;
	margin: 5px 5px 5px 0;
}
#availableTechnicians h2
{
	font-size: 14px;
	background: #ccc;
	border-bottom: 1px solid #000;
	padding: 5px;
	line-height: 25px;
	text-align: center;
}
#availableTechs{
	padding: 10px;
}
#availableTechs div.availTech{
	padding-bottom: 5px;
	font-weight: bold;
}
#availableTechs div.availTech a{
	font-weight: normal;
	color: #00f;
}
#scheduler
{
	width: 350px;
	margin: 5px;
	border: 1px solid #000;
	float: left;
}

#scheduler .client_select
{
	background-color: #ccc;
	border-bottom: 1px solid #666666;
	padding: 5px;
}
#scheduler .client_select td
{
	height: 16px;
	line-height: 16px;
	vertical-alignt: middle;
	padding: 0px;
	margin: 0px;
}
#scheduler .job_details
{
	margin: 5px;
}

#scheduler table tr td
{
	background-color: transparent;
}
#scheduler small{
	font-size: 11px;
	padding: 3px 2px;
}
#display
{
float: right;
}

.techSchedule div
{
	width: 200px;
	float: left;
}
#techInfo{
	width: 1100px;
}
#techMenu
{
	clear: both;
	background: #ccc;
	padding: 5px 0px;
	border: 1px solid #000;
	margin-left: 10px;
}

#techMenu a{
	color: #000;
	font-weight: bold;
	border-right: 1px solid #000;
	padding: 5px 7px;
}
#techMenu a:hover{
	text-decoration: none;
	background: #ddd;
}
#techMap
{
	width: 575px;
	height: 450px;
	float: right;
	margin-right: 50px;
}
#techMapDisplay
{
	width: 100%;
	height: 100%;
	border: 0;
}

div .techTableWrapper
{
	float: left;
	margin: 10px;
	position: relative;
	display: inline:
	height: 350px;
}

div .techTable
{
	border: 1px solid #000;
}
div.techSchedule{
	clear: both;
}

.techSchedule div.tech-name{
	background: #ccc;
	padding: 5px;
	border-top: 1px solid #000;
	border-left: 1px solid #000;
	border-right: 1px solid #000;
	width: 190px;
	font-weight: bold;
}

.techSchedule div .scheduled
{
	background: #4aa7be;
	display: block;
	cursor: pointer;
}

.techSchedule div .scheduled-existing
{
}

.techSchedule div .scheduled-new 
{
	border-top: 1px solid #000000;
}

.techSchedule div .unscheduled
{
}

.techSchedule div .unscheduledJobEnd
{
	border-top: 1px solid #FFFFFF;
}


.techSchedule div div
{
	float: none;
}

.techSchedule table
{
	border-collapse: collapse;
	width: 100%;
}
.techSchedule td
{
	padding: 3px;
	margin: 0px;
	background: #4aa7be;
}
.techSchedule div.unscheduled td.un-spacer
{
	border-bottom: 1px dotted #000000;
	background: #fff;
}
.techSchedule td.time
{
	vertical-align: top;
	font-weight: bold;	
	text-align: center;
	width: 30px;
	background: #ddd;
	border-right: 1px solid #000;
	border-bottom: 1px solid #000000;
}
.techSchedule div.scheduled td.time
{
	background: #ddd;
}
.techSchedule td.schedule-client{
	padding-left: 5px;
}
{
	vertical-align: top;
	font-weight: bold;	
}

.mapsCollapsingPanelContainer
{
	float: left; 
	width: 200px; 
	border: 1px solid black;
	text-align: right;
	margin-right: 10px;
}
.mapsCollapsingPanelContainer select
{
	width: 180px; 
}

.mapsCollapsingPanelContainerControl
{
	width: 95%;
	height: 25px;
	padding: 10px 0px 0px 5px;
	margin-left: auto; 
	margin-right: auto; 
	margin-top: 5px; 
}

.collapsingPanelHeader
{
	background-color: #ccc;
	width: 95%;
	height: 25px;
	padding: 10px 0px 0px 5px;
	margin-left: auto; 
	margin-right: auto; 
	margin-top: 5px; 
	font-size: larger; 
	font-weight: bold; 
	color: #000; 
	cursor: pointer; 
	border: 1px solid black;
	text-align: left;
}

.collapsingPanelContent
{
	width: 95%; 
	min-height: 25px; 
	padding: 10px 0px 0px 5px; 
	margin-left: auto; 
	margin-right: auto;  
	border-width: 0px 1px 1px 1px; 
	border-style: solid;
	text-align: left;
}
.form-error{
	font-weight: bold;
	color: #f00;
}
.workorder_search_results td{
	padding: 2px 5px;
}
</style>";
    
    
    $messsage =  '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">'."<html><head><title> $tech_name's Schedule</title>".
    "<link  rel='stylesheet' type='text/css' media='screen'  href='http://staging.atlanticbiomedical.accella.net/css/main.css'/>".
    "$style</head><body>Comments: <br/>$emailComment <br/><br/><div class='techSchedule' style='font-size: 12px;'>".
    "$output</div></body></html>"; 
    

    
 //$tech_email = "starkisspk@yahoo.com";
 //$tech_email = "jaking17@gmail.com";
 //$tech_email = "accellatest@gmail.com";
 //$tech_email = "csewell2008@gmail.com";
 
 $headers  = 'MIME-Version: 1.0' . "\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\n";
$headers .= 'From: Atlantic Biomedical <schedule@atlanticbiomedical.com>' . "\n";
file_put_contents('/home/ryan/sites/accella/abc/web/t/email.html',$messsage);
    if( !empty($tech_name) and !empty($tech_email) ) 
    { 
    	

/***************************************/
$mail=new PHPMailer();

$mail->IsSMTP();
$mail->SMTPAuth = true; // enable SMTP authentication
$mail->SMTPSecure = "ssl"; // sets the prefix to the servier
$mail->Host = "smtp.gmail.com"; // sets GMAIL as the SMTP server
$mail->Port = 465; // set the SMTP port
$mail->Username = "schedule@atlanticbiomedical.com"; // GMAIL username
$mail->Password = "success4"; // GMAIL password

$mail->From = "schedule@atlanticbiomedical.com";
$mail->FromName = "AtlanticBiomedical Schedule";
$mail->Subject = "$tech_name's Atlantic Biomedical Schedule " . $date;
$mail->Body = $messsage; //HTML Body
$mail->AltBody = "HTML IS REQUIRED TO VIEW"; //Text Body

$mail->WordWrap = 50; // set word wrap 
$mail->AddAddress("$tech_email","$tech_name");
$mail->AddReplyTo("schedule@atlanticbiomedical.com","Schedules");
$mail->AddCC("chris.endres@gmail.com","Chris Endres");
//$mail->AddAttachment("/path/to/file.zip"); // attachment
//$mail->AddAttachment("/path/to/image.jpg", "new.jpg"); // attachment
$result = $mail->Send();
/***************************************/
 
    	   if(!$result){
    	   	 
    	   	  echo "<b><span class='tech_email_error'>ERROR</span></b><br/> Unable to Email<br/>";
    	      echo "<b>Email: </b><br/> $tech_email<br/>";
    	      echo "<b>TechName: </b><br/> $tech_name<br/>";
    	   }else
    	     echo "Email was sent to<br/> <b>$tech_name</b> at<br/> <b>$tech_email</b><br/>";
    	
    }elseif(empty($tech_name)){
    	echo "<b><span class='tech_email_error'>ERROR</span></b><br/> Unknown Tech<br/>";
    	echo "<b>Email: </b><br/> $tech_email<br/>";
    }
    else{
    	echo "<b><span class='tech_email_error'>ERROR</span></b><br/> No Tech Email<br/>";
    	echo "<b>TechName: </b><br/> $tech_name<br/>";
    }
    echo "<input class='emailButton' id='close_butt_ajax' type='button' value='close' onclick='Element.hide(\"emailPopUp\")'>"; 

    
?>
    
