<!DOCTYPE html>
<html lang="fr">
<head>
    <?php
    require_once("path.php");
    require_once(includePath . "/head.php");
    
    authentificationRequise();
    
    if(isset($_POST["validationArretHtForm"]) && empty($_POST["selectedDate"])){
        $_SESSION["flash"]["danger"] = "Vous devez sélectionner une date";
        
        header("Location: arretHt.php");
        exit();
    }
    ?>
    
    <link rel="stylesheet" href="css/datePicker.css" />
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker3.min.css" />
    
    <title>Arrêt des heures théoriques</title>
</head>

<body>
    <?php require_once(includePath . "/navbar.php"); ?>
    
    <!-- content container -->
    <div class="container">
        <?php require_once(includePath . "/flash.php"); ?>
        
        <!-- row -->
        <div class="row">
            <!-- formulaire datepicker & services -->
            <form id="reportForm" action="arretHt.php" method="post" class="col-sm-6 col-md-4">
                <!-- row -->
                <div class="row">
                    <!-- datepicker -->
                    <div class="jsDatepicker col-12 form-group" data-date-start-view="1" data-date-min-view-mode="1" data-container="body" data-toggle="popover" data-placement="right" data-trigger="focus" data-html="true" data-content="<i class='fa fa-exclamation-triangle'></i> Vous devez sélectionner une date"></div>
                    <input class="jsSelectedDate" type="hidden" name="selectedDate" value=""/>
                    <!-- /datepicker -->
                    
                    <!-- div col -->
                    <div class="col-12">
                        <button name="validationArretHtForm" class="datepickerValidation btn btn-block btn-outline-primary">Valider</button>
                    </div>
                    <!-- div col -->
                </div>
                <!-- /row -->
            </form>
            <!-- /formulaire datepicker & services -->
            
            <!-- if service sélectionné -->
            <?php
            
            if(isset($_POST["validationArretHtForm"])){
                $ahtManager = new ArretHtManager($db);
                
                $_POST["selectedDate"] = $_POST["selectedDate"] . " 00:00:00";
                
                // DateTime début du mois sélectionné
                $datetime = DateTime::createFromFormat("d/m/Y H:i:s", $_POST["selectedDate"]);
                $date = $datetime->format("d/m/Y");
                
                // DateTime fin du mois sélectionné
                $datetime1mois = DateTime::createFromFormat("d/m/Y H:i:s", $_POST["selectedDate"]);
                $datetime1mois->add(new DateInterval("P1M"));
                $datetime1mois->sub(new DateInterval("P1D"));
                $date1mois = $datetime1mois->format("d/m/Y");
                
                $aht = $ahtManager->getByDate($datetime);
                
                if($aht){
                    $idValue = $aht->getId();
                    $dayValue =  $aht->getDatetime()->format("d");
                    $selectedDayValue = $aht->getDatetime()->format("d/m/Y");
                }
                else{
                    $idValue = null;
                    $dayValue = null;
                    $selectedDayValue = null;
                }
            ?>
            
            <!-- form heure theorique -->
            <form class="col-sm-6 col-md-8" action="process/arretHtForm.php" method="post">
                <input type="hidden" name="id" value="<?php echo $idValue; ?>"/>
                
                <div class="form-group input-group">
                    <span class="input-group-addon">Arrêt le</span>
                    <!-- datepicker -->
                    <input 
                        id="dayDatepicker"
                        class="form-control text-center" 
                        type="text"
                        value=""
                        style="background:white;"
                        data-date-start-date="<?php echo $date; ?>"
                        data-date-end-date="<?php echo $date1mois; ?>"
                        placeholder="<?php echo $dayValue; ?>"
                        value="<?php echo $dayValue; ?>"
                        readonly
                    />
                    <input type="hidden" name="selectedDay" value="<?php echo $selectedDayValue; ?>"/>
                    <!-- /datepicker -->
                    <span class="input-group-addon"><?php echo utf8_encode(strftime("%B", $datetime->getTimestamp())) ." ". $datetime->format("Y"); ?></span>
                </div>
                
                <button name="validationArretHt" class="datepickerValidation btn btn-block btn-outline-primary">Valider</button>
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