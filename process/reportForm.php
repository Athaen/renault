<?php

require_once("../path.php");

authentificationRequise();

if(isset($_POST["validationReportTable"])){
    foreach($_POST["salarie"] as $key => $value){
            $rManager = new ReportManager($db);
            $saManager = new SalarieManager($db);
            
            $id = (!empty($_POST["id"][$key])) ? $_POST["id"][$key] : null;
            $heure = (!empty($_POST["report"][$key])) ? $_POST["report"][$key] : 0;
            $date = $_POST["selectedDate"] ." 00:00:00";
            
            // DateTime début du mois sélectionné
            $datetime = DateTime::createFromFormat("d/m/Y H:i:s", $date);
            
            $report = new Report([
                "id" => $id,
                "salarie" => $saManager->get($_POST["salarie"][$key]),
                "datetime" => $datetime,
                "heure" => $heure
            ]);
            
            if(!empty($_POST["report"][$key])){
                $rManager->persist($report);
            }
            else{
                $rManager->delete($report);
            }
            
    }
    
    $_SESSION["flash"]["success"] = "Report d'heures effectué avec succès";
    
    header("Location: ../report.php");
}

?>