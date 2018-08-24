<?php

class Produto {
    private $id;
    private $nome;
    private $descricao;
    private $tipoProduto;
    private $valor;
    private $qtdEstoque;
    private $pathImagem;
    
    private $minSizeNome = 4;
    private $maxSizeNome = 100;
    private $maxSizeDescricao = 255;
    
    function getId() {
        return $this->id;
    }
    function getNome(){
        return $this->nome;
    }
    
    function getDescricao() {
        return $this->descricao;
    }
    function getTipoProduto() {
        return $this->tipoProduto;
    }
    function getValor() {
        return $this->valor;
    }
    function getQtdEstoque() {
        return $this->qtdEstoque;
    }
    
    function getPathImagem() {
        return $this->pathImagem;
    }
    function setId($id) {
        $this->id = $id;
    }
    function setNome($nome){
        $sizeNome = strlen($nome);
        if($sizeNome > $this->maxSizeDescricao){
            throw new Exception("Nome deve possuir entre 4 e 100 caracteres",12);
        }
        $this->nome = $nome;
    }
    
    function setDescricao($descricao) {
        $sizeNome = strlen($descricao);
        if($sizeNome < $this->minSizeNome || $sizeNome > $this->maxSizeNome){
            throw new Exception("Descricao deve possuir entre 4 e 100 caracteres",9);
        }
        $this->descricao = $descricao;
    }
    function setTipoProduto($tipoProduto) {
        $this->tipoProduto = $tipoProduto;
    }
    function setValor($valor) {
        if($valor <= 0){
            throw new Exception("Valor deve ser acima de zero",10);
        }
        $this->valor = $valor;
    }
    function setQtdEstoque($qtdEstoque) {
        if($qtdEstoque < 0){
            throw new Exception("Quantidade em estoque não pode ser negativa",11);
        }
        $this->qtdEstoque = $qtdEstoque;
    }
    
    function setPathImagem($pathImagem) {
        $this->pathImagem = $pathImagem;
    }
}

