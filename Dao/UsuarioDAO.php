<?php

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

        $sql = "INSERT INTO usuario "
                . "(`primeiro_nome`, `ultimo_nome`, `email`, `data_nascimento`, `cpf`, `username`, `senha`, `tipo_Conta`) "
                . "VALUES "
                . "(?,?,?,STR_TO_DATE(?,'%d-%m-%y'),?,?,?,?)";

        //Preparando o statement
        if (!$stmt = $conn->prepare($sql)) {
            throw new Exception("Erro em preparar o statement");
        }

        //Setando os parâmetros (i significa que o parâmetro é integer)
        $idTipoConta = 1;
        $primeiro_nome = $usuario->getPrimeiroNome();
        $ultimoNome = $usuario->getUltimoNome();
        $email = $usuario->getEmail();
        $data = $usuario->getDtNascimento();
        echo $data; 
        $cpf = $usuario->getCpf();
        $username = $usuario->getUsername();
        $senha = $usuario->getPassword();
        
        $stmt->bind_param("sssssssi", $primeiro_nome, $ultimoNome, $email, $data, $cpf, $username, $senha, $idTipoConta);
        
            $result = $stmt->execute();
           
            return $result;
            //return $this->login($usuario->getUsername(), $usuario->getPassword());
            
        }
        
         
    public function login($username, $password){
        $conn = ConnectionPool::getConnection();
        
        $sql = "SELECT u.id,"
                . " u.primeiro_nome,"
                . " u.ultimo_nome,"
                . " u.email,"
                . " DATE_FORMAT(u.dtNascimento,'%d/%m/%Y') as data_nascimento,"
                . " u.cpf,"
                . " u.username,"
                . " u.tipoConta,"
                . " FROM usuario u "
                . " WHERE u.username = ? AND u.password = md5(?)";
        
        //Preparando o statement
        if(!$stmt = $conn->prepare($sql)){ throw new Exception("Erro em preparar o statement");}
        
        //Setando os parâmetros (i significa que o parâmetro é integer)
        $stmt->bind_param("ss",$username,$password);
           
        //executa o statement
        $stmt->execute();
        
        //Dá bind em cada uma das colunas (todas as colunas precisam de bind)
        //Password será ignorado na hora de criar o objeto aqui, pois ele não será usado em outro lugar além de login
        $stmt->bind_result($id,$primeiroNome,$ultimoNome,$email,$dtNascimento,$cpf,$username,$idTipoConta,$isAtivado);
        
            
        //fetch() pega a prox linha e seta as variáveis indicadas no bind
        if($stmt->fetch()){
            $usuario = new Usuario();
            $usuario->setId($id);
            $usuario->setPrimeiroNome($primeiroNome);
            $usuario->setUltimoNome($ultimoNome);
            $usuario->setEmail($email);
            $usuario->setDtNascimento($dtNascimento);
            $usuario->setCpf($cpf);
            $usuario->setUsername($username);
            
            //Fetch recursivo de objeto interno
            $tipoConta = new TipoConta();
            $tipoConta->setId($idTipoConta);
            $tipoContaDAO = new TipoContaDAO();
            $tipoConta = $tipoContaDAO->find($tipoConta);
            $usuario->setTipoConta($tipoConta);     
            
            return $usuario;
        }
        else{
            return null;
        }
    }
     
    

}
