<?php session_start();

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include_once ('../conecBanco/ConnectionPool.php');

class TipoContaDAO{
    
    public function executarQuery($sql){
         $conn = ConnectionPool::getConnection();
     
       $resp = $conn->query($sql);
     

        return $resp;
        
    }
    
}