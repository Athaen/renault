<?php

require_once("../path.php");

authentificationRequise();

if(isset($_POST["validationServiceAjout"])){
    $seManager = new ServiceManager($db);
    
    $service = new Service([
        "libelle" => $_POST["libelleService"]
    ]);
    
    $seManager->add($service);
    
    $_SESSION["flash"]["success"] = "Service '". $service->getLibelle() ."' ajouté avec succès";
    
    header("Location: ../administrationService.php");
}

?>