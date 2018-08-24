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
    private $isAtivado;
    
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
    
    function getIsAtivado() {
        return $this->isAtivado;
    }
    function setIsAtivado($isAtivado) {
        $this->isAtivado = $isAtivado;
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
        if(!$this->isDate($dtNascimento)){
            throw new Exception("Data de nascimento inválida",4);
        }
        
        $this->dtNascimento = $dtNascimento;
    }
    function setCpf($cpf) {
        if(!$this->validaCPF($cpf)){
            throw new Exception("Cpf inválido",5);
        }
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
        
    private function isDate($date){
        return 1 === preg_match('~^(((0[1-9]|[12]\\d|3[01])\\/(0[13578]|1[02])\\/((19|[2-9]\\d)\\d{2}))|((0[1-9]|[12]\\d|30)\\/(0[13456789]|1[012])\\/((19|[2-9]\\d)\\d{2}))|((0[1-9]|1\\d|2[0-8])\\/02\\/((19|[2-9]\\d)\\d{2}))|(29\\/02\\/((1[6-9]|[2-9]\\d)(0[48]|[2468][048]|[13579][26])|((16|[2468][048]|[3579][26])00))))$~',
            $date
        );
        
    }
    
    private function validaCPF($cpf = null) {
	// Verifica se um número foi informado
	if(empty($cpf)) {return false;}
	// Elimina possivel mascara
	$cpf = preg_replace("/[^0-9]/", "", $cpf);
	$cpf = str_pad($cpf, 11, '0', STR_PAD_LEFT);
	
	// Verifica se o numero de digitos informados é igual a 11 
	if (strlen($cpf) != 11) {
		return false;
	}
	// Verifica se nenhuma das sequências invalidas abaixo 
	// foi digitada. Caso afirmativo, retorna falso
	else if ($cpf == '00000000000' || $cpf == '11111111111' || $cpf == '22222222222' || $cpf == '33333333333' || $cpf == '44444444444' || $cpf == '55555555555' || $cpf == '66666666666' || $cpf == '77777777777' || $cpf == '88888888888' || $cpf == '99999999999') {
		return false;
	 // Calcula os digitos verificadores para verificar se o
	 // CPF é válido
	 } else {   		
		for ($t = 9; $t < 11; $t++) {
			
			for ($d = 0, $c = 0; $c < $t; $c++) {
				$d += $cpf{$c} * (($t + 1) - $c);
			}
			$d = ((10 * $d) % 11) % 10;
			if ($cpf{$c} != $d) {
				return false;
			}
		}
		return true;
	}
    }
    
}