<?php

    header('CONTENT-TYPE: text/html; charset=utf-8');
    $servername = "localhost";
    $username = "root";
    $password = "123";
    $dbname = "repositorio";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    mysqli_set_charset($conn,"utf8");

?>