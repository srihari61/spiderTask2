<html>
    <head>
        <meta charset="utf-8">
        <title>My first PHP Website</title>
    </head>
    <body>
        <h2>Registration Page</h2>
        <a href="index.php">Click here to go back</a><br>
        <form action="register.php" method="POST">
           Enter Username: <input type="text" name="username" required="required"> <br>
           Enter password: <input type="password" name="password" required="required"> <br>
           <input type="submit" value="Register">
        </form>
    </body>
</html>
<?php
if($_SERVER[REQUEST_METHOD]=="POST")
{
	$username=mysqli_real_escape_string($_POST['username']);
    $password=mysqli_real_escape_string($_POST['password']);

$bool = true;
	$mysqli=new mysqli("localhost", "root",""); //Connect to server
	if ($mysqli->connect_errno) {                                //Check connection
    printf("Connect failed: %s\n", $mysqli->connect_error);
    exit();
}

	mysqli_select_db("spidertask2") or die("Cannot connect to database"); //Connect to database
	$query = $mysqli->query("Select * from login"); //Query the login table
	while($row = mysqli_fetch_array($query)) //display all rows from query
	{
		$table_users = $row['login']; // the first login row is passed on to $table_users, and so on until the query is finished
		if($username == $table_users) // checks if there are any matching fields
		{
			$bool = false; // sets bool to false
			Print '<script>alert("Username has been taken!");</script>'; //Prompts the user
			Print '<script>window.location.assign("register.php");</script>'; // redirects to register.php
		}
	}
	if($bool) // checks if bool is true
	{
		$mysqli->query("INSERT INTO login (username, hashedpwd) VALUES ('$username','SHA1($password)')"); //Inserts the value to table login
		Print '<script>alert("Successfully Registered!");</script>'; // Prompts the user
		Print '<script>window.location.assign("register.php");</script>'; // redirects to register.php
	}
}

?>