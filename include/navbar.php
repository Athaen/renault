<nav id="overallNavbar" class="navbar navbar-toggleable-md fixed-top navbar-inverse">
    <div class="container">
        <button class="navbar-toggler navbar-toggler-center" type="button" data-toggle="collapse" data-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <?php if(isLogged()){ ?>
        <!-- if logged -->
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <!-- navbar gauche -->
            <a class="navbar-brand" href="#">Renault Faurie</a>
            
            <div class="navbar-nav mr-auto">
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" >Planning</a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="planningTheorique.php">Planning théorique</a>
                        <a class="dropdown-item" href="#">Planning réel</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">Séparateur</a>
                    </div>
                </div>
                <a class="nav-item nav-link" href="#">Impression</span></a>
            </div> <!-- /navbar gauche -->
            <!-- navbar droite -->
            <div class="navbar-nav my-auto">
                    <a class="nav-item nav-link" href="#"><i class="fa fa-user-circle fa-lg" aria-hidden="true"></i>  <?php echo ucfirst($_SESSION["auth"]->getPrenom()) . " " . strtoupper($_SESSION["auth"]->getNom()); ?></a>
                    <a class="nav-item nav-link" href="process/logout.php"><i class="fa fa-window-close fa-lg" aria-hidden="true"></i>  Déconnexion</a>
            </div> <!-- /navbar droite -->
        </div> <!-- /if logged -->
        <?php } ?>
    </div> <!-- /container -->
</nav>