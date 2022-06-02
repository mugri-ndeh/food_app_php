<?php

include_once("../customer_functions.php");


    $foodItems = $_POST['foodItems'];
    $qty = $_POST['qty'];
    $state = $_POST['state'];
    $priceTotal = $_POST['priceTotal'];
   

    $result = create_order($foodItems, $qty, $state, $priceTotal);
    //pt the result and name in associative array to send back to front end

    $data = array(
        'state'=>$result,
    );
    

    echo json_encode($data);

