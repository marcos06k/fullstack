<?php
include("conexao.php");

// Ver o login da pessoa
// Inicie a sessão para acessar a variável de sessão verificar login
session_start();
//recebendo email
$dados = $_SESSION['meusDados'];



//fotos dos usuarios
$query_dadosUsuarios = mysqli_query($banco, "select nome, sobrenome, email, img_perfil from cadastro_professor");
$resultDadosLoginsBd = mysqli_num_rows($query_dadosUsuarios);

// Fechar a conexão
mysqli_close($banco);

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuários</title>
    <!-- CSS -->
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <!-- navbar -->
    <nav class="navbar navbar-expand-sm navbar-dark bg-info fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="assets/img/Logo.png" alt="Avatar Logo" style="width:50px;" class="rounded-pill">
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

    <div class="container_card_usuairios-usuarios">
        <div class="div_cards-usuarios">
            <?php
            for ($i = 0; $i < $resultDadosLoginsBd; $i++) {
                $dadosLoginUsuarios = mysqli_fetch_row($query_dadosUsuarios);
                if ($dados != $dadosLoginUsuarios[2]) {
                    echo "<div class='card_usuarios-usuarios'><img src='$dadosLoginUsuarios[3]' alt='' ><p>Professor: $dadosLoginUsuarios[0] $dadosLoginUsuarios[1]</p><p>$dadosLoginUsuarios[2]</p></div>";
                }
            }
            ?>
        </div>
    </div>


</body>

</html>