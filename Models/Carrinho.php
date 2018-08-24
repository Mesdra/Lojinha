<?php

/* 
  @author vinicius

 *  */

class Carrinho{
    
    private $usuario;
    private $produtos;
        
    function getUsuario(){
        
        return $this->usuario;
    }
        function getProdutos() {
        if(!isset($this->produtos)){
            $this->produtos = array();
        }
        return $this->produtos;
    }
    function setUsuario($usuario) {
        $this->usuario = $usuario;
    }
    function setProdutos($produtos) {
        $this->produtos = $produtos;
    }
    
}

