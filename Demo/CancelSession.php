<html>
	<head>
   <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link rel="stylesheet" type="text/css" href="tutors.css">   
   <title>Cancel Tutor Session</title>
</head>
<body > 

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
	
	// Obtain the session to cancel
	 $id = check_input($_GET["sid"]);	 
	 // Make sure input is a number and the session is their's to cancel
	 if (is_numeric($id))
	 {
	   // Make sure this session is owned by the current user
	   $schedule = getStudentSchedule($id);	      
	   if ($schedule->getTname() ==  $_SESSION['wsuser'])
	   {	   
	   	$dtext= $schedule->getCourse() . "," . $schedule->getThedate() . "," . $schedule->getDay() . "," . 
	   	     $schedule->getTStart() . "-" . $schedule->getTend() . " with " . $schedule->getFirstname() . " " . $schedule->getLastname();	   	
	   	echo "<form name='cancelit' method='POST' action='Cancelit.php'>	";
			// Display first part of the table
			echo "<h3> Cancel Tutor Session Confirmation </h3>";
			echo "<p></p>";	
			echo "<div>";
			echo "<table id='myerror'>";
			echo "<tr>";			
			echo "<td>Are you sure you want to cancel this session?</td>";
			echo "</tr>";
			echo "<tr>";	
			echo "<td>$dtext</td>";
			echo "</tr>";
			echo "<tr>";	
			echo "<td><input type='submit' value='Yes' name='Cancel'>&nbsp;&nbsp;&nbsp;&nbsp;<input type='submit' value='No' name='Cancel'></td>";
			echo "</tr>";									   	
			echo "<input type='hidden' name='sid' value='$id'>";
			echo "</form>";
			echo "</table>";			
		  echo "</div>";	  	
		  echo "<p></p>";					   	
	   	// Send email to tutor about cancellation
	   		 
	   }
	   else 
	  {
	  	echo "<h3>You can only cancel sessions you created</h3>";
	  }
	 }
	 else
	 {
	 	echo "Someone might be trying to hack the system";
	 }
		
	
 }