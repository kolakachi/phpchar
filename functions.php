<?php
  
	class sqdbc{
		//set database connection variable
		private static $dbc;
		
	    //set database connection method
		private static function connection(){
			if(!isset(SELF::$dbc)){
				try{SELF::$dbc= new PDO('sqlite:users.db');
					SELF::$dbc->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);}
					
					catch(PDOEXCEPTION $err){
			        //close the database and echo the error
			        SELF::dbclose();
			        echo'sorry can\'t connect because  '.$err->getmessage();}
	          
			  }return SELF::$dbc;
				}
		  //close the database
	      public static function dbclose(){
			  //set PDO instance to null
					SELF::$dbc= null;
					}
		
		
		// method for queries that don't return records
		   public static function execution($sql){
			   try{
				   //get the connection variable
				   $rec=SELF::connection();
			   	   $record=$rec->prepare($sql);
				   $record->execute();
					}catch(PDOEXCEPTION $err){
			        //close the database and echo the error
			        SELF::dbclose();
			        echo'sorry can\'t execute demand because  '.$err->getmessage();}
			   }
			   
			public static function dbFetchAll($sql){
		     
			 try{
				 $dbch=SELF::connection();
				 $data= $dbch->prepare($sql);
				 $data->execute();
				 // Fetch result
				$result=$data->fetchAll(PDO::FETCH_ASSOC);
				}
			 catch(PDOEXCEPTION $err){
			 
			 //close the database and echo the error
			 SELF::dbclose();
			 echo'sorry can\'t connect because  '.$err->getmessage();}
			 //return result
				 return $result;
		 }
		 public static function testinput($input){
			 $input=trim($input);
			 $input=stripslashes($input);
			 $input=htmlspecialchars($input);
			 return $input;}
		   
		   }


?>