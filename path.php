<?php

setlocale (LC_TIME, 'fr_FR.utf8','fra');

define('basePath', dirname(__FILE__));
define('includePath', basePath . "/include");
define('classePath', basePath . "/classe");
define('fonctionPath', basePath . "/fonction");
define('processPath', basePath . "/process");

require_once(includePath . "/db.php");

require_once(classePath . "/salarieManager.php");
require_once(classePath . "/serviceManager.php");
require_once(classePath . "/autorisationManager.php");
require_once(classePath . "/heureManager.php");;
require_once(classePath . "/typeHeureManager.php");
require_once(classePath . "/reportManager.php");
require_once(classePath . "/arretHtManager.php");
require_once(classePath . "/heureSuppManager.php");

require_once(fonctionPath . "/authentification.php");

session_start();

?>