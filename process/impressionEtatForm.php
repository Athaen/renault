<?php

require_once("../path.php");

authentificationRequise();

require(classePath . "/fpdf.php");

if(isset($_POST["validationEtatForm"])){
    $redirection = false;
    
    if(empty($_POST["dateStart"]) || empty($_POST["dateEnd"]) || empty($_POST["service"])){
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
            $this->SetFont('Arial', 'B', 15);
            $this->MultiCell(0, 0, "Etats de sortie du ". $_POST["dateStart"] ." au ". $_POST["dateEnd"], 0, 'C');
            $this->Ln(20);
            $this->SetY(20);
        }
        
        // Tableau affichage heures
        function BasicTable($pdf, $header, $data){
            // En-tête
            $i = 0;
            foreach($header as $col){
                $this->setFillColor(200,200,200);
                
                if($i == 0){
                    $pdf->SetFont("Arial","B",8);
                    $this->Cell(28, 5, $col, 1, 0, "C", 1);
                    $i++;
                }
                else{
                    $pdf->SetFont("Arial","",8);
                    $this->Cell(18, 5, $col, 1, 0, "C", 1);
                }
            }
            $this->Ln();
            
            // Données
            $j = 0;
            foreach($data as $row){
                $i = true;
                foreach($row as $col){
                    $pdf->SetFont("Arial","",6);
                    
                    if($i){
                        $this->Cell(28, 5, $col, 1, 0, "L");
                        $i = false;
                    }
                    else{
                        $this->Cell(18, 5, $col, 1, 0, "C");
                    }
                    
                }
                $j++;
                $this->Ln();
            }
        }
    }
    
    $pdf = new PDF();
    $pdf->AddPage();
    
    $seManager = new ServiceManager($db);
    $saManager = new SalarieManager($db);
    $hManager = new HeureManager($db);
    $thManager = new TypeHeureManager($db);
    
    $datetimeStart = DateTime::createFromFormat("d/m/Y", $_POST["dateStart"]);
    $datetimeEnd = DateTime::createFromFormat("d/m/Y", $_POST["dateEnd"]);
        
    foreach($_POST["service"] as $key => $value){
        $header = [];
        $data = [];
        $total = [];
        $total[] = "Total";
        
        // Header - Service        
        $service = $seManager->get($value);        
        $header[] = $service->getLibelle();
        
        // Header - Type heure
        foreach($thManager->getList() as $typeHeure){
            if($typeHeure->getId() != 1){
                $header[] = $typeHeure->getLibelle();
            }
        }
        
        foreach($saManager->getListByService($service) as $salarie){
            $ligne = [];
            
            $ligne[] = strtoupper($salarie->getNom()) ." ". ucfirst($salarie->getPrenom());
            $j = 0;
            foreach($thManager->getList() as $typeHeure){
                if($typeHeure->getId() != 1){
                    $j++;
                    $i = count($hManager->getListBySalarieTypeRange($salarie, $typeHeure, $datetimeStart, $datetimeEnd));
                    
                    $ligne[] = $i;
                    $total[$j] = $i;
                }
            }
            
            $data[] = $ligne;
        }
        
        $data[] = $total;
        
        $pdf->basicTable($pdf, $header, $data);
    }
    
    $pdf->Output();
}

?>