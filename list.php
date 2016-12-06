<?php
  //including the controller to reduce rewrite of few codes
  require_once('functions.php');
  
  //start session
  session_start();
  
  /*if session is not set go to login page else create new controller object, 
  query the database and store the resuts in variable records*/
  if(!isset($_SESSION['pw'])){
	  header('location:login.php');}
	  $dsn=new sqdbc();
	  $query = "SELECT * from users";
	  $records=$dsn::dbFetchAll($query);
	
?>

<!doctype html>
<html>
 <head>
  <meta charset="utf-8">
  <title>List</title>
  <link rel="stylesheet" type="text/css" href="css/phpcha.css">
 </head>

 <body>
  <div id="top">
   <h1>PHP Challenge</h1>
   <h4>For Admin Use Only</h4>
  </div>
  <p><a href="welcomepage.php">< BACK</a></p>
  <table>
   <thead>
    <tr>
     <td>Userid</td>
     <td>Name</td>
     <td>Option</td>
    </tr>
   </thead>
   <tbody>
    <?php foreach($records as $record): ?>
	<tr>
	 <td><?php echo htmlspecialchars($record['userid']); ?></td>
	 <td><?php echo htmlspecialchars($record['name']); ?></td>
	 
	 <td>
      <form action="delete.php" method="post">
       <div>
        <input type="hidden" name="name" value="<?php echo htmlspecialchars($record['name']); ?>">
        <input type="submit" name="delete" value="Delete">
       </div>
      </form>
     </td>
    </tr>
    <?php endforeach; ?>
   </tbody>
  </table>
 </body>
</html>
