<?php
    include("conexao.php");
    
    // Ver o login da pessoa
    // Inicie a sessão para acessar a variável de sessão verificar login
    session_start();
    //recebendo email
    $dados = $_SESSION['meusDados'];
  
    $imgUsuarioLogin = mysqli_query($banco, "select nome, img_perfil from cadastro where email='$dados';");
    $resultImgLogin = mysqli_fetch_row($imgUsuarioLogin);
    if ($resultImgLogin) {
        $imagem_blob = $resultImgLogin[1];
    } else {
        echo "Imagem não encontrada";
    }
    //*

    //fotos dos usuarios
    $imgBdLoginUsuarios = mysqli_query($banco, "select email, img_perfil from cadastro");
    $resultImgLoginsBd = mysqli_num_rows($imgBdLoginUsuarios);

    // Fechar a conexão
    mysqli_close($banco);

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Novo Cadastro</title>
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
                        <a class="nav-link" href="login.html">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="cadastro.html">cadastro</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.html">Pagina Inicial</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <section class="section_tela_inicial">
        <div class="img_nome_usuario">
            
                <?php
                   echo "<img src='$imagem_blob' alt='' width='140px'>";
                    echo "<h1>Dados : </h1>".$dados;
                ?>
        </div>
        <div class="abas">
            <div class="grid-container">
                <button class="grid-item">Temas de Estudo</button>
                <button class="grid-item">Bate Papo</button>
                <button class="grid-item">Materiais</button>
                <button class="grid-item">Usuários</button>

            </div>
        </div>

        <div class="usuarios">
            <h3>Usuários</h3>
            <div class="img_usuarios">
                <?php
                for ($i=0; $i < $resultImgLoginsBd; $i++) { 
                    $imgLoginUsuarios = mysqli_fetch_row($imgBdLoginUsuarios);
                    if($dados!=$imgLoginUsuarios[0]){
                        echo "<img src='$imgLoginUsuarios[1]' alt='' width='140px'>";
                    }
                
                }
                
                
                ?>
            </div>
        </div>

        <div class="opcoes">
            <a class="opcao_botao" href="editarPerfil.html">Editar Perfil</a>
            <a class="opcao_botao" href="">Gerenciar meus conteudos</a>
            <a class="opcao_botao" href="">Sair</a>
        </div>
    </section>


</body>

</html>