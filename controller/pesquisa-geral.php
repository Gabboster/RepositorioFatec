<?php
    include '../model/connect.php';

    $valorPesquisa = $_GET["valor-pesquisa"];

    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        $query = $conn->prepare("SELECT titulo, resumo, autor, ano, id, caminho FROM projeto WHERE (autor LIKE ? OR titulo LIKE ? OR eixo LIKE ? OR CAST(id as CHAR) LIKE ? OR CAST(ano as CHAR) LIKE ?)");
        
        if ($query) {
            $valorPesquisaNumero = intval($valorPesquisa);
            $valorPesquisa = '%'.$valorPesquisa.'%';
            $query->bind_param('sssss', $valorPesquisa, $valorPesquisa, $valorPesquisa, $valorPesquisa, $valorPesquisa);
            $query->execute();
            $query->store_result();
            
            $num = $query->num_rows;

            if($num > 0){
                $query->bind_result($titulo, $resumo, $autor, $ano, $id, $caminho);
                
                $rows = array();
    
                while ($query->fetch()) {
                    $obj = null;
                    $obj->titulo = $titulo;
                    $obj->resumo = $resumo;
                    $obj->autor = $autor;
                    $obj->ano = $ano;
                    $obj->id = $id;
                    $obj->caminho = $caminho;
            
                    array_push($rows, $obj);
                }
                print_r(json_encode($rows, JSON_UNESCAPED_UNICODE));
            } else{
                print_r(null);
            }
            
        }
    }

?>