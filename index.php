<?php

/* 
 * Progetto creato da Pietro Onesti 
 * data creazione: 11 feb 2024
 * Sistema di Login con pattern MVC
 * basato sul corso Udemy, "Laravel 9 e 10 con MySql, PHP OOP e MVC"
 */

require_once "models/Links.php";
require_once "models/Crud.php";
require_once "controllers/Controller.php";

$mvc = new Controller();
$mvc -> pagina();


