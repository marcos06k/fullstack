<?php 
    //importação dos dados do BD mysql
    include("conexao.php");
    //valores digitados na interface (index.HTML)
    $nome = $_POST["nome"];
    $sobrenome = $_POST["sobrenome"];
    $email = $_POST["email"];
    $telefone = $_POST["telefone"];
    $curso = $_POST["curso"];


    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Verificar se o campo 'imagem' foi enviado
        if (isset($_FILES["imagem"])) {
            $caminhoArquivo = $_FILES["imagem"]["name"];
            // echo "Caminho da imagem recebido: " . $caminhoArquivo;
            $email = mysqli_query($banco, "update cadastro_professor set nome='$nome', sobrenome='$sobrenome', email='$email', telefone='$telefone', curso='$curso', img_perfil='assets/img/imgUsuers/$caminhoArquivo' where email='$email'");
            
        } else {
            echo "Erro: Nenhuma imagem foi enviada.";
        }
    } else {
        echo "Erro: Método de requisição inválido.";
    }

    mysqli_close($banco);
?>