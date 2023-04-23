<?php
require("../admin/layout/db.php");
$target_dir = "./uploads/";
$target_file = $target_dir . basename($_FILES["file"]["name"]);

if(!isset($_SESSION)) 
{ 
    session_start(); 
}
$hid = $_SESSION["id"];
$file = basename($_FILES["file"]["name"]);
$uid = $_POST["id"];
$email = $_POST["email"];
$password = $_POST["password"];
$dname = $_POST["dname"];
$data = $_POST["data"];

if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
    $sql = "INSERT INTO list (uid,hid,pdf,dname,data)
    VALUES ('$uid','$hid','$file','$dname','$data')";

    if ($conn->query($sql) === TRUE) {
        header("Location: /hospital?email=$email&password=$password&msg=Image uploaded Successfully !");
        die();
    } else {
        header("Location: /hospital?email=$email&password=$password&err=Something went Wrong!");
        die();
    }
} else {
    header("Location: /hospital?email=$email&password=$password&err=Something went Wrong!");
    die();
}

?>