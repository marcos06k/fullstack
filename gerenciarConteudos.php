<?php
    include("conexao.php");
    
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Verificar se o campo 'arquivo' foi enviado
            if (isset($_FILES['arquivo'])) {
                $nomeArquivo = $_POST['nomeArquivo'];
                $email_login = $_SESSION['meusDados'];
    
                $caminhoArquivo = $_FILES['arquivo']['name'];
                echo "Caminho do arquivo recebido: " . $caminhoArquivo;
                
                $sql = mysqli_query($banco, "insert into materia values (null,'$nomeArquivo', 'assets/img/imgUsuers/$caminhoArquivo', NOW(), 2)");
                if ($sql) { 
                    // echo "arquivo cadastrado com sucesso";
                    echo"<META http-equiv='refresh' content='0,URL=materias.php'>";
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

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>GerenciarConteudos</title>
     <!-- CSS -->
     <link rel="stylesheet" href="assets/css/style.css">
        <!-- bootstrap -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
     <!-- navbar -->
     <nav class="navbar navbar-expand-sm navbar-dark bg-dark fixed-top">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">
                    <img src="assets/img/Logo.png" alt="Avatar Logo" style="width:70px;" class="rounded-pill">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mynavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
                <div class="collapse navbar-collapse" id="mynavbar">
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="index.php">Home</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <section class="section_conteudo">
        <div class="cadastrar_materias">
            <form method="post" action="gerenciarConteudos.php" enctype="multipart/form-data">
                <label class="espacamento_form" for="nomeArquivo_input">De o nome para o arquivo:</label>
                <input type="text" name="nomeArquivo" id="nomeArquivo_input">
                <label class="espacamento_form" for="arquivo_input">Selecione o arquivo</label>
                <input type="file" name="arquivo" id="arquivo_input" accept="arquivo/*">
                
                <input class="espacamento_form botao_form botao" type="submit" value="Enviar Arquivo" placeholder="Enviar Arquivo">
            </form>
        </div>

    </section>
</body>
</html>