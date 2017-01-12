<?php

function authentificationRequise(){
    if(session_status() == PHP_SESSION_NONE){
        session_start();
    }
    
    if(!isset($_SESSION['auth'])){
        $_SESSION['flash']['danger'] = "Vous n'avez pas le droit d'accéder à cette page";
        header('Location: index.php');
        exit();
    }
}

function isLogged(){
    if(session_status() == PHP_SESSION_NONE){
        session_start();
    }
    
    if(isset($_SESSION['auth'])){
        return true;
    }
    
    return false;
}

?>