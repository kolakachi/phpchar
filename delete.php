<?php
  //including the controller
  require_once('functions.php');
  
  //start session
  session_start();
  
  /*if session is not set go to login page else create new controller object, if the form has been submitted query the database delete the desired row and goto list page*/
  if(!isset($_SESSION['pw']))
  { header('location:login.php');}
	$dsn=new sqdbc();
	if(isset($_POST['delete'])){
		$item=$_POST['name'];
		$sql="DELETE FROM users where name='$item'";
		$dsn::execution($sql);
		header('location:list.php');}
?>