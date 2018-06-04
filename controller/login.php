<?php
include '../model/connect.php';
session_start();
$response = array(
    'error' => false,
    'data' => "ok"
);

 if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = mysqli_real_escape_string($conn, trim($_POST["email"]));
    $senha = mysqli_real_escape_string($conn, trim($_POST["password"]));

    $query = $conn->prepare('SELECT senha, matricula, nome, cargo FROM usuario WHERE email = ? AND ativa = ?');
    if ($query) {
        $ativa = 1;
        $query->bind_param("si", $email, $ativa);

        $query->execute();

        $query->bind_result($senhaHash, $matricula, $nome, $cargo);
        $query->fetch();

        if (strlen($senhaHash) > 0) {
            if (password_verify($senha, $senhaHash)) {
                $_SESSION["isLogged"] = true;
                $_SESSION["matricula"] = $matricula;
                $_SESSION["nome-completo"] = $nome;
                $primeiroNome = explode(" ", $nome);
                $_SESSION["nome"] = $primeiroNome[0];
                $_SESSION["cargo"] = $cargo;
            } else {
                $response = array(
                    'error' => true,
                    'data' => "E-mail ou senha Incorreta"
                );
            }
        } else{
            $response = array(
                'error' => true,
                'data' => "E-mail ou senha Incorreta"
            );
        }
    } else {
        $response = array(
            'error' => true,
            'data' => "Erro no servidor"
        );
    }
 } else {
    $response = array(
        'error' => true,
        'data' => "Erro no servidor"
    );
 }

 print_r(json_encode($response, JSON_UNESCAPED_UNICODE));
?>