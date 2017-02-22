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
    <link rel="stylesheet" href="css/multiple-select.css" />
    
    <title>Impression - Récapitulatif annuel</title>
</head>

<body>
    <?php require_once(includePath . "/navbar.php"); ?>
    
    <!-- content container -->
    <div class="container">
        <?php require_once(includePath . "/flash.php"); ?>
        
        <!-- row -->
        <div class="row">
            <!-- formulaire datepicker & services -->
            <form action="process/impressionRecapitulatifForm.php" target="_blank" method="post" class="col-12">
                <!-- row -->
                <div class="row">
                    <!-- datepicker -->
                    <div class="jsDatepicker datepickerImpression form-group col-12" data-date-start-view="2" data-date-min-view-mode="2" data-date-max-view-mode="2" data-container="body" data-toggle="popover" data-placement="right" data-trigger="focus" data-html="true" data-content="<i class='fa fa-exclamation-triangle'></i> Vous devez sélectionner une date"></div>
                    <input class="jsSelectedDate" type="hidden" name="selectedDate" value=""/>
                    <!-- /datepicker -->
                </div>
                <!-- /row -->
                
                <!-- form-group -->
                <div class="form-group row">
                    
                    <!-- multipleselect service -->
                    <div class="col-12">
                        <select id="selectSalarie" name="salarie[]" multiple>
                            <?php
                            
                            $seManager = new ServiceManager($db);
                            $saManager = new SalarieManager($db);
                            
                            foreach($seManager->getList() as $service){
                                $i++;
                                echo "<optgroup label='". mb_strtoupper($service->getLibelle(), "utf-8") ."'>";
                                
                                foreach($saManager->getListByService($service) as $salarie){
                                    echo "<option value='". $salarie->getId() ."'>". mb_strtoupper($salarie->getNom(), "utf-8") ." ". ucfirst($salarie->getPrenom()) ."</option>";
                                }
                                
                                echo "</optgroup>";
                            }
                            ?>
                        </select>
                    </div>
                    <!-- /multipleselect service -->
                </div>
                <!-- /form-group -->
                
                <button id="reload" name="validationRecapitulatifForm" target="_blank" class="btn btn-block btn-outline-primary">Valider</button>
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
    <script src="js/multiple-select.js"></script>
    
    <script>
        $(function(){
            $("#reload").click(function(){
                setTimeout("location.reload(true)", 100);
            });
            
            $('#selectSalarie').multipleSelect({
                maxHeight: 300,
                filter: true,
                multiple: true,
                placeholder: "Sélectionnez un ou plusieurs service(s)/salarié(s)",
                allSelected: "Tous les services ont été sélectionnés",
                minimumCountSelected: 1,
                countSelected: "# services sélectionnés"
            });
            
            $(".ms-select-all > label").css("cursor", "pointer");            
            $(".ms-select-all > label > input").css("display", "none");
        });
    </script>
    <!-- /scripts -->
</body>

</html>
