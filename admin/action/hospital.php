<?php
require("../layout/db.php");
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

$name = test_input($_POST['name']);
$mobile = test_input($_POST['mobile']);
$address = test_input($_POST['address']);
$mail = test_input($_POST['email']);
$password = test_input($_POST['password']);

$sql = "INSERT INTO hospital (name , email ,password , mobile , address)
VALUES ('$name' ,'$mail','$password','$mobile','$address' )";

if ($conn->query($sql) === TRUE) {
    header("Location: /admin/home.php?page=1&msg=Hospital Details Added Successfully !");
    die();
} else {
    header("Location: /admin/home.php?page=1&err=Something went Wrong!");
    die();
}


?>