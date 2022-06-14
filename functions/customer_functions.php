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

function addOrderItem($order_id, $food_id, $qty){
  $conn = openConn();
  $sql = 'INSERT INTO order_item (order_id, food_id, food_qty) VALUES (?, ?, ?)';
  $stmt = $conn->prepare($sql);
  $res = $stmt->execute([$order_id, $food_id, $qty]);

  if($res){
    return 'success';
  }
  else {
    return 'failed';
  }

}  

function create_order(array $foodItems, $qty, $state, $priceTotal, $userId){
    $conn = openConn();
    
    

  $sql = "INSERT INTO orders (qty, o_state, price_total, u_id) VALUES (?, ?, ?, ?) ";

  $stmt = $conn->prepare($sql);
  $result = $stmt->execute([$qty, $state, $priceTotal, $userId]);
  $last_id = $conn->lastInsertId();

  if($result){
    for ($i=0; $i <sizeof($foodItems) ; $i++) { 
      addOrderItem($last_id, $foodItems[$i]['item']['id'], $foodItems[$i]['qty']);
    }
    return 'success';
   }
  
  else {
      return "failed";
  }
}

function getOrderItem($order_id){
  $conn = openConn();

  $sql = 'SELECT order_item.order_id, order_item.food_qty, food.id, food.name, food.image, food.price, food.cat_id, food.description FROM order_item INNER JOIN food ON order_item.food_id = food.id WHERE order_item.order_id = ?';

  $stmt = $conn->prepare($sql);
  $stmt->execute([$order_id]);
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

function get_orders($userId){
    $conn = openConn();

    $sql = "SELECT orders.id, orders.o_state, orders.qty, orders.price_total FROM orders INNER JOIN user ON orders.u_id = ? ";

    // $sql = "SELECT order_item FROM ((order_item INNER JOIN orders ON orders.id = order_item.order_id) INNER JOIN user ON orders.u_id = ?) ";


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

  $sql = "SELECT * FROM food WHERE name LIKE ? LIMIT 5";

  $stmt = $conn->prepare($sql);
  
  $stmt->execute(["%$query%"]);
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

function getAllReviews($id){
  $conn = openConn();
  $sql = "SELECT * FROM reviews INNER JOIN users ON users.uid = reviews.user_id WHERE users.uid = ?";
  $stmt = $conn->prepare($sql);
  $stmt->execute([$id]);

  $row = $stmt->rowCount();

  if ($row>0){
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $data;
  }
  else{
    return 'failed';
  }
}