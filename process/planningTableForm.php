<?php

require_once("../path.php");

authentificationRequise();

if(isset($_POST["validationHeureTheorique"]) || isset($_POST["validationHeureReel"])){
//  définit le type d'heure et la redirection a effectuer
    if(isset($_POST["validationHeureTheorique"])){
        $hrHt = "ht";
        $location = "../planningTheorique";
    }
    elseif(isset($_POST["validationHeureReel"])){
        $hrHt = "hr";
        $location = "../planningReel";
    }
//  /définit le type d'heure et la redirection a effectuer

//  ajout des heures dans la bdd
    foreach($_POST["date"] as $key => $value){        
        if(!empty($_POST["heure"][$key]) || !empty($_POST["minute"][$key]) || $_POST["idTypeHeure"][$key] != 1){
            $hManager = new HeureManager($db);
            $saManager = new SalarieManager($db);
            $thManager = new TypeHeureManager($db);
            
            $id = (!empty($_POST["id"][$key])) ? $_POST["id"][$key] : null;
            $heure = (!empty($_POST["heure"][$key])) ? $_POST["heure"][$key] : 0;
            $minute = (!empty($_POST["minute"][$key])) ? $_POST["minute"][$key] : 0;
            
            $datetime = new DateTime("$value $heure:$minute:00");
            
            $heure = new Heure([
                "id" => $id,
                "salarie" => $saManager->get($_POST["idSalarie"]),
                "typeHeure" => $thManager->get($_POST["idTypeHeure"][$key]),
                "datetime" => $datetime,
                "hrHt" => $hrHt
            ]);
            
            $hManager->persist($heure);
        }
    }
// /ajout des heures dans la bdd
    
    $_SESSION['flash']['success'] = 'Planning mis à jour';
    
    header("Location: ". $location);
}

?>