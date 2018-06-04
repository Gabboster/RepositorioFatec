<?php
include '../model/connect.php';
$response = array(
    'error' => false,
    'data' => "ok"
);


    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = mysqli_real_escape_string($conn, trim($_POST["email"]));
        $matricula = mysqli_real_escape_string($conn, trim($_POST["matricula"]));
        $matricula = intval($matricula);
        $nome = mysqli_real_escape_string($conn, trim($_POST["name"]));
        $senha = mysqli_real_escape_string($conn, trim($_POST["password"]));
        $confirmed = mysqli_real_escape_string($conn, trim($_POST["confirmed-password"]));

        $hashed = password_hash($senha, PASSWORD_BCRYPT);
        $nameUpperCase = strtoupper($nome);

        $query = $conn->prepare("UPDATE usuario SET senha = ?, ativa = ? WHERE matricula = ? AND email = ? AND nome = ? ");
        
        if ($query) {
            $ativa = 1;
            if($query->bind_param("siiss", $hashed, $ativa, $matricula, $email, $nome)){
                if(!$query->execute()){
                    
                    print_r(json_encode($response, JSON_UNESCAPED_UNICODE));                    
                } else{
                    if ($query->affected_rows > 0) {
                        print_r(json_encode($response, JSON_UNESCAPED_UNICODE));
                    } else{
                        $response = array(
                            'error' => true,
                            'data' => "Dados não encontrados"
                        );
                        print_r(json_encode($response, JSON_UNESCAPED_UNICODE));
                    }
                }
            } else{
                $response = array(
                    'error' => true,
                    'data' => "Erro no servidor"
                );
                print_r(json_encode($response, JSON_UNESCAPED_UNICODE));
            }           
        }else{
            $response = array(
                'error' => true,
                'data' => "Erro no servidor"
            );
            print_r(json_encode($response, JSON_UNESCAPED_UNICODE));
        }
    } 


mysqli_close($conn);

?>