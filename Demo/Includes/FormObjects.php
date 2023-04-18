<?php

// Class to construct Students with getters/setter
class StudentClass
{
    // property declaration
    private $firstname="";
    private $lastname="";
    private $email="";
    private $tychoname="";
   
    // Constructor
    public function __construct($firstname,$lastname,$email,$tychoname)
    {
      $this->firstname = $firstname;
      $this->lastname = $lastname;
      $this->email = $email;
      $this->tychoname = $tychoname;      
    }
    
    // Get methods 
	  public function getFirstname ()
    {
    	return $this->firstname;
    } 
	  public function getLastname ()
    {
    	return $this->lastname;
    } 
	  public function getEmail ()
    {
    	return $this->email;
    } 
	  public function getTychoname ()
    {
    	return $this->tychoname;
    } 
	  

    // Set methods 
    public function setFirstname ($value)
    {
    	$this->firstname = $value;    	
    }
    public function setLastname ($value)
    {
    	$this->lastname = $value;    	
    }
    public function setEmail ($value)
    {
    	$this->email = $value;    	
    }
    public function setTychoname ($value)
    {
    	$this->tychoname = $value;    	
    }     
    
} // End Studentclass

// Class to construct Tutor Join view with getters/setter
class TutorJoinClass
{
    // property declaration
    private $sid="";
    private $firstname="";
    private $lastname="";
    private $email="";
    private $tychoname="";
   
    // Constructor
    public function __construct($sid,$tychoname,$firstname,$lastname,$email)
    {
    	$this->sid = $sid;
    	$this->tychoname = $tychoname;
      $this->firstname = $firstname;
      $this->lastname = $lastname;
      $this->email = $email;            
    }
    
    // Get methods 
     public function getSid ()
    {
    	return $this->sid;
    } 
	  public function getFirstname ()
    {
    	return $this->firstname;
    } 
	  public function getLastname ()
    {
    	return $this->lastname;
    } 
	  public function getEmail ()
    {
    	return $this->email;
    } 
	  public function getTychoname ()
    {
    	return $this->tychoname;
    } 
	  
    // Set methods 
     public function setSid ($value)
    {
    	$this->sid = $value;    	
    }
    public function setFirstname ($value)
    {
    	$this->firstname = $value;    	
    }
    public function setLastname ($value)
    {
    	$this->lastname = $value;    	
    }
    public function setEmail ($value)
    {
    	$this->email = $value;    	
    }
    public function setTychoname ($value)
    {
    	$this->tychoname = $value;    	
    }     
    
} // End TutorJoinclass

// Class to construct ScheduleJoin data with getters/setter
class ScheduleJoinClass
{
    // property declaration
    private $scheduleid="";
    private $thedate="";
    private $day="";
    private $timestart="";
    private $timeend="";
    private $groupname="";
    private $f2f="";
    private $sname="";    
     
    // Constructor
    public function __construct($scheduleid, $thedate,$day, $timestart, $timeend,$groupname,$f2f,$sname)
    {
      $this->scheduleid = $scheduleid;
      $this->thedate = $thedate;
      $this->day = $day;
      $this->timestart = $timestart; 
      $this->timeend = $timeend; 
      $this->groupname = $groupname; 
      $this->f2f = $f2f; 
      $this->sname = $sname;      
    }
    
    // Get methods 
	  public function getScheduleid ()
    {
    	return $this->scheduleid;
    } 
	  public function getThedate ()
    {
    	return $this->thedate;
    } 
	  public function getDay ()
    {
    	return $this->day;
    } 
	  public function getTimestart ()
    {
    	return $this->timestart;
    } 
    public function getTimeend ()
    {
    	return $this->timeend;
    } 
    public function getGroupname ()
    {
    	return $this->groupname;
    } 
    public function getF2f ()
    {
    	return $this->f2f;
    } 
    public function getSname ()
    {
    	return $this->sname;
    } 	  

