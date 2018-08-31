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
                . "(?,?,?,STR_TO_DATE(?, '%d/%m/%Y'),?,?,?,?)";

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
        $cpf = $usuario->getCpf();
        $username = $usuario->getUsername();
        $senha = $usuario->getPassword();
        
        $stmt->bind_param("sssssssi", $primeiro_nome, $ultimoNome, $email, $data, $cpf, $username, $senha, $idTipoConta);
        
            $result = $stmt->execute();
           
            return $result;
            //return $this->login($usuario->getUsername(), $usuario->getPassword());
            
        }
    

}
