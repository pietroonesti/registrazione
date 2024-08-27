<?php

    session_start();
    session_destroy();
    
    var_dump($_SESSION);

?>

<h1>Hai eseguito correttamente il logout</h1>