<?php

    include '../model/connect.php';

    $response->error = false;
    $response->data = 'ok';    

    session_start();
    if (isset($_SESSION['matricula'])) {
        $uploaddir = '/var/www/html/trabalhos/';
        $uploadfile = $uploaddir . basename($_FILES['userfile']['name'], '.pdf');
        $resumo = mysqli_real_escape_string($conn, trim(htmlspecialchars($_POST['resumo']))); //tratamento para tag <textarea>        
        $hash = md5($resumo);
        $caminho = '/trabalhos/'.basename($_FILES['userfile']['name'], '.pdf').$hash.'.pdf';             
    
        $queryCheckPath = $conn->prepare('SELECT caminho FROM projeto WHERE caminho = ?');
            
        
        if ($queryCheckPath) {
            $queryCheckPath->bind_param('s', $caminho);
            
            $queryCheckPath->execute();
            $queryCheckPath->store_result();
                
            $num = $queryCheckPath->num_rows;
            if ($num == 0) {
                        
                    $titulo = mysqli_real_escape_string($conn, trim($_POST["titulo"]));
                    $autor = mysqli_real_escape_string($conn, trim($_POST["autor"]));
                    $eixo = strtolower(mysqli_real_escape_string($conn, $_POST["eixo"]));
                    $ano = mysqli_real_escape_string($conn, $_POST["ano"]);
                    $evento = mysqli_real_escape_string($conn, trim($_POST["evento"]));
                    $status = mysqli_real_escape_string($conn, trim($_POST["status"])); 
                    
                    $query = $conn->prepare('INSERT INTO projeto (titulo, autor, resumo, caminho, eixo, evento, ano, matricula, situacao)
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?);
                    ');

                    if ($query) {
                        $query->bind_param('ssssssiis', $titulo, $autor, $resumo, $caminho, $eixo, $evento, $ano, $_SESSION['matricula'], $status);
                        $query->execute();                
                        if ($query->affected_rows < 0) {
                            $response->error = true;
                            $response->data = 'Erro, tente novamente ou contate o administrador';
                        } else{
                            if (!move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile.$hash.'.pdf')) {
                                $response->error = true;
                                $response->data = 'Erro ao subir arquivo';

                                $result = $conn->query("DELETE FROM projeto
                                WHERE caminho='".$caminho."'");
                            }
                        }
                    } else{
                        $response->error = true;
                        $response->data = 'Erro, tente novamente ou contate o administrador';
                    }
            } else{
                $response->error = true;
                $response->data = 'Arquivo ja existe';
            }
        } else{
            $response->error = true;
            $response->data = 'Erro, tente novamente ou contate o administrador';
        }
    } else {
        $response->error = true;
        $response->data = 'Sessão inexistente';
    }
    print_r(json_encode($response, JSON_UNESCAPED_UNICODE));
?>