<?php 

try{ 
    $db = new PDO('mysql:host=localhost;dbname=renault;charset=utf8', 'root', '');
   
}
catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}

?>