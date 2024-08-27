    <?php

ob_start(); //gestione output

/* 
 * Progetto creato da Pietro Onesti 
 * data creazione: 11 feb 2024
 * Sistema di Login con pattern MVC
 * basato sul corso Udemy, "Laravel 9 e 10 con MySql, PHP OOP e MVC"
 */

//include della classe CRUD per l'esecuzione delle query richiamate dal Controller
//include_once 'models/Crud.php';


//questa classe è il controller dell'applicazione

class Controller{
        
        //funzione che gestisce la include del modello di visualizzazione
	public function pagina(){	
		
		include "views/template.php";
	
	}

        //funzione che gestisce le rotte.
        //la variabile $_GET['action'] cattura la parte della url dopo "index.php?"
        
	public function linkPagineController(){

		if(isset( $_GET['action'])){
			
			$links = $_GET['action'];
		
		} else{

			$links = "index";
		}

		$response = Links::linkPagineModel($links);

		include $response;

	}
        
        //insert dati di registrazione utente
        public function registraUtenteController() {
            
            if(isset($_POST['submit'])){
                
                //cript della password
                $securePsw = crypt ($_POST['password'], 'pippo' );
                //
                
                $datiController = array(
                                  
                    "nome"=> $_POST['nome'],
                    "email"=> $_POST['email'],
                    "password" => $securePsw
                );

            $responseDB = Crud::registraUtenteModel($datiController, 'utenti');

//            echo $responseDB;

//            var_dump($datiController);
            if($responseDB == 'ok') {

//            header('location:index.php?action=ok');
              header('location:ok');
            
            } else {
                
                header('location:index.php');
                
            }
       
        } 
    }
    
    //FINE insert dati di registrazione utente
    //----------------------------------------
    //lettura dati tabella utenti
    
    public function mostraUtentiController()    {
        $responseDB = Crud::mostraUtentiModel('utenti');
        
//        var_dump($responseDB);
        
        foreach ($responseDB as $row => $data) {
            echo 
            '<tr>
             <td>' . $data['nome'] . '</td>
             <td>' . $data['email'] . '</td>
             <td>' . $data['password']. '</td>
             <td><a href="index.php?action=update&id='. $data['id'] . '"<button class="btn btn-success">Modifica</button></a></td>
             <td><a href="index.php?action=utenti&delete='. $data['id'] . '"<button class="btn btn-danger" >Cancella</button></a></td>
             </tr>';
        }
    }  

    //FINE lettura dati tabella utenti 
    //--------------------------------
    //gestione del LOGIN -> INIZIALIZZAZIONE DELLA SESSIONE
    
    public function loginUtenteController() {
        
        if(isset($_POST['login'])) {
            
            //cript della password per il match nel db
            $securePsw = crypt ($_POST['password'], 'pippo' );
            
            
            $datiController = array(
            "email" => $_POST['email'],
            "password" => $securePsw
             );
        
        
        $responseDB = Crud::loginUtenteModel($datiController, 'utenti');
        
        echo 'ritorno da model: ';
        var_dump($responseDB);
        if($responseDB == false){
//            'location:index.php?action=errore';
            exit('credenziali = false-> uscita');
        }
        
        if ($responseDB['email'] == $_POST['email'] && 
            $responseDB['password'] == $securePsw) {
            
            //**********************
            //apertura della SESSION
            //**********************
            session_start();
            
            //definizione delle variabili di sessione
            $_SESSION['valid'] = true;
            $_SESSION['userEmail'] = $responseDB['email'];
            //---------------------------------------
            
//                header('location:index.php?action=utenti');
                header('location:utenti');
            } 
            else {
        
                header('location:errore');
            }
            
        }   
     
    }    
    // FINE gestione del LOGIN -> INIZIALIZZAZIONE DELLA SESSIONE
    //------------------------------------------------------------
    //metodo per la selezione e modifica dei dati per update utente
    
    public function modificaUtentiController() {
        
        $datiController = $_GET['id'];
        
        $responseDB = Crud::modificaUtentiModel($datiController, 'utenti');
        
//        var_dump($responseDB);
        $id = $responseDB['id'];
        $nome = $responseDB['nome'];
        $email = $responseDB['email'];
        $password = $responseDB['password'];
        
        echo '
            <input type="hidden" value=" ' . $id . ' " name="idUtente">
                
            <div class="form-group">
                <label for="nome">Nome</label>
                <input type="text" class="form-control" name="nome" value=" '. $nome . '">

            </div>
            
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" name="email" value=" ' . $email . '">

            </div>
                <div class="form-group">
                <label for="password">Password</label>
                <input type="text" class="form-control" name="password" value=" ' . $password . '">
            </div>
            <button type="submit" class="btn btn-block btn-primary">Invia</button>
        ';
        }        
        //FINE metodo per la selezione e modifica dei dati per update utente
        //------------------------------------------------------------------
        //metodo per l'inserimento update dati utente
        
        public function aggiornaUtenteController() {
            
            if (isset($_POST['nome'])){
                
                //cript della password
                $securePsw = crypt ($_POST['password'], 'pippo' );
                
                $datiController = array(
                    "id"=> $_POST['idUtente'],
                    "nome"=> $_POST['nome'],
                    "email"=> $_POST['email'],
                    "password" => $securePsw
                    
                );
            
            $responseDB = Crud::aggiornaUtenteModel($datiController, 'utenti');
            
            
                if($responseDB == 'ok') {

//                    header('location:index.php?action=edit');
                    header('location:edit');
            
                } else {
                
                    echo 'error!!';
                
            }
        }
    }
    //FINE metodo per l'inserimento update dati utente
    //----------------
    //metodo per la cancellazione utente
    
    public function cancellaUtenteController() {
        
        if ((isset($_GET['delete']))){
            
            $datiController = $_GET['delete'];
            
            $responseDB = Crud::cancellaUtenteModel($datiController, 'utenti');
            
            if($responseDB == 'ok') {

//                    header('location:index.php?action=utenti');
                    header('location:utenti');
            
                } else {
                
                    echo 'error!!';
                
            }
        }
    }
    //FINEmetodo per la cancellazione utente
    //--------------------------------------
    //
    // INIZIO SEZIONE AJAX
    //
    //Ajax userValidation invocata dalla classe Ajax in views/modules/Ajax.php
    
    static public function userValidationController($validUser) {
        
        $datiController = $validUser;
        
        $responsDB = Crud::userValidModel($datiController, 'utenti');
        
        if(!empty($responsDB['nome'])){
            
            echo 0;            //il nome esiste 
        } else{
            echo 1;            //il nome non esiste
        }
    }
    //FINE Ajax userValidation
    //-------------------
    //Ajax mailValidation nvocata dalla classe Ajax in views/modules/Ajax.php
    
    static public function mailValidationController($validMail) {
        
        $datiController = $validMail;
        
        $responsDB = Crud::mailValidModel($datiController, 'utenti');
        
        if(!empty($responsDB['email'])){
            
            echo 0;            //il nome esiste 
        } else{
            echo 1;            //il nome non esiste
        }
    }
    //FINE Ajax mailValidation
    
    
    
    
    
    
    
    
//FINE classe Controller    
}