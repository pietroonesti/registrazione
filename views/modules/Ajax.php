<?php

/* 
 * Progetto creato da Pietro Onesti 
 * data creazione: 1 mar 2024
 * Sistema di Login con pattern MVC
 * basato sul corso Udemy, "Laravel 9 e 10 con MySql, PHP OOP e MVC"
 */

include_once '../../controllers/Controller.php';
include_once '../../models/Crud.php';


class Ajax {
    
    public $validUser ;
    public $validMail ;
    
    public function validUserAjax() {
        
        $dati = $this->validUser;
        
        $responseUser = Controller::userValidationController($dati);
            
           echo $responseUser;
        
        
    }
    
    public function validMailAjax() {
        
        $dati = $this->validMail;
        
        $responseMail = Controller::mailValidationController($dati);
            
           echo $responseMail;
        
        
    }
}

//controllo del $_POST in arrivo da validRegistration.js

if (isset($_POST['userValidation'])){
$validationUser = new Ajax();
$validationUser->validUser = $_POST['userValidation'];
$validationUser->validUserAjax();
}

if (isset($_POST['mailValidation'])){
$validationMail = new Ajax();
$validationMail->validMail = $_POST['mailValidation'];
$validationMail->validMailAjax();
}
