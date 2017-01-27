<!-- row -->
<div class="row">
    <!-- div col -->
    <div class="col-12 col-sm-6 col-md-4">
        <!-- form sélection salarie -->
        <form class="col-12" method="post" action="administrationSalarie.php">
            <!-- form-group row -->
            <div class="form-group row">
                <!-- select service -->
                <select class="form-control" name="idSalarie" size="15" required>
                    <?php
                    
                    $saManager = new SalarieManager($db);
                    $seManager = new ServiceManager($db);
                    
                    $services = $seManager->getList();
                    
                    foreach($services as $service){                            
                        echo '<optgroup label="' . mb_strtoupper($service->getLibelle(), "UTF-8") . '">';
                        
                        $salaries = $saManager->getListByService($service);
                        foreach($salaries as $salarie){
                            echo "<option value='". $salarie->getId() ."'>". mb_strtoupper($salarie->getNom(), "UTF-8") ." ". ucfirst($salarie->getPrenom()) ."</option>";
                        }
                        
                        echo "</optgroup>";
                    }
                    
                    ?>
                </select>
                <!-- /select service -->
            </div>
            <!-- /form-group row -->
            
            <!-- row -->
            <div class="row">
                <button id="validationSalarieGestionSelect" name="validationSalarieGestionSelect" class="btn btn-block btn-outline-primary">Valider</button>
            </div>
            <!-- /row -->
        </form>
        <!-- /form sélection salarie -->
    </div>
    <!-- /div col -->
    
    <!-- if salarié sélectionné -->
    <?php if(isset($_POST["validationSalarieGestionSelect"])){ ?>

        <!-- form gestion salarié -->
        <form action="process/administrationSalarieGestionForm.php" method="post" class="col-12 col-sm-6 col-md-8">
            <?php                
                $saManager = new SalarieManager($db);
                
                $salarie = $saManager->get($_POST["idSalarie"]);
            ?>
            <!-- idSalarie -->
            <input type="hidden" name="idSalarie" value="<?php echo $_POST["idSalarie"]; ?>">
            <!-- /idSalarie -->
            
            <!-- nom & prénom -->
            <div class="row">
                <div class="form-group col-sm-6">
                    <input class="form-control" type="text" id="nom" name="nom" value="<?php echo ucfirst($salarie->getNom());?>" placeholder="Nom" required/>
                </div>
                
                <div class="form-group col-sm-6">   
                    <input class="form-control" type="text" id="prenom" name="prenom" value="<?php echo ucfirst($salarie->getPrenom());?>" placeholder="Prénom" required/>
                </div>         
            </div>
            <!-- /nom & prénom -->
            
            <!-- multiple select service-->
            <div class="form-group row">
                <div class="col-12">
                    <select class="form-control" id="service" name="service" size="7" required>
                        <optgroup label="Service du salarié">
                            <?php
                            
                            $seManager = new ServiceManager($db);
                            
                            $services = $seManager->getList();
                            
                            foreach($services as $service){
                                $selected = "";
                                if($service == $salarie->getService()){
                                    $selected = "selected";
                                }
                                
                                echo "<option value='". $service->getId() ."' $selected>". mb_strtoupper($service->getLibelle(), "UTF-8") ."</option>";
                            }
                            
                            ?>
                        </optgroup>
                    </select>
                </div>
            </div>
            <!-- /multiple select service -->
            
            <!-- card & list-group checkbox autorisations -->
            <div class="form-group row">
                <div class="col-12">
                    <div class="card cadre">
                        <div class="card-header">Autorisations</div>
                        <ul class="list-group list-group-flush">
                           <?php
                            
                            $aManager = new AutorisationManager($db);
                            
                            $autorisations = $aManager->getList();
                            
                            $i = 1;
                            foreach($autorisations as $autorisation){
                                $checked = "";
                                foreach($salarie->getAutorisations() as $a){
                                    if($autorisation == $a){
                                        $checked = "checked";
                                    }
                                }
                            ?>
                            <li class="list-group-item justify-content-between">
                                <?php echo ucfirst($autorisation->getLibelle()); ?>
                                <div class="material-switch pull-right">
                                    <input id="<?php echo $i; ?>" name="autorisations[]" type="checkbox" value="<?php echo $autorisation->getId(); ?>" <?php echo $checked; ?>/>
                                    <label for="<?php echo $i; ?>" class=""></label>
                                </div>
                            </li>
                            <?php
                                $i += 2;
                            }
                            ?>
                        </ul>
                    </div>
                </div>            
            </div>
            <!-- /card & list-group checkbox autorisations -->
            
            <!-- input mdp -->
            <div class="row">
                <div class="form-group col-12" id="inputMdp2">
                    <input type="password" class="form-control" id="mdp2" name="mdp" value="<?php echo $salarie->getMdp(); ?>" placeholder="Mot de passe">
                </div>
            </div>
            <!-- /input mdp -->
            
            <button class="btn btn-block btn-outline-primary" name="validationSalarieModifier">Modifier</button>
        </form>
        <!-- /form gestion salarié -->
        
    <?php } ?>
    <!-- /if salarié sélectionné -->
</div>
<!-- /row -->