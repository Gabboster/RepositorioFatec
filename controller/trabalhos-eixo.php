<?php 
    function getTrabalhosPorEixo($conn, $eixo){
        
        $query = $conn->prepare("SELECT titulo, resumo, autor, ano, id, caminho FROM projeto WHERE eixo = ?");
        
        if ($query) {
            
            $query->bind_param('s', $eixo);
            $query->execute();
            $query->store_result();
            
            $num = $query->num_rows;

            if($num > 0){
                $query->bind_result($titulo, $resumo, $autor, $ano, $id, $caminho);
                
                $rows = array();
    
                while ($query->fetch()) {
                    $obj = new stdClass();
                    $obj->titulo = $titulo;
                    $obj->resumo = $resumo;
                    $obj->autor = $autor;
                    $obj->ano = $ano;
                    $obj->id = $id;
                    $obj->caminho = $caminho;
            
                    array_push($rows, $obj);
                }
                return $rows;
            } else{
                return 'nada';
            } 
        } else{
            return 'nada';
        }
    } 
?>