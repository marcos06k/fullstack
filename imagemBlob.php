<?php
    include("conexao.php");
    include("verificarLogin.php");
    
    
    $sql = mysqli_query($banco, "select img_perfil from cadastro where email='$email_input';");
    $result = mysqli_fetch_row($sql);
    
    if ($result) {
        $imagem_blob = $result[0];
    
        // Definir o cabeçalho para indicar que é uma imagem
        header('Content-Type: image/png'); // Ajuste conforme o tipo de imagem
    
        // Exibir a imagem diretamente
        echo $imagem_blob;
    } else {
         http_response_code(404);
        echo "Imagem não encontrada";
    }
    
    // Fechar a conexão
    mysqli_close($banco);
?>