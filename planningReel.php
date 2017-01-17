<!DOCTYPE html>
<html lang="fr">
<head>
    <?php
    require_once("path.php");
    require_once(includePath . "/head.php");
    
    authentificationRequise();
    ?>
    
    <link rel="stylesheet" href="css/planning.css"/>
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker3.min.css" />
    
    <title>Planning réel</title>
</head>
<body>
    <?php require_once(includePath . "/navbar.php"); ?>
    
    <!-- content container -->
    <div class="container">
        <?php require_once(includePath . "/flash.php"); ?>
        
        <div class="row">
            <form id="planningForm" action="planningReel.php" method="post" class="col-sm-6 col-md-4">
               <?php require_once(includePath . "/planningForm.php"); ?>

                <button id="validationPlanningForm" name="validationPlanningFormReel" class="btn btn-block btn-outline-primary">Valider</button>
            </form>
            
            <?php if(isset($_POST["validationPlanningFormReel"])){ ?>
            <div class='col-sm-6 col-md-8'>
                <form action="process/planningTableForm.php" method="post">
                    <?php require_once(includePath . "/planningTable.php"); ?>
                    
                    <button name='validationHeureReel' class='btn btn-block btn-outline-primary'>Valider les heures</button>
                </form>
            </div>
            <?php } ?>
        </div>
    </div> <!-- /content container -->
    
    <?php require_once(includePath . "/footer.php"); ?>
    
    <!-- scripts -->
    <?php require_once(includePath . "/scripts.php"); ?>
    <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.min.js"></script>
    <script src="js/datepicker.js"></script>
    <!-- /scripts -->
</body>
</html>