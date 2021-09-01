<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projeto Login</title>
    <link rel="stylesheet" href="css/estilo1.css">
</head>
<body>
    <div id="corpo-form-cad">
    <h1>Cadastrar</h1>
        <form method="$_POST">
            <input type="text" name="nome" placeholder="Nome" maxlength="30">
            <input type="number" name="telefone" placeholder="Telefone" maxlength="30"> 
            <input type="email" name="email" placeholder="Usuario" maxlength="40">
            <input type="password" name="senha" placeholder="Senha" maxlength="32">
            <input type="password" name="confsenha" placeholder="Confirmar Senha" maxlength="32">
            <input id="btn" type="submit" value="CADASTRAR">
         </form>
    </div>

    <?php
    require_once("usuarios.php");
    $us = new Usuario;
    if(isset($_POST["nome"])){
        $nome = addslashes($_POST["nome"]);
        $telefone = addslashes($_POST["telefone"]);
        $email = addslashes($_POST["email"]);
        $senha = addslashes($_POST["senha"]);
        $confirmarSenha = addslashes($_POST["confsenha"]);
        //verificar se esta preenchido
        if(!empty($nome) && !empty($telefone) && !empty($email)&&
        !empty($senha)&&!empty($confirmarSenha)){
            $us->__construct();
            if($us->msgErro == "")//se ta tudo de boa
            {
                if($senha == $confirmarSenha){
                    if($us->cadastrar($nome,$telefone,$email,$senha)){
                        echo "Cadastrado com sucesso! acesse para entrar";
                    }else{
                        echo "email já cadastrado";
                    }
                }else{
                    echo "senha não confirma";
                }
            }
        }else{
            echo "Preencha todos os campos!";
        }
    }
    ?>
</body>
</html>