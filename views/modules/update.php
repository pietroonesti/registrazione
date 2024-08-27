<?php
    //*******************
    // controllo sessione
    session_start();
    if(!$_SESSION['valid']) {
        
        header('location:index.php?action=login');
        exit;
    }
    //*******************
?>
<h1>update utente</h1>

<form method="post">

<?php
//form per la modifica dei dati dell'utente che viene innescato dalla 
//classe Controller -> metodo modificaUtentiController

$updateDatiUtente = new Controller();
$updateDatiUtente->modificaUtentiController();
$updateDatiUtente->aggiornaUtenteController();

//---------------------------------------------

?>
    
</form>