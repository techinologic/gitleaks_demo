<html>
	<head>
   <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link rel="stylesheet" type="text/css" href="tutors.css">   
   <title>Search Tutor Session</title>
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
		show_form();  
		show_history();			
	   
 	} 
	
function show_history() { 		
		
		
		// Call Function to retrieve available courses
		$mysessions = getStudentview($_SESSION['wsuser']);
		if (count($mysessions) > 0)
		{
		  echo "<h5>Welcome! You have the following history of tutoring sessions:</h5>";		
		   	
		  // Display table		
		  echo "<h3>Tutor Session History</h3>";		
			echo "<form name='updateit' method='POST' action='UpdateSessions.php'>	";
			// Display first part of the table
			echo "<p></p>";	
			echo "<div>";
			echo "<table id='myresults'>";
			echo "<tr>";			
			echo "<th>Course</th>";
			echo "<th>Date</th>";
			echo "<th>Time</th>";
			echo "<th>Tutoring Location</th>";
			echo "<th>Help Requested</th>";
			echo "<th>Tutor</th>";
			echo "<th>Cancel Session?</th>";
			echo "</tr>";				   	
		  foreach ($mysessions as $m)
	   	{	   			  	
	   			// Extract the data
	   			$id = $m->getID();
	  			$thedate = $m->getThedate(); 
	  			$day = $m->getDay();	 
	  			$tstart = $m->getTstart();	 
	  			$tend = $m->getTend();	 
	  			$f2f = getLocation($m->getF2f());	 	  		
	  			$tname = $m->getTname();	 
	  			$help = $m->getHelp();	 
	  			$course = $m->getCourse();	 
	  			$firstname = $m->getFirstname();
	  			$lastname = $m->getLastname(); 
	  			$email = $m->getEmail();	  								
	  			echo "<tr>";			
					echo "<td>$course</td>";
					echo "<td>$thedate, $day </td>";
					echo "<td>$tstart-$tend</td>";
					echo "<td>$f2f</td>";
					echo "<td><textarea name='helpdesc' rows='1' cols='25' readonly='readonly'>$help</textarea></td>";
					echo "<td>$firstname $lastname ($email)</td>";
					echo "<td><a href='CancelSession.php?sid=$id'>Cancel Session $id?</a></td>";
					echo "</tr>";				   					 																								  
			}				
		 
	// End the table
		  echo "</form>";
			echo "</table>";			
		  echo "</div>";	  	
		  echo "<p></p>";				
		
	  }
	
} // End Show form
		
function show_form() { 		
				
		// Call Function to retrieve available courses
		$courses = getCourses();
		
		echo "<h5>Select the course and the format you prefer for your tutoring session and then click Search.</h5>";		
		echo "<h5> If a course is not listed, tutoring is not currently available for that course.</h5>";
	
			// Display table
			echo "<h3>Search Tutor Sessions </h3>";			
			echo "<form name='searchit' method='POST' action='ShowSessions.php'>	";
			// Display first part of the table
			echo "<p></p>";	
			echo "<div>";
			echo "<table id='myresults'>";
			echo "<tr>";			
			echo "<td>Course:</td>";
			echo "<td> <select name='course' >";
			echo "<option value=''>Select Course</option>";	
			foreach ($courses as $c)
			{																			
				// Display the information in the table													
				echo "<option value='$c'>$c</option>";																						
			}			
			echo "</select></td>";
			echo "</tr>";		
			echo "<tr>";			
			echo "<td>Format:</td>";	 	
     	echo "<td><select name='format' >";		
     	echo "<option value=''>Select Format</option>";	
     	echo "<option value='online'>Online via Wimba</option>";	
     	echo "<option value='f2f'>Face-to-Face at Largo, MD</option>";
     	echo "</select></td>";		
     	echo "</tr>";		
     	echo "<tr>";				
     	echo "<td colspan='2'><input type='submit' value='Search' name='SearchIt'></td>	";
     	echo "</tr>";		
			// End the table
			echo "</form>";
			echo "</table>";			
		  echo "</div>";	  	
		  echo "<p></p>";				
	
} // End Show form


?>
</body>
</html>