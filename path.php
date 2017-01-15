<?php

setlocale (LC_TIME, 'fr_FR.utf8','fra');

define('basePath', realpath(dirname(__FILE__)));
define('includePath', basePath . "/include");
define('classePath', basePath . "/classe");
define('fonctionPath', basePath . "/fonction");
define('processPath', basePath . "/process");

require_once(includePath . "/db.php");

require_once(classePath . "/salarieManager.php");
require_once(classePath . "/categorieManager.php");
require_once(classePath . "/autorisationManager.php");

require_once(fonctionPath . "/authentification.php");

session_start();

?>