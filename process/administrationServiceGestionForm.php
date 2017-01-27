<?php

require_once("../path.php");

authentificationRequise();

if(isset($_POST["validationServiceModifier"])){
    $seManager = new ServiceManager($db);
    
    $service = new Service([
        "id" => $_POST["idService"],
        "libelle" => $_POST["libelleService"]
    ]);
    
    $seManager->update($service);
    
    $_SESSION["flash"]["success"] = "Service modifié avec succès";
    
    header("Location: ../administrationService.php");
}
elseif(isset($_POST["validationServiceSupprimer"])){
    $seManager = new ServiceManager($db);
    $saManager = new SalarieManager($db);
    
    $service = new Service([
        "id" => $_POST["idService"],
        "libelle" => $_POST["libelleService"]
    ]);
    
    $salaries = $saManager->getListByService($service);
    
    if(empty($salaries)){
        $seManager->delete($service);
        
        $_SESSION["flash"]["success"] = "Service '". $service->getLibelle() ."' supprimé avec succès";
    }
    else{
        $_SESSION["flash"]["danger"] = "Suppression impossible, le service '". $service->getLibelle() ."' ne doit contenir aucun salarié";
    }
    
    header("Location: ../administrationService.php");
}

?>