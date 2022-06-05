<?php

include_once("../customer_functions.php");


    $foodItems = $_POST['food_items'];
    $qty = $_POST['qty'];
    $state = $_POST['o_state'];
    $priceTotal = $_POST['price_total'];
    $userid = $_POST['user_id'];

   

    $result = create_order($foodItems, $qty, $state, $priceTotal, $userid);
    //pt the result and name in associative array to send back to front end

    $data = array(
        'state'=>$result,
    );
    

    echo json_encode($data);

