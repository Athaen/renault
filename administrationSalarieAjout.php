<!DOCTYPE html>
<html lang="fr">
<head>
    <?php
    require_once("path.php");
    require_once(includePath . "/head.php");
    
    authentificationRequise();
    ?>
    
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
                <!-- input text nom-->
                <div class="form-group row">
                    <div class="col-10 col-md-12">
                        <input class="form-control" type="text" id="nom" name="nom" placeholder="Nom du salarié" required/>
                    </div>
                </div>
                <!-- /input text nom -->
                
                <!-- input text prénom -->
                <div class="form-group row">
                    <div class="col-10 col-md-12">
                        <input class="form-control" type="text" id="prenom" name="prenom" placeholder="Prénom du salarié" required/>
                    </div>
                </div>
                <!-- /input text prénom -->
                
                <!-- select de la liste des services -->
                <div class="form-group row">
                    <div class="col-10 col-md-12">
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
                <!-- /select de la liste des services -->
                
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
    <!-- /scripts -->
</body>
</html>