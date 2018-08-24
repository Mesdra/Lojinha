<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Venda {
    private $id;
    private $usuario;
    //lista muitos pra muitos
    private $produtos;
    private $valor;
    private $dtCompra;
    
    function getId() {
        return $this->id;
    }
    function setId($id) {
        $this->id = $id;
    }
    
    function getUsuario() {
        return $this->usuario;
    }
    function getProdutos() {
        return $this->produtos;
    }
    function getValor() {
        return $this->valor;
    }
    function getDtCompra() {
        return $this->dtCompra;
    }
    function setUsuario($usuario) {
        $this->usuario = $usuario;
    }
    function setProdutos($produtos) {
        $this->produtos = $produtos;
    }
    function setValor($valor) {
        if($valor <= 0){
            throw new Exception("Valor não pode ser menor ou igual a R\$0,00",13);
        }
        $this->valor = $valor;
    }
    function setDtCompra($dtCompra) {
        if(!$this->isDate($dtCompra)){
            throw new Exception("Data inválida",14);
        }
        $this->dtCompra = $dtCompra;
    }
    
    private function isDate($date){
        return 1 === preg_match('~^(((0[1-9]|[12]\\d|3[01])\\/(0[13578]|1[02])\\/((19|[2-9]\\d)\\d{2}))|((0[1-9]|[12]\\d|30)\\/(0[13456789]|1[012])\\/((19|[2-9]\\d)\\d{2}))|((0[1-9]|1\\d|2[0-8])\\/02\\/((19|[2-9]\\d)\\d{2}))|(29\\/02\\/((1[6-9]|[2-9]\\d)(0[48]|[2468][048]|[13579][26])|((16|[2468][048]|[3579][26])00))))$~',
            $date
        );      
    }
}