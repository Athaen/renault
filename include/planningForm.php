<div id="embeddingDatePicker" class="col-12" data-container="body" data-toggle="popover" data-placement="right" data-trigger="focus" data-html="true" data-content="<i class='fa fa-exclamation-triangle'></i> Vous devez sélectionner une date"></div>
<input type="hidden" id="selectedDate" name="selectedDate"/>

<div class="form-group col-12">
        <?php
        
        $seManager = new ServiceManager($db);
        $saManager = new SalarieManager($db);
        
        $services = $seManager->getList();
        
        echo '<select id="selectMultiple" name="idSalarie" class="form-control" size="15" required>';
        
        foreach($services as $service){
            
            echo '<optgroup label="' . mb_strtoupper($service->getLibelle(), "UTF-8") . '">';
            
            $salaries = $saManager->getListFromService($service);
            foreach($salaries as $salarie){
                echo "<option value='" . $salarie->getId() . "'>" . mb_strtoupper($salarie->getNom(), 'UTF-8') . " " . ucfirst($salarie->getPrenom()) . "</option>";
            }
            
            echo "</optgroup>";
        }   
        
        echo "</select>";
        
        ?>
</div>