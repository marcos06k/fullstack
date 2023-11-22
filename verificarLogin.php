
    <?php
    include("conexao.php");

    // recebendo do html (front)
    $email_input = $_POST["email_input"];
    $senha_input = $_POST["senha_input"];


    $email = mysqli_query($banco, "select email from cadastro where email='$email_input' and senha='$senha_input';");
    $senha = mysqli_query($banco, "select senha from cadastro where email='$email_input' and senha='$senha_input';");
    $registro_email = mysqli_fetch_row($email);
    $registro_senha = mysqli_fetch_row($senha);

    if ($email_input == $registro_email[0] && $senha_input == $registro_senha[0]) {
        echo "<META http-equiv='refresh' content='0,URL=index.php'>";
    } else {
        echo "Opa... Ocorreu algum erro de digitação";
        echo "<META http-equiv='refresh' content='0,URL=login.html'>";
    }

    session_start();

    $dados = $registro_email[0];

    $_SESSION['meusDados'] = $dados;

    mysqli_close($banco);
    ?>


