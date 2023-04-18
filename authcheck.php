<html>
	<head>
   <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link rel="stylesheet" type="text/css" href="tutors.css">   
   <title>CSTutot Authenticate</title>
</head>

<body> 

<?php
		
	// Needed For SQLFunctions getFaculty call
	require_once('Includes/SQLFunctions.php');
	
	// Needed For Utils check_input call
	require_once('Includes/Utils.php');
	
	
	
	// Retrieve Post Data
	$wsuser = check_input($_POST["wsuser"]);	
	$wsemail = check_input($_POST["wsemail"]);	
	
	// Authenticate User
	$student = getStudent($wsuser,$wsemail);		

        if (strlen($student->getTychoname())==0)
        {
         // Show the login form again.
		 include('index.html');	 
	?>
         <p></p>
	 <p></p>
	 <div><table id="myerror">
	 <tr><td>		 		
	 <h4>Login Error</h4>
	 </td></tr>
	 <tr><td>
	 Sorry, the username and email do not match any current account.
	 </td></tr>
	 <tr><td>	
	 Try again, or create an account using the link above.
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
     				include('SearchSessions.php');	
        }


?>
</body>
</html>
