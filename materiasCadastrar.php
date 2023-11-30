<?php
include("conexao.php");

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Verificar se o campo 'arquivo' foi enviado
        if (isset($_FILES["arquivo"])) {
            $caminhoArquivo = $_FILES["arquivo"];
            echo "Caminho do arquivo recebido: " . $caminhoArquivo;
            $sql = mysqli_query($banco, "insert into materia values ('null, '$caminhoArquivo')");
            if ($sql) { 
                // echo "arquivo cadastrado com sucesso";
                echo"<META http-equiv='refresh' content='0,URL=index.html'>";
            } else {
                echo "Nâo foi possível cadastrar<br>Causa:".mysqli_error($banco) ;
            
            }
        
        } else {
            echo "Erro: Nenhum arquivo foi enviado.";
        }
    } else {
        echo "Erro: Método de requisição inválido.";
    }
    mysqli_close($banco);
?>