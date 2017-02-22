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
    <link rel="stylesheet" href="css/multiple-select.css" />
    
    <title>Impression -  &Eacute;tats de sortie</title>
</head>

<body>
    <?php require_once(includePath . "/navbar.php"); ?>
    
    <!-- content container -->
    <div class="container">
        <?php require_once(includePath . "/flash.php"); ?>
        
        <!-- row -->
        <div class="row">
            <!-- formulaire datepicker & services -->
            <form action="process/impressionEtatForm.php" target="_blank" method="post" class="col-12" id="bootstrapSelectForm">
                <!-- row -->
                <div class="form-group">
                    <!-- range datepicker -->
                    <div class="input-daterange input-group" id="rangeDatepicker">
                        <input type="text" class="input-sm form-control" name="dateStart" value="<?php echo date("d/m/Y"); ?>"/>
                        <span class="input-group-addon">  à  </span>
                        <input type="text" class="input-sm form-control" name="dateEnd" value="<?php echo date("d/m/Y"); ?>"/>
                    </div>
                    <!-- /range datepicker -->
                </div>
                <!-- /row -->
                
                <!-- form-group -->
                <div class="form-group">                    
                    <!-- multipleselect service -->
                    <select id="selectService" name="service[]" multiple>
                        <?php
                        
                        $seManager = new ServiceManager($db);
                        
                        foreach($seManager->getList() as $service){
                            $i++;
                            echo "<option value='". $service->getId() ."'>". mb_strtoupper($service->getLibelle(), "utf-8") ."</option>";
                        }
                        ?>
                    </select>
                    <!-- /multipleselect service -->
                </div>
                <!-- /form-group -->
                
                <button id="reload" name="validationEtatForm" target="_blank" class="btn btn-block btn-outline-primary">Valider</button>
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
//            $("#reload").click(function(){
//                setTimeout("location.reload(true)", 100);
//            });
            
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
