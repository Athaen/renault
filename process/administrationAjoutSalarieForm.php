<?php

require_once("../path.php");

authentificationRequise();

if(isset($_POST["validationAdministrationAjoutSalarie"])){
    $saManager = new SalarieManager($db);
    $seManager = new ServiceManager($db);
    
    $salarie = new Salarie([
        "nom" => $_POST["nom"],
        "prenom" => $_POST["prenom"],
        "service" => $seManager->get($_POST["service"])
    ]);
}

?>