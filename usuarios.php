<?php

class Usuario extends PDO{
    private $pdo;
    public $msgErro = "";//ok

    public function __construct()
    {   try{
        $this->pdo = new PDO("mysql:dbname=projeto;host=localhost","root","");
        echo "deu certo corno";

    }catch (PDOException $r){
        $this->msgErro = $r->getMessage();
        echo "deu errado";
    }
    }

    public function cadastrar($nome,$telefone,$email,$senha){
        //verificar se tem email cadastrado no bd;
        $sql = $this->pdo->prepare("SELECT id_usuario FROM usuarios
        WHERE email = :e");
        $sql->bindValue(":e",$email);//
        $sql->execute();
        if($sql->rowCount()>0){
            return false; //usuario já está cadastrado!
        }else{
            //caso não esteja, vamos cadastrar;
             $sql = $this->pdo->prepare("INSERT INTO usuarios(nome,
             telefone,email,senha) VALUES (:n, :t, :e, :s)");
             $sql->bindValue(":n",$nome);
             $sql->bindValue(":t",$telefone);
             $sql->bindValue(":e",$email);
             $sql->bindValue(":s",md5($senha));
             $sql->execute();
             return true;//tudo
        }
    }

    public function logar($email,$senha){
        //verificar e o email e a senha estão cadastrados.se sim
        $sql = $this->pdo->prepare("SELECT id_usuario FROM usuarios WHERE
        email = :e AND senha = :s");
         $sql->bindValue(":e",$email);
         $sql->bindValue(":s",md5($senha));
         $sql->execute();

         if($sql->rowCount()>0){
            //entrar no sistema(iniciar: sessão);
            $dado = $sql->fetch();
            session_start();
            $_SESSION["id_usuario"] = $dado["id_usuario"];
            return true; //pessoa fez o login com sucesso
         }else{
            return false; //não foi possivel fazer loguin
         }
    }
}

?>