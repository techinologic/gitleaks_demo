<html>
	<head>
   <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link rel="stylesheet" type="text/css" href="tutors.css">   
   <title>Request Tutor Session</title>
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
	
		if(isset($_POST["SubmitSession"])) 
		{    	 
	 	 		 	 	
	   	validate_form();	   	     
		} 
		else 
		{			    			
	    show_form();  
  	} 
	
}
		
function show_form() { 		
	
	
	
		// Show the page header
		include('Includes/Header.php');	
		require_once('Includes/Utils.php');		
		require_once('Includes/SQLFunctions.php');	
		
			
		// Assign values from search form
  $course = check_input($_POST["course"]);
  
  $format = check_input($_POST["format"]);
 
 if (strlen($course)>0 && strlen($format)>0 )
 {
  
  
  // Break out Subject and Course
  $areaname=substr($course,0,4);
  $coursenum=substr($course,4,3);
  $coursedata=$areaname.$coursenum;
  $schedflag='N';
  if ($format=='f2f')
      $schedflag='Y';     
  
		
	
		
		
		// Call Function to retrieve available tutor slots over next two weeks
		$theSchedule = getSchedules($schedflag,$areaname,$coursenum);
		$sessioncnt = count($theSchedule);
		
	  if ($sessioncnt > 0)
	  {
		echo "<h5>Select an available tutoring session from the dates and times listed below by clicking the radio button in the corresponding row. </h5>";
		echo "<h5>Then enter the topics/assignment you would like tutoring assistance and click Submit.</h5>		
		<h5>Sessions available over the next 2 weeks are displayed.</h5> 
		<h5>Note: All students must register for a specific tutoring session to be eligible for tutoring.</h5>";
		//if ($sessioncnt > 0)
		//{			
			// Display table
			echo "<h3>Tutoring Sessions Matching your Search Criteria ($sessioncnt) </h3>";			
			echo "<form name='requestit' method='POST' action='ShowSessions.php'>	";
			// Display first part of the table
			echo "<p></p>";	
			echo "<div>";
			echo "<table id='myresults'>";
			echo "<tr>";			
			echo "<th>Course(s)</th>";
			echo "<th>Select Day and Time</th>";
			echo "</tr>";		
			 	
			// Display the report
			foreach ($theSchedule as $sched)
			{
				// Extract the data			
				$myid=$sched->getScheduleid();	
				$mydate=$sched->getThedate();
				$myday=$sched->getDay();
				$mystart=$sched->getTimestart();	
				$myend=$sched->getTimeend();
				$mycoursegroup=$sched->getGroupname();
				// Call the function to retrieve Course list
				$coursenames = getCourselist($mycoursegroup);		
				// Display the information in the table										
				echo "<tr>";			
				echo "<td>$coursenames</td>";	
				echo "<td><input type='radio' name='scheduleid' value='$myid'>$mydate,$myday $mystart-$myend</td>";	
				echo "</tr>";																			
			}
			echo "<tr>";						
			echo "<td>Describe the topic<br> assignment or other activity<br> you would like help with.</td>";	
			echo "<td><textarea name='helpdesc' rows='4' cols='30'></textarea></td>";	
			echo "<input type='hidden' name='courseinfo' value='$coursedata' />";
			echo "</tr>";		
			// End the table
			echo "<tr>";						
			echo "<td colspan='2'><input type='submit' value='Submit' name='SubmitSession'></td>";	
			echo "</tr>";																						
			echo "</table>";
		  echo "</div>";	  	
		  echo "<p></p>";		
	  }
	  else
	  {
	  	echo "<h3> Sorry. No $format tutor sessions are available for $course, over the next 2 weeks.</h3>";
	  	echo "<h3>Return to <a href=SearchSessions.php>search</a></h3>";
	  }		  
	 
	}
	else {
		echo "<h3> No Course or Format search criteria were selected. Return to <a href=SearchSessions.php>search</a></h3>";
		 
		
		
	}
		
	
} // End Show form

