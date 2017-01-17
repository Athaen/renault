<?php 

$_POST["selectedDate"] = $_POST["selectedDate"] . " 00:00:00";

// DateTime début du mois sélectionné
$selectedDate = DateTime::createFromFormat("d/m/Y H:i:s", $_POST["selectedDate"]);

// DateTime fin du mois sélectionné
$plusUnMois = DateTime::createFromFormat("d/m/Y H:i:s", $_POST["selectedDate"]); 
$plusUnMois = $plusUnMois->add(new DateInterval("P1M"));

// DateInterval entre les deux DateTime
$diff = $selectedDate->diff($plusUnMois);

?>
<input type="hidden" name="idSalarie" value="<?php echo $_POST["idSalarie"]; ?>"/>

<table id='planningTable' class='table table-sm table-striped table-hover'>
    <thead>
        <tr>
            <th>Date</th>
            <th>Heures<htd>
            <th>Type</th>
        </tr>
    </thead>
    
    <tbody>
<?php
for($i = 0; $i < $diff->format("%a"); $i++){
    $heureValue = null;
    $minuteValue = null;
    
    // récupération des heures si déjà existantes en db
    if(isset($_POST["validationPlanningFormTheorique"])){
        $htManager = new HeureTheoriqueManager($db);
        $sManager = new SalarieManager($db);
        
        $salarie = $sManager->get($_POST["idSalarie"]);
        $heureTheorique = $htManager->getBySalarieDate($salarie, $selectedDate);
        
        if($heureTheorique){
            $heureValue = $heureTheorique->getDatetime()->format("G");
            $minuteValue = $heureTheorique->getDatetime()->format("i");
        }
    }
    else if(isset($_POST["validationPlanningFormReel"])){
        $hrManager = new HeureReelManager($db);
        $sManager = new SalarieManager($db);
        
        $salarie = $sManager->get($_POST["idSalarie"]);
        $heureReel = $hrManager->getBySalarieDate($salarie, $selectedDate);
        
        if($heureReel){
            $heureValue = $heureTheorique->getDatetime()->format("H");
            $minuteValue = $heureTheorique->getDatetime()->format("i");
        }
        
    } // /récupération des heures si déjà existantes en db
    
    $jour = strftime("%A", $selectedDate->getTimestamp());
    $jourNum = strftime("%w", $selectedDate->getTimestamp());
    $numero = strftime("%#d", $selectedDate->getTimestamp());
    $mois = utf8_encode(strftime("%B", $selectedDate->getTimestamp()));
    $annee = utf8_encode(strftime("%Y", $selectedDate->getTimestamp()));
?>
        <tr <?php if($jourNum == 0 || $jourNum == 6){ echo "class='planningBg'"; } ?>>
            <td>
                <?php echo ucfirst($jour) . " " . $numero . " " . $mois . " " . $annee; ?>
                <input type="hidden" name="date[]" value="<?php echo $selectedDate->format("Y-m-d"); ?>"/>
            </td>
            <td>
                <div class="input-group">
                    <input name="heure[]" type="number" class="form-control" min="1" max="24" step="1" value="<?php echo $heureValue; ?>">
                    <span class="input-group-addon">h</span>
                    <input name="minute[]" type="number" class="form-control" min="1" max="59" step="1" value="<?php echo $minuteValue; ?>">
                    <span class="input-group-addon">m</span>
                </div>
           </td>
            <td>
                    <select class="form-control" name="idTypeHeure[]">
                        <?php
                        $thManager = new TypeHeureManager($db);
                        
                        foreach($thManager->getList() as $typeHeure){
                            if($typeHeure->getId() == 1){
                                echo "<option value ='".$typeHeure->getId()."'></option>";
                            }
                            else{                                
                                echo "<option value ='".$typeHeure->getId()."'>".$typeHeure->getLibelle()."</option>";
                            }
                        }
                        ?>
                    </select>
            </td>
        </tr>
<?php 
    $selectedDate->add(new DateInterval("P1D"));
}
?>
    </tbody>
</table>
