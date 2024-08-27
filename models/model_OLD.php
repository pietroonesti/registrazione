<?php

/* 
 * Progetto creato da Pietro Onesti 
 * data creazione: 11 feb 2024
 * Sistema di Login con pattern MVC
 * basato sul corso Udemy, "Laravel 9 e 10 con MySql, PHP OOP e MVC"
 */

//classe che collega la action->_GET ad un file
class linkPaginaModello {
    
    public static function collegamentiPaginaModel($linkModel) {
        
        if ($linkModel == 'home' ||
            $linkModel == 'contacts') {
            
            $moduloNav = 'views/modules/' . $linkModel . ".php";
                        
        } else if ($linkModel == 'index') {
            
            $moduloNav = 'views/modules/home.php';
        } else {
            
            $moduloNav = 'views/modules/error.php';
        }
        
        return $moduloNav;
    }
}
