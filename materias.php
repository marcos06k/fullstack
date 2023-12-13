<?php
session_start();
include("conexao.php");

$queryArquivo = mysqli_query($banco, "select titulo, arquivo, data_materia, id_cadastro_professor from materia;");
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
        <div class="grid-container_materias">
            <?php
            for ($i = 0; $i < $arquivoBd; $i++) {
                $arquivoBanco = mysqli_fetch_row($queryArquivo);

                $queryProfessor = mysqli_query($banco, "select nome, sobrenome from cadastro_professor where $arquivoBanco[3];");
                $dadosProfessor = mysqli_fetch_row($queryProfessor);

                // converter uma data vinda do MYSQL para o formato PT-BR
                $data = implode("/",array_reverse(explode("-",$arquivoBanco[2])));

                echo "<div class='grid-item_materias materias'> Prof: $dadosProfessor[0] $dadosProfessor[1] <br> Conteudo:   <a href='$arquivoBanco[1]'> $arquivoBanco[0] </a> <br> $data </div>";
            }
            ?>

        </div>
    </section>


</body>

</html>