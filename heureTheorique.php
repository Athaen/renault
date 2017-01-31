<!DOCTYPE html>
<html lang="fr">

<head>
    <?php
    require_once("path.php");
    require_once(includePath . "/head.php");
    
    authentificationRequise();
    
    if(isset($_POST["validationHeureTheoriqueForm"]) && empty($_POST["selectedDate"])){
        $_SESSION["flash"]["danger"] = "Vous devez sélectionner une date";
        
        header("Location: heureTheorique.php");
        exit();
    }
    ?>
    
    <link rel="stylesheet" href="css/datePicker.css" />
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker3.min.css" />
    
    <title>Reports</title>
</head>

<body>
    <?php require_once(includePath . "/navbar.php"); ?>
    
    <!-- content container -->
    <div class="container">
        <?php require_once(includePath . "/flash.php"); ?>
        
        <!-- row -->
        <div class="row">
            <!-- formulaire datepicker & services -->
            <form id="reportForm" action="heureTheorique.php" method="post" class="col-sm-6 col-md-4">
                <!-- row -->
                <div class="row">
                    <!-- datepicker -->
                    <div class="jsDatepicker col-12 form-group" data-date-start-view="1" data-date-min-view-mode="1" data-container="body" data-toggle="popover" data-placement="right" data-trigger="focus" data-html="true" data-content="<i class='fa fa-exclamation-triangle'></i> Vous devez sélectionner une date"></div>
                    <input class="jsSelectedDate" type="hidden" name="selectedDate" value=""/>
                    <!-- /datepicker -->
                    
                    <!-- div col -->
                    <div class="col-12">
                        <button name="validationHeureTheoriqueForm" class="datepickerValidation btn btn-block btn-outline-primary">Valider</button>
                    </div>
                    <!-- div col -->
                </div>
                <!-- /row -->
            </form>
            <!-- /formulaire datepicker & services -->
            
            <!-- if service sélectionné -->
            <?php
            
            if(isset($_POST["validationHeureTheoriqueForm"])){
                $_POST["selectedDate"] = $_POST["selectedDate"] . " 00:00:00";
                
                // DateTime début du mois sélectionné
                $datetime = DateTime::createFromFormat("d/m/Y H:i:s", $_POST["selectedDate"]);                
            ?>
            
            <!-- form heure theorique -->
            <form class="col-sm-6 col-md-8" action="process/heureTheoriqueForm.php" method="post">
                <input type="hidden" name="selectedDate" value="<?php echo $_POST["selectedDate"]; ?>"/>
                
                <input class="form-group form-control" type="number" name="heureTheorique" placeholder="Heures théoriques" min="0" max="999" step="1" required/>
                
                <div class="form-group input-group">
                    <span class="input-group-addon">Arrêt le</span>
                    <input class="jsDatepicker form-control text-center" type="text" name="selectedDate" style="background:white;" readonly/>
                    <span class="input-group-addon"><?php echo utf8_encode(strftime("%B", $datetime->getTimestamp())) ." ". $datetime->format("Y"); ?></span>
                </div>
                
                <button name="validationHeureTheorique" class="datepickerValidation btn btn-block btn-outline-primary">Valider</button>
                <input type="hidden" class="selectedDate" name="selectedDay"/>
            </form>
            <!-- /form heure theorique -->
            
            <?php } ?>
            <!-- /if service sélectionné -->
        </div>
        <!-- /row -->
    </div>
    <!-- /content container -->
    
    <?php require_once(includePath . "/footer.php"); ?>
    
    <!-- scripts -->
    <?php require_once(includePath . "/scripts.php"); ?>
    <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.min.js"></script>
    <script src="js/datepicker.js"></script>
    <!-- /scripts -->
</body>

</html>