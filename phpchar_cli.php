#!C:\php\phpchar.php -q
<?php
/*Assuming the script is stored at"C:\php\"  and the Jenkins' API used is xml with the name "jobs.xml" stored at the same location.
with elements named jobs with nodes <name>,<status>, having values of the job name, job status respectively.
And an sqlite database with the table name "jobtable" having columns (name,status and time)
*/
   
   //store the xml object in a variable $xmlob
  $xmlob=simplexml_load_file("jobs.xml") or die("Error unable to create xml object");
  
  //connect to the database users.db and prepare insert queries for table jobtable
  try{$dbc= new PDO('sqlite:users.db');
	  $dbc->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	  $sql="INSERT INTO jobtable(name,status,checkedtime) VALUES(:name,:status,:time)";
	  $data=$dbc->prepare($sql);
	  
	  $data->bindparam(':name',$name);
	  $data->bindparam(':status',$status);
	  $data->bindparam(':time',$time);
	  }
					
  catch(PDOEXCEPTION $err){
	    //close the database and echo the error
	    $dbc= null;
	    echo'sorry can\'t connect because  '.$err->getmessage();}
	
  
  
  //check the amount of jobs available and store it in a variable $amount
  $jobs=$xmlob->jobs;
  $amount=count($jobs);
  
  //loop through the elements and insert the node values into the database 
  for($i=0; $i<$amount; $i++){
	  foreach($jobs[$i] as $job){
		  $name=$job['name'];
		  $status=$job['status'];
		  $time=date('Y-m-d H:i:s');
		  
		  $data->execute();}
		  
		  
	  }
  
  
  
  
  
