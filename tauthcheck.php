<html>
	<head>
   <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link rel="stylesheet" type="text/css" href="tutors.css">   
   <title>Tutor Authenticate</title>
</head>

<body> 

<?php
		
	// Needed For SQLFunctions getFaculty call
	require_once('Includes/SQLFunctions.php');
	
	// Needed For Utils check_input call
	require_once('Includes/Utils.php');
	
		
	// Retrieve Post Data
	$wsuser = check_input($_POST["wsuser"]);	
	$wspass = check_input($_POST["wspass"]);	
	
	// Authenticate User
	$count = findTutor($wsuser,$wspass);		

        if ($count==0)
        {
         // Show the login form again.
		 include('tlogin.html');	 
	?>
         <p></p>
	 <p></p>
	 <div><table id="myerror">
	 <tr><td>		 		
	 <h4>Login Error</h4>
	 </td></tr>
	 <tr><td>
	 Sorry, the username and password do not match any current account.
	 </td></tr>
	 <tr><td>	
	 Try again, or contact the Tutor account administrator.
	 </td></tr>
	 </table>
	 </div>

  <?php	 
	}	        
        else 
        {
            // Set the session information
	   				session_start();  
	   				$_SESSION['wsuser'] = $wsuser;	   				
	   				// Run the query for this tutor
	   				// Display the header
	   				// Show the page header
						include('Includes/Header.php');	
	   			  // Retrieve the ScheduleID over the next 2 weeks for this tutor
	   			  $sid = getTutorSchedule($wsuser);
	   			  $count = count($sid);
	   			  if ($count > 0 )
	   			  {	   			 
	   			  echo "<p></p>";	
	   			  echo "<h5>You currently have $count tutoring sessions over the next 2 weeks. </h5>";
	   			  echo "<h5>Be sure to check your site daily as students can register at anytime.</h5>";
	   			  echo "<h5>Also, students must register and be on your schedule to receive tutoring assistance.</h5>";
						echo "<div>";
						echo "<table id='myresults'>";
						echo "<tr>";			
						echo "<th>Course</th>";
						echo "<th>Student Name</th>";
						echo "<th>Email</th>";
						echo "<th>Tutor Session Details</th>";
						echo "<th>Location</th>";
						echo "<th>Help Details</th>";						
						echo "</tr>";		
	   			  
	   			  // Now retrieve the display information
	   			  $tutorview = array();
	   			  foreach ($sid as $s)
	   			  {	   			  	
	   			  	$data = getTutorview($s);	   			  	
	   			  	$tutorview [] = $data;	   			  	
	   			  }	   			    
	   			  // Now display the Tutorview
	   			  foreach ($tutorview as $t)
	   			  {	   			  	
	   			  	// Extract the data
	   			  	 $id = $t->getID();
	  					 $thedate = $t->getThedate(); 
	  					 $day = $t->getDay();	 
	  					 $tstart = $t->getTstart();	 
	  					 $tend = $t->getTend();	 
	  					 $f2f = $t->getF2f();	 
	  					 $sname = $t->getSname();	 
	  					 $tname = $t->getTname();	 
	  					 $help = $t->getHelp();	 
	  					 $course = $t->getCourse();	 
	  					 $firstname = $t->getFirstname();
	  					 $lastname = $t->getLastname(); 
	  					 $email = $t->getEmail();
	  					 echo "<tr>";			
							echo "<td>$course</td>";
							echo "<td>$firstname $lastname</td>";
							echo "<td>$email</td>";
							echo "<td>$thedate,$day,$tstart-$tend </td>";
							echo "<td>" . getLocation($f2f) . "</td>";
							echo "<td>$help</td>";							
							echo "</tr>";			   			  	    			  				  	
	   			  }
	   			  echo "</table>";
	   		  }
	   			else
	   			{
	   				echo "<h5>No students have currently registered for your scheduled tutoring sessions over the next 14 days</h5>";
	   			}	   			  
	   			
	   			echo "<h5>You can click on the link below to view all of your sessions for this semester. You can also delete sessions for emergency situations using this link.</h5>";
	   			echo "<h5><a href=ListSessions.php>Show all of my sessions</a></h5>"; 
        }

?>
</body>
</html>
