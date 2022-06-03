<?php
include_once("../customer_functions.php");

    $id = $_POST['id'];
   

    $result = getUser($id);
    //pt the result and name in associative array to send back to front end

    $data = array(
        'state'=>$result,
    );
    

    echo json_encode($data);
