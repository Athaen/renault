<?php

if(isset($_POST["nom"]) && isset($_POST["mdp"])){   
    if(session_status() == PHP_SESSION_NONE){
        session_start();
    }
    
    $saManager = new SalarieManager($db);
    $salarie = $saManager->authentification($_POST["nom"], $_POST["mdp"]);
    
    if(isset($salarie)){
        $_SESSION["auth"] = $salarie;
        
        $_SESSION["flash"]["success"] = "Vous êtes maintenant connecté";
        
        header("Location: log.php");
        exit();
    }
    else{
        $_SESSION["flash"]["danger"] = "Identifiant ou mot de passe invalide";
        
        header("Location: index.php");
        exit();
    }
}

?>