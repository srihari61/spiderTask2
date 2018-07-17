<?php
    session_start();
    $username = mysqli_real_escape_string($_POST['username']);
    $password = mysqli_real_escape_string($_POST['password']);
    $bool = true;

    mysqli_connect("localhost", "root", "") or die (mysqli_error()); //Connect to server
    mysqli_select_db("spidertask2") or die ("Cannot connect to database"); //Connect to database
    $query = mysqli_query("Select * from login WHERE username='$username'"); // Query the login table
    $exists = mysqli_num_rows($query); //Checks if username exists
    $table_users = "":
    $table_password = "";
    if($exists > 0) //IF there are no returning rows or no existing username
    {
       while($row = mysqli_fetch_assoc($query)) // display all rows from query
       {
          $table_users = $row['username']; // the first username row is passed on to $table_users, and so on until the query is finished
          $table_password = $row['SHA1(password)']; // the first password row is passed on to $table_password, and so on until the query is finished
       }
       if(($username == $table_users) && (SHA1($password) == $table_password))// checks if there are any matching fields
       {
          if(SHA1($password) == $table_password)
          {
             $_SESSION['user'] = $username; //set the username in a session. This serves as a global variable
             header("location: home.php"); // redirects the user to the authenticated home page
          }
       }
       else
       {
        Print '<script>alert("Incorrect Password!");</script>'; // Prompts the user
        Print '<script>window.location.assign("login.php");</script>'; // redirects to login.php
       }
    }
    else
    {
        Print '<script>alert("Incorrect username!");</script>'; // Prompts the user
        Print '<script>window.location.assign("login.php");</script>'; // redirects to login.php
    }
?>