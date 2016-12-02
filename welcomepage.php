<?php

/*I assumed that the user is going to be interacting with the  database directly,i created a login page to restrict access to the application making the admin the only one able to access the application.
*/

  //start session
  session_start();
  
  //check if seesion variable has been set else goto the login page 
  if(!isset($_SESSION['pw'])){
	header('location:login.php');}
?>

<!doctype html>
 <html>
 <head>
 <meta charset="utf-8">
 <title>Welcome Page</title>
 <link rel="stylesheet" type="text/css" href="css/phpcha.css">
 </head>
 
 <body>
  <div id="top">
   <h1>PHP Challenge</h1>
   <h4>For Admin Use Only</h4>
  </div>
  <ul>
   <li><a href="list.php">View List</a></li>
   <li><a href="add.php">Add List</a></li>
   <li><a href="logout.php">Log Out</a> </li>
  </ul>
 </body>
</html>