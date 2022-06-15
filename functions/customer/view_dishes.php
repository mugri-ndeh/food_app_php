<?php

include_once("../customer_functions.php");

$id = $_POST['id'];


$result = get_food_list($id);
//pt the result and name in associative array to send back to front end

$data = array(
    'state' => $result,
);


echo json_encode($data);