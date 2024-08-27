<?php
    //*******************
    // controllo sessione
    session_start();
    if(!$_SESSION['valid']) {
        
//        header('location:index.php?action=login');
        header('location:login');
        exit;
    } else {
        
        var_dump($_SESSION);
}
    //*******************

?>
<h2>UTENTI</h2>
<br>
<h6>Utente: <?php echo $_SESSION['userEmail']; ?> </h6>
<br>
<table class="table table-striped">
    <thead>
    <tr>
        <th scope="col">Nome</th>
        <th scope="col">Email</th>
        <th scope="col">Password</th>
        <th scope="col">Gestisci</th>
        <th></th>

    </tr>
    </thead>

    <tbody>
        <?php 
            $mostraUtenti = new Controller;
            $mostraUtenti->mostraUtentiController();
            
            $mostraUtenti->cancellaUtenteController();
            
        ?>
    </tbody>
</table>

        <?php
        
            if (isset($_GET['action'])){
                
                    if($_GET['action'] == 'edit'){
                        
                        echo 'AGGIORNAMENTO ESEGUITO';
                }
            }
        ?>