<?php

/*
 * Progetto creato da Pietro Onesti 
 * data creazione: 18 feb 2024
 * Sistema di Login con pattern MVC
 * basato sul corso Udemy, "Laravel 9 e 10 con MySql, PHP OOP e MVC"
 */

/**
 * Description of Crud
 *
 * @author pietroonesti
 */

//includo la classe che genera la connessione al db
require_once 'Connection.php';


class Crud extends Connection{
    
    //metodo insert dati di registrazione utente
    public static function registraUtenteModel($datiModel, $tabella) {
        
        $stmt = Connection::connect()->prepare("INSERT INTO $tabella (nome,email,password) VALUES(:nome,:email,:password)");
        
        $stmt->bindParam(":nome", $datiModel['nome'], PDO::PARAM_STR);
        $stmt->bindParam(":email", $datiModel['email'], PDO::PARAM_STR);
        $stmt->bindParam(":password", $datiModel['password'], PDO::PARAM_STR);
                
        if ($stmt->execute()){
            
            return 'ok';
                
            } else {
            
                return 'ko';
            }
            $stmt->close();
        }
        
    //FINE insert dati di registrazione utente
    //----------------------------------------
    //metodo per la lettura dati tabella utenti
        
    public static function mostraUtentiModel($tabella) {
        
        $stmt = Connection::connect()->prepare("SELECT * FROM $tabella");
        
        $stmt->execute();
        
        return $stmt->fetchAll();
        
//        $stmt->close();
    }
    //FINE lettura dati tabella utenti
    //--------------------------------
    //metodo per la gestione del LOGIN utente
    
    public static function loginUtenteModel($datiModel, $tabella) {
        
        $stmt = Connection::connect()->prepare("SELECT email, password FROM $tabella WHERE email = :email");
        
        $stmt->bindParam(":email", $datiModel['email'], PDO::PARAM_STR);
        
        $stmt->execute();
        
        return $stmt->fetch();
    
    }
    //FINE gestione del LOGIN
    //-----------------------
    //metodo per la selezione e modifica dei dati per update utente
    
    public static function modificaUtentiModel($datiModel, $tabella) {
        
        $stmt = Connection::connect()->prepare("SELECT * FROM $tabella WHERE id = :id");
        
        $stmt->bindParam(":id", $datiModel, PDO::PARAM_INT);
        
        $stmt->execute();
        
        return $stmt->fetch();
        
        
    }
    //FINE metodo per la selezione e modifica dei dati per update utente
    //--------------------------------------------------------------------
    //metodo per l'inaserimento dei dati utente modificati nel form update
    
    public static function aggiornaUtenteModel($datiModel, $tabella) {
        
        $stmt = Connection::connect()->prepare("UPDATE $tabella SET nome = :nome, email = :email, password = :password WHERE id = :id");
        
        $stmt->bindParam(":id", $datiModel['id'], PDO::PARAM_INT);
        $stmt->bindParam(":nome", $datiModel['nome'], PDO::PARAM_STR);
        $stmt->bindParam(":email", $datiModel['email'], PDO::PARAM_STR);
        $stmt->bindParam(":password", $datiModel['password'], PDO::PARAM_STR);
        
        if ($stmt->execute()){
            
            return 'ok';
                
            } else {
            
                return 'ko';
            }
            $stmt->close();
    }
    //FINE metodo per l'inaserimento dei dati utente modificati nel form update
    //-------------------------------------------------------------------------
    //metodo per la cancellazione di un utente
    
    public static function cancellaUtenteModel($datiModel, $tabella) {
        
        $stmt = Connection::connect()->prepare("DELETE FROM $tabella WHERE id = :id");
        
        $stmt->bindParam(":id", $datiModel, PDO::PARAM_INT);
        
        if ($stmt->execute()){
            
            return 'ok';
                
            } else {
            
                return 'ko';
            }
            $stmt->close();
        
    }
    //FINE metodo per la cancellazione di un utente
    //---------------------------------------------
    //
    //
    // INIZIO SEZIONE AJAX
    //
    //Ajax userValidation 
    
    public static function userValidModel($datiModel, $tabella) {
        
        $stmt = Connection::connect()->prepare("SELECT * FROM $tabella WHERE nome = :nome");
        
        $stmt->bindParam(":nome", $datiModel, PDO::PARAM_STR);
        
        $stmt->execute();
        
        return $stmt->fetch();
        
        $stmt->close();

    }
    //FINE Ajax userValidation
    //------------------------
    //Ajax mailValidation
    
    public static function mailValidModel($datiModel, $tabella) {
        
        $stmt = Connection::connect()->prepare("SELECT * FROM $tabella WHERE email = :email");
        
        $stmt->bindParam(":email", $datiModel, PDO::PARAM_STR);
        
        $stmt->execute();
        
        return $stmt->fetch();
        
        $stmt->close();

    }
    //FINE Ajax mailValidation
    
    
    

//FINE classe Crud    
}
