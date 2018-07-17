<?php
    session_start(); //starts the session
    if($_SESSION['user']){ //checks if user is logged in
    }
    else {
       header("location:index.php"); //redirects if user is not logged in.
    }

    if($_SERVER['REQUEST_METHOD'] == "GET")
    {
       mysqli_connect("localhost", "root", "") or die(mysqli_error()); //connect to server
       mysqli_select_db("spidertask2") or die("cannot connect to database"); //Connect to database
       $id = $_GET['id'];
       mysql_query("DELETE FROM notes WHERE id='$id'");
        
       header("location:home.php");
    }
?>