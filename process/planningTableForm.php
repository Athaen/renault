<?php

require_once("../path.php");


authentificationRequise();

if(isset($_POST["validationHeureTheorique"])){
    foreach($_POST["date"] as $key => $value){
        if(!empty($_POST["heure"][$key]) || !empty($_POST["minute"][$key]) || $_POST["idTypeHeure"][$key] != 1){
            $htManager = new HeureTheoriqueManager($db);
            $sManager = new SalarieManager($db);
            $thManager = new TypeHeureManager($db);
            
            $heure = (!empty($_POST["heure"][$key])) ? $_POST["heure"][$key] : 0;
            $minute = (!empty($_POST["minute"][$key])) ? $_POST["minute"][$key] : 0;
            
            $datetime = new DateTime("$value $heure:$minute:00");
            
            $heureTheorique = new HeureTheorique([
                "salarie" => $sManager->get($_POST["idSalarie"]),
                "typeHeure" => $thManager->get($_POST["idTypeHeure"][$key]),
                "datetime" => $datetime
            ]);
            
            $htManager->add($heureTheorique);
        }
    }
    
    header("Location: ../planningTheorique.php");
}
elseif(isset($_POST["validationHeureReel"])){
    foreach($_POST["date"] as $key => $value){
        if(!empty($_POST["heure"][$key]) || !empty($_POST["minute"][$key]) || $_POST["idTypeHeure"][$key] != 1){
            $hrManager = new HeureReelManager($db);
            $sManager = new SalarieManager($db);
            $thManager = new TypeHeureManager($db);
            
            $heure = (!empty($_POST["heure"][$key])) ? $_POST["heure"][$key] : 0;
            $minute = (!empty($_POST["minute"][$key])) ? $_POST["minute"][$key] : 0;
            
            $datetime = new DateTime("$value $heure:$minute:00");
            
            $heureReel = new HeureReel([
                "salarie" => $sManager->get($_POST["idSalarie"]),
                "typeHeure" => $thManager->get($_POST["idTypeHeure"][$key]),
                "datetime" => $datetime
            ]);
            
            $hrManager->add($heureReel);
        }
    }
    
    header("Location: ../planningReel.php");
}

?>