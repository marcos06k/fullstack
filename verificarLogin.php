<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Atualizar dados</title>
</head>

<body>
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
        echo"<META http-equiv='refresh' content='0,URL=index.html'>";
    } else {
        echo"Opa... Ocorreu algum erro de digitação";
        echo"<META http-equiv='refresh' content='0,URL=login.html'>";
    }
    

    mysqli_close($banco);
    ?>
</body>

</html>