    // Set methods 
    public function setScheduleid ($value)
    {
    	$this->scheduleid = $value;    	
    }
    public function setThedate ($value)
    {
    	$this->thedate = $value;    	
    }
    public function setDay ($value)
    {
    	$this->day = $value;    	
    }
    public function setTimestart ($value)
    {
    	$this->timestart = $value;    	
    }    
    public function setTimeend ($value)
    {
    	$this->timeend = $value;    	
    }  
    public function setGroupname ($value)
    {
    	$this->groupname = $value;    	
    }  
    public function setF2f ($value)
    {
    	$this->f2f = $value;    	
    }   
    public function setSname ($value)
    {
    	$this->sname = $value;    	
    }     
    
} // End ScheduleJoinClass

// Class to construct Students with getters/setter
class TutorClass
{
    // property declaration
    private $firstname="";
    private $lastname="";
    private $email="";
    private $tychoname="";
    private $f2f="";
   
    // Constructor
    public function __construct($firstname,$lastname,$email,$tychoname,$f2f)
    {
      $this->firstname = $firstname;
      $this->lastname = $lastname;
      $this->email = $email;
      $this->tychoname = $tychoname;      
      $this->f2f = $f2f;
    }
    
    // Get methods 
	  public function getFirstname ()
    {
    	return $this->firstname;
    } 
	  public function getLastname ()
    {
    	return $this->lastname;
    } 
	  public function getEmail ()
    {
    	return $this->email;
    } 
	  public function getTychoname ()
    {
    	return $this->tychoname;
    } 
	   public function getF2f ()
    {
    	return $this->f2f;
    } 	  

    // Set methods 
    public function setFirstname ($value)
    {
    	$this->firstname = $value;    	
    }
    public function setLastname ($value)
    {
    	$this->lastname = $value;    	
    }
    public function setEmail ($value)
    {
    	$this->email = $value;    	
    }
    public function setTychoname ($value)
    {
    	$this->tychoname = $value;    	
    }
    public function setF2f ($value)
    {
    	$this->f2f = $value;    	
    }     
    
} // End Tutorclass

// Class to construct Tutor Schedule View with getters/setter
class TutorViewClass
{
    // property declaration    
    private	$id = "";
	  private $thedate = ""; 
	  private $day = "";	 
	  private $tstart = "";	 
	  private $tend = "";	 
	  private $f2f = "";	 
	  private $sname = "";	 
	  private $tname = "";	 
	  private $help = "";	 
	  private $course =  "";	 
	  private $firstname = "";
	  private $lastname = ""; 
	  private $email = "";
   
    // Constructor
    public function __construct($id,$thedate,$day,$tstart,$tend,$f2f,
              $sname,$tname,$help,$course,$firstname,$lastname,$email)
    {
      $this->id = $id;
      $this->thedate = $thedate;
      $this->day = $day;
      $this->tstart = $tstart;      
      $this->tend = $tend;
      $this->f2f = $f2f;
      $this->sname = $sname;
      $this->tname = $tname;
      $this->help = $help;
      $this->course = $course;
      $this->firstname = $firstname;
      $this->lastname = $lastname;
      $this->email = $email;
    }
    
    // Get methods 
	  public function getID ()
    {
    	return $this->id;
    } 
	  public function getThedate ()
    {
    	return $this->thedate;
    } 
	  public function getDay ()
    {
    	return $this->day;
    } 
	  public function getTstart ()
    {
    	return $this->tstart;
    } 
	   public function getTend ()
    {
    	return $this->tend;
    } 	 
     public function getF2f ()
    {
    	return $this->f2f;
    } 	 
     public function getSname ()
    {
    	return $this->sname;
    } 	 
     public function getTname ()
    {
    	return $this->tname;
    } 	 
     public function getHelp ()
    {
    	return $this->help;
    } 	 
     public function getCourse ()
    {
    	return $this->course;
    } 	 
     public function getFirstname ()
    {
    	return $this->firstname;
    } 	 
     public function getLastname ()
    {
    	return $this->lastname;
    } 	 
     public function getEmail ()
    {
    	return $this->email;
    } 	  

