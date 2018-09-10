<?php session_start();

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include_once ('../Models/Usuario.php');
include_once ('../conecBanco/ConnectionPool.php');

class UsuarioDAO {

    public function cadastrar($usuario) {
        if (get_class($usuario) != 'Usuario') {
            return null;
        }
        
   
        $conn = ConnectionPool::getConnection();
        
        $idTipoConta = 1;
        $primeiro_nome = $usuario->getPrimeiroNome();
        $ultimoNome = $usuario->getUltimoNome();
        $email = $usuario->getEmail();
        $data = $usuario->getDtNascimento();
        $cpf = $usuario->getCpf();
        $username = $usuario->getUsername();
        $senha = $usuario->getPassword();
        
        
        $sql = "INSERT INTO usuario "
                . "(`primeiro_nome`, `ultimo_nome`, `email`, `data_nascimento`, `cpf`, `username`, `senha`, `tipo_Conta`) "
                . "VALUES "
                . "('".$primeiro_nome."','".$ultimoNome."','".$email."','".$data."','".$cpf."','".$username."','".$senha."',".$idTipoConta.")";

        if ($conn->query($sql) === TRUE) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
           
           header('Location: ../cadastro/indexLogin.php');
            
        }
         public function login($username, $password){
             $passwordMd5 = md5($password);
        $conn = ConnectionPool::getConnection();
        
        $sql = "SELECT u.id_usuario, u.primeiro_nome, u.ultimo_nome,u.email, u.data_nascimento, u.cpf, u.username, u.tipo_Conta FROM usuario u WHERE u.username = '".$username."' AND u.senha = '".$passwordMd5."';";
      
       $result = $conn->query($sql);
       
       if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
          echo "id: " . $row["id_usuario"]. " - Name: " . $row["primeiro_nome"]. " " . $row["ultimo_nome"]. "<br>";
           $usuario = new Usuario();
           $usuario->setCpf($row["cpf"]);
           $usuario->setDtNascimento($row["data_nascimento"]);
           $usuario->setEmail($row["email"]);
           $usuario->setId($row["id_usuario"]);
           $usuario->setPrimeiroNome($row["primeiro_nome"]);
           $usuario->setTipoConta($row["tipo_Conta"]);
           $usuario->setUltimoNome($row["ultimo_nome"]);
           $usuario->setUsername($row["username"]);
           
          
        }
        $s_Obj = serialize($usuario);
        $_SESSION['usuarioLogado'] = $s_Obj;
        return true;
    } else {
        echo "0 resultss";
        return false;
    }
    $conn->close();
           }
        
}