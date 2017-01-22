<!DOCTYPE html>
<html lang="fr">

<head>
    <?php
    require_once("path.php");
    require_once(includePath . "/head.php");
    require_once(includePath . "/authentification.php");
    ?>
    
    <link rel="stylesheet" href="css/index.css" />
    
    <title>Authentification</title>
</head>

<body>
    <?php require_once(includePath . "/navbar.php"); ?>
    
    <!-- content container-->
    <div class="container">
        <?php require_once(includePath . "/flash.php"); ?>
        
        <!-- formulaire de connexion -->
        <form action="index.php" method="post" class="form-signin">
            <h2 class="form-signin-heading text-center">Authentification</h2>
            
            <input name="nom" type="text" class="form-control" placeholder="Nom" required autofocus/>
            <input name="mdp" type="password" class="form-control" placeholder="Mot de passe" required/>
            
            <button class="btn btn-md btn-outline-primary btn-block" type="submit">Valider</button>
        </form>
        <!-- /formulaire de connexion -->
    </div>
    <!-- /content container -->
    
    <?php require_once(includePath . "/footer.php"); ?>
    
    <!-- scripts -->
    <?php require_once(includePath . "/scripts.php"); ?>
    <!-- /scripts -->
</body>

</html>