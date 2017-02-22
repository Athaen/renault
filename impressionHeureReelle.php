<!DOCTYPE html>
<html lang="fr">

<head>
    <?php
    require_once("path.php");
    require_once(includePath . "/head.php");
    
    authentificationRequise();
    
    <link rel="stylesheet" href="css/datePicker.css" />
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker3.min.css" />
    <link rel="stylesheet" href="css/multiple-select.css" />
    
    <title>Impression - Heures réelles</title>
</head>

<body>
    <?php require_once(includePath . "/navbar.php"); ?>
    
    <!-- content container -->
    <div class="container">
        <?php require_once(includePath . "/flash.php"); ?>
        
        <!-- row -->
        <div class="row">
            <!-- formulaire datepicker & services -->
            <form action="process/impressionForm.php" target="_blank" method="post" class="col-12" id="bootstrapSelectForm">
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
                    <!-- multipleselect mois -->
                    <div class="col-6">
                        <select id="selectMois" name="mois[]" multiple>
                            <option value="01">Janvier</option>
                            <option value="02">Février</option>
                            <option value="03">Mars</option>
                            <option value="04">Avril</option>
                            <option value="05">Mai</option>
                            <option value="06">Juin</option>
                            <option value="07">Juillet</option>
                            <option value="08">Août</option>
                            <option value="09">Septembre</option>
                            <option value="10">Octobre</option>
                            <option value="11">Novembre</option>
                            <option value="12">Décembre</option>
                        </select>
                    </div>
                    <!-- /multipleselect mois -->
                    
                    <!-- multipleselect service -->
                    <div class="col-6">
                        <select id="selectService" name="service[]" multiple>
                            <?php
                            
                            $seManager = new ServiceManager($db);
                            
                            foreach($seManager->getList() as $service){
                                $i++;
                                echo "<option value='". $service->getId() ."'>". mb_strtoupper($service->getLibelle(), "utf-8") ."</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <!-- /multipleselect service -->
                </div>
                <!-- /form-group -->
                
                <button id="reload" name="validationImpressionHrForm" target="_blank" class="btn btn-block btn-outline-primary">Valider</button>
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
            
            $('#selectMois').multipleSelect({
                maxHeight: 300,
                multiple: true,
                placeholder: "Sélectionnez un/plusieurs mois",
                allSelected: "Tous les mois ont été sélectionnés",
                minimumCountSelected: 6,
                countSelected: "# mois sélectionnés"
            });
            
            $('#selectService').multipleSelect({
                maxHeight: 300,
                multiple: true,
                placeholder: "Sélectionnez un/plusieurs services",
                allSelected: "Tous les services ont été sélectionnés",
                minimumCountSelected: 6,
                countSelected: "# services sélectionnés"
            });
            
            $(".ms-select-all > label").css("cursor", "pointer");            
            $(".ms-select-all > label > input").css("display", "none");
        });
    </script>
    <!-- /scripts -->
</body>

</html>
