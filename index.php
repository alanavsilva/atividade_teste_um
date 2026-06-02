<?php
    // Iniciamos php

    session_start(); 
    // Iniciamos uma sessão

    include("infra/db/connect.php");
    // Adicionamos o arquivo connect

    if($_SERVER['REQUEST_METHOD'] == "POST"){
        // Usamos para verificar se  o metódo que está sendo usado é post

        $usuario = $_POST["usuario"];
        $senha = $_POST["senha"];
        // USamos "$" para criar uma variável, e pegamos o valor do formulário
        
        $sql = "SELECT * FROM usuarios WHERE usuario = '$usuario' AND senha = '$senha'";
        // Buscamos nos registros de usuário se aquele usuario e senha informados existem

        $resultado = $conn->query($sql);
        // Vemos se existe no banco de dados

        if ($resultado->num_rows > 0){
            // Vemos quantas linhas no banco de dados exite com esses resultados, e usando if, caso tenha execta o código

            $_SESSION["usuario"] = $usuario;
            // Salvamos o nome de usuário na sessão

            header("Location: public/home.php");
            // Encaminhamos para tela de home

            exit();
            // Ele sai da tela de login

        }else{
            $erro = "Usuário ou senha inválidos!";
            // Caso não tenha, informamos que algum dado está errado

        }

    }
?>

<html lang="en">
    <!-- // iniciamos o html  -->
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <h1>Sitema de Login Simples</h1>
    <!-- // Usamos h1 para o título  -->

    <form method="POST">
        <label>Usuário:</label>
        <input type="text" name="usuario">
        <br>
        <label>Senha:</label>
        <input type="password" name="senha">
        <br>
        <!-- // Usamos form para abrir um formulário, e o method para ser no método "post" -->
        <?php

        // Iniciamos em php de novo para casos de erro 

            if(isset($erro)){
                echo $erro;
            };
        
        ?>

        <br>
        <button type="submit">Entrar</button>
    </form>

</body>
</html>