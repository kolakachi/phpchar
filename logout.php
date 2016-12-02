<?php
  //start session
  session_start();
  
  //check if session variable has been set clear session variable and delete 
  if(isset($_SESSION['pw'])){
	  $_SESSION = array();
      session_destroy();
	  header('location:login.php');
	}else{header('location:login.php');}
?>