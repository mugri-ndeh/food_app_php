<?php
include_once('../../settings/connection.php');

function signup($firstname, $lastname, $username, $email, $phonenumber, $password){

    $conn = openConn();
    $sql = "INSERT INTO user (firstname, lastname, username, email, phonenumber, password) VALUES (?, ?, ?, ?, ?, ?) ";


    $stmt = $conn->prepare($sql);
    $res = $stmt->execute([$firstname, $lastname, $username, $email, $phonenumber, $password]);
    $row = $stmt->rowCount();

    $last_id =  $conn->lastInsertId();
    $sql1 = "SELECT * FROM user WHERE id = ?";


   //if query works
    if ($res) {
        
        echo('Result exists');
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return 'success';
        }
       else {
          return 'failed';
       }
    
}


function login($email, $password){
    $conn = openConn();

    $sql = "SELECT * FROM user WHERE email = ? AND password = ?";

    $stmt = $conn->prepare($sql);
    $stmt->execute(array($email, $password));

    $row = $stmt->rowCount();

   //if query works
    if ($row>0) {
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
   
        return $data;
    }
       else {
          return 'failed';
       }
    
}

function getUser($id){
    $conn = openConn();

    $sql = "SELECT * FROM user WHERE id = ?";

    $stmt = $conn->prepare($sql);
    $stmt->execute(array($id));
    $row = $stmt->rowCount();

   //if query works
    if ($row>0) {
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        return $data;
        }
       else {
          return 'failed';
       }
}

function create_order($foodItems, $qty, $state, $priceTotal){
    $conn = openConn();

  $sql = "INSERT INTO orders (food_items, qty, o_state, price_total) VALUES (?, ?, ?, ?)";

  $stmt = $conn->prepare($sql);
  $result = $stmt->execute([$foodItems, $qty, $state, $priceTotal]);

  $result = $conn->query($sql);
  if($result){
      echo $result;
    return 'success';
   }
  
  else {
      return "failed";
  }
}

function get_orders($userId){
    $conn = openConn();

    $sql = "SELECT * FROM orders WHERE id = ?";

    $stmt = $db->prepare($sql);
    $stmt->execute([$userId]);
    $row = $stmt->rowCount();

    //if query works
     if ($row>0) {
         $data = $stmt->fetch(PDO::FETCH_ASSOC);
    
         return $data;
     }
        else {
           return 'failed';
        }
}


function get_food_list($cat_id){
    $conn = openConn();

  $sql = "SELECT * FROM food WHERE cat_id = ?";

  $stmt = $conn->prepare($sql);
  
  $stmt->execute([$cat_id]);
  $row = $stmt->rowCount();

  if ($row>0) {
//       $arr_data = array(); 
//       while(row>0){
// $arr_data = 
//       }
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
// echo $data;
    return $data;
}
   else {
      return 'failed';
   }
}

function joinquery($cat_id){
    $conn = openConn();
    $sql = 'SELECT * FROM food, food_category INNER JOIN food ON food.cat_id = food_category.id';
    
  $stmt = $db->prepare($sql);
  $result = $stmt->execute([$cat_id]);

  if($result){
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    json_encode($data);
  }
  else {
      return "failed";
  }
}