/* 
 * Progetto creato da Pietro Onesti 
 * data creazione: 21 feb 2024
 * Sistema di Login con pattern MVC
 * basato sul corso Udemy, "Laravel 9 e 10 con MySql, PHP OOP e MVC"
 * 
 * questo file contiene:
 * controllo Ajax unicità nome
 * e
 * validatzione campi registrazione utente
 */

/*
 * disabilito pulsante submit in attesa del controllo ajax
 * su unicità nome e email
*/

var userExist = false;
var mailExist = false;


//controllo Ajax unicità nome
$('#nome').change(function(){
    
    var utente = $('#nome').val();
    console.log (utente) ;
    
    var dati = new FormData();
    
//    console.log ('dati: ' + dati);
    dati.append('userValidation',utente)
    
    $.ajax({
        url:'views/modules/ajax.php', //chiamo ajax.php che chiama il controller
        method: 'POST',
        data: dati,
        contentType: false,
        processData: false,
        cache: false,
        success: function(responseUser){
            
            console.log('php dice:' + responseUser);
            
            if(responseUser == 0){
                
                $('label[for="nome"] span').html('<p class="alert alert-danger">name alredy exists</p>'); 
                
                //controllo della variabile che disabilita il pulsante submit
                userExist = true;
            } else {
                
                $('label[for="nome"] span').html('<p class="alert alert-success">OK</p>');
                
                //controllo della variabile che disabilita il pulsante submit
                userExist = false;
            }
        }
    });
    
});
//FINE controllo unicità nome
//-----------------------------------------------
//controllo Ajax unicità email

$('#email').change(function(){
    
    var mail = $('#email').val();
    console.log (mail) ;
    
    var dati = new FormData();
    
    console.log ('dati: ' + dati);
    dati.append('mailValidation',mail)
    
    $.ajax({
        url:'views/modules/ajax.php', //chiamo ajax.php che chiama il controller
        method: 'POST',
        data: dati,
        contentType: false,
        processData: false,
        cache: false,
        success: function(responseMail){
            
            console.log('php dice:' + responseMail);
            
            if(responseMail == 0){
                
                $('label[for="email"] span').html('<p class="alert alert-danger">email alredy exists</p>'); 
                
                //controllo della variabile che disabilita il pulsante submit
                mailExist = true;
            } else {
                
                $('label[for="email"] span').html('<p class="alert alert-success">OK</p>');
                
                //controllo della variabile che disabilita il pulsante submit
                mailExist = false;
            }
        }
    });
    
});




//validatzione campi registrazione utente
function validRegistration(){

//catturo le variabili dai capi del form mediante il valore di: id"=""
        var nome = document.querySelector('#nome').value;
        var email = document.querySelector('#email').value;
        var password = document.querySelector('#password').value;
        var policy = document.querySelector('#policy').checked;
 
        
    //controllo campo nome
        if (nome != '') {

//variabile che contiene il numero dei caratteri di nome
        var nomeCharLength = nome.length;
        
        //variabile che contiene la regExpr per il controllo dei caratteri del nome
        var regExpr = /^[a-zA-Z0-9]*$/;
        
        //controllo lunghezza del campo nome
        if (nomeCharLength > 25) {

        document.querySelector('label[for="nome"').innerHTML += '<br><b>!!MAX 25 char</b>';
        return false;
    }

//controllo sui caratteri speciali del nome
        if (!regExpr.test(nome)){

        document.querySelector('label[for="nome"').innerHTML += '<br><b>!!NO special char</b>';
        return false;
        }
        
//controllo unicità del nome che arriva da ajax
        if (userExist){
            
            document.querySelector('label[for="nome"').innerHTML += '<p class="alert alert-danger">!!email exist!!</p>';
            return false;
        }
    }
//FINE controllo campo nome
//-----------------------------
//controllo dell'indirizzo mail

        if (email != '') {

        var regExpr = /^[^@]+@[^@]+\.[^@]+$/;
        
            if (!regExpr.test(email)){

                document.querySelector('label[for="email"').innerHTML += '<br><b>!!MAIL non corretta</b>';
                
            return false;
         }
    //controllo unicità della mail che arriva da ajax
        if (mailExist){
            
            return false;
        }

    }
    //FINE controllo dell'indirizzo mail
    //----------------------------------
    //controllo composizione password
    if (password != '') {

        var regExpr = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@#€!£$%&?])[A-Za-z0-9@#€!£$%&?]{8,32}$/;

        if (!regExpr.test(password)){

            document.querySelector('label[for="password"').innerHTML += '<br><b>!!bad password!!!</b>';
        
            return false;
        } 

    }
    //FINE controllo composizione password
    //------------------------------------
    //controllo check box policy
    
    if(!policy){
        
        document.querySelector('form').innerHTML += '<br><b>!!checkbox!!!!!</b>';
        
        //mantengo i campi popolati
                
        document.querySelector('#nome').value = nome;
        document.querySelector('#email').value = email;
        document.querySelector('#password').value = password;
            
        return false;
        
    } 

return true;
        }

