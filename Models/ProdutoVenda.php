<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class ProdutoVenda {
    private $produto;
    private $venda;
    private $valor;
    private $quantidade;
    
    function getProduto() {
        return $this->produto;
    }
    function getVenda() {
        return $this->venda;
    }
    function getValor() {
        return $this->valor;
    }
    function getQuantidade() {
        return $this->quantidade;
    }
    function setProduto($produto) {
        $this->produto = $produto;
    }
    function setVenda($venda) {
        $this->venda = $venda;
    }
    function setValor($valor) {
        $this->valor = $valor;
    }
    function setQuantidade($quantidade) {
        $this->quantidade = $quantidade;
    }
}