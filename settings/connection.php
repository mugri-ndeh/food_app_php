<?php
   // display errors if any
   error_reporting(E_ALL);
   ini_set('display_errors', 1);
   
   // function to open connection
  function openConn(){
   $dbhost = "localhost";
   $dbuser = "root";
   $dbpass = "";
   $db = "test_db";
   $conn = mysqli_connect($dbhost, $dbuser, $dbpass,$db);
   
   if(!$conn){
      die("Connect failed:".mysqli_error());
   }
  
   //echo "Connected";
   return $conn;
  }
   
?>