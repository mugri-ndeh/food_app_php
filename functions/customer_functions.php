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

function editProfile($firstname, $lastname, $username, $email, $phonenumber, $id){
    $conn = openConn();

    $sql = "UPDATE user SET firstname = ?, lastname = ?, username = ?, email = ?, phonenumber = ? WHERE id = ? ";

    $stmt = $conn->prepare($sql);
    $stmt->execute([$firstname, $lastname, $username, $email, $phonenumber, $id]);
    $row = $stmt->rowCount();

   //if query works
    if ($row>0) {
        $data = getUser($id);
        return $data;
        }
       else {
          return 'failed';
       }
}

function create_order($foodItems, $qty, $state, $priceTotal, $userId){
    $conn = openConn();
    $newItems = json_decode($foodItems);

  $sql = "INSERT INTO orders (food_items, qty, o_state, price_total, u_id) VALUES (?, ?, ?, ?, ?) ";

  $stmt = $conn->prepare($sql);
  $result = $stmt->execute([$foodItems, $qty, $state, $priceTotal, $userId]);

  if($result){
    return 'success';
   }
  
  else {
      return "failed";
  }
}

function get_orders($userId){
    $conn = openConn();

    $sql = "SELECT * FROM orders WHERE u_id = ? ";

    $stmt = $conn->prepare($sql);
    $stmt->execute([$userId]);
    $row = $stmt->rowCount();

    //if query works
     if ($row>0) {
         $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
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

    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $data;
}
   else {
      return 'failed';
   }
}

function getAllFoods($query){
    $conn = openConn();

  $sql = "SELECT * FROM food WHERE name = ?";

  $stmt = $conn->prepare($sql);
  
  $stmt->execute([$query]);
  $row = $stmt->rowCount();

  if ($row>0) {

    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $data;
}
   else {
      return 'failed';
   }
}

function joinquery($cat_id){
    $conn = openConn();
    $sql = 'SELECT * FROM food, food_category INNER JOIN food ON food.cat_id = food_category.id';
    
  $stmt = $conn->prepare($sql);
  $result = $stmt->execute([$cat_id]);

  if($result){
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    json_encode($data);
  }
  else {
      return "failed";
  }
}