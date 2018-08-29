<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Usuario {
    private $id;
    private $primeiroNome;
    private $ultimoNome;
    private $email;
    private $dtNascimento;
    private $cpf;
    private $username;
    private $password;
    //Tipo de fetch: eager
    private $tipoConta;

    private $minSizeNome = 4;
    private $maxSizeNome = 30;
    
    function getPassword() {
        return $this->password;
    }
    function getId() {
        return $this->id;
    }
    function getPrimeiroNome() {
        return $this->primeiroNome;
    }
    function getUltimoNome() {
        return $this->ultimoNome;
    }
    function getEmail() {
        return $this->email;
    }
    function getDtNascimento() {
        return $this->dtNascimento;
    }
    function getCpf() {
        return $this->cpf;
    }
    function getUsername() {
        return $this->username;
    }
    function getTipoConta() {
        return $this->tipoConta;
    }
    function setTipoConta($tipoConta) {
        $this->tipoConta = $tipoConta;
    }
    
    function setId($id) {
        $this->id = $id;
    }
    function setPrimeiroNome($primeiroNome) {
        $sizeNome = strlen($primeiroNome);
        if($sizeNome < $this->minSizeNome || $sizeNome > $this->maxSizeNome){
            throw new Exception("Nome deve possuir entre 4 e 30 caracteres",1);
        }
        $this->primeiroNome = $primeiroNome;
    }
    function setUltimoNome($ultimoNome) {
        $sizeNome = strlen($ultimoNome);
        if($sizeNome < $this->minSizeNome || $sizeNome > $this->maxSizeNome){
            throw new Exception("Ultimo nome deve possuir entre 4 e 30 caracteres",2);
        }
        $this->ultimoNome = $ultimoNome;
    }
    function setEmail($email) {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new Exception("Email inválido",3);
        }        
        $this->email = $email;
    }
    function setDtNascimento($dtNascimento) {
        
        $this->dtNascimento = $dtNascimento;
    }
    function setCpf($cpf) {
        $this->cpf = $cpf;
    }
    function setUsername($username) {
        $sizeNome = strlen($username);
        if($sizeNome < $this->minSizeNome || $sizeNome > $this->maxSizeNome){
            throw new Exception("Senha deve possuir entre 4 e 30 caracteres",6);
        }
        $this->username = $username;
    }
    
    function setPassword($password) {
        $sizeNome = strlen($password);
        if($sizeNome < $this->minSizeNome || $sizeNome > $this->maxSizeNome){
            throw new Exception("Senha deve possuir entre 4 e 30 caracteres",7);
        }
        $this->password = md5($password);
    }
        
    
    
}