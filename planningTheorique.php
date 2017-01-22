<!DOCTYPE html>
<html lang="fr">

<head>
    <?php
    require_once("path.php");
    require_once(includePath . "/head.php");
    
    authentificationRequise();
    ?>
    
    <link rel="stylesheet" href="css/planning.css" />
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker3.min.css" />
    
    <title>Planning théorique</title>
</head>

<body>
    <?php require_once(includePath . "/navbar.php"); ?>
    
    <!-- content container -->
    <div class="container">
        <?php require_once(includePath . "/flash.php"); ?>
        
        <!-- row -->
        <div class="row">
            <!-- formulaire datepicker & salariés -->
            <form id="planningForm" action="planningTheorique.php" method="post" class="col-sm-6 col-md-4">
                <?php require_once(includePath . "/planningForm.php"); ?>
                
                <button id="validationPlanningForm" name="validationPlanningFormTheorique" class="btn btn-block btn-outline-primary">Valider</button>
            </form>
            <!-- /formulaire datepicker & salariés -->
            
            <!-- tableau de saisie des heures -->
            <?php if(isset($_POST["validationPlanningFormTheorique"])){ ?>
            <div class='col-sm-6 col-md-8'>
                <form action="process/planningTableForm.php" method="post">
                    <?php require_once(includePath . "/planningTable.php"); ?>
                    
                    <button name='validationHeureTheorique' class='btn btn-block btn-outline-primary'>Valider les heures</button>
                </form>
            </div>
            <?php } ?>
            <!-- /tableau de saisie des heures -->
        </div>
        <!-- /row -->
    </div>
    <!-- /content container -->
    
    <?php require_once(includePath . "/footer.php"); ?>
    
    <!-- scripts -->
    <?php require_once(includePath . "/scripts.php"); ?>
    <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.min.js"></script>
    <script src="js/datepicker.js"></script>
    <script src="js/planning.js"></script>
    <!-- /scripts -->
</body>

</html>