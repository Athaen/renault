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
            <form id="reportForm" action="report.php" method="post" class="col-sm-6 col-md-4">
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
            
            <!-- if service sélectionné -->
            <?php
                if(isset($_POST["validationReportForm"])){
                    $saManager = new SalarieManager($db);
                    $seManager = new ServiceManager($db);
                    $hManager = new HeureManager($db);
                    
                    $service = $seManager->get($_POST["idService"]);
                    
                    $salaries = $saManager->getListByService($service);
            ?>
            
            <!-- form report -->
            <form class="col-sm-6 col-md-8" action="process/reportForm.php" method="post">
                <input type="hidden" name="selectedDate" value="<?php echo $_POST["selectedDate"]; ?>"/>
                
                <table class='cadre table table-sm table-striped table-hover'>
                    <thead>
                        <tr>
                            <th>Salarié</th>
                            <th>Report</th>
                        </tr>
                    </thead>
                    
                    <tbody>
                        <?php 
                            foreach($salaries as $salarie){
                                $datetime = new DateTime($_POST["selectedDate"] ." 00:00:00");
                                $heure = $hManager->getBySalarieDate($salarie, $datetime, "r");
                                
                                if($heure){
                                    $reportValue = ltrim($heure->getDatetime()->format("G"), 0);
                                    $idValue = $heure->getId();
                                }
                                else{
                                    $reportValue = null;
                                    $idValue = null;
                                }
                        ?>
                        
                        <input type="hidden" name="salarie[]" value="<?php echo $salarie->getId(); ?>"/>
                        <input type="hidden" name="id[]" value="<?php echo $idValue; ?>"/>
                        
                        <tr>
                            <td>
                                <?php echo mb_strtoupper($salarie->getNom(), "UTF-8") ." ". ucfirst($salarie->getPrenom()); ?>
                            </td>
                            <td>
                                <div class="input-group justify-content-center">
                                    <input class="text-center" name="report[]" type="number" class="form-control" min="0" max="9999" step="1" value="<?php echo $reportValue; ?>">
                                    <span class="input-group-addon">h</span>
                                </div>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
                
                <button name="validationReportTable" class="btn btn-block btn-outline-primary">Valider</button>
            </form>
            <!-- form report -->
            
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