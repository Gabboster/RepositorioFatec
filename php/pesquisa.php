<?php
header('CONTENT-TYPE: text/html; charset=utf-8');
$servername = "localhost";
$username = "root";
$password = "123";
$dbname = "repositorio";
$valorPesquisa = $_GET["valor"];

$conn = new mysqli($servername, $username, $password, $dbname);
mysqli_set_charset($conn,"utf8");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = 'SELECT titulo, resumo, autor, ano, id, caminho FROM projeto WHERE titulo LIKE "'. $valorPesquisa.'" OR autor LIKE "'.$valorPesquisa.'" OR id LIKE "'.$valorPesquisa.'"';
$result = $conn->query($sql);

$rows = array();

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $obj = null;
        $obj->titulo = $row['titulo'];
        $obj->resumo = $row['resumo'];
        $obj->autor = $row['autor'];
        $obj->ano = $row['ano'];
        $obj->id = $row['id'];
        $obj->caminho = $row['caminho'];

        array_push($rows, $obj);
    }
    print_r(json_encode($rows, JSON_UNESCAPED_UNICODE));
    
} 

?>