    // Set methods 
    public function setID ($value)
    {
    	$this->id = $value;    	
    }
    public function setThedate ($value)
    {
    	$this->thedate = $value;    	
    }
    public function setDay ($value)
    {
    	$this->day = $value;    	
    }
    public function setTstart ($value)
    {
    	$this->tstart = $value;    	
    }
    public function setTend ($value)
    {
    	$this->tend = $value;    	
    }  
    public function setF2f ($value)
    {
    	$this->f2f = $value;    	
    }  
    public function setSname ($value)
    {
    	$this->sname = $value;    	
    }  
    public function setTname ($value)
    {
    	$this->tname = $value;    	
    }  
    public function setHelp ($value)
    {
    	$this->help = $value;    	
    }  
    public function setCourse ($value)
    {
    	$this->course = $value;    	
    }  
    public function setFirstname ($value)
    {
    	$this->firstname = $value;    	
    }  
    public function setLastname ($value)
    {
    	$this->lastname = $value;    	
    }  
    public function setEmail ($value)
    {
    	$this->email = $value;    	
    }     
    
} // End TutorViewclass

// Class to construct Tutor Cancel View with getters/setter
class TutorCancelClass
{
    // property declaration    
    private	$id = "";
	  private $thedate = ""; 
	  private $day = "";	 
	  private $tstart = "";	 
	  private $tend = "";	 
	  private $group = "";	 
	  private $f2f = "";	 
	  private $sname = "";	 
	  private $tname = "";	 
	 
   
    // Constructor
    public function __construct($id,$thedate,$day,$tstart,$tend,$group,$f2f,$sname,$tname)
    {
      $this->id = $id;
      $this->thedate = $thedate;
      $this->day = $day;
      $this->tstart = $tstart;      
      $this->tend = $tend;
      $this->group = $group;
      $this->f2f = $f2f;
      $this->sname = $sname;
      $this->tname = $tname;     
    }
    
    // Get methods 
	  public function getID ()
    {
    	return $this->id;
    } 
	  public function getThedate ()
    {
    	return $this->thedate;
    } 
	  public function getDay ()
    {
    	return $this->day;
    } 
	  public function getTstart ()
    {
    	return $this->tstart;
    } 
	   public function getTend ()
    {
    	return $this->tend;
    } 	 
     public function getGroup ()
    {
    	return $this->group;
    } 	 
     public function getF2f ()
    {
    	return $this->f2f;
    } 	 
     public function getSname ()
    {
    	return $this->sname;
    } 	 
     public function getTname ()
    {
    	return $this->tname;
    } 	 
    
     
    // Set methods 
    public function setID ($value)
    {
    	$this->id = $value;    	
    }
    public function setThedate ($value)
    {
    	$this->thedate = $value;    	
    }
    public function setDay ($value)
    {
    	$this->day = $value;    	
    }
    public function setTstart ($value)
    {
    	$this->tstart = $value;    	
    }
    public function setTend ($value)
    {
    	$this->tend = $value;    	
    }  
     public function setGroup ($value)
    {
    	$this->group = $value;    	
    }  
    public function setF2f ($value)
    {
    	$this->f2f = $value;    	
    }  
    public function setSname ($value)
    {
    	$this->sname = $value;    	
    }  
    public function setTname ($value)
    {
    	$this->tname = $value;    	
    }  
    
    
} // End TutorCancelclass

