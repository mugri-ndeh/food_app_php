<?php
   // display errors if any
   error_reporting(E_ALL);
   ini_set('display_errors', 1);
   
   // function to open connection
  function openConn(){
   $host = "localhost";
   $user = "root";
   $password = "";
   $db = "test_db";
   
//    if(!$conn){
//       die("Connect failed:".mysqli_error());
//    }
  
//    echo "Connected";
//    return $conn;
//   }

  try
  {
    $conn = new PDO("mysql:host=$host; dbname=$db;charset=UTF8;", $user, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      
  }
  catch(PDOException $exception)
  {
      echo "Connection error: " . $exception->getMessage();
  }
   
  return $conn;
}

/*
<?php
   // display errors if any
   error_reporting(E_ALL);
   ini_set('display_errors', 1);
   
   // function to open connection
  function openConn(){
   $host = "localhost";
   $user = "id19059713_maestro";
   $password = "<oX(=YX@3(iJfD%1";
   $db = "id19059713_test_db";
   
//    if(!$conn){
//       die("Connect failed:".mysqli_error());
//    }
  
//    echo "Connected";
//    return $conn;
//   }

  try
  {
    $conn = new PDO("mysql:host=$host; dbname=$db;charset=UTF8;", $user, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $conn;
*/