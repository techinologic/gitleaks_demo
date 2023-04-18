<html>
	<head>
   <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link rel="stylesheet" type="text/css" href="tutors.css">   
   <title>CSTutor Cancel Confirmation</title>
</head>

<body> 

<?php

	session_start();
	if (!isset($_SESSION['wsuser'])) 	   
	{ 
	  include('index.html');  
	}
	else 
	{	
	  // Show the page header
		include('Includes/Header.php');	
		require_once('Includes/Utils.php');		
		require_once('Includes/SQLFunctions.php');		
		
	 // Retrieve Post Data
	 $theuser = $_SESSION['wsuser'];
	 $sid = check_input($_POST["sid"]);	
	 $value =  check_input($_POST["Cancel"]);	
	
	if ($value=='Yes')
	{		
		// Cancel the session
		$rowsdeleted=cancelSession($sid);
		
		// Echo successful response		
		echo "<h3>Thank you! The tutoring session has been cancelled.</h3>";
		echo "<h3>Return to <a href=SearchSessions.php>search</a></h3>";
		
		// Retrieve the session information
		$myschedule=getGroupSchedule($sid);
		$messageshort = $myschedule->getThedate() . "," . $myschedule->getDay() . "," . $myschedule->getTimestart() . "-" . $myschedule->getTimeend();
		$subject = "Tutor Session Cancelled:  $messageshort";
		$message="The following tutoring session was cancelled by $theuser: $messageshort " . getLocation($myschedule->getF2f()) 
		  . "," . getGroupCourses($myschedule->getGroupname()) .  " for " . $myschedule->getSname(); 
				
		// Determine who the tutor of this session was as this is who will receive the email:
		$tutor = getTutor($sid);
		$student=getStudentbyID($theuser);
		
		$temail = $tutor->getEmail();
		$semail = $student->getEmail();
		
		// Send email to Tutor
		// Removed email functionality for this demo
	
	}
	else
	{
		echo "<h3>Based on the user response, the tutoring session was not cancelled.</h3>";
		echo "<h3>Return to <a href=SearchSessions.php>search</a></h3>";
	}
	
 
 
  }  
	
	
?>
       
</body>
</html>
