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
	 $value =  check_input($_POST["Delete"]);	
	
	if ($value=='Yes')
	{		
		// Retrieve the session information
		$myschedule=getGroupSchedule($sid);
		
		// Build the message for email
		$messageshort = $myschedule->getThedate() . "," . $myschedule->getDay() . "," . $myschedule->getTimestart() . "-" . $myschedule->getTimeend();
		$subject = "Tutor Session Deleted:  $messageshort";
		$message="The following tutoring session was deleted by $theuser: $messageshort " . getLocation($myschedule->getF2f()) 
		  . "," . getGroupCourses($myschedule->getGroupname()) .  " for " . $myschedule->getSname(); 
		  
		// Determine who the tutor of this session was as this is who will receive the email:		
		// Need to gather student data to send email
		$tutor = getTutor($sid);
		
		$temail=$tutor->getEmail();  
		// Double check to see if a student has already been scheduled
		$exists = checkReservation($sid);
		if($exists > 0)
		{		  
			// Get student email to send note of cancellation
			$mysched = getJoinStudent($sid);		 
		  $semail = $mysched->getEmail();
		  $messages=$message .  "<br/> Please visit the tutor site to select another available session.";
		  
		  // Delete the student schedule
		  $rowsdeleted=cancelSession($sid);				 	
		// Send email to Tutor and student about cancellation
		// removed for this app
		  
		}					
	
	  // Send copy of cancellations to director
		$semail = "jrobertson@umuc.edu";
	
		// Delete the session
		$rowsdeleted=deleteSession($sid);
		
		// Echo successful response		
		echo "<h3>Thank you! The tutoring session has been Deleted.</h3>";		
	  echo "<h3><a href=ListSessions.php>Show all of my sessions</a></h3>"; 
		
		// Send email to Tutor		
		// removed email functionality
	
	}
	else
	{
		echo "<h3>Based on the user response, the tutoring session was not deleted.</h3>";		
		echo "<h3><a href=ListSessions.php>Show all of my sessions</a></h3>"; 
	}
	
 
 
  }  
	
	
?>
       
</body>
</html>
