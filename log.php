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
    <?php require_once(includePath . "/scripts.php"); ?>
    <!-- /scripts -->
</body>
</html>