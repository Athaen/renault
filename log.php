<!DOCTYPE html>
<html lang="fr">
<head>
    <?php
    require_once("path.php");
    require_once(includePath . "/head.php");
    
    authentificationRequise();
    ?>
    <link rel="stylesheet" href="css/index.css"/>
    
    <title>Authentification</title>
</head>
<body>
    <?php require_once(includePath . "/navbar.php"); ?>
    
    <div class="container">
        <?php require_once(includePath . "/flash.php"); ?>
        
        <?php 
        var_dump($_SESSION["auth"]);
        ?>
    </div> <!-- /container -->

    <!-- scripts -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <!-- /scripts -->
</body>
</html>