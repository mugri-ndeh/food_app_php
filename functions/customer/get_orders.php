<?php
include_once("../customer_functions.php");

    $id = $_POST['id'];

     // );



    $result = get_orders($id);
    //pt the result and name in associative array to send back to front end
    $orders = [];

    foreach($result as $item){
     $fooditem = getOrderItem($item['id']);

        array_push($orders, array(
            'items'=> $fooditem,
            'order'=>$item
          ));
    }
    $data = array(
        'state'=>$orders,
    );
    

    echo json_encode($data);
