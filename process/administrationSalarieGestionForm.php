<?php

require_once("../path.php");

authentificationRequise();

if(isset($_POST["validationSalarieModifier"])){
    $saManager = new SalarieManager($db);
    $seManager = new ServiceManager($db);
    
    $salarie = new Salarie([
        "id" => $_POST["idSalarie"],
        "nom" => $_POST["nom"],
        "prenom" => $_POST["prenom"],
        "service" => $seManager->get($_POST["service"])
    ]);
    
    if(!empty($_POST["autorisations"][0])){
        $aManager = new AutorisationManager($db);
        
        foreach($_POST["autorisations"] as $key => $value){
            $autorisations[] = $aManager->get($value);
        }
        
        $salarie->setAutorisations($autorisations);
    }
    
    if(!empty($_POST["mdp"])){
        $salarie->setMdp($_POST["mdp"]);
    }
    else{
        $salarie->setMdp("");
    }
    
    $saManager->update($salarie);
    
    $_SESSION["flash"]["success"] = "Salarié modifié avec succès";
    
    header("Location: ../administrationSalarie.php");
}

?>