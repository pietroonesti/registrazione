<?php
//session_start();
////*******************
//    // controllo sessione
//    session_start();
//    
//    var_dump($_SESSION);
//
//    //*******************

?>

<h2>LOGIN</h2>

<form method="post">

    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" class="form-control"  aria-describedby="emailHelp" placeholder="la tua mail" name="email">

    </div>
    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" class="form-control" placeholder="password" name="password">
    </div>

    <button type="submit" class="btn btn-block btn-primary" name="login">Invia</button>
</form>

<?php

    $login = new Controller();
    $login->loginUtenteController();
    
    if (isset($_GET['action'])) { 
        if ($_GET['action'] == 'errore') {
            echo 
            'Errore nel LOGIN';
        } 
    }