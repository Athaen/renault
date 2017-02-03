<?php

require_once("../path.php");

authentificationRequise();

if(isset($_POST["validationHeureSupp"])){
    foreach($_POST["salarie"] as $key => $value){
            $hsManager = new HeureSuppManager($db);
            $saManager = new SalarieManager($db);
            
            $id = (!empty($_POST["id"][$key])) ? $_POST["id"][$key] : null;
            $heure = (!empty($_POST["heureSupp"][$key])) ? $_POST["heureSupp"][$key] : 0;
            $date = $_POST["selectedDate"] ." 00:00:00";
            
            // DateTime début du mois sélectionné
            $datetime = DateTime::createFromFormat("d/m/Y H:i:s", $date);
            
            $heureSupp = new HeureSupp([
                "id" => $id,
                "salarie" => $saManager->get($_POST["salarie"][$key]),
                "datetime" => $datetime,
                "heure" => $heure
            ]);
            
            if(!empty($_POST["heureSupp"][$key])){
                $hsManager->persist($heureSupp);
            }
            else{
                $hsManager->delete($heureSupp);
            }
            
    }
    
    $_SESSION["flash"]["success"] = "Heures supplémentaires modifiées avec succès";
    
    header("Location: ../heureSupp.php");
}

?>