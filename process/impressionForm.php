<?php

require_once("../path.php");

authentificationRequise();

require(classePath . "/fpdf.php");

if(isset($_POST["validationImpressionHtForm"]) or isset($_POST["validationImpressionHrForm"])){
    $redirection = false;
    if(isset($_POST["validationImpressionHtForm"])){
        $location = "../impressionHeureTheorique.php";
    }
    else{
        $location = "../impressionHeureReelle.php";
    }
    
    if(empty($_POST["selectedDate"]) || empty($_POST["mois"]) || empty($_POST["service"])){
        $_SESSION["flash"]["danger"] = "Vous devez renseigner tous les champs du formulaire";
        
        ?>
        <script>
            // Fermeture de l'onglet ouvert
            self.close();
        </script>
        <?php
        
        exit();
    }
    
    global $titre;    
    if(isset($_POST["validationImpressionHtForm"])){
        $titre = "Planning théorique";
        $hrHt = "ht";
    }
    else{
        $titre = "Planning réel";
        $hrHt = "hr";
    }
    
    class PDF extends FPDF
    {
        function Header()
        {
            global $titre;
            $this->SetFont('Arial', 'B', 15);
            $this->MultiCell(0, 0, $titre, 0, 'C');
            $this->Ln(20);
            $this->SetY(20);
        }

        
        // Tableau affichage heures
        function BasicTable($pdf, $header, $data){
            // En-tête
            $i = 0;
            foreach($header as $col){
                if($i == 0){
                    $pdf->SetFont("Arial","B",8);
                    $this->Cell(24, 5, $col, 0, 0, "C");
                    $i++;
                }
                else{
                    if($col == "S" || $col == "D"){
                        $this->setFillColor(150,150,150);
                    }
                    else{                        
                        $this->setFillColor(255,255,255);
                    }
                    
                    $pdf->SetFont("Arial","B",8);
                    $this->Cell(8.5, 5, $col, 1, 0, "C", 1);
                }
            }
            $this->Ln();
            
            // Données
            $j = 0;
            foreach($data as $row){
                $i = 0;
                $this->setX(5);
                foreach($row as $col){                    
                    if($i == 0){
                        if($col[0] == "service"){
                            $this->setFillColor(150,150,150);
                        }
                        else{
                            $this->setFillColor(255,255,255);
                        }
                        $pdf->SetFont("Arial","",6);
                        $this->Cell(24, 5, $col[1], 1, 0, "L", 1);
                        $i++;
                    }
                    else{
                        if($col[0] == 0 || $col[0] == 6 || $j == 0){
                            $this->setFillColor(150,150,150);
                        }
                        else{
                            $this->setFillColor(255,255,255);
                        }
                        
                        $pdf->SetFont("Arial","",5);
                        $this->Cell(8.5, 5, $col[1], 1, 0, "C", 1);
                    }
                    
                }
                $j++;
                $this->Ln();
            }
        }
    }
    
    $pdf = new PDF("L");
    $pdf->AddPage();
    
    foreach($_POST["mois"] as $key => $value){
        $time = strtotime($_POST["selectedDate"]);
        $annee = date('Y',$time);
        $date = "01/$value/$annee 00:00:00";
        
        // DateTime début du mois sélectionné
        $datetime = DateTime::createFromFormat("d/m/Y H:i:s", $date);
        
        // DateTime fin du mois sélectionné
        $datetimeFin = clone $datetime;
        $datetimeFin->add(new DateInterval("P1M"));
        
        // nombre de jours entre les deux DateTime
        $diff = $datetime->diff($datetimeFin)->format("%a");
        
        $mois = utf8_encode(strftime("%B", $datetime->getTimestamp()));
        $annee = strftime("%Y", $datetime->getTimestamp());
        
        $header = array(ucfirst($mois) ." ". $annee);
        $data = array();
        
        for($i = 1; $i <= $diff; $i++){ 
            // Mise en header de la première lettre de chaque jour du mois concerné
            array_push($header, strtoupper(substr(strftime("%a", $datetime->getTimestamp()),0,1)));
            
            $datetime->add(new DateInterval("P1D"));
        }
        
        $seManager = new ServiceManager($db);
        $saManager = new SalarieManager($db);
        $hManager = new HeureManager($db);
        
        foreach($_POST["service"] as $key => $value){
            $service = $seManager->get($value);
            
            array_push($data, array(array("service", mb_strtoupper($service->getLibelle(), "utf-8"))));
            
            $ligneSalarie = array();
            foreach($saManager->getListByService($service) as $salarie){
                $nom = mb_strtoupper($salarie->getNom(), "utf-8");
                $prenom = mb_strtoupper(substr($salarie->getPrenom(), 0, 1), "utf-8");
                
                array_push($ligneSalarie, array("", "$prenom. $nom"));
                
                // datetime début du mois sélectionné 
                $datetime = DateTime::createFromFormat("d/m/Y H:i:s", $date);
                
                // datetime fin du mois sélectionné
                $datetimeFin = clone $datetime;
                $datetimeFin->add(new DateInterval("P1M"));
                
                // nombre de jours entre les deux DateTime
                $diff = $datetime->diff($datetimeFin)->format("%a");
                
                for($i = 1; $i <= $diff; $i++){                    
                    $heure = $hManager->getBySalarieDate($salarie, $datetime, $hrHt);
                    
                    if(isset($heure) && ($heure->getTypeHeure()->getId() != 1)){
                        array_push($ligneSalarie, array(strftime("%w", $datetime->getTimestamp()), $heure->getTypeHeure()->getLibelle()));
                    }
                    else if(isset($heure) && ($heure->getDatetime()->format("i") == "00")){
                        array_push($ligneSalarie, array(strftime("%w", $datetime->getTimestamp()), $heure->getDatetime()->format("G") ."h"));
                    }
                    else if(isset($heure) && ($heure->getDatetime()->format("H:i") != "00:00")){
                        array_push($ligneSalarie, array(strftime("%w", $datetime->getTimestamp()), $heure->getDatetime()->format("G") ."h". $heure->getDatetime()->format("i")));
                    }
                    else{
                        array_push($ligneSalarie, array(strftime("%w", $datetime->getTimestamp()), ""));
                    }
                    
                    $datetime->add(new DateInterval("P1D"));
                }
                
                array_push($data, $ligneSalarie);
                $ligneSalarie = [];
            }
            
        }
        
        $pdf->setX(5);
        $pdf->SetFont("Arial", "", 8);
        $pdf->basicTable($pdf, $header, $data);
    }
    
    $pdf->Output();
}

?>