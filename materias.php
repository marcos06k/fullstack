<?php
include("conexao.php");

$queryArquivo = mysqli_query($banco, "select conteudo, arquivo from materia;");
$arquivoBd = mysqli_num_rows($queryArquivo);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Materiais</title>
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
    <section class="section_conteudo">
        <div class="cadastrar_materias">
            <form method="post" action="materiasCadastrar.php" enctype="multipart/form-data">
                <label class="espacamento_form" for="nomeArquivo_input">De o nome para o arquivo:</label>
                <input type="text" name="nomeArquivo" id="nomeArquivo_input">
                <label class="espacamento_form" for="arquivo_input">Selecione o arquivo</label>
                <input type="file" name="arquivo" id="arquivo_input" accept="arquivo/*">
                
                <input class="espacamento_form botao_form botao" type="submit" value="Enviar Arquivo" placeholder="Enviar Arquivo">
            </form>
        </div>

    </section>

    <section class="section_conteudo">
        <div class="grid-container_materias">
            <?php
            for ($i = 0; $i < $arquivoBd; $i++) {
                $arquivoBanco = mysqli_fetch_row($queryArquivo);
                echo "<div class='grid-item_materias materias'> <a href='$arquivoBanco[1]'>$arquivoBanco[0]</a> </div>";
            }
            ?>

        </div>
    </section>


</body>

</html>