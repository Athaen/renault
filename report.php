<!DOCTYPE html>
<html lang="fr">

<head>
    <?php
    require_once("path.php");
    require_once(includePath . "/head.php");
    
    authentificationRequise();
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
                    <div id="yearDatePicker" class="col-12" data-container="body" data-toggle="popover" data-placement="right" data-trigger="focus" data-html="true" data-content="<i class='fa fa-exclamation-triangle'></i> Vous devez sélectionner une date"></div>
                    <input type="hidden" id="selectedDate" name="selectedDate"/>
                    <!-- /datepicker -->
                    
                    <!-- div col -->
                    <div class="col-12">
                        <!-- select service-->
                        <select class="form-group form-control" name="idService" size="12" required>
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

                        <button id="validationReport" name="validationReportForm" class="btn btn-block btn-outline-primary">Valider</button>
                    </div>
                    <!-- div col -->
                </div>
                <!-- /row -->
            </form>
            <!-- /formulaire datepicker & services -->
            
            <!-- if service sélectionné -->
            <?php if(isset($_POST["validationReport"])){
            
            $_POST["selectedDate"] = $_POST["selectedDate"] . " 00:00:00";
            
            // DateTime début du mois sélectionné
            $selectedDate = DateTime::createFromFormat("d/m/Y H:i:s", $_POST["selectedDate"]);
            
            $saManager = new SalarieManager($db);
            $seManager = new ServiceManager($db);
            
            $service = $seManager->get($_POST["idService"]);
            
            $salaries = $saManager->getListByService($service);
            ?>
            
            <form class="col-sm-6 col-md-8" action="process/reportForm.php">
                <table class='cadre table table-sm table-striped table-hover'>
                    <thead>
                        <tr>
                            <th>Salarié</th>
                            <th>Report</th>
                        </tr>
                    </thead>
                    
                    <tbody>
                        <?php foreach($salaries as $salarie){ ?>
                        <tr>
                            <td>
                                <?php echo mb_strtoupper($salarie->getNom(), "UTF-8") ." ". ucfirst($salarie->getPrenom()); ?>
                            </td>
                            <td>
                                <div class="input-group justify-content-center">
                                    <input class="heure text-center" name="heure[]" type="number" class="form-control" min="0" step="1" value="">
                                    <span class="input-group-addon">h</span>
                                </div>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
                
                <button id="validationReport" name="validationReportTable" class="btn btn-block btn-outline-primary">Valider</button>
            </form>
            
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
    <script src="js/planning.js"></script>
    <!-- /scripts -->
</body>

</html>