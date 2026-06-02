<?php
// Iniciamos php

session_start();
// Iniciamos uma sessão

if(!isset($_SESSION["usuario"])){
    header("Location: ../index.php");
    exit();
    // Usamos esse if para caso a sessão não esteja vinculada a um usuário, voltar a tela index (de login) e sair da home
}

include("../infra/db/connect.php");
// Adicionamos o arquivo connect

if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Usamos para verificar se  o metódo que está sendo usado é post

    $novoUsuario = $_POST['usuario'];
    $novaSenha = $_POST['senha'];

     // USamos "$" para criar uma variável, e pegamos o valor do formulário

    $sql = "INSERT INTO usuarios (usuario,senha) 
    VALUES ('$novoUsuario','$novaSenha')";  
    // Utilizamos o $sql para insert(inserir) valores nas tabelas do sql, no caso em usuario e senha, colocamos os "values" (valores) da nova variavel

    if($conn->query($sql) === TRUE){
        echo "<script> alert('Usuário cadastrado com sucesso!')</script>";
    }else{
        echo "<script> alert('Erro ao cadastrar')</script>";
    }
    // Usamos if e else para, caso essa conexão do banco der certo, informar a mensagem de sucesso, se não, erro
};

?>

<html lang="en">
    <!-- // iniciamos o html  -->
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
</head>
<body>
    <h3>Bem-Vindo! <?php echo $_SESSION["usuario"]; ?></h3>
    <!-- // Usamos h3 para a saudação e a sessão no php do usuario para mostrar o nome da pessoa junto  -->    

    <a href="logout.php"> Sair</a>
    <!-- // Trouxemos o href para linkar a página de logout ao clicar em sair  -->  

    <hr>
    <h4>Cadastro de Novo Usuário.</h4>
    <!-- // Usamos h4 para o título  -->

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
        <button type="submit">Cadastrar</button>
    </form>
    <hr>
    <?php
    
    include("components/table.php")

    ?>



</body>
</html>