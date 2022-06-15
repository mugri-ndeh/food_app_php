<?php
include_once("../customer_functions.php");

$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$username = $_POST['username'];
$email = $_POST['email'];
$phonenumber = $_POST['phonenumber'];
$id = (int)($_POST['id']);


$result = editProfile($firstname, $lastname, $username, $email, $phonenumber, $id);

$data = array(
   'state' => $result,
);


echo json_encode($data);