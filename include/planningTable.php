<?php

$_POST["selectedDate"] = $_POST["selectedDate"] . " 00:00:00";

// DateTime début du mois sélectionné
$selectedDate = DateTime::createFromFormat("d/m/Y H:i:s", $_POST["selectedDate"]);

// DateTime fin du mois sélectionné
$plusUnMois = DateTime::createFromFormat("d/m/Y H:i:s", $_POST["selectedDate"]); 
$plusUnMois = $plusUnMois->add(new DateInterval("P1M"));

// nombre de jours entre les deux DateTime
$diff = $selectedDate->diff($plusUnMois)->format("%a");

?>
<input type="hidden" name="idSalarie" value="<?php echo $_POST["idSalarie"]; ?>"/>

<table id='planningTable' class='cadre table table-sm table-striped table-hover'>
    <thead>
        <tr>
            <th>Date</th>
            <th>Heures<htd>
            <th>Type</th>
        </tr>
    </thead>
    
    <tbody>
<?php
for($i = 1; $i <= $diff; $i++){
    //  récupération des heures existantes en db
    $hManager = new HeureManager($db);
    $saManager = new SalarieManager($db);
    
    $salarie = $saManager->get($_POST["idSalarie"]);
    
    if(isset($_POST["validationPlanningFormTheorique"])){
        $rt = "t";
    }
    elseif(isset($_POST["validationPlanningFormReel"])){
        $rt = "r";
    }
    
    $heure = $hManager->getBySalarieDate($salarie, $selectedDate, $rt);
    
    $id = null;
    $heureValue = null;
    $minuteValue = null;
    $th = null;
    
    if($heure){
        $id = $heure->getId();
        $heureValue = ltrim($heure->getDatetime()->format("G"), 0);
        $minuteValue = ltrim($heure->getDatetime()->format("i"), 0);
        $th = $heure->getTypeHeure();
    }
    // /récupération des heures existantes en db
    
    $jour = strftime("%A", $selectedDate->getTimestamp());
    $jourNum = strftime("%w", $selectedDate->getTimestamp());
    $numero = strftime("%#d", $selectedDate->getTimestamp());
    $mois = utf8_encode(strftime("%B", $selectedDate->getTimestamp()));
    $annee = utf8_encode(strftime("%Y", $selectedDate->getTimestamp()));
?>
        <tr <?php if($jourNum == 0 || $jourNum == 6){ echo "class='planningBg'"; } echo "id='$i'";?>>
            <td>
                <?php if($jourNum == 1): ?>
                <i class="applyToNextWeek fa fa-chevron-circle-down fa-lg" title="Dupliquer les heures sur la semaine suivante"></i>
                <?php endif ?>
                <?php echo ucfirst($jour) . " " . $numero . " " . $mois . " " . $annee; ?>
                <input type="hidden" name="date[]" value="<?php echo $selectedDate->format("Y-m-d"); ?>"/>
                <input type="hidden" name="id[]" value="<?php echo $id; ?>"/>
            </td>
            <td>
                <div class="input-group">
                    <input class="heure" name="heure[]" type="number" class="form-control" min="0" max="24" step="1" value="<?php echo $heureValue; ?>">
                    <span class="input-group-addon">h</span>
                    <input class="minute" name="minute[]" type="number" class="form-control" min="0" max="59" step="1" value="<?php echo $minuteValue; ?>">
                    <span class="input-group-addon">m</span>
                </div>
           </td>
            <td>
                <select class="type form-control" name="idTypeHeure[]">
                    <?php
                    $thManager = new TypeHeureManager($db);
                    
                    foreach($thManager->getList() as $typeHeure){
                        if($typeHeure->getId() == 1){
                            echo "<option value ='".$typeHeure->getId()."'></option>";
                        }
                        else{
                            $selected = "";
                            if($th == $typeHeure){
                                $selected = "selected";
                            }

                            echo "<option value ='".$typeHeure->getId()."' $selected>".$typeHeure->getLibelle()."</option>";
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
