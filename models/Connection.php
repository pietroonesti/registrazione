<?php

/*
 * Progetto creato da Pietro Onesti 
 * data creazione: 11 feb 2024
 * Sistema di Login con pattern MVC
 * basato sul corso Udemy, "Laravel 9 e 10 con MySql, PHP OOP e MVC"
 */

/**
 * Description of Connection:
 * classe x la connessione al db
 * @author pietroonesti
 */
class Connection {
    
    public static function connect() {
        
        $link = new PDO('mysql:host=localhost;dbname=loginMVC', 'root' , 'root');
        
        return $link;
        
        //test
//        var_dump($link);
        
    }
    
    
}
//test
//$test = new Connection();
//$test->connect();
        