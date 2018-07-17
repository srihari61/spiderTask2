<html>
	<head>
		<title>My first PHP website</title>
	</head>
	<? php
	session_start(); //starts the session
	if($_SESSION['user']){ //checks if user is logged in
	}
	else{
		header("location:index.php"); // redirects if user is not logged in
	}
	$user = $_SESSION['user']; //assigns user value
	?>
	<body>
		<h2>Home Page</h2>
		<p>Hello <?php Print "$user"?>!</p> <!--Displays user's name-->
		<a href="logout.php">Click here to logout</a><br><br>
		<form action="add.php" method="POST">
			<div id="inputNotes">Add more to notes:<br>
				Title:<input type="text" name="titleNotes"/><br>
			    Data: <input type="text" name="details"/><br>
			<!-- public post? <input type="checkbox" name="public[]" value="yes"/><br/>  -->
		</div>
			<input type="submit" value="Add to notes"/>
		</form>
		<form action="add.php" method="POST">
			<div id="inputList">Add more to to-do list:<br>
				Title:<input type="text" name="titleToDoList"/><br>
			    
			    Data: <input type="text" name="detailsList"/>

			
			<!-- public post? <input type="checkbox" name="public[]" value="yes"/><br/>  -->
		    </div>
			<input type="submit" value="Add to notes"/>
		</form>
		<h2 align="center">My notes</h2>
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
				mysqli_connect("localhost", "root","") or die(mysqli_error()); //Connect to server
				mysqli_select_db("spidertask2") or die("Cannot connect to database"); //connect to database
				$query = mysqli_query("Select * from notes"); // SQL Query
				while($row = mysqli_fetch_array($query))
				{
					Print "<tr>";
						Print '<td align="center">'. $row['id'] . "</td>";
						Print '<td align="center">'. $row['Title'] . "</td>";
						Print '<td align="center">'. $row['Message'] . "</td>";
						  
						Print '<td align="center"><a href="edit.php?id='. $row['id'] .'">edit</a> </td>';
						Print '<td align="center"><a href="#" onclick="myFunction('.$row['id'].','deleteNote')">delete</a> </td>';
						
					Print "</tr>";
				}
			?>
		</table>
		<br>
		<div>
			To Do List:<br>
            <div id="displayToDo">
            	
            </div><br><br>

		</div>
    <?php
    				mysqli_connect("localhost", "root","") or die(mysqli_error()); //Connect to server
				mysqli_select_db("spidertask2") or die("Cannot connect to database"); //connect to database
				$query = mysqli_query("Select * from list-data"); // SQL Query
				$displayResult='document.getElementById("displayToDo").innerHTML';
				while($row = mysqli_fetch_array($query))
				{
					Print "$dispalyResult";
					
						Print  $row['ListNo']."    ";
						Print  $row['CbState']." ";
						Print  $row['Item'];
						Print '<br>'.'<a href="edit.php?id='. $row['id'] .'">edit</a>';
						Print '<a href="#" onclick="myFunction('.$row['id'].','deleteToDoList')">delete</a>';
						'<br>'.'<br>';
						
					
				}
			?>

		<script>
			function myFunction(id,var linkName)
			{
			var r=confirm("Are you sure you want to delete this record?");
			if (r==true)
			  {
			  	if(linkName=="deleteNote")
			  	window.location.assign("deleteNote.php?id=" + id);
			  else
			    window.location.assign("deleteTD.php?id=" + id);
			  }
			}
		</script>
	</body>
	<!--             Print '<td align="center">'. $row['date_posted']. " - ". $row['time_posted']."</td>";
						Print '<td align="center">'. $row['date_edited']. " - ". $row['time_edited']. "</td>";
						Print '<td align="center">'. $row['public']. "</td>";
					-->
</html>

