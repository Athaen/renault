<!-- row -->
<div class="row">
    <!-- div col -->
    <div class="col-12 col-sm-6 col-md-4">
        <!-- form sélection service -->
        <form class="col-12" action="administrationService.php" method="post">
            <!-- form-group row -->
            <div class="form-group row">
                <!-- select service-->
                <select class="form-control" name="idService" size="12" required>
                    <optgroup label="Services">
                        <?php
                        
                        $seManager = new ServiceManager($db);
                        
                        $services = $seManager->getList();
                        
                        foreach($services as $service){
                            echo "<option value='". $service->getId() ."'>". mb_strtoupper($service->getLibelle(), "UTF-8") ."</option>";
                        }
                        
                        ?>
                    </optgroup>
                </select>
                <!-- select service-->
            </div>
            <!-- /form-group row -->
            
            <!-- row -->
            <div class="row">
                <button id="validationSalarieGestionSelect" name="validationSalarieGestionSelect" class="btn btn-block btn-outline-primary">Valider</button>
            </div>
            <!-- /row -->
        </form>
        <!-- /form sélection service -->
    </div>
    <!-- /div col -->
    
    <!-- if service sélectionné -->
    <?php if(isset($_POST["validationSalarieGestionSelect"])){ ?>
    
    <!-- form gestion service -->
    <form action="process/administrationServiceGestionForm.php" method="post" class="col-12 col-sm-6 col-md-8">
        <?php                
            $seManager = new ServiceManager($db);
            
            $service = $seManager->get($_POST["idService"]);
        ?>
        <!-- idSalarie -->
        <input type="hidden" name="idService" value="<?php echo $_POST["idService"]; ?>">
        <!-- /idSalarie -->
        
        <!-- libelle service -->
        <input class="form-group form-control" type="text" name="libelleService" value="<?php echo ucfirst($service->getLibelle());?>" placeholder="Libellé du service" required/>
        <!-- /libelle service -->
        
        <!-- row -->
        <div class="row">
            <div class="col-6">
                <button class="btn btn-block btn-outline-primary" name="validationServiceSupprimer">Supprimer</button>
            </div>
            
            <div class="col-6">
                <button class="btn btn-block btn-outline-primary" name="validationServiceModifier">Modifier</button>
            </div>
        </div>
        <!-- /row -->
    </form>
    <!-- /form gestion service -->
    
    <?php } ?>
    <!-- /if service sélectionné -->
</div>
<!-- /row -->