<!DOCTYPE html>
<html lang="fr">
<head>
    <?php
    require_once("path.php");
    require_once(includePath . "/head.php");
    
    authentificationRequise();
    ?>
    
    <link rel="stylesheet" href="css/planningTheorique.css"/>
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.min.css" />
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker3.min.css" />
    
    <title>Authentification</title>
</head>
<body>
    <?php require_once(includePath . "/navbar.php"); ?>
    
    <div class="container">
        <?php require_once(includePath . "/flash.php"); ?>
        
        <form id="planningTheoriqueForm" action="planningTheorique.php" method="post" class="col-md-3 col-sm-4">
           <?php require_once(includePath . "/planningTheoriqueForm.php"); ?>
        </form>
        
        <?php
        
        if(isset($_POST["validationForm"])){
            var_dump($_POST);
        }
        
        ?>
    </div> <!-- /container -->

    <!-- scripts -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>    
    <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.min.js"></script>
    <script src="js/datepicker.js"></script>
    
    <!-- /scripts -->
</body>
</html>