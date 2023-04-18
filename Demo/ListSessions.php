 <html>
	<head>
   <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link rel="stylesheet" type="text/css" href="tutors.css">   
   <title>List All Sessions</title>
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
    
    // Get the current semester and tutor name
    $currentsem = "Spring 2015";
    $theuser = $_SESSION['wsuser'];
    
    // Return and display all of the tutors schedule from today
    $allschedule = getGroupSchedulebyTutor($theuser,$currentsem);	   			  	   			
    $sessioncnt= count($allschedule);
    if ($sessioncnt > 0 )
    {	   			 
		  echo "<p></p>";	
		  echo "<h5>You currently have a total of $sessioncnt tutoring sessions for $currentsem as shown below. </h5>";
		  echo "<h5>To permanently Delete a session click on the Delete button. Deletions should only be for emergency situations. </h5>";
		  echo "<h5>Once a session is deleted, no students can sign up for this session.</h5>";
			echo "<div>";
			echo "<table id='myresults'>";
			echo "<tr>";			
			echo "<th>Session ID</th>";
			echo "<th>Date</th>";
			echo "<th>Day</th>";
			echo "<th>Times</th>";
			echo "<th>Course(s)</th>";
			echo "<th>Location</th>";			
			echo "<th>Semester</th>";			
			echo "<th>Delete?</th>";						
			echo "</tr>";		
			foreach ($allschedule as $s)
		  {	   			  	
		  	// Extract the data
		  	 $sid = $s->getScheduleid();
				 $thedate = $s->getThedate(); 
				 $day = $s->getDay();	 
				 $tstart = $s->getTimestart();	 
				 $tend = $s->getTimeend();	 
				 $group = $s->getGroupname();	 
				 $f2f = $s->getF2f();	 
				 $sname = $s->getSname();	 	  					
				echo "<tr>";			
				echo "<td>$sid</td>";
				echo "<td>$thedate</td>";
				echo "<td>$day</td>";
				echo "<td>$tstart-$tend </td>";
				echo "<td>" . getGroupCourses($group). "</td>";
				echo "<td>" . getLocation($f2f). "</td>";
				echo "<td>$sname</td>";			
				echo "<td><a href='DeleteSession.php?sid=$sid'>Delete Session?</a></td>";												
				echo "</tr>";			   			  	    			  				  	
		  }
    echo "</table>";
  }	   			  
 		   			  
     				
}
?>
</body>
</html>

