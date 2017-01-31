<?php

require_once("../path.php");

authentificationRequise();

if(isset($_POST["validationHeureTheorique"]) && empty($_POST["selectedDate"])){
    $_SESSION["flash"]["danger"] = "Vous devez sélectionner une date";
    
    header("Location: ../heureTheorique.php");
    exit();
}

if(isset($_POST["validationReportTable"])){
    foreach($_POST["salarie"] as $key => $value){        
        if($_POST["report"][$key] != null){
            $hManager = new HeureManager($db);
            $th = new TypeHeureManager($db);
            $saManager = new SalarieManager($db);
            
            $id = (!empty($_POST["id"][$key])) ? $_POST["id"][$key] : null;
            $date = $_POST["selectedDate"];
            $heure = (!empty($_POST["report"][$key])) ? $_POST["report"][$key] : "00";
            
            $datetime = new DateTime("$date $heure:00:00");
            
            $heure = new Heure([
                "id" => $id,
                "salarie" => $saManager->get($_POST["salarie"][$key]),
                "datetime" => $datetime,
                "typeHeure" => $th->get(11),
                "hr_ht_r" => "r"
            ]);
            
            if(!empty($_POST["report"][$key])){
                $hManager->persist($heure);
            }
            else{
                $hManager->delete($heure);
            }
            
        }
    }
    
    $_SESSION["flash"]["success"] = "Report d'heures effectué avec succès";
    
    header("Location: ../report.php");
    exit();
}

?>