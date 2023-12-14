<?php
// Inicie a sessão para acessar a variável de sessão verificar login
    session_start();
    include("conexao.php");
    
    //buscando por meio de uma seção o email do usuario logado
    
    $email_login = $_SESSION['meusDados'];
    
    //verifica se a vinda do metodo for post 
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

            // Verificar se o campo 'arquivo' foi enviado
            if (isset($_FILES['arquivo'])) {
                //pegando o arquivo por metodo post do html
                $nomeArquivo = $_POST['nomeArquivo'];
                
                //query para pegar o id do usuario no banco de dados conforme seu email
                $query_dadosUsuario_login = mysqli_query($banco, "select id_cadastro_professor from cadastro_professor where email='$email_login';");
                //pegando o dado que a query achou
                $dadosUsuario_login = mysqli_fetch_row($query_dadosUsuario_login);

                //pegando o caminho do arquivo
                $caminhoArquivo = $_FILES['arquivo']['name'];
                //inserindo a materia no banco de dados
                $sql = mysqli_query($banco, "insert into materia values (null,'$nomeArquivo', 'assets/img/imgUsuers/$caminhoArquivo', NOW(), '$dadosUsuario_login[0]')");

                if ($sql) { 
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
    
        //query para pegar o id do usuario no banco de dados conforme seu email
        $query_dadosUsuarioProfessor = mysqli_query($banco, "select id_cadastro_professor from cadastro_professor where email='$email_login';");
        //pegando o dado que a query achou
        $dadosUsuarioProfessor = mysqli_fetch_row($query_dadosUsuarioProfessor);
    
        //query para pegar os dados da classe materia
        $queryArquivoProfessor = mysqli_query($banco, "select titulo, arquivo, data_materia, id_cadastro_professor from materia where id_cadastro_professor='$dadosUsuarioProfessor[0]';");
        //pegando o numero total de linhas que a query conseguiu pegar
        $arquivoProfessorBd = mysqli_num_rows($queryArquivoProfessor);

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
     <nav class="navbar navbar-expand-sm  navbar-dark  fixed-top" style="background-color: rgb(1, 127, 201);">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="assets/img/logoEscola.png" alt="Avatar Logo" style="width:50px;" class="rounded-pill">
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
                <label class="espacamento_form" for="nomeArquivo_input">Nome do arquivo:</label>
                <input type="text" name="nomeArquivo" id="nomeArquivo_input">
                <input type="file" name="arquivo" id="arquivo_input" accept="arquivo/*">
                
                <input class="espacamento_form botao_form botao" type="submit" value="Enviar Arquivo" placeholder="Enviar Arquivo">
            </form>
        </div>
    </section>

    <section class="section_conteudo">
        <div class="grid-container_materias">
            <?php
            for ($i = 0; $i < $arquivoProfessorBd; $i++) {
                //pega os dados contido em cada linha
                $arquivoProfessorBanco = mysqli_fetch_row($queryArquivoProfessor);

                $query_dadosProfessorBanco = mysqli_query($banco, "select nome, sobrenome from cadastro_professor where id_cadastro_professor='$arquivoProfessorBanco[3]';");
                $dadosProfessorBanco = mysqli_fetch_row($query_dadosProfessorBanco);

                // converter uma data vinda do MYSQL para o formato PT-BR
                $data = implode("/",array_reverse(explode("-",$arquivoProfessorBanco[2])));

                //adiciona as materias na tela
                echo "<div class='grid-item_materias materias'> Prof: $dadosProfessorBanco[0] $dadosProfessorBanco[1] <br> Conteudo:   <a href='$arquivoProfessorBanco[1]'> $arquivoProfessorBanco[0] </a> <br> $data </div>";
            }
            ?>

        </div>
    </section>
    
</body>
</html>