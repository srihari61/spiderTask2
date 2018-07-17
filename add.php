<?php
    session_start();
    if($_SESSION['user']){
    }
    else{ 
       header("location:index.php");
    }

    $titleNotes=mysqli_real_escape_string($_POST['titleNotes']);
    $details=mysqli_real_escape_string($_POST['details']);
    $titleToDoList=mysqli_real_escape_string($_POST['titleToDoList']);
    $detailsList=mysqli_real_escape_string($_POST['detailsList']);

    $decision = "no";
   
       mysqli_connect("localhost","root","") or die(mysqli_error()); //Connect to server
       mysqli_select_db("first_db") or die("Cannot connect to database"); //Conect to database
       foreach($_POST['detailsList'] in $each_check) //gets the data from the checkbox
       {
          if($each_check != null){ //checks if checkbox is checked
             $decision = "yes"; // sets the value
          }
       }

       mysql_query("INSERT INTO notes(Title,Message) VALUES ('$titleNotes','$details')
       	            INSERT INTO to-do-list(Name) VALUES ('$titleToDoList') 
                    INSERT INTO list-data(CbState,Item) VALUES ('','$detailsList)"); //SQL query
       header("location:home.php");
    }
    else
    {
       header("location:home.php");
    }








?>    