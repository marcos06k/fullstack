
    <?php
        //importação dos dados do BD mysql
        include("conexao.php");
        //valores digitados na interface (index.HTML)
        $nome = $_POST["nome"];
        $sobrenome = $_POST["sobrenome"];
        $email = $_POST["email"];
        $telefone = $_POST["telefone"];
        $curso = $_POST["curso"];
        $senha = $_POST["senha"];
        //query do sql
        $sql = mysqli_query($banco,"insert into cadastro_professor values(null,'$nome','$sobrenome','$email','$telefone','$curso','$senha','');");
        if ($sql) { 
            // echo "Contato cadastrado com sucesso";
            echo"<META http-equiv='refresh' content='0,URL=index.html'>";
        } else {
            // echo "Nâo foi possível cadastrar<br>Causa:".mysqli_error($banco) ;
            
        }
        mysqli_close($banco);

    ?>
