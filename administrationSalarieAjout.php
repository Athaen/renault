<!DOCTYPE html>
<html lang="fr">
<head>
    <?php
    require_once("path.php");
    require_once(includePath . "/head.php");
    
    authentificationRequise();
    ?>
    
    <link rel="stylesheet" href="css/materialCheckbox.css"/>
    
    <title>Ajouter un salarié</title>
</head>
<body>
    <?php require_once(includePath . "/navbar.php"); ?>
    
    <!-- content container -->
    <div class="container">
        <?php require_once(includePath . "/flash.php"); ?>
        <!-- row -->
        <div class="row">
            <!-- formulaire ajout salarié -->
            <form action="process/administrationAjoutSalarieForm.php" method="post" class="col-12">
                <!-- nom & prénom -->
                <div class="row">
                    <div class="form-group col-12 col-sm-6">
                        <input class="form-control" type="text" id="nom" name="nom" placeholder="Nom du salarié" required/>
                    </div>
                    
                    <div class="form-group col-12 col-sm-6">     
                        <input class="form-control" type="text" id="prenom" name="prenom" placeholder="Prénom du salarié" required/>
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
                                    echo "<option value='". $service->getId() ."'>". mb_strtoupper($service->getLibelle(), "UTF-8") ."</option>";
                                }
                                
                                ?>
                            </optgroup>
                        </select>
                    </div>
                </div>
                <!-- /multiple select service -->
                
                <!-- card & list-group checkbox autorisations -->
                <div class="form-group row">
                    <div class="col-xs-12 col-sm-6 col-lg-12 col-sm-offset-3 col-md-offset-4">
                        <div class="card">
                            <div class="card-header">Autorisations</div>
                            <ul class="list-group list-group-flush">
                               <?php
                                
                                $aManager = new AutorisationManager($db);
                                
                                $autorisations = $aManager->getList();
                                
                                $i = 0;
                                foreach($autorisations as $autorisation){
                                ?>
                                <li class="list-group-item justify-content-between">
                                    <?php echo ucfirst($autorisation->getLibelle()); ?>
                                    <div class="material-switch pull-right">
                                        <input id="<?php echo $i; ?>" name="autorisations[]" type="checkbox" value="<?php echo $autorisation->getId(); ?>"/>
                                        <label for="<?php echo $i; ?>" class=""></label>
                                    </div>
                                </li>
                                <?php
                                    $i++;
                                }
                                ?>
                            </ul>
                        </div>
                    </div>            
                </div>
                <!-- /card & list-group checkbox autorisations -->
                
                <!-- input mdp -->
                <div class="row">
                    <div class="form-group col-12" id="inputMdp">
                        <input type="password" class="form-control" id="mdp" name="mdp" placeholder="Mot de passe" required>
                    </div>
                </div>
                <!-- /input mdp -->
                
                <button class="btn btn-block btn-outline-primary" name="validationAdministrationSalarieAjout">Ajouter</button>
            </form>
            <!-- /formulaire ajout salarié -->
        </div>
        <!-- /row -->
    </div>  
    <!-- /content container -->
    
    <?php require_once(includePath . "/footer.php"); ?>
    
    <!-- scripts -->
    <?php require_once(includePath . "/scripts.php"); ?>
    <script src="js/administrationSalarieAjout.js"></script>
    <!-- /scripts -->
</body>
</html>