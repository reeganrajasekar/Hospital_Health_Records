<?php
require("../layout/db.php");

$id =$_POST['id'];

$sql = "DELETE FROM hospital WHERE id='$id'";

if ($conn->query($sql) === TRUE) {
    header("Location: /admin/home.php?page=1&msg=Hospital Details Deleted Successfully !");
    die();
} else {
    header("Location: /admin/home.php?page=1&err=Something went Wrong!");
    die();
}


?>