    <!-- Fixed navbar -->
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">Renault Faurie</a>
            </div>
            
            <?php if(isLogged()){ ?>
            <div id="navbar" class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Planning <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="planningTheorique.php">Planning théorique</a></li>
                            <li><a href="#">Planning réel</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="#">One more separated link</a></li>
                        </ul>
                    </li>
                    <li><a href="#">Impression</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="#"><span class="glyphicon glyphicon-user" aria-hidden="true"></span>  <?php echo ucfirst($_SESSION["auth"]->getPrenom()) . " " . strtoupper($_SESSION["auth"]->getNom()); ?></a></li>
                    <li><a href="process/logout.php"><span class="glyphicon glyphicon-off" aria-hidden="true"></span>  Déconnexion</a></li>
                </ul>
            </div><!--/.nav-collapse -->
            <?php } ?>
        </div>
    </nav> <!-- /fixed navbar -->