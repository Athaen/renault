<!DOCTYPE html>
<html lang="fr">
<head>
    <?php
    require_once("path.php");
    require_once(includePath . "/head.php");
    
    authentificationRequise();
    ?>
    
    <link rel="stylesheet" href="css/materialCheckbox.css"/>
    
    <title>Gestion des salariés</title>
</head>
<body>
    <?php require_once(includePath . "/navbar.php"); ?>
    
    <!-- content container -->
    <div class="container">
        <?php require_once(includePath . "/flash.php"); ?>
        
        <!-- nav tabs -->
        <ul class="nav nav-tabs" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#gestion" role="tab"><i class="fa fa-sliders">  Gérer les salariés</i></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#ajout" role="tab"><i class="fa fa-user-plus">  Ajouter un salarié</i></a>
            </li>
        </ul>
        <!-- /nav tabs -->
        
        <!-- tab panes -->
        <div class="tab-content">
            <div class="tab-pane active" id="gestion" role="tabpanel">
                <?php require_once("include/administrationSalarieGestion.php"); ?>
            </div>
            <div class="tab-pane" id="ajout" role="tabpanel">
                <?php require_once("include/administrationSalarieAjout.php"); ?>
            </div>
        </div>
        <!-- /tab panes -->
    </div>  
    <!-- /content container -->
    
    <?php require_once(includePath . "/footer.php"); ?>
    
    <!-- scripts -->
    <?php require_once(includePath . "/scripts.php"); ?>
    <script src="js/administrationSalarie.js"></script>
    <!-- /scripts -->
</body>
</html>