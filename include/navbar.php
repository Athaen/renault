<nav id="overallNavbar" class="navbar navbar-toggleable-md fixed-top navbar-inverse">
    <div class="container">
        <button class="navbar-toggler navbar-toggler-center" type="button" data-toggle="collapse" data-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarCollapse">
            <!-- navbar gauche -->
            <a class="navbar-brand" href="#">Tulle Automobiles</a>

            <?php if(isLogged()){ ?>

            <div class="navbar-nav mr-auto">
                <!-- planning dropdown -->
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Planning</a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="planningTheorique.php">Planning théorique</a>
                        <a class="dropdown-item" href="planningReel.php">Planning réel</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="report.php">Reports</a>
                    </div>
                </div>
                <!-- /planning dropdown-->

                <!-- gestion dropdown -->
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Administration</a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="administrationSalarie.php">Gestion des salariés</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="administrationService.php">Gestion des services</a>
                    </div>
                </div>
                <!-- /gestion dropdwn -->

                <a class="nav-item nav-link" href="#">Impression</span></a>
            </div>
            <!-- /navbar gauche -->

            <!-- navbar droite -->
            <div class="navbar-nav my-auto">
                <a class="nav-item nav-link" href="#"><i class="fa fa-user-circle fa-lg" aria-hidden="true"></i>  <?php echo ucfirst($_SESSION["auth"]->getPrenom()) . " " . strtoupper($_SESSION["auth"]->getNom()); ?></a>
                <a class="nav-item nav-link" href="process/logout.php"><i class="fa fa-window-close fa-lg" aria-hidden="true"></i>  Déconnexion</a>
            </div>
            <!-- /navbar droite -->
            
            <?php } ?>
            <!-- /if logged -->            
        </div>
        <!-- /navbar-collapse -->
    </div>
    <!-- /container -->
</nav>