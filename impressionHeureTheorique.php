<!DOCTYPE html>
<html lang="fr">

<head>
    <?php
    require_once("path.php");
    require_once(includePath . "/head.php");
    
    authentificationRequise();
    
    if(isset($_POST["validationReportForm"]) && empty($_POST["selectedDate"])){
        $_SESSION["flash"]["danger"] = "Vous devez sélectionner une date";
        
        header("Location: report.php");
        exit();
    }
    ?>
    
    <link rel="stylesheet" href="css/datePicker.css" />
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker3.min.css" />
    
    <title>Impression - Heures théoriques</title>
</head>

<body>
    <?php require_once(includePath . "/navbar.php"); ?>
    
    <!-- content container -->
    <div class="container">
        <?php require_once(includePath . "/flash.php"); ?>
        
        <!-- row -->
        <div class="row">
            <!-- formulaire datepicker & services -->
            <form id="reportForm" action="report.php" method="post" class="col-12">
                <!-- row -->
                <div class="row">
                    <!-- datepicker -->
                    <div class="jsDatepicker col-12" data-date-start-view="2" data-date-min-view-mode="2" data-date-max-view-mode="2" data-container="body" data-toggle="popover" data-placement="right" data-trigger="focus" data-html="true" data-content="<i class='fa fa-exclamation-triangle'></i> Vous devez sélectionner une date"></div>
                    <input class="jsSelectedDate" type="hidden" name="selectedDate" value=""/>
                    <!-- /datepicker -->
                    
                    <!-- div col -->
                    <div class="col-12">
                        <!-- select service-->
                        <select class="form-group form-control datepickerSelect" name="idService" size="12" required>
                            <optgroup label="Services">
                                <?php
                                
                                $seManager = new ServiceManager($db);
                                
                                $services = $seManager->getList();
                                
                                foreach($services as $service){
                                    echo "<option value='". $service->getId() ."'>". mb_strtoupper($service->getLibelle(), "UTF-8") ."</option>";
                                }
                                
                                ?>
                            </optgroup>
                        </select>
                        <!-- select service-->
                        
                        <button name="validationReportForm" class="datepickerValidation btn btn-block btn-outline-primary">Valider</button>
                    </div>
                    <!-- div col -->
                </div>
                <!-- /row -->
            </form>
            <!-- /formulaire datepicker & services -->
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