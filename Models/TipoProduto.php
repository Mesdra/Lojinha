<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class TipoProduto {
    private $id;
    private $descricao;
    
    private $minSizeNome = 4;
    private $maxSizeNome = 30;
    
    function getId() {
        return $this->id;
    }
    function getDescricao() {
        return $this->descricao;
    }
    function setId($id) {
        $this->id = $id;
    }
    function setDescricao($descricao) {
        $sizeNome = strlen($descricao);
        if($sizeNome < $this->minSizeNome || $sizeNome > $this->maxSizeNome){
            throw new Exception("Descrição deve possuir entre 4 e 30 caracteres",8);
        }
        $this->descricao = $descricao;
    }
}