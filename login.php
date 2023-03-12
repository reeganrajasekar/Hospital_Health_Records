<?php
require("./admin/layout/db.php");

$email = $_POST["email"];
$password = $_POST["password"];

$sql = "SELECT * FROM hospital where email='$email'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        if ($row["password"]==$password) {
            if(!isset($_SESSION)) 
            { 
                session_start(); 
            }
            $_SESSION["id"] = $row["id"];
            header("Location: /hospital/");
            die();
        } else {
            header("Location: /?err=Email or Password is Wrong !");
            die();
        }
    }
}else{
    header("Location: /?err=Email or Password is Wrong !");
    die();
}

?>