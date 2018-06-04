<?php
header('CONTENT-TYPE: text/html; charset=utf-8');
$servername = "localhost";
$username = "root";
$password = "123";
$dbname = "repositorio";

$conn = new mysqli($servername, $username, $password, $dbname);
mysqli_set_charset($conn,"utf8");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = 'SELECT id FROM projeto ORDER BY id DESC LIMIT 1';
$result = $conn->query($sql);

if (!$result) {
    
    die('Could not query:' . mysqli_error());
}

$row = mysqli_fetch_array($result);
echo $row[0];

?>