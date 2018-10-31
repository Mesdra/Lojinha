<?php
/* 
  @author vinicius

 *  */

class Carrinho{
    
    private $usuario;
    private $produtos = array();
    private $quant = array();
    
    function addAoCarrinho($produto,$quantidade){
        
        for($i =0; $i <= 50; $i++ ){  
            
            if(empty($this->produtos[$i])){
                $this->produtos[$i]= $produto;
                $this->quant[$i]= $quantidade;
                echo $produto;
                 $s_Car = serialize($this);
                $_SESSION['carrinhoUsuario'] = $s_Car;
                return;
            }
            echo $this->produtos[$i];
        }
    }
  
    
        
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

