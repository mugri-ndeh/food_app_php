<?php
include_once("../customer_functions.php");

    $email = $_POST['email'];
    $password = $_POST['password'];
   

    $result = login($email, $password);
    //pt the result and name in associative array to send back to front end

    $data = array(
        'state'=>$result,
    );
    

    echo json_encode($data);
