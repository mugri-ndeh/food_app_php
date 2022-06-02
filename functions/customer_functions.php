<?php
include_once('../settings/connection.php');
function signup($firstname, $lastname, $username, $email, $phonenumber, $password){
    $sql = "INSERT INTO user (firstname, lastname, username email, phonenumber, password) VALUES (?, ?, ?, ?, ?, ?) ";

    $stmt = $db->prepare($sql);
    $result = $stmt->execute([$firstname, $lastname, $username $email, $phonenumber, $password]);


   //if query works
    if ($result) {

        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        return json_encode(
            [
                'user' => $data
            ]
            );
       else {
          return 'failed';
       }
    }
}


function login($email, $password){
    $sql = "SELECT * FROM user WHERE username = ? AND password = ?";

    $stmt = $db->prepare($sql);
    $result = $stmt->execute([$username, $password]);


   //if query works
    if ($result) {

        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        return json_encode(
            [
                'user' => $data
            ]
            );
       else {
          return 'failed';
       }
    }
}

function create_order($foodItems, $qty, $state, $priceTotal){
  $sql = "INSERT INTO orders (food_items, qty, o_state, price_total) VALUES ('$foodItems','$qty','$state','$priceTotal')"

  $result = $conn->query($sql);
  if($result){
    return 'success';
   }
  
  else {
      return "failed";
  }
}

function get_orders($userId){
    $sql = "SELECT * FROM orders WHERE u_id = ?";

    $stmt = $db->prepare($sql);
    $result = $stmt->execute([$userId]);


    if($result){
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        return json_encode($data);
    }
    else {
        return "failed";
    }
}


function get_food_list($category){
  $sql = "SELECT * FROM food WHERE category = ?";

  $stmt = $db->prepare($sql);
  $result = $stmt->execute([$category]);

  if($result){
    $data = $stmt->fetch(PDO::FETCH_ASSOC);
    json_encode($data);
  }
  else {
      return "failed";
  }
}