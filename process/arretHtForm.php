<?php

require_once("../path.php");

authentificationRequise();

if(isset($_POST["validationArretHt"]) && empty($_POST["selectedDay"])){
    $_SESSION["flash"]["danger"] = "Vous devez sélectionner une date";
    
    header("Location: ../arretHt.php");
    exit();
}

if(isset($_POST["validationArretHt"])){
    $ahtManager = new ArretHtManager($db);
    
    $heure = (isset($_POST["heureTheorique"])) ? $_POST["heureTheorique"] : 0;
    
    $aht = new ArretHt([
        "id" => $_POST["id"],
        "datetime" => DateTime::createFromFormat("d/m/Y H:i:s", $_POST["selectedDay"] ." 00:00:00"),
        "heure" => $_POST["heureTheorique"]
    ]);
    
    if(!empty($_POST["heureTheorique"]) && !empty($_POST["selectedDay"])){
        $ahtManager->persist($aht);
    }
    else{
        $ahtManager->delete($aht);
    }
    
    $_SESSION["flash"]["success"] = "Limite des heures théoriques modifiée avec succès";
    
    header("Location: ../arretHt.php");
    exit();
}

?>