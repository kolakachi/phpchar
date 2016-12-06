<?php
/*I assumed that the user is going to be interacting with the  database directly,
i created a login page to restrict access to the application making the admin the only one able to access the application.
*/

   //including the controller to reduce rewrite of few codes
  require_once('functions.php');
  
  //start session
  session_start();
  
  //set $err to empty
  $err="";
  
  //check if session variable has been set
  if(!isset($_SESSION['pw'])){
	  
     //check if user has submitted the form
     if(isset($_POST['submit'])){
		 
		 // create new controller object
	    $func= new sqdbc();
		
		//create name and password variables after striping the user input of injection
	    $name=$func::testinput($_POST['admin']);
	    $pword= $func::testinput($_POST['password']);
		
		//storing the login query ina variable query
	    $query = "SELECT username, password FROM admin WHERE password='$pword' AND username='$name'";
		
		//calling dbfetchall method from the controller for getting the rows
	    $count=count($func::dbFetchAll($query));
		
		//check if the username and password exists
	    if($count>0)
	      { $_SESSION['pw']=$pword;
	        header('location:welcomepage.php');}
			
		else{
			//set the error message for wrong username and password
			$err='wrong username or password';}
		}
		}else{header('location:welcomepage.php');}
	?>

<!doctype html>
 <html>
  <head>
  <meta charset="utf-8">
  <title>Login</title>
  <link rel="stylesheet" type="text/css" href="css/phpcha.css">
 </head>

 <body>
  <div id="top">
   <h1>PHP Challenge</h1>
   <h4>For Admin Use Only</h4>
  </div>
  <div>
  
  <form  action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" role="form" >
  <?php echo $err;?>
   <table>
    <tr>
     <td>
      <label for="name" >NAME</label>
     </td>
     <td>
      <input type="text"  id="name" value="admin" name="admin" required/>
     </td>
    </tr>
    <tr>
     <td>
      <label for="password">password</label>
     </td>
     <td>
      <input type="password"  id="password" name="password" required/>
     </td>
    </tr>
    <tr>
     <td></td>
     
     <td>
      <input type="submit" value="submit" id="submit" name="submit"/>
     </td>
    </tr>
   </table>
  </form>
 </div>
</body>
</html>
