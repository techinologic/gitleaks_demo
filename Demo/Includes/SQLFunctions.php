<?php

  // Include the required DBConnection information
  require_once('Includes/Dbconnect.php');
  
  // Include the Faculty999Class definition
  require_once('Includes/FormObjects.php');
  
  function getStudent($tname,$em)
  {
	
	// Init values to ""
  $firstname="";
	$lastname="";
	$email="";
	$tychoname="";
	// Connect to the database
	$mysqli = connectdb();
		
	// Define the Query
	// For Windows MYSQL String is case insensitive
	 $Myquery = "SELECT firstName, lastName, eMail, tychoName from Students
		   where tychoName='$tname' and eMail='$em'";	 
		
	 if ($result = $mysqli->query($Myquery)) 
		  {
	   /* Fetch the results of the query */	     
	   while( $row = $result->fetch_assoc() )
	   {
	  	$firstname=$row["firstName"];	    
		$lastname = $row["lastName"]; 	 
		$email=$row["eMail"];	    
		$tychoname = $row["tychoName"]; 	    	   	     	  	     	  
	   }
	   $myStudent = new StudentClass($firstname,$lastname,$email,$tychoname);
	
 	   /* Destroy the result set and free the memory used for it */
	   $result->close();	      
          }
	
	$mysqli->close();   
	    
	return $myStudent;
	       
  }
  function countStudent ($student)
  {  	  	 
  	// Connect to the database
   $mysqli = connectdb();
   $firstname = $student->getFirstname();
   $lastname = $student->getLastname();
   $wsname = $student->getTychoname();
   $email = $student->getEmail();
   
		// Connect to the database
	$mysqli = connectdb();
		
	// Define the Query
	// For Windows MYSQL String is case insensitive
	 $Myquery = "SELECT count(*) as count from Students
		   where tychoName='$wsname'";	 
		
	 if ($result = $mysqli->query($Myquery)) 
	 {
	    /* Fetch the results of the query */	     
	    while( $row = $result->fetch_assoc() )
	    {
	  	  $count=$row["count"];	    			   	     	  	     	  
	    }	 
	
 	    /* Destroy the result set and free the memory used for it */
	    $result->close();	      
   }
	
	$mysqli->close();   
	    
	return $count;
  	
  	
  }

 function insertStudent ($student)
  {
		
		// Connect to the database
   $mysqli = connectdb();
		
	 $firstname = $student->getFirstname();
   $lastname = $student->getLastname();
   $wsname = $student->getTychoname();
   $email = $student->getEmail();
		
	// Now we can insert
	$Query = "INSERT INTO Students 
	          (firstName,lastName,eMail,tychoName) 
	           VALUES ('$firstname', '$lastname', '$email', '$wsname')";
	
	$Success=false;           
	if ($result = $mysqli->query($Query)) {	
	  $Success=true;
	}
	$mysqli->close();
		
		return $Success;
	}
	
	 function getSchedules($f2f,$area,$num)
  {
  	
		$mySchedule = array();
	
	  // Need to get the group for this course
	  $groupname = getGroupname($area,$num);
		// Connect to the database
		$mysqli = connectdb();
		
		// Define the Query
		// For Windows MYSQL String is case insensitive
	 	$Myquery = "SELECT scheduleID,thedate,day,timeStart,timeEnd,groupName,f2f,sName 
	             from GroupSchedules where
	             (thedate between CURDATE() and DATE_ADD(CURDATE(), INTERVAL 14 DAY)
	             and f2f='$f2f'
	             and GroupName='$groupname')
	             and scheduleID NOT IN (select scheduleID from StudentSchedules)";	 	             
	   
	 if ($result = $mysqli->query($Myquery)) 
		  {
	   /* Fetch the results of the query */	     
	   while( $row = $result->fetch_assoc() )
	   {
	  	$scheduleid=$row["scheduleID"];	    
			$thedate = $row["thedate"]; 	 
			$day=$row["day"];	    
			$timestart = $row["timeStart"]; 
			$timeend = $row["timeEnd"]; 	    	   	     	  	     	  
			$groupname = $row["groupName"]; 
			$f2f = $row["f2f"]; 
			$sname = $row["sName"]; 
			$mySchedule[] = new ScheduleJoinClass($scheduleid,$thedate,$day,$timestart,$timeend,$groupname,$f2f,$sname);
	   }
	  
	
 	   /* Destroy the result set and free the memory used for it */
	   $result->close();	      
          }
	
	$mysqli->close();   
	    
	return $mySchedule;
	       
  }
  
   function getCourselist($groupname)
  {
		$mycourses = "";
	
		// Connect to the database
		$mysqli = connectdb();
		
		// Define the Query
		// For Windows MYSQL String is case insensitive
		// Changed to CourseGroups2
	 	$Myquery = "SELECT courseDisc,courseNum from CourseGroups where groupname='$groupname'";	 	             
	            
		
	 if ($result = $mysqli->query($Myquery)) 
		  {
	   /* Fetch the results of the query */	     
	   while( $row = $result->fetch_assoc() )
	   {
	  	$coursedisc=$row["courseDisc"];	    
			$coursenum = $row["courseNum"]; 	 			
			$mycourses = $mycourses . $coursedisc . $coursenum . "<br>";
	   }
	  
	
 	   /* Destroy the result set and free the memory used for it */
	   $result->close();	      
     }
	
	$mysqli->close();   
	    
	return $mycourses;
	       
  }
  
  // Returns Array of Courses
   function getCourses()
  {
		$mycourses = array();
	
		// Connect to the database
		$mysqli = connectdb();
		
		// Define the Query
		// For Windows MYSQL String is case insensitive
	 	$Myquery = "SELECT courseDisc,courseNum,courseTitle from Courses";	 	             
	            
		
	 if ($result = $mysqli->query($Myquery)) 
		  {
	   /* Fetch the results of the query */	     
	   while( $row = $result->fetch_assoc() )
	   {
	  	$coursedisc=$row["courseDisc"];	    
			$coursenum = $row["courseNum"]; 	 			
			$coursetitle = $row["courseTitle"]; 
			$mycourses[] = $coursedisc . $coursenum . "-" . $coursetitle;
	   }
	  
	
 	   /* Destroy the result set and free the memory used for it */
	   $result->close();	      
     }
	
	$mysqli->close();   
	    
	return $mycourses;
	       
  }
  
  function getGroupname($area,$num)
  {
	
	$groupname="";
	// Connect to the database
	$mysqli = connectdb();
		
	// Define the Query
	// For Windows MYSQL String is case insensitive
	 $Myquery = "SELECT groupName from CourseGroups
		   where courseDisc='$area' and courseNum='$num'";	 
		
	 if ($result = $mysqli->query($Myquery)) 
		  {
	   /* Fetch the results of the query */	     
	   while( $row = $result->fetch_assoc() )
	   {	  
		  $groupname = $row["groupName"]; 	    	   	     	  	     	  
	   }	  
	
 	   /* Destroy the result set and free the memory used for it */
	   $result->close();	      
          }
	
	$mysqli->close();   
	    
	return $groupname;
	       
  }
  
   function getSchedulebyID($id)
  {
		$mySchedule = "";	
	 
		// Connect to the database
		$mysqli = connectdb();
		
		// Define the Query
		// For Windows MYSQL String is case insensitive
	 	$Myquery = "SELECT scheduleID,thedate,day,timeStart,timeEnd,groupName,f2f,sName 
	             from GroupSchedules where
	             scheduleID = '$id'";	 	             	   
	  
	 if ($result = $mysqli->query($Myquery)) 
		 {
	   /* Fetch the results of the query */	     
	   while( $row = $result->fetch_assoc() )
	   {
	  	$scheduleid=$row["scheduleID"];	    
			$thedate = $row["thedate"]; 	 
			$day=$row["day"];	    
			$timestart = $row["timeStart"]; 
			$timeend = $row["timeEnd"]; 	    	   	     	  	     	  
			$groupname = $row["groupName"]; 
			$f2f = $row["f2f"]; 
			$sname = $row["sName"]; 
			$mySchedule = new ScheduleJoinClass($scheduleid,$thedate,$day,$timestart,$timeend,$groupname,$f2f,$sname);
	   }	  
	
 	   /* Destroy the result set and free the memory used for it */
	   $result->close();	      
     }
	
	$mysqli->close();   
	    
	return $mySchedule;
	       
  }
  
  function getTutorbyID($id)
  {
		$mytutor = "";	
	 
		// Connect to the database
		$mysqli = connectdb();
		
		// Define the Query
		// For Windows MYSQL String is case insensitive
	 	$Myquery = "SELECT firstName,lastName,eMail,tychoName,f2f from Tutors
	              where tychoName = 
	             (select tychoName from TutorSchedules where scheduleID = '$id')";	 	            
	                 	   
	 if ($result = $mysqli->query($Myquery)) 
		 {
	   /* Fetch the results of the query */	     
	   while( $row = $result->fetch_assoc() )
	   {
	  	$firstname=$row["firstName"];	    
			$lastname = $row["lastName"]; 	 
			$email=$row["eMail"];	    
			$tychoname = $row["tychoName"]; 	
			$f2f = $row["f2f"]; 		
			$mytutor = new TutorClass($firstname,$lastname,$email,$tychoname,$f2f);
	   }	  
	
 	   /* Destroy the result set and free the memory used for it */
	   $result->close();	      
     }
	
	$mysqli->close();   
	    
	return $mytutor;
	       
  }
   function getStudentbyID($tname)
  {
	
	// Init values to ""
  $firstname="";
	$lastname="";
	$email="";
	$tychoname="";
	// Connect to the database
	$mysqli = connectdb();
		
	// Define the Query
	// For Windows MYSQL String is case insensitive
	 $Myquery = "SELECT firstName, lastName, eMail, tychoName from Students
		   where tychoName='$tname'";	 
		
	 if ($result = $mysqli->query($Myquery)) 
		  {
	   /* Fetch the results of the query */	     
	   while( $row = $result->fetch_assoc() )
	   {
	  	$firstname=$row["firstName"];	    
		  $lastname = $row["lastName"]; 	 
		  $email=$row["eMail"];	    
		  $tychoname = $row["tychoName"]; 	    	   	     	  	     	  
	   }
	   $myStudent = new StudentClass($firstname,$lastname,$email,$tychoname);
	
 	   /* Destroy the result set and free the memory used for it */
	   $result->close();	      
          }
	
	$mysqli->close();   
	    
	return $myStudent;
	       
  }
  
  // Method to see if the session has already been taken
   function checkReservation($id)
  {
		$mycount = 0;	
	 
		// Connect to the database
		$mysqli = connectdb();
		
		// Define the Query
		// For Windows MYSQL String is case insensitive
	 	$Myquery = "SELECT count(*) thecount
	             from StudentSchedules where
	             scheduleID = '$id'";	 	             	   
	  
	 if ($result = $mysqli->query($Myquery)) 
		 {
	   /* Fetch the results of the query */	     
	   while( $row = $result->fetch_assoc() )
	   {	  	
			$mycount = $row["thecount"]; 			
	   }	  
	
 	   /* Destroy the result set and free the memory used for it */
	   $result->close();	      
     }
	
	$mysqli->close();   
	    
	return $mycount;
		       
  }
  
  // Method to see if the session has already been taken
   function getJoinStudent($id)
  {
		$myjoin = "";	
	 
		// Connect to the database
		$mysqli = connectdb();
		
		// Define the Query
		// For Windows MYSQL String is case insensitive
	 	$Myquery = "select  scheduleID, a.tychoName, helpDescription, courseInfo, RegisterDate , email
               from StudentSchedules a, Students b
               where a.tychoName = b.tychoName
               and scheduleID = $id";	 	             	   
	  
	 if ($result = $mysqli->query($Myquery)) 
		 {
	   /* Fetch the results of the query */	     
	   while( $row = $result->fetch_assoc() )
	   {	  	
			$sid = $row["scheduleID"]; 			
			$tychoname = $row["tychoName"]; 			
			$help = $row["helpDescription"]; 
			$course = $row["courseInfo"]; 
			$rdate = $row["RegisterDate"]; 
			$email = $row["email"]; 	
	   }	  
	   $myjoin = new StudentJoinClass ($sid,$tychoname,$help,$course,$rdate,$email);
	
 	   /* Destroy the result set and free the memory used for it */
	   $result->close();	      
     }
	
	$mysqli->close();   
	    
	return $myjoin;
		       
  }
  
  function reserveSession ($id,$tname,$course,$help,$today)
  {
		
		// Check that $help is less than 255 characters.
		$helplen = strlen($help);
		if ($helplen >255)
		{
			$help=substr($help,0,254);
		}
		
		// Connect to the database
   $mysqli = connectdb();	
		
	// Remove potential user entered quotes and such so we can save in the database	
	$help = $mysqli->real_escape_string($help);	
	// Now we can insert
	$Query = "INSERT INTO StudentSchedules 
	           VALUES ('$id', '$tname', '$help', '$course','$today')";
	
	$Success=false;           
	if ($result = $mysqli->query($Query)) {	
	  $Success=true;
	}
	$mysqli->close();
		
		return $Success;
	}
	
	function findTutor($tname,$pass)
  {
	
	// Init count to 0
  $count=0;
	// Connect to the database
	$mysqli = connectdb();
		
	// Define the Query
	// For Windows MYSQL String is case insensitive
	 $Myquery = "SELECT count(*) cnt from TutorDetails
		   where tychoName='$tname' and password='$pass'";	 
		
	 if ($result = $mysqli->query($Myquery)) 
		{
	   /* Fetch the results of the query */	     
	   while( $row = $result->fetch_assoc() )
	   {
	  	$count=$row["cnt"];	
	   }
 	   /* Destroy the result set and free the memory used for it */
	   $result->close();	      
    }
	
	$mysqli->close();   
	    
	return $count;
	       
  }
  
   
   // Retrieves tutors schedule between today and the next 14 days
   function getTutorSchedule($tychoname)
  {
		$mySchedule = array();	
	 
		// Connect to the database
		$mysqli = connectdb();
		
		// Define the Query
		// For Windows MYSQL String is case insensitive
	 	$Myquery = "Select scheduleID from GroupSchedules  
	             where scheduleID IN (select scheduleID from StudentSchedules)
	             and scheduleID IN (select scheduleID from TutorSchedules where tychoName = '$tychoname')
	             and thedate between CURDATE() and DATE_ADD(CURDATE(), INTERVAL 14 DAY)";		            
	               
	 if ($result = $mysqli->query($Myquery)) 
		 {
	   /* Fetch the results of the query */	     
	   while( $row = $result->fetch_assoc() )
	   {
	  	$mySchedule[]=$row["scheduleID"];	    			
	   }	  
	
 	   /* Destroy the result set and free the memory used for it */
	   $result->close();	      
     }
	
	$mysqli->close();   
	    
	return $mySchedule;
	       
  }
  
   // Retrieves tutors schedule for a specific id
   function getTutorSchedulebyID($id)
  {
		$mySchedule = array();	
	 
		// Connect to the database
		$mysqli = connectdb();
		
		// Define the Query
		// For Windows MYSQL String is case insensitive
	 	$Myquery = "Select a.scheduleID, thedate, day, timeStart, timeEnd, 
              groupName, f2f, sName,tychoName from TutorSchedules a, GroupSchedules b
	             where a.scheduleID = $id 
	             and a.scheduleID=b.scheduleID";		            
	               
	 if ($result = $mysqli->query($Myquery)) 
		 {
	   /* Fetch the results of the query */	     
	   while( $row = $result->fetch_assoc() )
	   {
	  	$id = $row["scheduleID"];	 
	   	$thedate = $row["thedate"];	 
	   	$day = $row["day"];	 
	   	$tstart = $row["timeStart"];	 
	   	$tend = $row["timeEnd"];	
	   	$group = $row["groupName"];	 
	   	$f2f = $row["f2f"];	 
	   	$sname = $row["sName"];	 
	   	$tname = $row["tychoName"];	 	   		   
	   	$mySchedule = new TutorCancelClass($id,$thedate,$day,$tstart,$tend,$group,$f2f,$sname,$tname);	   	                                     	   	
                                          
	   }	  
	
		
 	   /* Destroy the result set and free the memory used for it */
	   $result->close();	      
     }
	
	$mysqli->close();   	
	    
	return $mySchedule;
	       
  }
  
   // Retrieves tutors schedule for a specific ID
   function getTutorview($id)
  {
		$mySchedule = "";	
	 
		// Connect to the database
		$mysqli = connectdb();
		
		// Define the Query
		// For Windows MYSQL String is case insensitive
	 	$Myquery = "Select a.scheduleID, thedate,day, timeStart,timeEnd,f2f,sName, b.tychoName, 
	               helpDescription, courseInfo, RegisterDate, firstName, lastName, eMail
	               from GroupSchedules a, StudentSchedules b, Students c
	               where a.scheduleID = b.scheduleID
	               and b.tychoName = c.tychoName
	               and a.scheduleID = '$id'
	               order by thedate,timeStart";	 	             	               	                                                        
	  
	             
	               
	 if ($result = $mysqli->query($Myquery)) 
		 {
	   /* Fetch the results of the query */	     
	   while( $row = $result->fetch_assoc() )
	   {
	   	$id = $row["scheduleID"];	 
	   	$thedate = $row["thedate"];	 
	   	$day = $row["day"];	 
	   	$tstart = $row["timeStart"];	 
	   	$tend = $row["timeEnd"];	 
	   	$f2f = $row["f2f"];	 
	   	$sname = $row["sName"];	 
	   	$tname = $row["tychoName"];	 
	   	$help = $row["helpDescription"];	 
	   	$course =  $row["courseInfo"];	 
	   	$firstname = $row["firstName"];	
	   	$lastname = $row["lastName"];	 
	   	$email = $row["eMail"];	
	   	// Make this an Object
	   	$mySchedule = new TutorViewClass($id,$thedate,$day,$tstart,$tend,$f2f,
              $sname,$tname,$help,$course,$firstname,$lastname,$email);	  			
	   }	  
	
 	   /* Destroy the result set and free the memory used for it */
	   $result->close();	      
     }
	
	$mysqli->close();   
	    
	return $mySchedule;
	       
  }
   
    // Retrieves tutors schedule between today and the next 14 days
   function getStudentview($tycho)
  {
		$mySchedule = array();	
	 
		// Connect to the database
		$mysqli = connectdb();
		
		// Define the Query
		// For Windows MYSQL String is case insensitive	 
	  $Myquery = "select a.scheduleID,thedate,day,timeStart,timeEnd,a.tychoName,b.f2f,
	              helpDescription,courseInfo,RegisterDate,d.firstName,d.lastName,d.eMail
                from StudentSchedules a, GroupSchedules b, TutorSchedules c, Tutors d 
                where a.tychoName  = '$tycho'
                and a.scheduleID = b.scheduleID
                and a.scheduleID = c.scheduleID
                and c.tychoName = d.tychoName
                order by thedate,timeStart";
	             
	               
	 if ($result = $mysqli->query($Myquery)) 
		 {
	   /* Fetch the results of the query */	     
	   while( $row = $result->fetch_assoc() )
	   {
	   	$id = $row["scheduleID"];	 
	   	$thedate = $row["thedate"];	 
	   	$day = $row["day"];	 
	   	$tstart = $row["timeStart"];	 
	   	$tend = $row["timeEnd"];	 
	   	$tname = $row["tychoName"];	 
	   	$f2f = $row["f2f"];		   
	   	$help = $row["helpDescription"];	 
	   	$course =  $row["courseInfo"];	 
	   	$registerdate = $row["RegisterDate"];	 
	   	$firstname = $row["firstName"];	
	   	$lastname = $row["lastName"];	 
	   	$email = $row["eMail"];		   	
	   	// Make this an Object
	   	$mySchedule[] = new StudentViewClass($id,$thedate,$day,$tstart,$tend,$tname,$f2f,
              $help,$course,$registerdate,$firstname,$lastname,$email);	  			
	   }	  
	
 	   /* Destroy the result set and free the memory used for it */
	   $result->close();	      
     }
	
	$mysqli->close();   
	    
	return $mySchedule;	       
  }
  
   function getStudentSchedule($id)
  {
		$mySchedule = "";	
	 
		// Connect to the database
		$mysqli = connectdb();
		
		// Define the Query
		// For Windows MYSQL String is case insensitive	 
	  $Myquery = "select a.scheduleID,thedate,day,timeStart,timeEnd,a.tychoName,b.f2f,
	              helpDescription,courseInfo,RegisterDate,d.firstName,d.lastName,d.eMail
                from StudentSchedules a, GroupSchedules b, TutorSchedules c, Tutors d 
                where a.scheduleID = b.scheduleID
                and a.scheduleID = c.scheduleID
                and c.tychoName = d.tychoName
                and a.scheduleID=$id
                order by thedate,timeStart";
	             
	               
	 if ($result = $mysqli->query($Myquery)) 
		 {
	   /* Fetch the results of the query */	     
	   while( $row = $result->fetch_assoc() )
	   {
	   	$id = $row["scheduleID"];	 
	   	$thedate = $row["thedate"];	 
	   	$day = $row["day"];	 
	   	$tstart = $row["timeStart"];	 
	   	$tend = $row["timeEnd"];	 
	   	$tname = $row["tychoName"];	 
	   	$f2f = $row["f2f"];		   
	   	$help = $row["helpDescription"];	 
	   	$course =  $row["courseInfo"];	 
	   	$registerdate = $row["RegisterDate"];	 
	   	$firstname = $row["firstName"];	
	   	$lastname = $row["lastName"];	 
	   	$email = $row["eMail"];		   	
	   	// Make this an Object
	   	$mySchedule = new StudentViewClass($id,$thedate,$day,$tstart,$tend,$tname,$f2f,
              $help,$course,$registerdate,$firstname,$lastname,$email);	  			
	   }	  
	
 	   /* Destroy the result set and free the memory used for it */
	   $result->close();	      
     }
	
	$mysqli->close();   
	    
	return $mySchedule;	       
  }
  
     // Cancels an existing session
   function cancelSession($id)
  {
		$rowdeleted=0;	 
		// Connect to the database
		$mysqli = connectdb();
		
		// Define the Query
		// For Windows MYSQL String is case insensitive	 
	  $Myquery = "delete from StudentSchedules 
	              where scheduleID = $id";	             
	               
	  $mysqli->query($Myquery);
	  
	  $rowsdeleted=$mysqli->affected_rows;
	
	  $mysqli->close();   
	        
	  return $rowsdeleted;
  }
  
     // deletes an existing session
   function deleteSession($id)
  {
		$rowdeleted=0;	 
		
		// Connect to the database
		$mysqli = connectdb();
		
		// Define the first Query		
	  $Myquery = "delete from TutorSchedules 
	              where scheduleID = $id";	             
	               
	  $mysqli->query($Myquery);
	  
	  $rowsdeleted=$mysqli->affected_rows;
	  
	  // Need to delete from Student schedules if it has been assigned and send a cancelation email
	  
	  
	  // Define the second query
	  $Myquery = "delete from GroupSchedules 
	              where scheduleID = $id";	             
	               
	  $mysqli->query($Myquery);
	  
	  $rowsdeleted=$mysqli->affected_rows;
	
	  $mysqli->close();   
	        
	  return $rowsdeleted;
  }
   
  function getGroupSchedule($id)
  {
		$mySchedule = "";	
	 
		// Connect to the database
		$mysqli = connectdb();
		
		// Define the Query
		// For Windows MYSQL String is case insensitive	 
	  $Myquery = "select scheduleID,thedate,day,timeStart,timeEnd,groupName,f2f,sName
	              from GroupSchedules
                where scheduleID=$id";              
	             
	               
	 if ($result = $mysqli->query($Myquery)) 
		 {
	   /* Fetch the results of the query */	     
	   while( $row = $result->fetch_assoc() )
	   {
	   	$id = $row["scheduleID"];	 
	   	$thedate = $row["thedate"];	 
	   	$day = $row["day"];	 
	   	$tstart = $row["timeStart"];	 
	   	$tend = $row["timeEnd"];	 	   
	   	$groupname = $row["groupName"];	 	   
	   	$f2f = $row["f2f"];		   
	   	$sname = $row["sName"];	
	   		      	
	   	// Make this an Object
	   	$mySchedule = new ScheduleJoinClass($id,$thedate,$day,$tstart,$tend,$groupname,$f2f,
              $sname);	  			
	   }	  
	
 	   /* Destroy the result set and free the memory used for it */
	   $result->close();	      
     }
	
	$mysqli->close();   
	    
	return $mySchedule;	       
  }
  
   function getGroupSchedulebyTutor($tutor,$semester)
  {
		$mySchedule = array();	
	 
		// Connect to the database
		$mysqli = connectdb();
		
		// Define the Query
		// For Windows MYSQL String is case insensitive	 
	  $Myquery = "Select scheduleID,thedate,day,timeStart,timeEnd,groupName,f2f,sName from GroupSchedules  
	             where scheduleID IN (select scheduleID from TutorSchedules where tychoName = '$tutor')
	             and sName = '$semester'";	                
	             
	               
	 if ($result = $mysqli->query($Myquery)) 
		 {
	   /* Fetch the results of the query */	     
	   while( $row = $result->fetch_assoc() )
	   {
	   	$id = $row["scheduleID"];	 
	   	$thedate = $row["thedate"];	 
	   	$day = $row["day"];	 
	   	$tstart = $row["timeStart"];	 
	   	$tend = $row["timeEnd"];	 	   
	   	$groupname = $row["groupName"];	 	   
	   	$f2f = $row["f2f"];		   
	   	$sname = $row["sName"];	
	   		      	
	   	// Make this an Object
	   	$mySchedule[] = new ScheduleJoinClass($id,$thedate,$day,$tstart,$tend,$groupname,$f2f,$sname);	  			
	   }	  
	
 	   /* Destroy the result set and free the memory used for it */
	   $result->close();	      
     }
	
	$mysqli->close();   
	    
	return $mySchedule;	       
  }
  
  function getTutor($id)
  {
		$mytutor = "";	
	 
		// Connect to the database
		$mysqli = connectdb();
		
		// Define the Query
		// For Windows MYSQL String is case insensitive	 
	  $Myquery = "select scheduleID, a.tychoName, firstName, lastName, eMail 
               from TutorSchedules a, Tutors b
               where a.tychoName = b.tychoName
               and a.scheduleID = $id;";              	             
	               
	 if ($result = $mysqli->query($Myquery)) 
		 {
	   /* Fetch the results of the query */	     
	   while( $row = $result->fetch_assoc() )
	   {
	   	$id = $row["scheduleID"];	 
	   	$tycho = $row["tychoName"];	 
	   	$firstname = $row["firstName"];	 
	   	$lastname = $row["lastName"];	 
	   	$email = $row["eMail"];	 	   	   	
	   		      	
	   	// Make this an Object
	   	$mytutor = new TutorJoinClass($id,$tycho,$firstname,$lastname,$email);	  			
	   }	  
	
 	   /* Destroy the result set and free the memory used for it */
	   $result->close();	      
     }
	
	$mysqli->close();   
	    
	return $mytutor;	       
  }
     
?>