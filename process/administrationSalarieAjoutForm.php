<?php

require_once("../path.php");

authentificationRequise();

if(isset($_POST["validationSalarieAjout"])){
    $saManager = new SalarieManager($db);
    $seManager = new ServiceManager($db);
    
    $salarie = new Salarie([
        "nom" => $_POST["nom"],
        "prenom" => $_POST["prenom"],
        "service" => $seManager->get($_POST["service"]),
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
    
    $saManager->add($salarie);
    
    $_SESSION["flash"]["success"] = "Salarié ajouté avec succès";
    
    header("Location: ../administrationSalarie.php");
}

?>