// Class to construct Student Schedule View with getters/setter
class StudentViewClass
{
    // property declaration    
    private	$id = "";
	  private $thedate = ""; 
	  private $day = "";	 
	  private $tstart = "";	 
	  private $tend = "";	 
	  private $tname = "";	 
	  private $f2f = "";	 	 
	  private $help = "";	 
	  private $course =  "";
	  private $registerdate =  "";	 
	  private $firstname = "";
	  private $lastname = ""; 
	  private $email = ""; 
   
   
    // Constructor
    public function __construct($id,$thedate,$day,$tstart,$tend,$tname,$f2f,
              $help,$course,$registerdate,$firstname,$lastname,$email)
    {
      $this->id = $id;
      $this->thedate = $thedate;
      $this->day = $day;
      $this->tstart = $tstart;      
      $this->tend = $tend;
      $this->tname = $tname;
      $this->f2f = $f2f;      
      $this->help = $help;
      $this->course = $course;
      $this->registerdate = $registerdate;
      $this->firstname = $firstname;
      $this->lastname = $lastname;
      $this->email = $email;
    }
    
    // Get methods 
	  public function getID ()
    {
    	return $this->id;
    } 
	  public function getThedate ()
    {
    	return $this->thedate;
    } 
	  public function getDay ()
    {
    	return $this->day;
    } 
	  public function getTstart ()
    {
    	return $this->tstart;
    } 
	   public function getTend ()
    {
    	return $this->tend;
    } 	 
     public function getF2f ()
    {
    	return $this->f2f;
    } 	     
     public function getTname ()
    {
    	return $this->tname;
    } 	 
     public function getHelp ()
    {
    	return $this->help;
    } 	 
     public function getCourse ()
    {
    	return $this->course;
    } 	 
     public function getRegisterdate ()
    {
    	return $this->registerdate;
    } 	 
     public function getFirstname ()
    {
    	return $this->firstname;
    } 	 
     public function getLastname ()
    {
    	return $this->lastname;
    } 	 
     public function getEmail ()
    {
    	return $this->email;
    } 	  

    // Set methods 
    public function setID ($value)
    {
    	$this->id = $value;    	
    }
    public function setThedate ($value)
    {
    	$this->thedate = $value;    	
    }
    public function setDay ($value)
    {
    	$this->day = $value;    	
    }
    public function setTstart ($value)
    {
    	$this->tstart = $value;    	
    }
    public function setTend ($value)
    {
    	$this->tend = $value;    	
    }  
    public function setF2f ($value)
    {
    	$this->f2f = $value;    	
    }     
    public function setTname ($value)
    {
    	$this->tname = $value;    	
    }  
    public function setHelp ($value)
    {
    	$this->help = $value;    	
    }  
    public function setCourse ($value)
    {
    	$this->course = $value;    	
    }  
     public function setRegisterdate ($value)
    {
    	$this->course = $registerdate;    	
    }  
    public function setFirstname ($value)
    {
    	$this->firstname = $value;    	
    }  
    public function setLastname ($value)
    {
    	$this->lastname = $value;    	
    }  
    public function setEmail ($value)
    {
    	$this->email = $value;    	
    }     
    
} // End StudentViewclass

// Class to construct StudentSchedule Class with getters/setter
class StudentScheduleClass
{
    // property declaration    
    private	$id = "";	
	  private $tycho =  "";	 
	  private $help = "";
	  private $course = ""; 
	  private $register = "";   
 
    // Constructor
    public function __construct($id,$tycho,$help,$course,$register)
    {
      $this->id = $id;
      $this->tycho = $tycho;
      $this->help = $help;
      $this->course = $course;      
      $this->register = $register;      
    }
    
    // Get methods 
	  public function getID ()
    {
    	return $this->id;
    } 
	  public function getTycho ()
    {
    	return $this->tycho;
    } 
	  public function getHelp ()
    {
    	return $this->help;
    } 
	  public function getCourse ()
    {
    	return $this->course;
    } 
	   public function getRegister ()
    {
    	return $this->register;
    } 	     

