<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class ConnectionPool {
    private static $servername = "localhost:3306";
    private static $username = "root";
    private static $password = "";
    private static $dbname = "lojinha";
    
    private static $conn = null;
        
    public static function getConnection(){
        if(ConnectionPool::$conn == null || !is_resource(ConnectionPool::$conn)){
            try{
                return mysqli_connect(ConnectionPool::$servername, ConnectionPool::$username, ConnectionPool::$password, ConnectionPool::$dbname);
            } catch (Exception $ex) {
                throw new Exception("Não foi possível conectar-se aos serviços");
            }         
        }
        else{
            return ConnectionPool::$conn;
        }
    }
    
}