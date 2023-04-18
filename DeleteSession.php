<html>
	<head>
   <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link rel="stylesheet" type="text/css" href="tutors.css">   
   <title>Delete Tutor Session</title>
</head>
<body > 

<?php   
	
	session_start();
	if (!isset($_SESSION['wsuser'])) 	   
	{ 
	  include('tindex.html');  
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
	   $schedule = getTutorSchedulebyID($id);	      
	   if ($schedule->getTname() ==  $_SESSION['wsuser'])
	   {	   
	   	$dtext= getGroupCourses($schedule->getGroup()) . "," . $schedule->getThedate() . "," . $schedule->getDay() . "," . 
	   	     $schedule->getTStart() . "-" . $schedule->getTend() ;	   	
	   	echo "<form name='deleteit' method='POST' action='Deleteit.php'>	";
			// Display first part of the table
			echo "<h3> Delete Tutor Session Confirmation </h3>";
			echo "<p></p>";	
			echo "<div>";
			echo "<table id='myerror'>";
			echo "<tr>";			
			echo "<td>Are you sure you want to permanently delete this session?</td>";
			echo "</tr>";
			echo "<tr>";	
			echo "<td>$dtext</td>";
			echo "</tr>";
			echo "<tr>";	
			echo "<td><input type='submit' value='Yes' name='Delete'>&nbsp;&nbsp;&nbsp;&nbsp;<input type='submit' value='No' name='Delete'></td>";
			echo "</tr>";									   	
			echo "<input type='hidden' name='sid' value='$id'>";
			echo "</form>";
			echo "</table>";			
		  echo "</div>";	  	
		  echo "<p></p>";					   		   
	   		 
	   }
	   else 
	  {
	  	echo "<h3>You can only cancel sessions you own.</h3>";
	  }
	 }
	 else
	 {
	 	echo "Someone might be trying to hack the system";
	 }
		
	
 }