function validate_form()
{
	require_once('Includes/Utils.php');	
	require_once('Includes/FormObjects.php');		
	require_once('Includes/SQLFunctions.php');			
	
	 	// Set the Date stamp
    date_default_timezone_set('America/New_York');
    $today = date("F j, Y, g:i a");   
    
	// Show the page header
	include('Includes/Header.php');	
	
  // Assign values
  $scheduleid = check_input($_POST["scheduleid"]);  
  $coursesave = check_input($_POST["courseinfo"]); 
  $helpdesc = check_input($_POST["helpdesc"]); 
 
  // Just check for null values and email format
  if (strlen($scheduleid)==0)
  { 
  	 echo "<h3> No tutor session was selected. Return to <a href=SearchSessions.php>search</a> to start over.</h3>";
  }  	 	  
  else 
  { 	
		
		// Retrieve the Session Information		
		
		$myname = $_SESSION['wsuser'];			
		if (strlen($myname) > 0)
		{			
			  // Make sure the time/date is still available
			  $isReserved = checkReservation($scheduleid);
			  
			  // If available make the reservation and send the success message
			  if ($isReserved==0) 
			  {
					 	// Insert the reservation
					 	$success = reserveSession($scheduleid,$myname,$coursesave,$helpdesc,$today);
					 	$STDOUT = fopen('logs/logdata.txt', 'a');
						fwrite($STDOUT,"S3: Reservation success from $scheduleid, $myname, $coursesave on $today was $success\n");  	
						fclose($STDOUT);
					 	// Display the results
					 // Retrieve the session information and ask for them to print for their records.
						  $theschedule = getSchedulebyID($scheduleid);
						  
						  // Retrieve the tutor information
						  $thetutor = getTutorbyID($scheduleid);			  
						  
						   // Retrieve the Student information
						  $thestudent = getStudentbyID($myname);
						  
						  // Logic for determining the session code and URLs (Probably should be in database also
						  // Get the Day and GroupName
              $cday=$theschedule->getDay();
              $cgroup=$theschedule->getGroupName();
              $ctime=$theschedule->getTimestart();
           
              // Sunday CMIS102 9AM - 1PM 
						  if ($cday=="Sunday" && $cgroup=="A" && $ctime >=900 && $ctime <=1300)
              {
               $sessionURL = "https://umuc.webex.com/umuc/j.php?ED=178300712&UID=490978387&RT=MiMxMQ%3D%3D";
               $phoneIN = "1-650-479-3208";
               $accessCode = "642 744 012";
             }
             // Sunday CMIS141/242/440 9AM - 1PM 
						  if ($cday=="Sunday" && $cgroup=="B" && $ctime >=900 && $ctime <=1300)
              {
               $sessionURL = "https://umuc.webex.com/umuc/j.php?ED=178301827&UID=490978387&RT=MiMxMQ%3D%3D";
               $phoneIN = "1-650-479-3208";
               $accessCode = "644 263 125";
             }
              // Sunday CMSC150 9AM-1PM,
						  if ($cday=="Sunday" && $cgroup=="F" && $ctime >=900 && $ctime <=1300)
              {
               $sessionURL = "https://umuc.webex.com/umuc/j.php?ED=178302967&UID=490978387&RT=MiMxMQ%3D%3D";
               $phoneIN = "1-650-479-3208";
               $accessCode = "641 029 245";
             }
             // Sunday CMIS125 6PM-10PM,
						  if ($cday=="Sunday" && $cgroup=="C" && $ctime >=1800 && $ctime <=2200)
              {
               $sessionURL = "https://umuc.webex.com/umuc/j.php?ED=178302307&UID=490978387&RT=MiMxMQ%3D%3D";
               $phoneIN = "1-650-479-3208";
               $accessCode = "643 980 788";
             }
              // Sunday IFSM201 6PM-10PM
						  if ($cday=="Sunday" && $cgroup=="G" && $ctime >=1800 && $ctime <=2200)
              {
               $sessionURL = "https://umuc.webex.com/umuc/j.php?ED=178303427&UID=490978387&RT=MiMxMQ%3D%3D";
               $phoneIN = "1-650-479-3208";
               $accessCode = "647 926 468";
             }
             // Tuesday CMIS102 6PM-10PM
						  if ($cday=="Tuesday" && $cgroup=="A" && $ctime >=1800 && $ctime <=2200)
              {
               $sessionURL = "https://umuc.webex.com/umuc/j.php?ED=178301242&UID=490978387&RT=MiMxMQ%3D%3D";
               $phoneIN = "1-650-479-3208";
               $accessCode = "642 460 009";
             }
             // Tuesday CMIS170/320 6PM-10PM
						  if ($cday=="Tuesday" && $cgroup=="E" && $ctime >=1800 && $ctime <=2200)
              {
               $sessionURL = "https://umuc.webex.com/umuc/j.php?ED=178302837&UID=490978387&RT=MiMxMQ%3D%3D";
               $phoneIN = "1-650-479-3208";
               $accessCode = "645 833 731";
             }
              // Wednesday CMIS310/325 6PM-10PM
						  if ($cday=="Wednesday" && $cgroup=="D" && $ctime >=1800 && $ctime <=2200)
              {
               $sessionURL = "https://umuc.webex.com/umuc/j.php?ED=178302507&UID=490978387&RT=MiMxMQ%3D%3D";
               $phoneIN = "1-650-479-3208";
               $accessCode = "649 884 192";
             }
              // Saturday CMIS102 9AM-1PM
						  if ($cday=="Saturday" && $cgroup=="A" && $ctime >=900 && $ctime <=1300)
              {
               $sessionURL = "https://umuc.webex.com/umuc/j.php?ED=178301407&UID=490978387&RT=MiMxMQ%3D%3D";
               $phoneIN = "1-650-479-3208";
               $accessCode = "646 527 893";
             }
              // Saturday IFSM201 9AM-1PM
						  if ($cday=="Saturday" && $cgroup=="G" && $ctime >=900 && $ctime <=1300)
              {
               $sessionURL = "https://umuc.webex.com/umuc/j.php?ED=231765307&UID=0&RT=MiMxMQ%3D%3D";
               $phoneIN = "1-650-479-3208";
               $accessCode = "649 797 162";
             }
                
						  
						  // Due some conversions
						  $theformat = 'Online via Wimba';
						  if ($theschedule->getF2f()=='Y')
						    $theformat = 'Face-to-Face at Largo, MD';
						    
						  $emailstring =  "Congratulations $myname you have successfully signed up for the following tutoring session!" ."<br/>";
						  $emailstring .= "\nStudent name:" .$thestudent->getFirstname(). " " .$thestudent->getLastname() . "<br/>";
						  $emailstring .=  "Student email:" .$thestudent->getEmail() . "<br/>";
						  $emailstring .= "Session Date:" .$theschedule->getThedate() . "<br/>";
							$emailstring .= "Day:" .$theschedule->getDay() . "<br/>";
							$emailstring .= "Start time:" .$theschedule->getTimestart()."<br/>";
							$emailstring .= "Stop time:" .$theschedule->getTimeend()."<br/>";
							$emailstring .= "Format: $theformat<br/>";
						  $emailstring .= "Semester:" .$theschedule->getSname()."<br/>";
							$emailstring .="Tutor name:".$thetutor->getFirstname(). " " .$thetutor->getLastname()."<br/>";
							$emailstring .= "Tutor email:" .$thetutor->getEmail()."<br/>";
							if ($theschedule->getF2f()=='N'){
							   $emailstring .= "WebEx URL: $sessionURL" ."<br/>";
							   $emailstring .= "WebEx Phone Dial In Number:  $phoneIN" ."<br/>";
							   $emailstring .= "WebEx Access Code:  $accessCode" ."<br/>";
							   $emailstring .= "Date Reservation submitted:$today" ."<br/><br/>";
						 }
							$emailstring .=	"Note the following details about tutoring sessions:<br/> ";
              $emailstring .= "F2F tutoring sessions occur in the student lounge area at the Largo Center (1616 McCormick Drive Largo MD 20774)<br/>";              
  						$emailstring .= "Online tutoring sessions occur through WebEx. <br/>";						            
						
							
							// Also put the contact/information
							
							echo "<h5>Congratulations $myname you have successfully signed up for the following tutoring session!</h5> ";		
							// Display first part of the table
							echo "<p></p>";	
							echo "<div>";
							echo "<table id='myresults'>";
							echo "<tr>";			
							echo "<th>Field</th>";
							echo "<th>Value</th>";
							echo "</tr>";	
							echo "<tr>";			
							echo "<td>Course:</td>";
							echo "<td>$coursesave</td>";
							echo "</tr>";		
							echo "<tr>";			
							echo "<td>Help requested:</td>";
							echo "<td>$helpdesc</td>";
							echo "</tr>";		
							echo "<tr>";			
							echo "<td>Student name:</td>";
							echo "<td>".$thestudent->getFirstname(). " " .$thestudent->getLastname(). "</td>";
							echo "</tr>";		
							echo "<tr>";			
							echo "<tr>";			
							echo "<td>Student email:</td>";
							echo "<td>".$thestudent->getEmail(). "</td>";
							echo "</tr>";				
							echo "<td>Session Date:</td>";
							echo "<td>".$theschedule->getThedate()."</td>";
							echo "</tr>";			
							echo "<tr>";			
							echo "<td>Day:</td>";
							echo "<td>".$theschedule->getDay()."</td>";
							echo "</tr>";		
							echo "<tr>";			
							echo "<td>Start time:</td>";
							echo "<td>".$theschedule->getTimestart()."</td>";
							echo "</tr>";				
							echo "<tr>";			
							echo "<td>Stop time:</td>";
							echo "<td>".$theschedule->getTimeend()."</td>";
							echo "</tr>";				
							echo "<tr>";			
							echo "<td>Format:</td>";
							echo "<td>$theformat</td>";
							echo "</tr>";			
							echo "<tr>";			
							echo "<td>Semester:</td>";
							echo "<td>".$theschedule->getSname()."</td>";
							echo "</tr>";	
							echo "<tr>";			
							echo "<td>Tutor name:</td>";
							echo "<td>".$thetutor->getFirstname(). " " .$thetutor->getLastname(). "</td>";
							echo "</tr>";				
							echo "<tr>";			
							echo "<td>Tutor email:</td>";
							echo "<td>".$thetutor->getEmail(). "</td>";
							echo "</tr>";	
							echo "<tr>";			
							if ($theschedule->getF2f()=='N'){
								echo "<td>WebEx URL:</td>";
								echo "<td><a href='".$sessionURL. "' target='_blank'>$sessionURL</a></td>";
								echo "</tr>";	
								echo "<tr>";			
								echo "<td>WebEx Phone Number:</td>";
								echo "<td>". $phoneIN. "</td>";
								echo "</tr>";	
								echo "<tr>";			
								echo "<td>WebEx Session Access Code:</td>";
								echo "<td>". $accessCode. "</td>";
								echo "</tr>";	
						  }								
							echo "<tr>";			
							echo "<td>Date Reservation submitted:</td>";
							echo "<td>$today</td>";
							echo "</tr>";				
							echo "</table>";
					  	echo "</div>";	  	
					  	echo "<p></p>";				
					  	echo "<h5> Please print for your records. An email is also being sent to your email address of " .$thestudent->getEmail() . "</h5>";				
					  	echo "<h5>Note the following details about tutoring sessions: ";
              echo "<ol><li>F2F tutoring sessions occur in the student lounge area at the Largo Center (1616 McCormick Drive Largo MD 20774)</li>";               
  						echo "<li>Online tutoring sessions occur through WebEx 	</li>";  						
							echo "</ol> </h5>";
							
						
							// Send the email to tutor and student
							// Send email to Tutor
							$subject = "Tutor Session Confirmation";
							$temail = $thetutor->getEmail();
							$semail=$thestudent->getEmail();
							// Removed email	
							// Log email being sent
							$STDOUT = fopen('logs/logdata.txt', 'a');
						  fwrite($STDOUT,"S4: Reservation Email sent to $semail, $temail on $today was $ret\n");  	
						  fclose($STDOUT);
					  	
				}
				else 
				{
					// Log Error being sent
							$STDOUT = fopen('logs/logdata.txt', 'a');
						  fwrite($STDOUT,"S5: Session, $scheduleID was not saved by $myname on $today\n");  	
						  fclose($STDOUT);
					echo "<h3>Oops! There was an error in saving your request. </h3>";
					echo "<h3>Most likely your session has timed out, or someone else has reserved the time you wanted. Please try again.</h3> ";		
					echo "<a href='SearchSessions.php'>Add another Tutoring Session</a>";		
				}			
				
				echo "<p></p>";
				echo "<a href='SearchSessions.php'>Add another Tutoring Session</a>";		  				  	
		}
			  
			  
			 
  	
  }
  
}

 
?>
</body>
</html>