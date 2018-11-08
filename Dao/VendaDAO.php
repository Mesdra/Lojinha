<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include_once ('/opt/lampp/htdocs/Lojinha/Models/Usuario.php');
include_once ('/opt/lampp/htdocs/Lojinha/conecBanco/ConnectionPool.php');
include_once ('/opt/lampp/htdocs/Lojinha/Models/Carrinho.php');

class VendaDAO {

    public function cadastrar($idUsuario) {


        $conn = ConnectionPool::getConnection();


       $sql = "INSERT INTO venda"
            . "(`id_usuario`) "
            . "VALUES "
            . "($idUsuario)";


        if ($conn->query($sql) === TRUE) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $sql = "select * from venda order by(id_venda) desc limit 1";
        $resp = $conn->query($sql);
        $row = $resp->fetch_assoc();
        return $row['id_venda'];
    }

public function addvendaProduto($id_venda,$produtos,$quant){

    $conn = ConnectionPool::getConnection();


    $sql = "INSERT INTO venda_produto"
        . " VALUES "
        . "($produtos,$id_venda,$quant)";

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }


}
}