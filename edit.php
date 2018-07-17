<html>
	<head>
		<title>My first PHP website</title>
	</head>
	<?php
	session_start(); //starts the session
	if($_SESSION['user']){ //checks if user is logged in
	}
	else{
		header("location:index.php"); // redirects if user is not logged in
	}
	$user = $_SESSION['user']; //assigns user value
	$id_exists = false;
	?>
	<body>
		<h2>Home Page</h2>
		<p>Hello <?php Print "$user"?>!</p> <!--Displays user's name-->
		<a href="logout.php">Click here to logout</a><br/><br/>
		<a href="home.php">Return to Home page</a>
		<h2 align="center">Currently Selected</h2>
		<table border="1px" width="100%">
			<tr>
				<th>Id</th>
				<th>Title</th>
				<th>Notes</th>
				<!--<th>Post Time</th>
				<th>Edit Time</th>  -->
				<th>Edit</th>
				<th>Delete</th>
			<!--	<th>Public Post</th>   -->
			</tr>
			<?php
				if(!empty($_GET['id']))
				{
					$id = $_GET['id'];
					$_SESSION['id'] = $id;
					$id_exists = true;
					mysqli_connect("localhost", "root","") or die(mysqli_error()); //Connect to server
					mysqli_select_db("spidertask2") or die("Cannot connect to database"); //connect to database
					$query = mysqli_query("Select * from notes Where id='$id'"); // SQL Query
					$count = mysqli_num_rows($query);
					if($count > 0)
					{
				         while($row = mysqli_fetch_array($query))
				           {
					           Print "<tr>";
						       Print '<td align="center">'. $row['id'] . "</td>";
						       Print '<td align="center">'. $row['Title'] . "</td>";
						       Print '<td align="center">'. $row['Message'] . "</td>";
						 
					           Print "</tr>";
				           }
				     } 
				     else
					{
						$id_exists = false;
					}
				}      
			?>
		</table>
		<br/>
		<?php
		if($id_exists)
		{
		Print '
		<form action="edit.php" method="POST">
			Enter new detail:
            <div>Title:<input type="text" name="titleNotes"/><br>
			Data: <input type="text" name="details"/><br>
		    </div>
			<!--   <input type="text" name="details"/><br/>
			public post? <input type="checkbox" name="public[]" value="yes"/><br/>    -->
			<input type="submit" value="Update List"/>   
		</form>
		';
		}
		else
		{
			Print '<h2 align="center">There is no data to be edited.</h2>';
		}
		?>

<div>
			To Do List:<br>
            <div id="displayToDo">
            	
            </div><br><br>

		</div>
<?php
				if(!empty($_GET['id']))
				{
					$id = $_GET['id'];
					$_SESSION['id'] = $id;
					$id_exists = true;
					mysqli_connect("localhost", "root","") or die(mysqli_error()); //Connect to server
					mysqli_select_db("spidertask2") or die("Cannot connect to database"); //connect to database
					$query = mysqli_query("Select * from list-data Where id='$id' "); // SQL Query  To include list number for easy and correct reference
					$count = mysqli_num_rows($query);
					$displayResult='document.getElementById("displayToDo").innerHTML';
					if($count > 0)
					{
				         while($row = mysqli_fetch_array($query))
				           {
					          Print "$dispalyResult";
					
						Print  $row['ListNo']."    ";
						Print  $row['CbState']." ";
						Print  $row['Item'];
						
				           }
				     } 
				     else
					{
						$id_exists = false;
					}
				}      
			?>				
<?php
		if($id_exists)
		{
		Print '
		<form action="edit.php" method="POST">
			Enter new detail:
            <div>
            	Title:<input type="text" name="titleToDoList"/><br>
			    Data: <input type="text" name="detailsList"/>
		    </div>
			<!--   <input type="text" name="details"/><br/>
			public post? <input type="checkbox" name="public[]" value="yes"/><br/>    -->
			<input type="submit" value="Update List"/>   
		</form>
		';
		}
		else
		{
			Print '<h2 align="center">There is no data to be edited.</h2>';
		}
		?>



	</body>
</html>
//For notes
<?php
   if($_SERVER['REQUEST_METHOD'] == "POST")
   {
      mysqli_connect("localhost", "root", "") or die (mysqli_error()); //Connect to server
      mysqli_select_db("spidertask2") or die ("Cannot connect to database"); //Connect to database
      $titleNotes = mysqli_real_escape_string($_POST['titleNotes']);
      $details = mysqli_real_escape_string($_POST['details']);
      
      /* $public = "no";
      $id = $_SESSION['id'];
      $time = strftime("%X"); //time
      $date = strftime("%B %D, %Y"); //date   */

      /* foreach($_POST['public'] as $list)
      {
         if($list != null)
         {
            $public = "yes";
         }
      }   
      */
      mysqli_query("UPDATE notes SET Message='$details',Title='$titleNotes' WHERE id='$id'");
      header("location:home.php");
   }
?>
//For to do list
<?php
   if($_SERVER['REQUEST_METHOD'] == "POST")
   {
      mysqli_connect("localhost", "root", "") or die (mysqli_error()); //Connect to server
      mysqli_select_db("first_db") or die ("Cannot connect to database"); //Connect to database
      $detailsList = mysqli_real_escape_string($_POST['detailsList']);
      $titleToDoList = mysqli_real_escape_string($_POST['titleToDoList']);
      /*  $public = "no";
      $id = $_SESSION['id'];
      $time = strftime("%X"); //time
      $date = strftime("%B %D, %Y"); //date

      foreach($_POST['public'] as $list)
      {
         if($list != null)
         {
            $public = "yes";
         }
      }
      */
      mysqli_query("UPDATE to-do-list SET Name='$titleToDoList' WHERE id='$id'
                   //Assign ListNo for referencing
                   UPDATE list-data SET Item='$detailsList' WHERE id='$id'
                   ");
      header("location:home.php");
   }
?>