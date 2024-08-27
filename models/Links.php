<?php

/*
 * Progetto creato da Pietro Onesti 
 * data creazione: 17 feb 2024
 * Sistema di Login con pattern MVC
 * basato sul corso Udemy, "Laravel 9 e 10 con MySql, PHP OOP e MVC"
 */

/**
 * Description of links
 *
 * @author pietroonesti
 */
class Links {
    
    public static function linkPagineModel($links){


            if($links == "login"
            || $links == "utenti"
            || $links == "update"
            || $links == "logout"){

		$module =  "views/modules/".$links.".php";
		
		}

		else if($links == "index"){

			$module =  "views/modules/registration.php";
		}
                
                //link fittizio post registrazione che evita il reinvio del form
                else if($links == "ok"){

			$module =  "views/modules/registration.php";
		}

                else if ($links == "errore") {
			$module =  "views/modules/login.php";
		}
                
                else if ($links == "edit") {
			$module =  "views/modules/utenti.php";
		}
                
                else{
			$module =  "views/modules/registration.php";
		}

		
		return $module;

	}
}
