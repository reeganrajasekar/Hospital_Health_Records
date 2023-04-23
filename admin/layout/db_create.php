<?php 
require("./db.php");


$sql = "CREATE TABLE list(
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    hid INT(6) NOT NULL,
    uid INT(6) NOT NULL,
    dname VARCHAR(500) NOT NULL,
    data VARCHAR(500) NOT NULL,
    pdf VARCHAR(500) NOT NULL,
    reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)";

if ($conn->query($sql) === TRUE) {
    echo "Table list created successfully<br>";
} else {
    echo "Error creating table: ";
}

// 
$sql = "CREATE TABLE hospital(
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(500) NOT NULL,
    email VARCHAR(500) NOT NULL,
    password VARCHAR(500) NOT NULL,
    address VARCHAR(500) NOT NULL,
    mobile VARCHAR(500) NOT NULL,
    reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)";

if ($conn->query($sql) === TRUE) {
    echo "Table hospital created successfully<br>";
} else {
    echo "Error creating table: ";
}


$sql = "CREATE TABLE user(
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(500) NOT NULL,
    email VARCHAR(500) NOT NULL unique,
    password VARCHAR(500) NOT NULL,
    address VARCHAR(500) NOT NULL,
    mobile VARCHAR(500) NOT NULL,
    reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)";

if ($conn->query($sql) === TRUE) {
    echo "Table user created successfully<br>";
} else {
    echo "Error creating table: ";
}

?>