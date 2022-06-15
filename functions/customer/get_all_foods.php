<?php

include_once("../customer_functions.php");

$query = ucfirst(strtolower($_POST['query']));


$result = getAllFoods($query);
//pt the result and name in associative array to send back to front end

$data = array(
    'state' => $result,
);


echo json_encode($data);