<!DOCTYPE html>
<html lang="fr">
<head>
    <?php
    require_once("path.php");
    require_once(includePath . "/head.php");
    require_once(includePath . "/authentification.php");
    ?>
    <link rel="stylesheet" href="css/index.css"/>
    
    <title>Authentification</title>
</head>
<body>
    <?php require_once(includePath . "/navbar.php"); ?>
    
    <div class="container">
        <?php require_once(includePath . "/flash.php"); ?>
        
        <form action="index.php" method="post" class="form-signin">
            <h2 class="form-signin-heading text-center">Authentification</h2>
            
            <input name="nom" type="text" class="form-control" placeholder="Nom" required autofocus/>
            <input name="mdp" type="password" class="form-control" placeholder="Mot de passe" required/>
            
            <button class="btn btn-lg btn-primary btn-block" type="submit">Valider</button>
        </form>
    </div> <!-- /container -->

    <!-- Scripts -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <!-- End Scripts -->
</body>
</html>