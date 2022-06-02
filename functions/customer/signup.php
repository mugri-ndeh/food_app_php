<?php
include_once("../customer_functions.php");

 $firstname = $_POST['firstname']
 $lastname = $_POST['lastname']
 $username = $_POST['username']
 $email = $_POST['email']
 $phonenumber = $_POST['phonenumber']
 $password = $_POST['password']

 $result = signup($firstname, $lastname, $username, $email, $phonenumber, $password);

 $data = array(
    'state'=>$result,
);


echo json_encode($data);