<?php

require_once("../path.php");

authentificationRequise();

require(classePath . "/fpdf.php");

if(isset($_POST["validationRecapitulatifForm"])){
    if(empty($_POST["selectedDate"]) || empty($_POST["salarie"])){
        $_SESSION["flash"]["danger"] = "Vous devez renseigner tous les champs du formulaire";
        
        ?>
        <script>
            // Fermeture de l'onglet ouvert
            self.close();
        </script>
        <?php
        
        exit();
    }
    
    class PDF extends FPDF{
        function Header()
        {
            global $titre;
            $this->setY(5);
            $this->SetFont('Arial', 'B', 9);
            $this->MultiCell(0, 0, $titre, 0, 'C');
            $this->Ln(20);
            $this->SetY(9);
        }
        
        
        // Tableau affichage heures
        function BasicTable($pdf, $header, $data){
            // En-tête
            foreach($header as $col){
                $pdf->SetFont("Arial","B",6);
                $this->Cell(21, 2.3, $col, 0, 2, "C");
            }
            
            // Données
            foreach($data as $row){
                $i = 0;
                foreach($row as $col){
                    if($col[0] == "arretHt"){
                        $this->setFillColor(130,130,130);
                    }
                    else{                        
                        if($col[0] == 0 || $col[0] == 6){
                            $this->setFillColor(180,180,180);
                        }
                        else{
                            $this->setFillColor(255,255,255);                            
                        }
                    }
                    
                    if($i == 0){
                        $pdf->SetFont("Arial","",5);
                        $this->Cell(3, 2.3, $col[1], 1, 0, "C", 1);
                    }
                    else if($i == 1){                        
                        $pdf->SetFont("Arial","",5);
                        $this->Cell(3, 2.3, $col[1], 1, 0, "C", 1);
                    }
                    else if($i == 2){                        
                        $pdf->SetFont("Arial","",5);
                        $this->Cell(6, 2.3, $col[1], 1, 0, "C", 1);
                    }
                    else if($i == 3){
                        $pdf->SetFont("Arial","",5);
                        $this->Cell(9, 2.3, $col[1], 1, 2, "C", 1);
                        $this->setX($this->getX() - 12);
                    }
                    else{
                        $pdf->SetFont("Arial","",5);
                        $this->Cell(10, 2.3, $col[1], 1, 0, "C", 1);
                    }                    
                    
                    $i++;
                }
            }
        }
    }
    
    $pdf = new PDF("L");
    $pdf->SetAutoPagebreak(False);
    $pdf->SetMargins(0,0,0);
    
    $saManager = new SalarieManager($db);
    $hManager = new HeureManager($db);
    $ahManager = new ArretHtManager($db);
    $hsManager = new HeureSuppManager($db);
    
    foreach($_POST["salarie"] as $key => $value){        
        $time = strtotime($_POST["selectedDate"]);
        $annee = date('Y',$time);
        $date = "01/01/$annee 00:00:00";
        $salarie = $saManager->get($value);        
        $hrCumul = 0;
        $hsCumul = 0;
        $soldeCumul = 0;
        
        global $titre;
        $titre = "Récapitulatif annuel ". $annee ." - ". mb_strtoupper($salarie->getNom(), "utf-8") ." ". ucfirst($salarie->getPrenom());
        
        $pdf->AddPage();
        
        $pdf->setX(10);
        $y = $pdf->getY();
        $x = $pdf->getX();
        
        // DateTime début du mois
        $datetime = DateTime::createFromFormat("d/m/Y H:i:s", $date);
        
        for($i = 0; $i < 12; $i ++){
            // DateTime fin du mois
            $datetimeFin = clone $datetime;
            $datetimeFin->add(new DateInterval("P1M"));
            
            // nombre de jours entre les deux DateTime
            $diff = $datetime->diff($datetimeFin)->format("%a");
            
            $mois = utf8_encode(strftime("%B", $datetime->getTimestamp()));
            
            $header = array(ucfirst($mois) ." ". $annee);            
            $data = array();            
            $ligneSalarie = array();
            
            // Arrêt HT
            $arret = $ahManager->getByDate($datetime);
            
            for($j = 0; $j < $diff; $j++){
                // Label
                if(!empty($arret) && $arret->getDatetime()->format("j") == $j + 1){
                    $label = "arretHt";
                }
                else{
                    $label = strftime("%w", $datetime->getTimestamp());
                }
                
                array_push($ligneSalarie, array($label, $datetime->format("j")));
                array_push($ligneSalarie, array($label,  strtoupper(substr(strftime("%a", $datetime->getTimestamp()),0,1))));
                
                // Heures réelles
                $heure = $hManager->getBySalarieDate($salarie, $datetime, "hr");
                
                if(isset($heure) && ($heure->getDatetime()->format("i") == "00")){
                    array_push($ligneSalarie, array($label, $heure->getDatetime()->format("G") ."h"));
                }
                else if(isset($heure) && ($heure->getDatetime()->format("H:i") != "00:00")){
                    array_push($ligneSalarie, array($label, $heure->getDatetime()->format("G") ."h". $heure->getDatetime()->format("i")));
                }
                else{
                    array_push($ligneSalarie, array($label, ""));
                }
                
                $heure = $hManager->getBySalarieDate($salarie, $datetime, "hr");
                
                if(isset($heure) && ($heure->getTypeHeure()->getId() != 1)){
                    array_push($ligneSalarie, array($label, $heure->getTypeHeure()->getLibelle()));
                }
                else{                    
                    array_push($ligneSalarie, array($label, ""));
                }
                
                array_push($data, $ligneSalarie);
                
                $ligneSalarie = [];
                $datetime->add(new DateInterval("P1D"));
            }            
            
            if($i == 6){
                $y = 110;
                $x = 10;
            }
            
            $pdf->setXY($x, $y);
            $x += 50;
            
            $pdf->SetFont("Arial", "", 8);
            $pdf->basicTable($pdf, $header, $data);
            
            // Report de l'année précédente
            if($i == 0){
                $rManager = new ReportManager($db);
                
                $datetime->sub(new DateInterval("P1Y"));
                $report = $rManager->getBySalarieDate($salarie, $datetime);
                $datetime->add(new DateInterval("P1Y"));
                
                if($report){
                    $pdf->setXY($x - 51, $pdf->getY() + 2.3);
                    $pdf->Cell(25, 0, "Report de l'année précédente : ", 0, 0, "L");
                    $pdf->Cell(2, 0, $report->getHeure() ."h", 0, 0, "L");
                }
            }
            
            // Heures théoriques du mois
            $datetime->sub(new DateInterval("P2M"));
            $arretPrecedent = $ahManager->getByDate($datetime);
            $datetime->add(new DateInterval("P2M"));
            
            if(!empty($arretPrecedent)){
                $datetimeStart = $arretPrecedent->getDatetime();
            }
            else{
                $datetimeStart = clone $datetime;
                $datetimeStart->sub(new DateInterval("P1M"));
            }
            
            $datetimeEnd = clone $datetimeStart;
            $datetimeEnd->add(new DateInterval("P1M"));
            $datetimeEnd->setTimestamp(strtotime(date("Y-m-t", $datetimeEnd->getTimestamp())));
            
            $diff = $datetimeStart->diff($datetimeEnd)->format("%a");
            
            $htTotal = 0;
            for($k = 0; $k < $diff; $k++){
                $ht = $hManager->getBySalarieDate($salarie, $datetimeStart, "ht");
                
                if($ht){
                    $h = $ht->getDatetime()->format("H");
                    $min = $ht->getDatetime()->format("i");
                    
                    $htTotal += $h + ($min / 60);
                }
                
                if(!empty($arret) && $arret->getDatetime()->format("Y-m-d") == $datetimeStart->format("Y-m-d")){
                    break;
                }
                
                
                $datetimeStart->add(new DateInterval("P1D"));
            }
            
            $pdf->setXY($x - 51, $pdf->getY() + 2.3);
            $pdf->Cell(25, 0, "Total heures théoriques mois : ", 0, 0, "L");
            $pdf->Cell(2, 0, round($htTotal, 2) ."h", 0, 0, "L");
            
            // Heures réalisées du mois
            
            $datetime->sub(new DateInterval("P2M"));
            $arretPrecedent = $ahManager->getByDate($datetime);
            $datetime->add(new DateInterval("P2M"));
            
            if(!empty($arretPrecedent)){
                $datetimeStart = $arretPrecedent->getDatetime();
            }
            else{
                $datetimeStart = clone $datetime;
                $datetimeStart->sub(new DateInterval("P1M"));
            }
            
            $datetimeEnd = clone $datetimeStart;
            $datetimeEnd->add(new DateInterval("P1M"));
            $datetimeEnd->setTimestamp(strtotime(date("Y-m-t", $datetimeEnd->getTimestamp())));
            
            $diff = $datetimeStart->diff($datetimeEnd)->format("%a");
            
            $hrTotal = 0;
            for($k = 0; $k < $diff; $k++){
                $hr = $hManager->getBySalarieDate($salarie, $datetimeStart, "hr");
                
                if($hr){
                    $h = $hr->getDatetime()->format("H");
                    $min = $hr->getDatetime()->format("i");
                    
                    $hrTotal += $h + ($min / 60);
                    $hrCumul += $h + ($min / 60);
                }
                
                if(!empty($arret) && $arret->getDatetime()->format("Y-m-d") == $datetimeStart->format("Y-m-d")){
                    break;
                }
                
                $datetimeStart->add(new DateInterval("P1D"));
            }
            
            $pdf->setXY($x - 51, $pdf->getY() + 2.3);
            $pdf->Cell(25, 0, "Heures réalisées mois : ", 0, 0, "L");
            $pdf->Cell(2, 0, round($hrTotal, 2) ."h", 0, 0, "L");
            
            // Heures réalisées cumul
            $pdf->setXY($x - 51, $pdf->getY() + 2.3);
            $pdf->Cell(25, 0, "Heures réalisées cumul : ", 0, 0, "L");
            $pdf->Cell(2, 0, round($hrCumul, 2) ."h", 0, 0, "L");
            
            // Heures supp payées du mois
            $datetime->sub(new DateInterval("P1M"));                
            $hs = $hsManager->getBySalarieMonth($salarie, $datetime);
            $datetime->add(new DateInterval("P1M"));
            
            if(empty($hs)){
                $hs = 0;
            }
            else{
                $hs = $hs->getHeure();
                $hsCumul += $hs;
            }
            
            $pdf->setXY($x - 51, $pdf->getY() + 2.3);
            $pdf->Cell(25, 0, "Heures sup. payées mois : ", 0, 0, "L");
            $pdf->Cell(2, 0, $hs ."h", 0, 0, "L");
            
            // Heures supp payées cumul
            $pdf->setXY($x - 51, $pdf->getY() + 2.3);
            $pdf->Cell(25, 0, "Heures sup. payées cumul : ", 0, 0, "L");
            $pdf->Cell(2, 0, $hsCumul ."h", 0, 0, "L");
            
            // Solde du mois            
            $pdf->setXY($x - 51, $pdf->getY() + 2.3);
            $pdf->Cell(25, 0, "Solde mois : ", 0, 0, "L");
            $pdf->Cell(2, 0, round($hrTotal - $htTotal, 2) ."h", 0, 0, "L");
            
            // Solde  cumul
            $soldeCumul += $hrTotal - $htTotal;
            $pdf->setXY($x - 51, $pdf->getY() + 2.3);
            $pdf->Cell(25, 0, "Solde à la fin : ", 0, 0, "L");
            $pdf->Cell(2, 0, round($soldeCumul, 2) ."h", 0, 0, "L");
        }
    }
    $pdf->Output();
}

?>