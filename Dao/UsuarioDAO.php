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

        $sql = "INSERT INTO usuario"
                . "(`primeiroNome`, `ultimoNome`, `email`, `dtNascimento`, `cpf`, `username`, `password`, `id_tipoConta`, `isAtivado`) "
                . "VALUES "
                . "(?,?,?,STR_TO_DATE(?, '%d/%m/%Y'),?,?,?,?,?)";

        //Preparando o statement
        if (!$stmt = $conn->prepare($sql)) {
            throw new Exception("Erro em preparar o statement");
        }

        //Setando os parâmetros (i significa que o parâmetro é integer)
        $isAtivado = true;
        $idTipoConta = 1;
        $stmt->bind_param("sssssssii", $usuario->getPrimeiroNome(), $usuario->getUltimoNome(), $usuario->getEmail(), $usuario->getDtNascimento(), $usuario->getCpf(), $usuario->getUsername(), $usuario->getPassword(), $idTipoConta, $isAtivado);

        try {
            $stmt->execute();
            return $this->login($usuario->getUsername(), $usuario->getPassword());
        } catch (Exception $ex) {
            return null;
        }
    }

}
