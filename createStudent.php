<html>
	<head>
   <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link rel="stylesheet" type="text/css" href="tutors.css">   
   <title>Create Student </title>
</head>
<body OnLoad="document.createstudent.firstname.focus();"> 

<?php   
	
		if(isset($_POST["CreateSubmit"])) 
		{    	 
	 	 		 	 	
	   	validate_form();	   	     
		} 
		else 
		{			    
			$messages = array();
	    show_form($messages);  
  	} 
	
		
function show_form($messages) { 		
		// Show the page header
		include('Includes/Header.php');	
		require_once('Includes/Utils.php');		
		
		if (count($messages) > 0 ) 
	  {  	
	  	echo "<p></p>";
	  	echo "<div><table id='myresults'>";
	  	echo "<tr>";
	    echo "<td>";
	    echo "<h2>Warning! Form Entry Errors Exist.</h2>";
	  	echo "<h4>Please revise based on the following issues and submit again.</h4>";   	
	  	echo "<ol>";  


		  foreach ($messages as $m) 
		  {	  
		  	echo "<li> $m </li>";	  
		  }
		  echo "</ol>";
		  echo "</td>";
	  	echo "</tr>";
		  echo "</table></div>";	  
		  echo "<p></p>";
		}  
		
		// Assign post values if exist
		$firstname="";
		$lastname="";
		$wsname="";
		$email="";
		if (isset($_POST["firstname"]))
		  $firstname=check_input($_POST["firstname"]);
	  if (isset($_POST["lastname"]))
		  $lastname=check_input($_POST["lastname"]);	  
		if (isset($_POST["wsname"]))
		  $wsname=check_input($_POST["wsname"]);  
		if (isset($_POST["email"]))
		  $email=check_input($_POST["email"]);
	
	echo "<p></p>";
	echo "<h2> Request Student Tutor Account</h2>";
	echo "<p></p>";	 	
	?>
	<h5>Complete the information in the form below and click Submit to create your account. All fields are required.</h5>
	<form name="createstudent" method="POST" action="createStudent.php">	
	<table border="1" width="100%" cellpadding="0" id="mylogin">			
			<tr>
				<td width="157">Firstname:</td>
				<td><input type="text" name="firstname" value='<?php echo $firstname ?>' size="30"></td>
			</tr>
			<tr>
				<td width="157">Lastname:</td>
				<td><input type="text" name="lastname" value='<?php echo $lastname ?>' size="30"></td>
			</tr>
			<tr>
				<td width="157">WebTycho username:</td>
				<td><input type="text" name="wsname" value='<?php echo $wsname ?>' size="30"></td>
			</tr>
			<tr>
				<td width="157">Email:</td>
				<td><input type="text" name="email" value='<?php echo $email ?>' size="30"></td>
			</tr>
			<tr>
				<td width="157"><input type="submit" value="Submit" name="CreateSubmit"></td>
				<td>&nbsp;</td>
			</tr>
	</table>			
	</form>
	
	<?php
} // End Show form

function validate_form()
{
	require_once('Includes/Utils.php');	
	require_once('Includes/FormObjects.php');		
	require_once('Includes/SQLFunctions.php');		
	
	$messages = array();
  $redisplay = false;
  // Assign values
  $firstname = check_input($_POST["firstname"]);
  $lastname = check_input($_POST["lastname"]);
  $wsname = check_input($_POST["wsname"]);
  $email = check_input($_POST["email"]);
 
  // Just check for null values and email format
  if (strlen($firstname)==0)
  {
  	  $redisplay = true;
  	  $messages[]="Please enter your Firstname.";
  }  	 	
  if (strlen($lastname)==0)
  {
  	  $redisplay = true;
  	  $messages[]="Please enter your lastname.";
  }  	 	
  if (strlen($wsname)==0)
  {
  	  $redisplay = true;
  	  $messages[]="Please enter your WebTycho username.";
  }  	 	
  if (strlen($email)==0)
  {
  	  $redisplay = true;
  	  $messages[]="Please enter your Email address.";
  }  	 	
  if ($redisplay) 
  {
    	show_form($messages);                 	
  }
  else 
  {
  	
  	// Show the page header
		include('Includes/Header.php');	
  	$student = new StudentClass($firstname,$lastname,$email,$wsname);
  	$count = countStudent($student);    	  
  	// Check for accounts that already exist and Do insert
  	if ($count==0) 
  	{  		
  		$res = insertStudent($student);
  		echo "<h3>Welcome to the CS Tutor program!</h3> ";
                echo "<h3>click here to <a href='index.html' >login</a></h3> ";

  	}
  	else 
  	{
  		echo "<h3>A student account with that WenTycho username already exists.</h3> ";
  		echo "<h3>Please <a href='index.html'> login</a> using $wsname </h3>";
  	}
  	
  }
  
}

 
?>
</body>
</html>