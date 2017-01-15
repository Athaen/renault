<!DOCTYPE html>
<html lang="fr">
<head>
    <?php
    require_once("path.php");
    require_once(includePath . "/head.php");
    
    authentificationRequise();
    ?>
    
    <link rel="stylesheet" href="css/planningTheorique.css"/>
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker3.min.css" />
    
    <title>Planning théorique</title>
</head>
<body>
    <?php require_once(includePath . "/navbar.php"); ?>
    
    <!-- content container -->
    <div class="container">
        <?php require_once(includePath . "/flash.php"); ?>
        
        <div class="row">
            <form id="planningTheoriqueForm" action="planningTheorique.php" method="post" class="col-sm-5 col-md-4">
               <?php require_once(includePath . "/planningTheoriqueForm.php"); ?>
            </form>
            
            <?php
            
            if(isset($_POST["validationForm"])){
                $_POST["selectedDate"] = $_POST["selectedDate"] . " 00:00:00";
                
                // DateTime début du mois sélectionné
                $selectedDate = DateTime::createFromFormat("d/m/Y H:i:s", $_POST["selectedDate"]);
                
                // DateTime fin du mois sélectionné
                $plusUnMois = DateTime::createFromFormat("d/m/Y H:i:s", $_POST["selectedDate"]); 
                $plusUnMois = $plusUnMois->add(new DateInterval("P1M"));
                
                // DateInterval entre les deux DateTime
                $diff = $selectedDate->diff($plusUnMois);
                
                ?>
                    <div class='col-sm-4 col-md-8'>
                        <form action="process/planningTheoriqueForm.php" method="post">
                        <table id='planningTheoriqueTable' class='table table-sm table-striped table-hover'>
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Heures théoriques<htd>
                                    <th>Type</th>
                                </tr>
                            </thead>
                            <tbody>
                <?php
                for($i = 0; $i < $diff->format("%a"); $i++){
                    $jour = strftime("%A", $selectedDate->getTimestamp());
                    $numero = strftime("%#d", $selectedDate->getTimestamp());
                    $mois = utf8_encode(strftime("%B", $selectedDate->getTimestamp()));
                    $annee = utf8_encode(strftime("%Y", $selectedDate->getTimestamp()));
                    $selectedDate->add(new DateInterval("P1D"));
                    ?>
                        <tr>
                            <td><?php echo ucfirst($jour) . " " . $numero . " " . $mois . " " . $annee; ?></td>
                            <td>
                                <div class="input-group">
                                    <input type="number" class="form-control" min="1" max="24" step="1">
                                    <span class="input-group-addon">h</span>
                                </div>
                           </td>
                            <td>
                                    <select class="form-control" id="exampleSelect1">
                                        <option></option>
                                        <option>Maternité</option>
                                        <option>Paternité</option>
                                        <option>Maladie</option>
                                        <option>CP</option>
                                        <option>Férié</option>
                                        <option>Formation</option>
                                        <option>Récup</option>
                                        <option>RTT</option>
                                        <option>Solidarité</option>
                                    </select>
                            </td>
                        </tr>
                    <?php
                }
                ?>
                            </tbody>
                        </table>
                        <button id='singlebutton' name='validationForm' class='btn btn-block btn-outline-primary'>Valider les heures</button>
                        </form>
                    </div>
                <?php
            }
            ?>
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