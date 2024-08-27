<?php



?>

<h2>REGISTRAZIONE</h2>

<form method="post" onsubmit="return validRegistration()" >
    <div class="form-group">
        <label for="nome">Nome<span></span></label>
        <input type="text" class="form-control" placeholder="il tuo nome" name="nome" id="nome" required>

    </div>
    <div class="form-group">
        <label for="email">Email<span></span></label>
        <input type="email" class="form-control"  aria-describedby="emailHelp" placeholder="la tua mail" name="email" id="email" required>

    </div>
    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" class="form-control" placeholder="password" name="password" id="password" required>
    </div>
    
    <div class="form-check mb-5">
        <input class="form-check-input" type="checkbox" id="policy">
        <label class="form-check-label" for="policy" <a href="#">Accetta</a></label>
    </div>
    
    <button type="submit" class="btn btn-block btn-primary" name="submit" id="btn">Invia</button>
</form>

<?php

    $registraUtente = new Controller;
    $registraUtente->registraUtenteController();
    
    //gestione messaggio esito invio dati
    if (isset($_GET['action'])) {
        if($_GET['action'] == 'ok'){
            echo 'utente registrato';
        }
    }

?>


