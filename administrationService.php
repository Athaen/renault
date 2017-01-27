<!DOCTYPE html>
<html lang="fr">
<head>
    <?php
    require_once("path.php");
    require_once(includePath . "/head.php");
    
    authentificationRequise();
    ?>
    
    <title>Gestion des services</title>
</head>
<body>
    <?php require_once(includePath . "/navbar.php"); ?>
    
    <!-- content container -->
    <div class="container">
        <?php require_once(includePath . "/flash.php"); ?>
        
        <!-- nav tabs -->
        <ul class="nav nav-tabs" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#gestion" role="tab"><i class="fa fa-sliders">  Gérer les services</i></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#ajout" role="tab"><i class="fa fa-plus">  Ajouter un service</i></a>
            </li>
        </ul>
        <!-- /nav tabs -->
        
        <!-- tab panes -->
        <div class="tab-content">
            <div class="tab-pane active" id="gestion" role="tabpanel">
                <?php require_once("include/administrationServiceGestion.php"); ?>
            </div>
            <div class="tab-pane" id="ajout" role="tabpanel">
                <?php require_once("include/administrationServiceAjout.php"); ?>
            </div>
        </div>
        <!-- /tab panes -->
    </div>  
    <!-- /content container -->
    
    <?php require_once(includePath . "/footer.php"); ?>
    
    <!-- scripts -->
    <?php require_once(includePath . "/scripts.php"); ?>
    <!-- /scripts -->
</body>
</html>