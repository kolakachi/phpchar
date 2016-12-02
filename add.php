<?php
   
    //including the controller to reduce rewrite of few codes
   require_once('functions.php');
   
   //start session
   session_start();
   
   //check if session variable has been set else goto the login page 
   if(!isset($_SESSION['pw'])){
	  header('location:login.php');}else{
		
     //set the variables name and error message for wrong entry
     $errname="";
     $name="";

     //check if user has submitted the form
     if(isset($_POST['submit'])){
	 
	 // create new controller object
	 $func= new sqdbc();
	 
	 //create name and password variables after striping the user input of injection
	 $name=$func::testinput($_POST['name']);
	 
	 //validate user input to avoid injection
	 if(!preg_match("/^[a-zA-Z]*$/",$name))
	 { $errname='Only letters are allowed'; }
	 else{
		 $sql="INSERT INTO users (name) VALUES('$name')";
		 $func::execution($sql);
		 header('location:list.php');}
	 }}

?>


<!doctype html>
 <html>
 <head>
 <meta charset="utf-8">
 <title>Add</title>
 <link href="css/phpcha.css" rel="stylesheet" type="text/css">
 </head>

 <body>
  <div id="top">
   <h1>PHP Challenge</h1>
   <h4>For Admin Use Only</h4>
  </div>
  <p><a href="welcomepage.php">< BACK</a></p>
  <form  action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" role="form" class="form" >
  <?php echo $errname;?>
   <label for="name" >NAME</label>
   <input type="text"  id="name" name="name" required/>
   <input type="submit" value="submit" id="submit" name="submit"/>
  </form>
 </body>
</html>