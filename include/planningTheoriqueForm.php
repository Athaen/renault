<div id="embeddingDatePicker" class="col-xs-12" ></div>
<input type="hidden" id="selectedDate" name="selectedDate" />

<div class="form-group col-xs-12">
    <div class="">
        <?php
        
        $cManager = new CategorieManager($db);
        $sManager = new SalarieManager($db);
        
        $categories = $cManager->getList();
        
        echo "<select id='selectMultiple' name='idSalarie' class='form-control' size='2'>";
        
        foreach($categories as $categorie){
            echo "<optgroup label='" . mb_strtoupper($categorie->getLibelle(), "UTF-8") . "'>";
            
            $salaries = $sManager->getListFromCategorie($categorie);
            foreach($salaries as $salarie){
                echo "<option value='" . $salarie->getId() . "'>" . mb_strtoupper($salarie->getNom(), 'UTF-8') . " " . ucfirst($salarie->getPrenom()) . "</option>";
            }
            
            echo "</optgroup>";
        }   
        
        echo "</select>";
        
        ?>
    </div>
</div>

<button id="singlebutton" name="validationForm" class="btn btn-block btn-outline-primary">Valider</button>