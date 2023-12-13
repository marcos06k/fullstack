<?php
session_start(); //Iniciando sessão para resgatar e compartilhar dados com outras pag

ob_start(); //Limpar o buffer de saida para evitar erro de redirecionamento
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat</title>
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

    <section class="section_batepapo-batepapo">

        <div class="div_batepapo_left">
            <img src="assets/img/logoEscola.png" alt="">
        </div>

        <div class="div_batepapo_right">
            <!-- Bem vindo com o nome do usuário vindo da pag. index.php -->
            <p>Bem-vindo: <span id="nome-usuario">
                    <?php echo $_SESSION['nome_usuario']; ?>
                </span> </p>


            <!-- Campo onde será exibido a mensagem com o nome do usuário  -->
            <div class="campo_mensagens-batepapo" id="campo_mensagens-batepapo">
                <span id="mensagem-chat"> </span>
            </div>

            <div class="digitar_enviar_mensagem-batepapo">
                <!-- Campo e botão para o usuário enviar mensagem -->
                <input type="text" name="mensagem" id="mensagem" placeholder="Digite a mensagem...">
                <input type="button" onclick="enviar()" value="enviar" id="botao_enviar">
            </div>
        </div>




    </section>

    <script>
        // resgatando o campo html que será impresso as mensagens 
        const mensagemChat = document.getElementById("mensagem-chat")

        // endereço do websocket
        const ws = new WebSocket('ws://localhost:8080')
        //realizar a conexão com websocket
        ws.onopen = (e) => {
            // console.log("Conectado!");
        }

        //receber a mensagem do websocket
        ws.onmessage = (mensagemRecebida) => {
            // ler mensagem enviada pelo websocket
            let resultado = JSON.parse(mensagemRecebida.data)

            // enviar a mensagem para o HTML, inserindo no final da lista de mensagens
            mensagemChat.insertAdjacentHTML('beforeend', ` ${resultado.mensagem}<br>`)
        }

        const enviar = () => {
            // resgatando o campo mensagem
            let mensagem = document.getElementById("mensagem")

            let nomeUsuario = document.getElementById("nome-usuario").textContent

            // criar um array de dados para enviar para websocket
            let dados = {
                mensagem: `${nomeUsuario}: ${mensagem.value}<br>`
            }
            // enviar a mensagem para o websocket
            ws.send(JSON.stringify(dados))

            // enviar a mensagem para o HTML, inserindo no final da lista de mensagens
            mensagemChat.insertAdjacentHTML('beforeend', `${nomeUsuario}: ${mensagem.value}<br>`)

            // limpar o campo de mensagem
            mensagem.value = ''
        }


        // scroll do overflow no chat ficar sempre na parte inferior conforme aumenta a quantidade de mensagem

        // var container = document.getElementById('campo_mensagens-batepapo');

        // // Função para rolar para a parte inferior
        // function scrollToBottom() {
        //     container.scrollTop = container.scrollHeight;
        // }

        // // Exemplo de adição de conteúdo (você pode chamar scrollToBottom() sempre que o conteúdo for adicionado)
        // function addContent() {
        //     var content = document.createElement('div');
        //     content.textContent = 'Novo conteúdo adicionado!';
        //     container.appendChild(content);
        //     // Rola para a parte inferior após adicionar conteúdo
        //     scrollToBottom();
        // }

        // // Exemplo: Adiciona conteúdo após um intervalo de tempo
        // setInterval(addContent, 0.5);  // Adiciona conteúdo a cada 2 segundos (exemplo)
    </script>
</body>

</html>