    // Set methods 
    public function setID ($value)
    {
    	$this->id = $value;    	
    }
    public function setTycho ($value)
    {
    	$this->tycho = $value;    	
    }
    public function setHelp ($value)
    {
    	$this->help = $value;    	
    }
    public function setCourse ($value)
    {
    	$this->course = $value;    	
    }
    public function setRegister ($value)
    {
    	$this->register = $value;    	
    }  
   
    
} // End StudentScheduleclass

// Class to construct StudentJoin Class with getters/setter
class StudentJoinClass
{
    // property declaration    
    private	$id = "";	
	  private $tycho =  "";	 
	  private $help = "";
	  private $course = ""; 
	  private $register = "";   
	  private $email = "";   
 
    // Constructor
    public function __construct($id,$tycho,$help,$course,$register,$email)
    {
      $this->id = $id;
      $this->tycho = $tycho;
      $this->help = $help;
      $this->course = $course;      
      $this->register = $register;  
      $this->email = $email;      
    }
    
    // Get methods 
	  public function getID ()
    {
    	return $this->id;
    } 
	  public function getTycho ()
    {
    	return $this->tycho;
    } 
	  public function getHelp ()
    {
    	return $this->help;
    } 
	  public function getCourse ()
    {
    	return $this->course;
    } 
	   public function getRegister ()
    {
    	return $this->register;
    } 	     
     public function getEmail ()
    {
    	return $this->email;
    } 	     

    // Set methods 
    public function setID ($value)
    {
    	$this->id = $value;    	
    }
    public function setTycho ($value)
    {
    	$this->tycho = $value;    	
    }
    public function setHelp ($value)
    {
    	$this->help = $value;    	
    }
    public function setCourse ($value)
    {
    	$this->course = $value;    	
    }
    public function setRegister ($value)
    {
    	$this->register = $value;    	
    }  
    public function setEmail ($value)
    {
    	$this->email = $value;    	
    }  
   
    
} // End StudentScheduleclass

// Email parameters class
class EmailparmsClass
	{
	    // property declaration
			private $smtphost = ""; 
			private $smtpport = 0; 
			private $smtpauth = false; 
			private $smtpuser = ""; 
			private $smtppass= "";
			private $smtpfrom="";
	   
	    // Constructor
	    public function __construct($mysmtphost,$mysmtpport,$mysmtpauth,$mysmtpuser,
	               $mysmtppass,$mysmtpfrom)
	    {
			  $this->smtphost = $mysmtphost;
			  $this->smtpport = $mysmtpport;
			  $this->smtpauth = $mysmtpauth;
			  $this->smtpuser = $mysmtpuser;
			  $this->smtppass = $mysmtppass;
			  $this->smtpfrom = $mysmtpfrom;
	    }
	    
	    // Get methods
		  public function getsmtphost ()
	    {
	    	return $this->smtphost;
	    } 
		  public function getsmtpport ()
	    {
	    	return $this->smtpport;
	    } 
		  public function getsmtpauth ()
	    {
	    	return $this->smtpauth;
	    } 
		  public function getsmtpuser ()
	    {
	    	return $this->smtpuser;
	    } 
		  public function getsmtppass ()
	    {
	    	return $this->smtppass;
	    } 
		  public function getsmtpfrom ()
	    {
	    	return $this->smtpfrom;
	    } 
	
	    // Set methods
	    public function setsmtphost ($smtphost)
	    {
	    	$this->smtphost = $smtphost;    	
	    }
	    public function setsmtpport ($smtpport)
	    {
	    	$this->smtpport = $smtpport;    	
	    }
	    public function setsmtpauth ($smtpauth)
	    {
	    	$this->smtpauth = $smtpauth;    	
	    }
	    public function setsmtpuser ($smtpuser)
	    {
	    	$this->smtpuser = $smtpuser;    	
	    }
	    public function setsmtppass ($smtppass)
	    {
	    	$this->smtppass = $smtppass;    	
	    }
	    public function setsmtpfrom ($smtpfrom)
	    {
	    	$this->smtpfrom = $smtpfrom;    	
	    }
	    
	} // End Emailparms class

?>