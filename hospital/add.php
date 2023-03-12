<?php
require("../admin/layout/db.php");
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

$sql = "INSERT INTO user (name , email ,password , mobile , address)
VALUES ('$name' ,'$mail','$password','$mobile','$address' )";

if ($conn->query($sql) === TRUE) {
    header("Location: /hospital/?page=1&msg=User Details Added Successfully !");
    die();
} else {
    header("Location: /hospital?page=1&err=Something went Wrong!");
    die();
}


?>